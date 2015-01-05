<?php

$name = ucwords(strtolower($name));

list($first, $last) = explode(' ', $name);

$first =  empty($first) ? $name : $first;

?>

Dear <?=$first;?>,<br>
<p>
Thank you very much for applying for a position with our company.
Once we review your application, we will get back to you as soon as possible.
</p>
<p>
Regards,
</p>

Michael J. Dove<br>
<a href="http://michaeljdove.com">michaeljdove.com</a>

