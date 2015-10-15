<?php
// If SSI.php is in the same place as this file, and SMF isn't defined, this is being run standalone.
if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');
// Hmm... no SSI.php and no SMF?
elseif (!defined('SMF'))
	die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php.');
$hooks = array(
	'integrate_pre_include' => '$sourcedir/Subs-teknoromisidebar.php',
	'integrate_admin_areas' => 'teknoromisidebar_admin_areas',
);
// Adding or removing them?
if (!empty($context['uninstalling']))
	$call = 'remove_integration_function';
else
	$call = 'add_integration_function';
// Do the deed
foreach ($hooks as $hook => $function)
	$call($hook, $function);


// If we're using SSI, tell them we're done
if (SMF == 'SSI')
	echo 'Database changes are complete!';

?>


