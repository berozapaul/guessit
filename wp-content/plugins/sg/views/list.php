<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<script type="text/javascript">var $ = jQuery.noConflict();</script>

<?php 
   global $current_user;
   $addNewUrl    = admin_url() . 'admin.php?page=add-new-event';   
?>

<div class="wrap">
<div class="ef_icon_container"><i class="icon-inbox icon-2x"></i></div>
<div ><h2>Recently Submitted Forms</h2> </div>
<div class="clear"></div>

<div id="ef_dashboard_container">
<?php if ($_REQUEST['cmd']): ?>
<div class="message">
The submission #<?=$_REQUEST['id'];?> has been <?=$_REQUEST['cmd'];?>d.
</div>
<?php endif;?>
<?php if($list):?>
   <table class="wp-list-table widefat">
   <thead>
   <tr>
      <th>Id</th>      
      <th>Date</th>      
      <th>Form Name</th>
      <th>Submitted By</th>
      <th>Action</th>
   </tr>
   </thead>
   <?php 
      foreach($list as $thisSubmission):
        $submittedData = base64_encode(serialize($thisSubmission));
   ?>
   <tr>
      <td><?=$thisSubmission->id;?></td>
      <td><?=date('m/d/y', strtotime($thisSubmission->entry_date));?></td>
      <td><?=$thisSubmission->form_name;?></td>
      <td><?=$thisSubmission->submitted_by;?></td>
      <td>
      <?php if ($thisSubmission->status == 0): ?>
         <a href="javascript:void(0);" onclick="tpApproveFeedback('<?=$submittedData?>');"><i class="icon-ok-sign icon-large"></i></a>&nbsp;&nbsp;                
      <?php endif; ?>
      <?php if ($thisSubmission->status != 2): ?>
         <a href="javascript:void(0);" onclick="tpTrashFeedback(<?=$thisSubmission->id;?>, 2);"><i class="icon-archive icon-large"></i></a>&nbsp;&nbsp; 
         <?php endif; ?>
      <?php if ($thisSubmission->status != 3): ?>
         <a href="javascript:void(0);" onclick="tpTrashFeedback(<?=$thisSubmission->id;?>, 3);"><i class="icon-trash icon-large"></i></a>
         <?php endif; ?>
      </td>
   </tr>      
   <?php endforeach;?>
   </table>
<?php else:?>
<div class="ef_empty_event">
<p>The system does not have any pending form submissions yet.</p>
</div>
<?php endif;?>
</div>
</div> <!-- End of wrap div -->

<script type="text/javascript">
function tpApproveFeedback(data)
{
   $.ajax(
   {
       url: '/wp-admin/admin-ajax.php',
       type: 'POST', 
       dataType: 'json',            
       data:{"data" : data, "action" : 'tp_approve_thisSubmission'},
       success: function(res)
       {
          if(res.success)
          {
             document.location.reload();
          }
       }
   });
}

function tpTrashFeedback(id, status)
{
   if(!confirm('Are you sure you want to do this action?')) return false;
   
   $.ajax(
   {
       url: '/wp-admin/admin-ajax.php',
       type: 'POST', 
       dataType: 'json',            
       data:{"thisSubmission_id" : id, "status" : status, "action" : 'tp_delete_thisSubmission'},
       success: function(res)
       {
          if(res.success)
          {
             document.location.reload();
          }
       }
   });   
}
</script>

<style type="text/css">
.wp-list-table th{font-weight:bold;}
.wp-list-table .ef_title_and_time{font-weight:bold;}

.ef_icon_container{float:left;margin:11px 20px 0 0;}
#tp_dashboard_container{margin-top:50px;}

.ef_add_new{float:right;text-decoration:none !important;}
.ef_empty_event{margin-top:5px;}
.ef_empty_event a{text-decoration:none;}

.message {color: #b94a48;background-color:#f2dede;
   border:#eed3d7 solid 1px;
   border-radius: 5px;
   -moz-border-radius: 5px;
   padding: 10px;
   font-size: 13px;
   position: relative;
   margin: 0 0 15px 0;
}

</style>
