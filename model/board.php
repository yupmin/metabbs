<?php
model('post');
model('user');

class Board extends Model {
	var $count;
	var $name, $title;
	var $skin = 'default';
	var $posts_per_page = 10;
	var $searchtype = '';
	var $search = '';

	function get_id_for_href() {
		return $this->name;
	}
	function find_by_name($name) {
		return model_find('board', null, "name='$name'");
	}
	function find($id) {
		return model_find('board', $id);
	}
	function find_all() {
		return model_find_all('board');
	}
	function get_where() {
        	if ($this->searchtype) {
			$searchtype = $this->searchtype;
		}
		else {
			$searchtype = 'tb';
		}
		$search = '%' . $this->search . '%';
		if ($searchtype == 'tb') {
			return "(title LIKE '$search' OR body LIKE '$search')";
		}
		else if ($searchtype == 't') {
			return "title LIKE '$search'";
		}
		else if ($searchtype == 'b') {
			return "body LIKE '$search'";
		}
	}
	function get_posts($offset, $limit) {
		$where = "board_id=$this->id";
		if ($this->search) {
			$where .= " AND " . $this->get_where();
		}
		return model_find_all('post', $where, 'id DESC', $offset, $limit);
	}
	function get_post_count() {
		if (!$this->count) {
			$where = "board_id=$this->id";
			if ($this->search) {
				$where .= " AND (title LIKE '%$this->search%' OR body LIKE '%$this->search%')";
			}
			$this->count = model_count('post', $where);
		}
		return $this->count;
	}
	function validate() {
		$board = Board::find_by_name($this->name);
		return !$board->exists();
	}
	function create() {
		model_insert('board', array(
			'name' => $this->name,
			'skin' => $this->skin,
			'posts_per_page' => $this->posts_per_page,
			'title' => $this->title,
			'use_attachment' => $this->use_attachment,
			'perm_read' => $this->perm_read,
			'perm_write' => $this->perm_write,
			'perm_comment' => $this->perm_comment,
			'perm_delete' => $this->perm_delete));
	}
	function update() {
		model_update('board', array(
			'name' => $this->name,
			'skin' => $this->skin,
			'posts_per_page' => $this->posts_per_page,
			'title' => $this->title,
			'use_attachment' => $this->use_attachment,
			'perm_read' => $this->perm_read,
			'perm_write' => $this->perm_write,
			'perm_comment' => $this->perm_comment,
			'perm_delete' => $this->perm_delete),
		'id='.$this->id);
	}
	function delete() {
		model_delete('board', 'id='.$this->id);
		model_delete('post', 'board_id='.$this->id);
	}
}
?>