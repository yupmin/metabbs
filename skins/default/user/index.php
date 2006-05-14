<h1>User Information</h1>
<div id="profile">
<p><big><?=$user->name?></big> (<?=$user->user?>)</p>
<p>
<? if ($user->email) { ?>
E-mail: <a href="mailto:<?=$user->email?>"><?=str_replace("@", " at ", $user->email)?></a><br />
<? } ?>
<? if ($user->url) {
	if (strpos($user->url, "http://") !== 0)
		$user->url = 'http://' . $user->url;
?>
Homepage: <a href="<?=$user->url?>"><?=$user->url?></a><br />
<? } ?>
</p>
<p><?=$board->get_post_count()?> posts, <?=$board->get_comment_count()?> comments</p>
</div>
<table id="list">
	<tr>
		<th class="name">Board</th>
		<th class="title">Title</th>
		<th class="date">Date</th>
	</tr>
<? foreach ($posts as $post) { ?>
	<tr>
		<td class="name"><a href="<?=url_for($post->get_board())?>"><?=$post->get_board_name()?></a></td>
		<td class="title"><a href="<?=url_for($post, '', array('page' => Page::get_requested_page()))?>"><?=$post->title?></a><? if ($post->get_comment_count()>0) { ?> <a href="<?=url_for($post)?>#comments"><small>[<?=$post->get_comment_count()?>]</small></a><? } ?></td>
		<td class="date"><?=date_format("%Y-%m-%d", $post->created_at)?></td>
	</tr>
<? } ?>
</table>

<div id="nav">
<ul id="pages">
<? if (!$page->is_first()) { ?>
	<li class="first"><a href="<?=get_href($page->first())?>">&laquo;</a></li>
<? } ?>
<? if ($page->has_prev()) { ?>
	<li class="next"><a href="<?=get_href($page->prev())?>">&lsaquo;</a></li>
<? } ?>
<? foreach ($pages as $p) { ?>
<? if (!$p->here()) { ?>
	<li><a href="<?=get_href($p)?>"><?=$p->page?></a></li>
<? } else { ?>	
	<li class="here"><a href="<?=get_href($p)?>"><?=$p->page?></a></li>
<? } ?>
<? } ?>
<? if ($page->has_next()) { ?>
	<li class="next"><a href="<?=get_href($page->next())?>">&rsaquo;</a></li>
<? } ?>
<? if (!$page->is_last()) { ?>
	<li class="last"><a href="<?=get_href($page->last())?>">&raquo;</a></li>
<? } ?>
</ul>
</div>
