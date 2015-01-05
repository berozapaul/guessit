<?php

list($first, $last) = explode(' ', trim(ucwords(strtolower($name))));

?>
<?php if ($status): ?>
<h2>Thank you very much!</h2>
<?=$first;?>, we are very glad to know that you are interested to work with us.<br>
Once we have reviewed your application, we will  get back to you as soon as possible.<br>
<?php else: ?>
<h2>Sorry, something went wrong and we could not save your application.</h2>
Can you please, please try again later.
<?php endif;?>

