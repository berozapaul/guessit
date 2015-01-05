<?php
class  SweetGuess extends CorePlugin {

  public function __construct()
  {
      $this->pluginDir = plugin_dir_path(__FILE__);
  }

  public function showForm($attr, $content)
  {
     $data = array();
     $name = $attr['name'];
     $form = $this->slug($name);

     if (!$_POST)
     {
        $this->render($form, $data);

     } else {
        if ($status = $this->save())
        {
           $this->render('thankyou', array('name' => $_REQUEST['applicant_name'], 'status' => $status));
        }
     }
  }

  public function save()
  {
     global $wpdb;

     // Do not continue if nonce security field  
     if ( !isset($_REQUEST['identity']) || !wp_verify_nonce($_REQUEST['identity'],'check_identity') )
     {
        die("Failed security.");
     }

     // Create a new resume post
     $category = get_category_by_slug('job-applications');

     $newResume = array(
        'post_title'    => wp_strip_all_tags( "Job Application of " . $_REQUEST['applicant_name']),
        'post_status'   => 'private',
        'post_author'   => 1,
        'post_category' => array( $category->term_id )
      );

     if ($postId = wp_insert_post( $newResume ))
     {
         // Attach the file to the post
         $attachmentId = media_handle_upload('resume', $postId);
         $link         = wp_get_attachment_link($attachmentId);
         $_REQUEST['link'] = $link;
         $contents = $this->render('job-post', $_REQUEST, false);
         $updatePost = array( 'ID' => $postId, 'post_content' => $contents);
         wp_update_post( $updatePost );

     }

     if ($_REQUEST['email'])
     {
         $_REQUEST['permalink'] = get_permalink($postId);
         $this->sendEmailToSubmitter($_REQUEST['applicant_name'], $_REQUEST['email']);
         $this->sendEmailToAdmin($_REQUEST);
     }
     return true;
  }
  
  public function showAdminHome()
  {
     $cmd  = $_REQUEST['cmd'];

     switch($cmd)
     {

        case 'delete'  :  $this->delete(); break;
     }

     $data = array();
     $data['list'] = $this->getForms();
     $this->render('list', $data);
  }  
  
  public function getForms()
  {
  }

  public function delete()
  {
     $res = new stdclass();
     $res->success = false;
     
     $res->success = true;
     echo json_encode($res);
     exit;    
  }
  
  private function sendEmailToAdmin($data)
  {
     $user = get_user_by('login', 'michael');
     $params['id']         = $data['id'];
     $params['to']         = $user->user_email;
     $params['from_name']  = 'Web Site';
     $params['from_email'] = 'noreply@' . $_SERVER['HTTP_HOST'];
     $params['subject']    = 'New Job Application : ' . ucwords(strtolower($data['applicant_name'])) 
                              . ' ' . date('m/d/Y H:i:s A T');
     $params['fields']     = $data;
     $params['message']    = $this->render('email_to_admin', $data, false);
     $this->sendEmail($params);
  }

  private function sendEmailToSubmitter($name, $email)
  {
     $params['name']       = $name;
     $params['email']      = $email;
     $params['to']         = $email;
     $params['from_name']  = 'Web Site';
     $params['from_email'] = 'noreply@' . $_SERVER['HTTP_HOST'];
     $params['subject']    = 'Thank You For Your Feedback ';
     $params['message']    = $this->render('email_to_submitter', $params, false);
     $this->sendEmail($params);
  }
  
  public function setupAdminMenu()
  {
     global $current_user;  
     $allowedRoles = array('editor', 'administrator');
 
     if(!in_array($current_user->roles[0], $allowedRoles))
     return false;
     
     add_menu_page('Pending Forms', 'Forms', 'read', __FILE__, array($this, 'showAdminHome'), '');       
  }  
  
  public function activate()
  {     
     // $this->createTable($ddl);
  }   
  
  public function deactivate()
  {
  }   
} // End of class
