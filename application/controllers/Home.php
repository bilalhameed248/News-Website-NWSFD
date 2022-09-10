<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('user');
        $_SESSION['message'] = '';
        $this->load->library("pagination");
    }

    public function index($a='')
    {
    	$config = array();
		$config["base_url"] = base_url().'home/index';
		$config["total_rows"] = $this->user->count_all_news();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['rssfeed'] = $this->user->get_authors($config["per_page"], $page);
        $this->load->view('news_feed', $data);
    }
	public function signup()
	{
		if(isset($_POST['submit']))
		{
			$data=$this->input->post();
			$email=$data['email'];
			$isreg=$this->user->is_email_reg($email); //isemail already registered.... '1' tells to get id of that email
			if(!$isreg)
			{
				$this->user->register($data);
				$this->session->set_flashdata('message_detail', 'Sign up Successfully, Login With Your Credential');
				redirect(base_url().'home/login/');
			}
			else
			{
				$this->session->set_flashdata('message', 'Email Already Registered...!');
				$this->load->view('signup');
			}
			
		}
		else
		{
			$_SESSION['message'] = '';
			$this->load->view('signup');
		}
	}
	public function login()
	{
		if(isset($_POST['submit']))
		{
			$islogedin=$this->user->checklogin($_POST);
			if($islogedin)
			{
				redirect(base_url().'home/index');
			}
			else
			{
				$this->session->set_flashdata('message', 'Invalid Credentials, Please Try Again..');
				$this->load->view('signin');
			}
		}
		else
		{
			$this->load->view('signin');
		}
	}
	public function logout()
	{
		//$this->session->unset_userdata('');
		$logout=$this->user->logout();
		if($logout)
		{
			redirect(base_url().'home/login/');
		}
		
	}
	public function news_description($id)
	{
		$data['news_detail']=$this->user->get_specific_news($id);
		$this->load->view('news_description', $data);
	}
	public function delete_news($id)
	{
		$this->user->delete_news($id);
		redirect(base_url().'home/index/');
	}
	public function view_privacy_policy()
	{
		$this->load->view('privacy_policy');
	}
}
