<?php
permission_required('comment', $post);

if (!isset($_POST['comment'])) {
	$_POST['comment'] = array(
		'name' => @$_POST['author'],
		'password' => @$_POST['password'],
		'body' => $_POST['body']
	);
}

$comment = new Comment($_POST['comment']);
if (!$comment->valid()) {
	exit;
}
$comment->user_id = $account->id;
if (!$account->is_guest()) {
	$comment->name = $account->name;
} else {
	cookie_register('name', $comment->name);
}
$comment->post_id = $post->id;

apply_filters('PostComment', $comment, array('reply' => false));
apply_filters('ValidateCommentCreate', $_POST, $error_messages);

if (empty($post->name))
	$error_messages->add('Please enter the name', 'author');

if (empty($post->body))
	$error_messages->add('Please enter the body', 'body');

if ($account->is_guest() && strlen($post->password) < 5)
		$error_messages->add('Password length must be longer than 5', 'password');

if(!$error_messages->exists()) {
	$post->add_comment($comment);

	apply_filters('AfterPostComment', $comment, array('reply' => false));

	if (is_xhr()) {
		$template = get_template($board, '_comment');
		apply_filters('PostViewComment', $comment);
		$template->set('board', $board);
		$template->set('comment', $comment);
		$template->render_partial();
		exit;
	} else {
		redirect_to(url_for($post));
	}
}
?>