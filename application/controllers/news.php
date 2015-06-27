<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	public $navData = array();

	public function __construct(){
		parent::__construct();
		$this->load->model('articles_model');
		$this->load->model('users_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->navData = array(
			'meta_description' => "index",
			'meta_keywords' => "index",
			'meta_classification' => "index",
		);
	}

	public function index()
	{
		//what the nav needs
		$navigation_data = $this->navData;
		$navigation_data['navTab'] = "home";

		//basic info for the header
		$layout_data['pageTitle'] = "List of articles";

		$body_data['articles'] = $this->articles_model->getArticles();
		//get data from database

		//load the content variables
		$layout_data['content_navigation'] = $this->load->view('navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('articles_view', $body_data, true);

		$this->load->view('layouts/main', $layout_data);
	}
	public function article($id = ''){
		if (!is_numeric($id) || !$id) show_404();

		$body_data['article'] = $this->articles_model->get($id);

		if(empty($body_data['article'])) show_404();
		//basic info for the header
		$navigation_data = $this->navData;
		$navigation_data['navTab'] = "home";

		// if does not have article by $id

		$layout_data['pageTitle'] = strip_tags($body_data['article'][0]['title']);
		$body_data['pageTitle'] = "";

		//get data from database
		//load the content variables
		$layout_data['content_navigation'] = $this->load->view('navigation', $navigation_data, true);
		$layout_data['content_body'] = $this->load->view('article_view', $body_data, true);

		$this->add_count($id);
		$this->load->view('layouts/main', $layout_data);
	}

	public function add_count($id){
		if (!is_numeric($id) || !$id) show_404();
		$cookie_id = 'cookie_'.$id;
		$this->load->helper('cookie');
		$check_visitor = $this->input->cookie($cookie_id, FALSE);
		$ip = $this->input->ip_address(); 
		if ($check_visitor == false) {
			$this->input->set_cookie($cookie_id, $ip, (24 * 60 * 60 * 4));
			//for four days or three I don't know
			$this->articles_model->update_counter($id);
		}
	}
}
