<?php

class CorePlugin {

  public $pluginDir;

  public function __construct()
  {
  }

  public function setPluginDir($dir)
  {
      $this->pluginDir = $dir;
  }

  public function init()
  {
    global $wp_roles;

    if (!isset( $wp_roles )) {
         $wp_roles = new WP_Roles();
    }
    
    $wp_roles->roles['editor']['name'] = 'Owner';
    $wp_roles->role_names['editor'] = 'Owner';

    unset($wp_roles->roles['administrator']['name']);
    unset($wp_roles->role_names['administrator']);
    
    $this->hideWPUpdates();
  }
  
  private function hideWPUpdates()
  {     
     if(!current_user_can('manage_options')) 
     {
        remove_action('admin_notices', 'update_nag', 3 );
     }  
  }
  
  public function addClearCacheMetaBox()
  {     
     global $current_user;     
     $allowedRoles = array('editor', 'administrator');

     if(!in_array($current_user->roles[0], $allowedRoles))
     return false;  
  
     add_meta_box(
         'clear-cache-meta-box'
        ,__('Clear WP Cache', 'myplugin_textdomain')
        ,array($this, 'cacheMetaBoxContent')
        ,'dashboard'
        ,'side'
        ,'high'
     );     
  }
  
  public function cacheMetaBoxContent()
  {
     if($_REQUEST['cmd'] == 'evoknow_clear_cache')
     {
        $this->clearWPCache();        
     }
    
     $data = array();
     $this->setPluginDir(dirname(__FILE__) . '/');
     $this->render('cache_meta', $data);
  }
  
  public function sendEmail($params)
  {
     $headers = $params['headers'];
     if ($params['from_name'] && $params['from_email'])
     {
        $headers[] = 'From: ' . $params['from_name'] . ' <' . $params['from_email'] . '>';
     } elseif ($params['from_email']) {
        $headers[] = 'From: <' . $params['from_email'] . '>';
     } 
     
     if ($params['cc']) {
        $headers[] = 'Cc: <' . $params['cc'] . '>';
     } 
     
     if ($params['bcc']) {
        $headers[] = 'Bcc: <' . $params['bcc'] . '>';
     }

     if ($params['content-type']) {
        $headers[] = 'Content-Type: ' . $params['conent-type'];
     } else {
        $headers[] = 'Content-Type: text/html';
     }

     wp_mail( $params['to'], $params['subject'], $params['message'], $headers);
  }

  public function render($template, $data, $showOutput = true)
  {
     if (!$this->pluginDir)
     {
         die("Set \$this->pluginDir for your plugin before calling render().");
     }

     $data['pluginPrefix'] = $this->prefix;

     extract($data);

     ob_start();

     $viewDir = $this->pluginDir . 'views';
     $viewFile = $viewDir . '/' . $template . '.php';

     if (file_exists($viewFile))
     {
        include($viewFile);
     } else {
       die("Missing $viewFile");
     }
 
     $output = ob_get_clean();
     if ($showOutput) {
         echo $output;
     } else {
        return $output;
     }
  }
  
   public function slug($str, $char = '-')
   {
      // Lower case the string and remove whitespace from the beginning or end
      $str = trim(strtolower($str));

      // Remove single quotes from the string
      $str = str_replace("'", '', $str);

      // Every character other than a-z, 0-9 will be replaced with a single dash (-)
      $str = preg_replace("/[^a-z0-9]+/", $char, $str);

      // Remove any beginning or trailing dashes
      $str = trim($str, $char);

      return $str;
   }  
   
   public static function sanitize($str, $char = '-')
   {
      $str = trim(strtolower($str));
   
      $str = str_replace("'", '', $str);
   
      $str = preg_replace("/[^a-z0-9.]+/", $char, $str);
   
      $str = trim($str, $char);
   
      return $str;
   }   
   
  public function getParam($key)
  {
     return $_REQUEST[$this->prefix . '_' . $key];
  }

  public function activate()
  {     
     $this->addUserManagementCap('editor');         
     //$this->addMenuManagementCap('editor');
     $params         = array();
     $params['slug'] = 'employee';
     $params['name'] = 'Employee';
     $params['cap']  = array('read' => true);
     $this->addRole($params);

     $this->removeRole('author');
     $this->removeRole('contributor');
     $this->removeRole('installer');
  }   
  
  public function deactivate()
  {
     $this->removeUserManagementCap('editor');
     $this->removeRole('employee');
  }

  public function addUserManagementCap($role)
  {
     $roleObj = get_role($role);     
     $roleObj->add_cap('create_users');
     $roleObj->add_cap('list_users');
     $roleObj->add_cap('edit_users');
     $roleObj->add_cap('delete_users');
     $roleObj->add_cap('remove_users');
  }  

  public function XXX_addMenuManagementCap($role)
  {
     $roleObj = get_role($role);     
     $roleObj->add_cap('edit_theme_options');
  }  
  
  public function removeUserManagementCap($role)
  {     
     $wp_roles = new WP_Roles();
     $wp_roles->remove_cap($role, 'create_users');   
     $wp_roles->remove_cap($role, 'list_users');   
     $wp_roles->remove_cap($role, 'edit_users');   
     $wp_roles->remove_cap($role, 'delete_users');   
     $wp_roles->remove_cap($role, 'remove_users');   
  }  
  
  public function addRole($params)
  {
     $slug = $params['slug'];
     $name = $params['name'];
     $cap  = $params['cap'];
     add_role($slug, $name, $cap);
  }
  
  public function removeRole($slug)
  {
     $wp_roles = new WP_Roles();
     $wp_roles->remove_role($slug);
  }
  
  public function clearWPCache()
  {
     $file_prefix = 'wp-cache-';
     wp_cache_clean_cache($file_prefix, true);
  }

   // Remove unwanted dashboard widgets for relevant users
   public function cleanupDashboard() 
   {
      remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
      remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
      remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
      remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
      remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
      remove_meta_box('dashboard_primary', 'dashboard', 'side');
      remove_meta_box('dashboard_secondary', 'dashboard', 'side'); 
      remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); 
   }
  
  
  public function d($r, $f = null)
  {
     echo '<pre>';
     print_r($r);
     echo '</pre>';
     
     if($f) exit;
  }
} // End of class


?>
