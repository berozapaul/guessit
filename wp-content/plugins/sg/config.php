<?php

$prefix      = 'sg_'; 
$pluginClass = 'SweetGuess';
$pluginName  = basename(dirname(__FILE__));
$GLOBALS['prefix'] = $prefix;
$GLOBALS[$prefix . 'plugin_dir'] = str_replace('\\', '/', dirname(__FILE__));
$GLOBALS[$prefix . 'plugin_url'] = admin_url() . 'admin.php?page=' . $pluginName . '/' . $pluginClass . '.php';
