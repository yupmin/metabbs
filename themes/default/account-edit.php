<? include "_account_menu.php" ?>

<h1><?=i('Account Edit')?></h1>

<?=flash_message_box()?>
<?=error_message_box($error_messages)?>
<form method="post" action="<?=url_with_referer_for('account', 'edit', $params)?>" id="account-edit-form">
<fieldset>
<h2>기본 정보</h2>
<p>
	<label><?=i('User ID')?></label>
	<?=$account->user?>
</p>
<? if (!$account->is_openid_account()): ?>
<p>
	<label><?=i('Password')?></label>
	<input type="password" name="user[password]" class="ignore <?=marked_by_error_message('password', $error_messages)?>"/>
</p>
<? endif; ?>
<p>
	<label><?=i('Screen name')?><span class="star">*</span></label>
	<input type="text" name="user[name]" value="<?=$account->name?>" />
</p>
<p>
	<label><?=i('E-Mail Address')?><span class="star">*</span></label>
	<input type="text" name="user[email]" size="50" class="ignore <?=marked_by_error_message('email', $error_messages)?>" value="<?=$account->email?>" />
</p>
</fieldset>
<fieldset>
<h2>추가 정보</h2>
<p>
	<label><?=i('Homepage')?></label>
	<input type="text" name="user[url]" size="50" class="ignore <?=marked_by_error_message('url', $error_messages)?>" value="<?=$account->url?>" />
</p>
<p>
	<label><?=i('Signature')?></label>
	<textarea name="user[signature]" cols="50" rows="5" class="ignore"><?=$account->signature?></textarea>
</p>
<p><input type="submit" value="<?=i('Edit Info')?>" class="button"/>
<? if (isset($params['url']) && !empty($params['url'])): ?> <a href="<?=$params['url']?>" class="button dialog-close"><?=i('Cancel')?></a><? endif; ?></p>
</fieldset>
</form>
