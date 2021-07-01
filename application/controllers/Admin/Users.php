<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{


	function __construct()
	{
		parent::__construct();

		$this->load->model('Common_Model', 'cm');
	}

	public function blockUser($id)
	{
		
		if ($this->session->has_userdata('admin_login_session')) {
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => '', // change it to yours
				'smtp_pass' => '', // change it to yours
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);
			$data['user'] = $this->cm->SelectSingleData('user_id', $id, 'tbl_users', null, null);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			$this->email->from('youremail@gmail.com', 'SaveNotes');

			$this->email->to($data['user'][0]->email);
			$this->email->subject('Yor Savenotes account has been blocked!');
			$this->email->message($this->load->view('Admin/block-mail-format', $data, true));

			if ($this->email->send()) {
				$data = array('blocked' => '1');
				$this->cm->updateData('tbl_users', $data, 'user_id', $id, null, null);
				$array_msg = array('title' => 'User Block Successfully', 'status' => 'success', 'msg' => '');
				$this->session->set_flashdata('login', $array_msg);
				echo "success";
			} else {
				echo "fail";
			}
		} else {
			redirect('Home/Login');
		}
	}
	//unblock the users account
	public function unblockUser($id)
	{
		
		if ($this->session->has_userdata('admin_login_session')) {
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => '', // change it to yours
				'smtp_pass' => '', // change it to yours
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);
			$data['user'] = $this->cm->SelectSingleData('id', $id, 'tbl_accounts_reactivation', null, null);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$email = $data['user'][0]->email;
			$this->email->from('youremail@gmail.com', 'SaveNotes');

			$this->email->to($email);
			$this->email->subject('Yor Savenotes account has been reactivated!');
			$this->email->message($this->load->view('Admin/unblock-mail-format', $data, true));

			if ($this->email->send()) {
				$data = array('blocked' => '0');
				$this->cm->updateData('tbl_users', $data, 'email', $email, null, null);
				$this->cm->deleteData('tbl_accounts_reactivation','id',$id,null,null);
				$array_msg = array('title' => 'User Unblock Successfully', 'status' => 'success', 'msg' => '');
				$this->session->set_flashdata('login', $array_msg);
				echo "success";
			} else {
				echo "fail";
			}
		} else {
			redirect('Home/Login');
		}
	}
	public function userContact()
	{ 
		if ($this->session->has_userdata('admin_login_session')) {
		$result['contacts'] = $this->cm->SelectSingleData(null, null, 'tbl_contact_us', null, null);
		$this->load->view('Admin/user-contacts', $result);
		}
		else{
			redirect('Admin/AdminLogin');
		}
	}
	public function DeleteContact($id)
	{
		if($id == null)
		{
			echo "error";
		}
		else{
		if ($this->session->has_userdata('admin_login_session')) {
			
			if($this->cm->deleteData('tbl_contact_us','con_id',$id,null,null))
			{
				$array_msg = array('title' => 'User Contact Delete Successfully', 'status' => 'success', 'msg' => '');
				$this->session->set_flashdata('login', $array_msg);	
				redirect('Admin/Users/userContact');
			}
			else{
				redirect('Admin/Users/userContact');
			}
		}
		else{
			redirect('Admin/AdminLogin');
		}
		}
	}
	public function allUsers()
	{

		if ($this->session->has_userdata('admin_login_session')) {
            $result['users'] = $this->cm->SelectSingleData(null, null, 'tbl_users', null, null);
			$this->load->view('Admin/all-users', $result);
			
		} else {
			redirect('Admin/AdminLogin');
		}
	}
	
    public function activeUsers()
	{

		if ($this->session->has_userdata('admin_login_session')) {
            $result['activeusers'] = $this->cm->SelectSingleData('status', '1', 'tbl_users', null, null);
			$this->load->view('Admin/active-users', $result);
			
		} else {
			redirect('Admin/AdminLogin');
		}
	}
    public function inactiveUsers()
	{

		if ($this->session->has_userdata('admin_login_session')) {
            $result['inactiveUsers'] = $this->cm->SelectSingleData('status', '0', 'tbl_users', null, null);
			$this->load->view('Admin/inactive-users', $result);
			
		} else {
			redirect('Admin/AdminLogin');
		}
	}


	//account reactivation requests
	public function requestAccount(){
		if ($this->session->has_userdata('admin_login_session')) {
			$result['users_requests'] = $this->cm->SelectSingleData(null, null, 'tbl_accounts_reactivation', null, null);
			$this->load->view('Admin/account-reactivate-requests',$result);
		}
		else{
			redirect('Home/Login');
		}
	}


	//all feedbacks
	public function userFeedbacks()
	{ 
		if ($this->session->has_userdata('admin_login_session')) {
		$result['feedbacks'] = $this->cm->SelectSingleData(null, null, 'tbl_feedbacks', null, null);
		$this->load->view('Admin/user-feedbacks', $result);
		}
		else{
			redirect('Admin/AdminLogin');
		}
	}
	//delete feedbacks
	public function DeleteFeedback($id)
	{
		if($id == null)
		{
			echo "error";
		}
		else{
		if ($this->session->has_userdata('admin_login_session')) {
			
			if($this->cm->deleteData('tbl_feedbacks','id',$id,null,null))
			{
				$array_msg = array('title' => 'User Feedback Delete Successfully', 'status' => 'success', 'msg' => '');
				$this->session->set_flashdata('login', $array_msg);	
				redirect('Admin/Users/userFeedbacks');
			}
			else{
				redirect('Admin/Users/userContact');
			}
		}
		else{
			redirect('Admin/AdminLogin');
		}
		}
	}
}
