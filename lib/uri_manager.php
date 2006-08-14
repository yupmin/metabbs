<?php
function get_base_uri() {
	static $uri;
	if (!isset($uri)) {
		$uri = METABBS_BASE_PATH;
		if (!isset($_GET['redirect'])) {
			$uri .= 'metabbs.php/';
		}
	}
	return $uri;
}

function chomp(&$str) {
	$str = substr($str, 0, -1);
}

function get_href($model) {
	if (is_string($model)) {
		return $model;
	} else {
		return $model->get_model_name() . '/' . $model->get_id();
	}
}

function _url_for($controller, $action = null, $params = array()) {
	$url = get_base_uri() . get_href($controller);

	if ($action)
		$url .= '/' . $action;

	if ($params) {
		$url .= "?";
		foreach ($params as $key => $value)
			$url .= "$key=$value&";
		chomp($url);
	}

	return $url;
}

function full_url_for($controller, $action = '') {
	return 'http://'.$_SERVER['HTTP_HOST']._url_for($controller, $action);
}

function url_for($controller, $action = null, $params = array()) {
	if (isset($_GET['search']) && $_GET['search']) {
		foreach ($_GET['search'] as $k => $v) {
			if ($v) $params["search[$k]"] = urlencode($v);
		}
	}
	return _url_for($controller, $action, $params);
}
function url_with_referer_for($controller, $action = null, $params = array()) {
	$params['url'] = urlencode($_SERVER['REQUEST_URI']);
	if (isset($GLOBALS['board'])) {
		$params['board_id'] = $GLOBALS['board']->id;
	}
	return url_for($controller, $action, $params);
}

function redirect_to($url) {
	header('Location: ' . $url);
	exit;
}

function redirect_back() {
	if (isset($_GET['url'])) {
		redirect_to($_GET['url']);
	} else {
		redirect_to(url_for(""));
	}
}

?>
