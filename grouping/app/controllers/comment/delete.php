<?php
$post = $comment->get_post();
if (!$account->has_perm($board, 'moderate') && $comment->user_id != $account->id) {
	access_denied();
}
if (is_post() && ($comment->user_id != 0 && $account->id == $post->user_id || $account->has_perm($board, 'moderate') || $post->user_id == 0 && $comment->password == md5($_POST['password']))) {
	$comment->delete();
	redirect_to(url_for($post));
} else {
	$link_cancel = url_for($post);

	if ($comment->user_id != 0 && $comment->user_id == $account->id ||
		$account->has_perm($board, 'moderate')) {
		$ask_password = false;
	} else {
		$ask_password = true;
	}
}
?>