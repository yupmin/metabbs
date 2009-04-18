<?php
define('METABBS_VERSION', '0.12-devel');
// template
define('DEFAULT_VIEW', 0);
define('ADMIN_VIEW', 1);
// permission
define('ASK_PASSWORD', 2);
// i18n;
define('SOURCE_LANGUAGE', 'en');
// plugin - Filter API
define('META_FILTER_OVERWRITE', 1);		// 필터 충돌시 겹쳐쓴다.
define('META_FILTER_PREPEND', 2);		// 필터 충돌시 앞에 쓴다.
define('META_FILTER_APPEND', 3);		// 필터 충돌시 뒤에 쓴다.
define('META_FILTER_CALLBACK', 4);		// 충돌시 콜백 함수를 호출한다.

requireCore('config');
$config = new Config(METABBS_DIR . '/metabbs.conf.php');

$backend = $config->get('backend', 'mysql');
if (!defined('METABBS_BASE_PATH')) {
	define('METABBS_BASE_PATH', $config->get('base_path', $metabbs_base_path));
}
requireCore('query');
$__cache = new ObjectCache;
requireModel('metadata');
requireCore('model');
requireCore('backends/' . $backend . '/backend');

$__db = get_conn();
set_table_prefix($config->get('prefix', 'meta_'));

$filters = array();
$handlers = array();
$__plugins = array();
$__admin_menu = array();
$extra_attributes = array();

// core
requireModel('user');
requireModel('plugin');
// common
requireModel('site');
requireModel('board');
requireModel('category');
requireModel('uncategorized_posts');
requireModel('post');
requireModel('post_finder');
requireModel('comment');
requireModel('trackback');
requireModel('attachment');
requireModel('tag');
requireModel('tag_post');

// core
requireCore('template');
requireCore('account');
requireCore('timezone');
requireCore('permission');
requireCore('request');
requireCore('i18n');
requireCore('cookie');
requireCore('tag_helper');
requireCore('plugin');
requireCore('metadata');
requireCore('trackback');
requireCore('theme');
requireCore('feed');
requireCore('validate');
requireCore('message');
requireCore('csrf');
requireCore('dispatcher');
?>
