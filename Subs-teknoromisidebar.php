<?php
// No Direct Access!
if (!defined('SMF'))
	die('Hacking attempt...');
function teknoromisidebarsol()
{
	global $boarddir,$modSettings,$txt,$settings,$context;
	echo'<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tbody><tr>';
		require_once($boarddir . '/SSI.php');
		
		if (!empty($modSettings['sideleft'])&& empty($context['current_action']))
			{
		    echo '<td valign="top">
			<button type="button" id="teknoleft" title="" onclick="leftPanel.toggle();"></button>
			</td>
			<td valign="top" id="upshrinkLeftBarTD">
				<div id="upshrinkLeftBar" style="width:',$modSettings['sideleftwidth'] ? $modSettings['sideleftwidth'] :'200px','; margin-right:4px; overflow:auto;" >';
				if (!empty($modSettings['sideleft1']))
				{
					echo'<div class="cat_bar">
							<h3 class="catbg">
							'.$modSettings['lefthtmlbaslik'].'
							</h3></div>';
					echo''.$modSettings['sideleft1'].'';
				}
				if (!empty($modSettings['sideleftphp']))
				{	
					echo'<div class="cat_bar"><h3 class="catbg">'.$modSettings['leftphpbaslik'].'</h3></div>';
					eval($modSettings['sideleftphp']);
				}	
				if (!empty($modSettings['sidelefthaberetkin']))
				{
				$array = ssi_boardNews($modSettings['sidelefthaber'], $modSettings['sideleftsay'], null, 1000, 'array');
					echo'<div class="cat_bar">
							<h3 class="catbg">',$modSettings['lbaslik'],'</h3>
						</div>';
					global $memberContext;	
					foreach ($array as $news)
					 {
					  loadMemberData($news['poster']['id']);
					  loadMemberContext($news['poster']['id']);
						  echo '<div class="sidehaber">
								<div class="sideBaslik">
								', $news['icon'], '
								<h3><a href="', $news['href'], '">', $news['subject'], '</a></h3>
								</div>
								<div class="snrj"> ', $memberContext[$news['poster']['id']]['avatar']['image'],' 
								<p>', $txt['by'], '', $news['poster']['link'], '</p>
								</div>
								</div><hr/>';
					 }
				} 
				echo'</div>
			</td>';
			}
			echo '<td valign="top" width="100%">
			<table id="maintable" border="0" width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td valign="top">';
}		

function teknoromisidebarsag()
{
	global $boarddir,$modSettings,$txt,$context;
	require_once($boarddir . '/SSI.php');
	echo '</td></tr></tbody></table>';
	
		if (!empty($modSettings['sideright'])&& empty($context['current_action']))
			{
			echo '<td valign="top" id="upshrinkRightBarTD">
				<div id="upshrinkRightBar" style="width:',$modSettings['siderightwidth'] ? $modSettings['siderightwidth'] :'200px','; margin-right:4px; overflow:auto;">';
				if (!empty($modSettings['sideright1']))
				{
					echo'<div class="cat_bar"><h3 class="catbg">'.$modSettings['righthtmlbaslik'].'</h3></div>';
					echo''.$modSettings['sideright1'].'';
				}
				if (!empty($modSettings['siderightphp'])){
					echo'<div class="cat_bar"><h3 class="catbg">'.$modSettings['rightphpbaslik'].'</h3></div>';
					eval($modSettings['siderightphp']);}
				if (!empty($modSettings['siderighthaberetkin']))
				{
				$array = ssi_boardNews($modSettings['siderighthaber'], $modSettings['siderightsay'], null, 1000, 'array');
					echo'<div class="cat_bar">
							<h3 class="catbg">',$modSettings['rbaslik'],'</h3>
						</div>';
					global $memberContext;	
					foreach ($array as $news)
					 {
					  loadMemberData($news['poster']['id']);
					  loadMemberContext($news['poster']['id']);
						  echo '<div class="sidehaber">
								<div class="sideBaslik">
								', $news['icon'], '
								<h3><a href="', $news['href'], '">', $news['subject'], '</a></h3>
								</div>
								<div class="snrj"> ', $memberContext[$news['poster']['id']]['avatar']['image'],' 
								<p>', $txt['by'], '', $news['poster']['link'], '</p>
								</div>
								</div><hr/>';
					 }
				 } 
				echo '</div>
			</td>
			<td valign="top">
			<button type="button" onclick="rightPanel.toggle();" id="teknoright"></button>
			</td>';
			}
				echo '
		</tr></tbody></table>';
}		

function teknoromisidebarscript()
{
echo '<script type="text/javascript"><!-- // --><![CDATA[
		var teknoromi_sidebar = new Object();
		teknoromi_sidebar["left"] = "left Panel";
		teknoromi_sidebar["right"] = "right Panel";
		function setUpshrinkTitles() {if(this.opt.bToggleEnabled){ var panel = this.opt.aSwappableContainers[0].substring(8, this.opt.aSwappableContainers[0].length - 3).toLowerCase(); document.getElementById("tekno" + panel).setAttribute("title", (this.bCollapsed ? "Hide the " : "Show the ") + teknoromi_sidebar[panel]);}}	
		var leftPanel=new smc_Toggle({bToggleEnabled:true,bCurrentlyCollapsed:false,funcOnBeforeCollapse:setUpshrinkTitles,funcOnBeforeExpand:setUpshrinkTitles,aSwappableContainers:[\'upshrinkLeftBar\'],oCookieOptions:{bUseCookie:true,sCookieName:\'upshrleftPanel\',sCookieValue:\'0\'}});	
		var rightPanel=new smc_Toggle({bToggleEnabled:true,bCurrentlyCollapsed:false,funcOnBeforeCollapse:setUpshrinkTitles,funcOnBeforeExpand:setUpshrinkTitles,aSwappableContainers:[\'upshrinkRightBar\'],oCookieOptions:{bUseCookie:true,sCookieName:\'upshrrightPanel\',sCookieValue:\'0\'}});	
// ]]></script>';
}
function teknoromisidebar_admin_areas(&$admin_areas)
{
	global $txt;
		loadLanguage('teknoromisidebar');
	$admin_areas['config']['areas']['modsettings']['subsections']['teknoromisidebar'] = array($txt['teknoromisidebartitle']);
}
function teknoromisidebarSettings($return_config = false)
{
	global $modSettings, $webmaster_email, $txt, $scripturl, $context, $sc, $smcFunc;
		loadLanguage('teknoromisidebar');
	$boards = array();
	$request = $smcFunc['db_query']('order_by_board_order', '
		SELECT b.id_board, b.name AS board_name, c.name AS cat_name
		FROM {db_prefix}boards AS b
			LEFT JOIN {db_prefix}categories AS c ON (c.id_cat = b.id_cat)',
		array(
		)
	);
	while ($row = $smcFunc['db_fetch_assoc']($request))
		$boards[$row['id_board']] = $row['cat_name'] . ' - ' . $row['board_name'];
	$smcFunc['db_free_result']($request);
	$config_vars = array(
	      
			array('check', 'sideleft'),
			array('text', 'sideleftwidth'),
			array('text', 'lefthtmlbaslik'),
			array('large_text', 'sideleft1'),
			array('text', 'leftphpbaslik'),
			array('large_text', 'sideleftphp'),
			array('check', 'sidelefthaberetkin'),
			array('text', 'lbaslik'),
			array('select', 'sidelefthaber', $boards,),
			array('int', 'sideleftsay'),
			'',
			array('check', 'sideright'),
			array('text', 'siderightwidth'),
			array('text', 'righthtmlbaslik'),
			array('large_text', 'sideright1'),
			array('text', 'rightphpbaslik'),
			array('large_text', 'siderightphp'),
			array('check', 'siderighthaberetkin'),
			array('text', 'rbaslik'),
	        array('select', 'siderighthaber', $boards,),
			array('int', 'siderightsay'),
	);
	
	
if ($return_config)
		return $config_vars;

	$context['post_url'] = $scripturl . '?action=admin;area=modsettings;save;sa=teknoromisidebar';
	$context['settings_title'] = $txt['teknoromisidebartitle'];

	// Saving?
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=modsettings;sa=teknoromisidebar');
	}

	prepareDBSettingContext($config_vars);
}
