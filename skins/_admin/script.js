function $(id) { return document.getElementById(id); }
function editCategory(id, url) {
	$(id).innerHTML = '&rarr; <form method="post" action="' + url + '"><input type="text" name="new_name" size="10" /></form>';
}
Function.prototype.bind = function (o) {
	var __method = this;
	return function () {
		return __method.apply(o, arguments);
	}
}
function RemoteForm(form) {
	this.form = form;
	if (window.XMLHttpRequest) {
		this.xhr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		this.xhr = new ActiveXObject('Microsoft.XMLHTTP');
	} else {
		this.xhr = null;
	}
}
RemoteForm.prototype.onStateChange = function () {
	if (this.xhr.readyState == 4) {
		this.onComplete();
	}
}
RemoteForm.prototype.send = function () {
	this.xhr.onreadystatechange = this.onStateChange.bind(this);
	this.xhr.open(this.form.method, this.form.action, true);
	this.xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	this.xhr.send(this.serialize());
}
RemoteForm.prototype.serialize = function () {
	var length = this.form.elements.length;
	var elements = this.form.elements;
	var parts = [];
	for (var i = 0; i < length; i++) {
		var el = elements[i];
		// TODO: add support for <select>
		if (['input', 'textarea'].indexOf(el.tagName.toLowerCase()) != -1) {
			if (el.name) {
				parts.push(escape(el.name) + '=' + escape(el.value));
			}
		}
	}
	return parts.join('&');
}
function addNewBoard(form) {
	if (!form.name.value) {
		form.name.className = 'empty';
		return false;
	} else {
		form.name.className = '';
	}
	var rf = new RemoteForm(form);
	rf.onComplete = function () {
		var result = this.xhr.responseText;
		if (result) {
			$('boards').innerHTML += result;
			this.form.name.value = '';
		} else {
			alert("Board '" + this.form.name.value + "' already exists.");
		}
	}
	rf.send();
	return false;
}
