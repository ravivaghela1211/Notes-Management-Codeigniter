<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();

        $this->load->model('Common_Model', 'cm');
		$session = $this->session->userdata('login_session');
        $result = $this->cm->SelectSingleData('token', $session['token'], 'tbl_user_login_tracking', 'user_id', $session['user_id']);
        if(empty($result))
        {
        $session = $this->session->userdata('login_session');
		$login_id = $session['login_id'];
		$data = array('logout_time' => date('Y-m-d H:i:s'), 'status' => 'Logged out');
		$this->cm->updateData('tbl_login_history', $data, 'history_id', $login_id, null, null);
        unset($_SESSION['login_session']);
		
        }
      
    }
	public function index()
	{
		
		$result['feedbacks'] = $this->cm->SelectLimitedData('tbl_feedbacks','4','id','DESC');
		$this->load->view('index',$result);
		
	}

	public function Contact_Us()
	{
		$this->load->view('contact-us');
	}

	public function SignUp()
	{
		$this->load->view('signup');
	}
	public function Login()
	{
		if($this->session->has_userdata('login_session'))
		{
			redirect('Notes');
		}
		else{
			$this->load->view('login');
		}
		
	}

	public function ForgotPassword()
	{
		$this->load->view('forgot-password');
	}

}
