<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	function getUsers(){
		$this->db->select('id, username, email')
		->from('users');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get($id){
		$this->db->select('id, username, email')
		->from('users')
		->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	function getArticlesByUser($id){
		$this->db->select('id, title, preview, body, date, user_id')
		->from('news')
		->where('user_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	function login($email,$password)
	{
		$this->db->where("email", $email);
		$this->db->where("password", $password);

		$query=$this->db->get("users");

		if($query->num_rows()>0)
		{
		foreach($query->result() as $rows)
		{
			//add all data to session
			$newdata = array(
				'id'  => $rows->id,
				'username'  => $rows->username,
				'email'    => $rows->email,
				'logged_in'  => TRUE,
			);
		}
		$this->session->set_userdata($newdata);
			return true;
		}
		$this->session->set_flashdata('message_login', '<div class="warning">Wrong password or Email</div>');
		return false;
	}
	public function getDuplicate(){
		$q =  $this->db->select('email')
			->from('users')
			->where('email', $this->input->post('email_address'))->get();
		if($q->num_rows() == 0)
			return false;
		return true;
	}
	public function register($verification_code){
		//insert goes here
		$data=array(
			'username'=>$this->input->post('user_name'),
			'email'=>$this->input->post('email_address'),
			'password'=>md5($this->input->post('password')),
			'email_verification_code' => $verification_code,
		);
		return $this->db->insert('users', $data);
	}
	public function verifyEmailAddress($verification_code){
		$sql = 'UPDATE users SET active_status = 1 WHERE email_verification_code=?';
		$this->db->query($sql, array($verification_code));
		return $this->db->affected_rows();
	}
}
?>