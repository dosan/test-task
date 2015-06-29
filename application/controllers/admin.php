<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public $layout_data = array();

	public $ckeditorData = array();
	public $navData = array();
	public $bodyData = array();

	public function __construct(){
		parent::__construct();
		$this->load->model('articles_model');
		$this->load->model('users_model');
		$this->load->library('session');
 		$this->navData = array(
			'meta_description' => "index",
			'meta_keywords' => "index",
			'meta_classification' => "index",
		);
	}

	public function index(){
		// I have no time to make permissions
		if ($this->session->userdata('logged_in') != TRUE) {
			$this->load->helper(array('form', 'url'));
			$navigation_data = $this->navData;
			$navigation_data['navTab'] = "user";

			$layout_data['pageTitle'] = "User Profile";

			$body_data = $this->bodyData;
			$body_data['pageTitle'] = "Please Sign in or Sign up to access Admin panel";
			$body_data['message'] = $this->session->flashdata('message');
			$body_data['message_login'] = $this->session->flashdata('message_login');
			
			$layout_data['content_navigation'] = $this->load->view('navigation', $navigation_data, true);
			$layout_data['content_body'] = $this->load->view('registration_view', $body_data, true);
			$this->load->view('layouts/main', $layout_data);
		}else{
			//what the nav needs
			$navigation_data['navTab'] = "index";

			//basic info for the header
			$layout_data['pageTitle'] = "List of articles";

			$body_data['articles'] = $this->articles_model->getArticles();
			$body_data['pageTitle'] = $layout_data['pageTitle'];
			//get data from database

			//load the content variables
			$layout_data['content_navigation'] = $this->load->view('admin/navigation', $navigation_data, true);
			$layout_data['content_body'] = $this->load->view('admin/indexBody', $body_data, true);

			$this->load->view('layouts/dashboard', $layout_data);
		}
	}

	public function article($id = ''){
		if (!is_numeric($id) || !$id) show_404();

		//basic info for the header
		$body_data['article'] = $this->articles_model->get($id);

		// if does not have article by $id
		if(empty($body_data['article'])) show_404();

		$navigation_data['navTab'] = "";
		$layout_data['pageTitle'] = strip_tags($body_data['article'][0]['title']);
		$body_data['pageTitle'] = "";
		//get data from database
		//load the content variables
		$layout_data['content_navigation'] = $this->load->view('admin/navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('admin/articleBody', $body_data, true);

		$this->load->view('layouts/dashboard', $layout_data);
	}
	public function users(){

		//what the nav needs
		$navigation_data['navTab'] = "users";
		//basic info for the header
		$layout_data['pageTitle'] = "Users List";
		$body_data['users'] = $this->users_model->getUsers();
		$body_data['pageTitle'] = $layout_data['pageTitle'];

		//load the content variables
		$layout_data['content_navigation'] = $this->load->view('admin/navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('admin/usersBody', $body_data, true);

		$this->load->view('layouts/dashboard', $layout_data);
	}
	public function user($id = ''){

		if (!is_numeric($id) || !$id) show_404();

		//get data from database
		$body_data['user'] = $this->users_model->get($id);
		if(empty($body_data['user'])) show_404();
		$body_data['users_articles'] = $this->users_model->getArticlesByUser($body_data['user'][0]['id']);

		//what the nav need
		$navigation_data['navTab'] = "user";
		//basic info for the header
		$layout_data['pageTitle'] = "User ".$body_data['user'][0]['username'];
		$body_data['pageTitle'] = $layout_data['pageTitle'];

		//load the content variables
		$layout_data['content_navigation'] = $this->load->view('admin/navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('admin/userBody', $body_data, true);

		$this->load->view('layouts/dashboard', $layout_data);
	}
	public function sendmailto($id = ''){
		$this->load->helper(array('form', 'url'));
		if (!is_numeric($id) || !$id) show_404();

		//get data from database
		$body_data['user'] = $this->users_model->get($id);
		if(empty($body_data['user'])) show_404();

		//what the nav need
		$navigation_data['navTab'] = "mail";
		//basic info for the header
		$layout_data['pageTitle'] = "Send Mail To ".$body_data['user'][0]['username'];
		$body_data['pageTitle'] = $layout_data['pageTitle'];

		//load the content variables
		$layout_data['content_navigation'] = $this->load->view('admin/navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('admin/mailBody', $body_data, true);

		$this->load->view('layouts/dashboard', $layout_data);
	}
	public function send(){
		$this->load->library('email');
		$this->email->clear();

		$this->email->from('your@example.com', 'Your Name');
		$this->email->to($email);

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();

		echo $this->email->print_debugger();
	}
	public function add(){
		$this->ckeditor_init();
		$body_data = $this->ckeditorData;
		$this->load->library('session');

		$body_data['errors'] = $this->session->flashdata('errors');
		//what the nav needs
		$navigation_data['navTab'] = "add";
		//basic info for the header
		$layout_data['pageTitle'] = "Add Article";
		$body_data['pageTitle'] = $layout_data['pageTitle'];


		//get data from database
		//load the content variables
		$layout_data['content_navigation'] = $this->load->view('admin/navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('admin/addBody', $body_data, true);

		$this->load->view('layouts/dashboard', $layout_data);
	}
	public function update($id = ''){
		if (!is_numeric($id) || !$id) show_404();
		$this->ckeditor_init();
		$body_data = $this->ckeditorData;
		$this->load->library('session');

		$body_data['errors'] = $this->session->flashdata('errors');

		//get data from database
		$body_data['article'] = $this->articles_model->get($id);
		if(empty($body_data['article'])) show_404();

		//what the nav needs
		$navigation_data['navTab'] = "update";
		//basic info for the header
		$layout_data['pageTitle'] = "Update Article";
		$body_data['pageTitle'] = $layout_data['pageTitle'];

		//load the content variables
		$layout_data['content_navigation'] = $this->load->view('admin/navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('admin/updateBody', $body_data, true);

		$this->load->view('layouts/dashboard', $layout_data);
	}
	public function delete($id = ''){

		if (!is_numeric($id) || !$id) show_404();

		//basic info for the header
		$body_data['article'] = $this->articles_model->get($id);
		// if does not have article by $id
		if(empty($body_data['article'])) show_404();

		$navigation_data['navTab'] = "delete";
		$layout_data['pageTitle'] = "Delete Article";
		$body_data['pageTitle'] = "Are you sure?(delete this article)";
		//get data from database
		//load the content variables
		$layout_data['content_navigation'] = $this->load->view('admin/navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('admin/deleteBody', $body_data, true);

		$this->load->view('layouts/dashboard', $layout_data);
	}
	public function deletefromdatabase(){
		$this->load->helper('url');
		if($this->input->post('idArticleToDelete') != '' && $this->input->post('idArticleToDelete') != null){
			$article_id = $this->input->post('idArticleToDelete');
			$result = $this->articles_model->del_article($article_id);
			if ($result) {
				redirect('/admin/index', 'refresh');
			}else{
				echo 'something wrong';
			}
		}else{
			redirect('/admin/index', 'refresh');
		}
	}
	public function updateOrAdd(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		//$this->form_validation->set_rules('id', 'Id article', 'trim|required|is_natural');
		//$this->form_validation->set_rules('author_id', 'Author', 'trim|required|is_natural');
		$this->form_validation->set_rules('title', 'Title of article', 'trim|required');
		$this->form_validation->set_rules('preview', 'Preview of article', 'trim|required');
		$this->form_validation->set_rules('body', 'Body of article', 'trim|required');
		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_message('is_natural', '%s can only contain numbers.');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			if ($this->input->post('article_id') != null && is_numeric($this->input->post('article_id'))) {
				redirect(base_url().'admin/update/'.$this->input->post('article_id'));
			}else{
				redirect(base_url().'admin/add');
			}
		}else{

			$data = array(
				'title' => $this->input->post('title'),
				'preview' => $this->input->post('preview'),
				'body' => $this->input->post('body'),
			);
			//if in POST request article_id then will update article else add new article. logic   
			if ($this->input->post('article_id') != null && is_numeric($this->input->post('article_id'))) {
				$data['id'] = $this->input->post('article_id');
				$result = $this->articles_model->update_article($data);
			}else{
				$data['user_id'] = $this->input->post('author_id');
				$result = $this->articles_model->add_article($data);
			}
			if ($result) 
				redirect('/admin/index', 'refresh');
			else
				echo 'something wrong';
		}
	}
	
	public function ckeditor_init() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('ckeditor');

		//Ckeditor's configuration
		$this->ckeditorData['title'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'title',
			'path'	=>	'ckeditor',
		
			//Optionnal values
			'config' => array(
				'width' 	=> 	"900px",	//Setting a custom width
				'height' 	=> 	'60px',	//Setting a custom height
				'toolbar' 	=> 	array(	//Setting a custom toolbar
					array('Bold', 'Italic'),
					array('Underline', 'Strike', 'FontSize'),
					array('Smiley'),
					'/'
				)
			)
		);
		$this->ckeditorData['preview'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'preview',
			'path'	=>	'ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"900px",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
					
			)
		);
		$this->ckeditorData['body'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'body',
			'path'	=>	'ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"900px",	//Setting a custom width
				'height' 	=> 	'400px',	//Setting a custom height
					
			)
		);
	}
}
