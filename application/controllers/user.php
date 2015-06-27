<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller{

	public $navData = array();
	public $bodyData = array();

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('users_model');
		$this->load->library('session');
 		$this->navData = array(
			'meta_description' => "index",
			'meta_keywords' => "index",
			'meta_classification' => "index",
		);
	}

	public function profile($id = ''){

		if (!is_numeric($id) || !$id) show_404();
		$this->load->library('session');

		//get data from database
		$body_data['user'] = $this->users_model->get($id);
		if(empty($body_data['user'])) show_404();
		$body_data['users_articles'] = $this->users_model->getArticlesByUser($body_data['user'][0]['id']);

		//what the nav needs
		$navigation_data = $this->navData;
		$navigation_data['navTab'] = "profile";
		//basic info for the header
		$layout_data['pageTitle'] = "User Profile";
		$body_data['pageTitle'] = $layout_data['pageTitle'];

		//load the content variables
		$layout_data['content_navigation'] = $this->load->view('navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('profile_view', $body_data, true);

		$this->load->view('layouts/main', $layout_data);
	}

	public function index(){
		if(($this->session->userdata('username')!=""))
		{
			$this->welcome();
		}else{
			$navigation_data = $this->navData;
			$navigation_data['navTab'] = "user";

			$layout_data['pageTitle'] = "User Profile";

			$body_data = $this->bodyData;
			$body_data['message'] = $this->session->flashdata('message');
			$body_data['message_login'] = $this->session->flashdata('message_login');
			
			$layout_data['content_navigation'] = $this->load->view('navigation', $navigation_data, true);
			$layout_data['content_body'] = $this->load->view('registration_view', $body_data, true);
			$this->load->view('layouts/main', $layout_data);
		}
	}
	public function welcome(){
		$navigation_data = $this->navData;
		$navigation_data['navTab'] = "user";

		$layout_data['pageTitle'] = "User Profile";

		$body_data = $this->bodyData;
		$layout_data['content_navigation'] = $this->load->view('navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('welcome_view', $body_data, true);

		$this->load->view('layouts/main', $layout_data);
	}
	public function login(){
		$email=$this->input->post('user_email');
		$password=md5($this->input->post('user_password'));

		$result=$this->users_model->login($email,$password);
		if($result){
			$this->welcome();
		} else {
			redirect(base_url().'user');
		}   
	}
	public function thank(){
		$navigation_data = $this->navData;
		$navigation_data['navTab'] = "user";

		$layout_data['pageTitle'] = "User Profile";

		$body_data = $this->bodyData;
		$layout_data['content_navigation'] = $this->load->view('navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('thank_view', $body_data, true);

		$this->load->view('layouts/main', $layout_data);
	}
	public function registration(){
		$this->load->library('form_validation');
		// field name, error message, validation rules
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

		if($this->form_validation->run() != FALSE){
			if ($this->users_model->getDuplicate() == FALSE) {
				$result = $this->users_model->register();
				if ($result) {
					$this->thank();
				}else{
					$this->session->set_flashdata('message', '<div class="warning">Something went wrong</div>');
					redirect(base_url().'user');
				}
			}
			else{
				$this->session->set_flashdata('message', '<div class="warning">This email already registered!</div>');
				redirect(base_url().'user');
			}
		}
		else{
			$this->session->set_flashdata('message', validation_errors('<div class="warning">', '</div>'));
			redirect(base_url().'user');
		}
	}
	public function logout(){
		$newdata = array(
			'id'   =>'',
			'username'  =>'',
			'email'     => '',
			'logged_in' => FALSE,
		);
		$this->session->unset_userdata($newdata );
		$this->session->sess_destroy();
		$this->index();
	}
}
?>