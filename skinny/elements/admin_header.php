<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?=$title?></title>
	<?php $layout->print_head(); ?>
</head>
<body>
<div id="meta-admin">
<h1><?=i('MetaBBS Administration')?></h1>
<div id="header">
<?=link_to(i('Boards'), 'admin')?> |
<?=link_to(i('Users'), 'admin', 'users')?> |
<?=link_to(i('Settings'), 'admin', 'settings')?> |
<?=link_to(i('Plugins'), 'admin', 'plugins')?> |
<?=link_to(i('Backup and Restore'), 'admin', 'backup')?> |
<?=link_to(i('Uninstall'), 'admin', 'uninstall')?> |
<? foreach ($__admin_menu as $item) echo $item . ' | '; ?>
<a href="<?=url_with_referer_for('account', 'logout')?>"><?=i('Logout')?> &raquo;</a></p>
</div>
<div id="body">
<? if (isset($flash)) { ?>
<div class="flash <?=$flash_class?>">
<p><?=$flash?></p>
</div>
<? } ?>