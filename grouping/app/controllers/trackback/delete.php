<?php
$trackback = Trackback::find($id);
$post = $trackback->get_post();
$board = $post->get_board();
if (!$account->has_perm($board, 'moderate')) {
	access_denied();
}
$trackback->delete();
redirect_to(url_for($post));
?>