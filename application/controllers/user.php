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
		$navigation_data['navTab'] = "user";
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
		$this->load->helper('string');
		// field name, error message, validation rules
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

		if($this->form_validation->run() != FALSE){
			if ($this->users_model->getDuplicate() == FALSE) {
				$verification_code = random_string('alnum',20);
				$result = $this->users_model->register($verification_code);
				if ($result) {
					$this->sendActivationCode($this->input->post('email_address'), $this->input->post('user_name'), $verification_code);
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
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		$this->index();
	}
	public function sendActivationCode($email, $name, $verification_code){
        $config = array();
        $config['useragent'] = "CodeIgniter";
        $config['mailpath']  = "/usr/sbin/sendmail -t -i"; // or "/usr/sbin/sendmail"
        $config['protocol']  = "smtp";
        $config['smtp_host'] = "ssl://smtp.googlemail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = 'sandor@sandor.cu.cc';
		$config['smtp_pass'] = '######';
        $config['mailtype']  = 'html';
        $config['charset']   = 'utf-8';
        $config['newline']   = "\r\n";
        $config['wordwrap']  = TRUE;
		
		$this->load->library('email', $config);

		//$this->email->clear();

		$this->email->from('sandor@sandor.cu.cc', 'Dosan');
		$this->email->to($email);

		$this->email->subject('Registration User');
		$this->email->message("Dear ".$name.",\nPlease click on below URL or paste into your browser to verify your Email Address\n\n ".base_url().'verify/'.$verification_code."\n"."\n\nThanks\nAdmin Team");
 
		$this->email->send();
	}
	public function verify($verification_code = null){
		if ($verification_code == null && $verification_code == '') show_404();
		$records = $this->users_model->verifyEmailAddress($verification_code);  
		if ($records > 0)
			$message = array( 'success' => "Email Verified Successfully!"); 
		else
			$message = array( 'error' => "Sorry Unable to Verify Your Email!"); 
		$data['message'] = $message; 
		$this->load->view('activated.php', $data);   
	}
}
?>