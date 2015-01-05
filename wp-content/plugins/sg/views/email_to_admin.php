<?php
  $prefix      = $GLOBALS['prefix'];
  $deleteUrl   = admin_url() . $GLOBALS[$prefix . 'plugin_url'] . '&id=' . $id. '&cmd=delete';
  $name        = ucwords(strtolower($applicant_name));
?>

Dear Admin,<br>
<p>
You have a new job application from <?=$name;?><br>
</p>
Here are the application details :<br>

<h3><?=$name;?></h3>
Email: <?=$email;?><br>
Phone: <?=$phone;?><br>
Submitted on: <?=date('m/d/Y H:i:s A T');?><br>

<?php if ($experience): ?> <p><h3>Experience</h3> <?=$experience;?> </p><?php endif; ?>

<?php if ($pitch): ?> <h3>Why <?=$name;?> thinks s/he is the best fit for this job:</h3> <?=$pitch;?> <?php endif; ?>

<p>
You can view the entire application and any uploaded resume file at: <br>
<?=$permalink;?>
</p>

<hr>
<?=$name;?> uses <?=$_SERVER['HTTP_USER_AGENT'];?> from ip address <?=$_SERVER['REMOTE_ADDR'];?>.
