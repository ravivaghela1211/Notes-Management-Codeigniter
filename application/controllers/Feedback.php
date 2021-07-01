<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends CI_Controller
{
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
        if($_POST)
        {
           if($this->cm->insertData('tbl_feedbacks', $_POST))
           {
            $array_msg = array('title' => 'Thank You For Your Valuable Feedback', 'status' => 'success', 'msg' => '');
            
            $this->session->set_flashdata('feedback', $array_msg);
            redirect('Home');
           }
           else{
            redirect('Home');
           }

        }

    }
        
}