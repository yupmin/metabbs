<?php
$profiles = array(
	'board' => array(
		'order_by' => 'created_at DESC'),
	'gallery' => array(
		'use_attachment' => true,
		'style' => 'gallery-default',
		'order_by' => 'created_at DESC',
	),
	'blog' => array(
		'use_attachment' => true,
		'use_category' => true,
		'posts_per_page' => 5,
		'perm_write' => 255,
		'style' => 'blog-default',
		'order_by' => 'created_at DESC',
	)
);

$board = new Board(array('name' => $params['name']));
if (empty($params['name']))
	$error_messages->add('Board name is empty');

if (!$board->validate())
	$error_messages->add("Board '$board->name' already exists");

// 이름 규칙 영문_-만

if (!$error_messages->exists()) {
	$profile = $profiles[$params['profile']];
	$board->import($profile);
	$board->create();
	Flash::set('Board has been created');
	redirect_to(url_admin_for('board'));
}
$boards = Board::find_all();
?>