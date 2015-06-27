<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Articles_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	function get($id){
		$this->db->select('n.id, n.title, n.preview, n.body, n.date, n.count, n.user_id')
		->select('u.username as user_name')
		->from('news n')
		->join('users u', 'n.user_id = u.id', 'left')
		->where('n.id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	function getArticles()
	{
		$this->db->select('n.id, n.title, n.preview, n.date, n.count, n.user_id')
		->select('u.username as user_name')
		->from('news n')
		->join('users u', 'u.id = n.user_id', 'left');
		$query = $this->db->get();
		return $query->result_array();
	}
	//add to table 
	function add_article($data){
		return $this->db->insert('news', $data);
	}
	//update where id 
	function update_article($data){
		$this->db->where('id', $data['id']);
		return $this->db->update('news', $data);
	}
	//delete 
	function del_article($id){
		$this->db->where('id', $id);
		return $this->db->delete('news');
	}
	function update_counter($id) {
	  // return current article views
	  $this->db->where('id', $id);
	  $this->db->select('count');
	  $data = $this->db->get('news')->row();
	  // then increase by one
	  $this->db->where('id', $id);
	  $this->db->set('count', ($data->count + 1));
	  $this->db->update('news');
	}
}
