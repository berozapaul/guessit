<?php

 list($first, $last) = explode(' ', trim(ucwords($name)));

?>
<h1>Job Applicant: <?=ucwords(strtolower($name)); ?></h1>
This job application by <?=$first;?> was submitted on <?=date('m/d/Y H:i:s A T');?><br>

<p>
Full Name: <?=$name;?><br>
Email Address: <?=$email;?>
</p>
<p>
Here is what <?=$first;?> told us about the job experience:<br>
<?=nl2br($experience);?>
</p>

<p>
Here is what <?=$first;?> told us about why s/he is best qualified to work for the company <br>
Tell us about why you think you are good fit for our company:<br>
<?=nl2br($pitch);?>
</p>

<?php if ($link): ?>
<h3>Here is the resume <?=$first;?> provided:<br>
<?=$link;?>
<?php endif;?>

<hr>
<?=$first;?> uses <?=$_SERVER['HTTP_USER_AGENT'];?> from ip address <?=$_SERVER['REMOTE_ADDR'];?>.
