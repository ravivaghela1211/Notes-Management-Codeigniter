<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
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
	public function ResetPassword()
	{
		if ($this->session->has_userdata('login_session')) {
			$this->load->view('reset-password');
		}
	}
	public function ResetPasswordProcess()
	{
		if ($this->session->has_userdata('login_session')) {

			$this->form_validation->set_rules('current_psw', 'Current Password', 'required|callback_password_validate');
			$this->form_validation->set_rules('create_psw', 'Password', 'required|min_length[8]');
			$this->form_validation->set_rules('confirm_psw', 'Password Confirmation', 'trim|required|matches[create_psw]');
			if ($this->form_validation->run() == FALSE) {

				$this->load->view('reset-password');
			} else {
				$data = $this->session->userdata('login_session');
				$post = $this->input->post();
				$updateData = array('psw' => $this->encrypt->encode($post['create_psw']));
				$res = $this->cm->updateData('tbl_users', $updateData, 'user_id', $data['user_id'], null, null);
				if ($res) {
					$array_msg = array('title' => 'Password reset Successfully', 'status' => 'success', 'msg' => '');
					$this->session->set_flashdata('note', $array_msg);
					redirect('Notes');
				} else {
					echo "error";
				}
			}
		} else {
			redirect('Home/Login');
		}
	}
	public function password_validate()
	{
		if ($_POST) {
			$data = $this->input->post();
			if ($this->session->has_userdata('login_session')) {
				$post = $this->session->userdata('login_session');
				$result = $this->cm->SelectSingleData('email', $post['email'], 'tbl_users', null, null);

				if (!empty($result)) {
					if ($data['current_psw'] == $this->encrypt->decode($result[0]->psw)) {
						return true;
					} else {
						$this->form_validation->set_message('password_validate', 'Current Password is wrong');
						return false;
					}
				} else {
					redirect('Home/Login');
				}
			} else {
				redirect('Home/Login');
			}
			redirect('Settings/ResetPassword');
		}
	}
	public function LoginHistory()
	{
		if ($this->session->has_userdata('login_session')) {
			$session_data = $this->session->userdata('login_session');

			$result['log_history'] = $this->cm->SelectSingleData('user_id', $session_data['user_id'], 'tbl_login_history', null, null);

			$this->load->view('login-history', $result);
		} else {
			redirect('Home/Login');
		}
	}

	public function DeleteLoginHistory($history_id)
	{

		if ($history_id == null) {
			echo "error";
		} else {
			if ($this->session->has_userdata('login_session')) {

				if ($this->cm->deleteData('tbl_login_history', 'history_id', $history_id, null, null)) {


					redirect('Settings/LoginHistory');
				} else {
					redirect('Admin/LoginHistory');
				}
			} else {
				redirect('Home/Login');
			}
		}
	}
	public function DeleteAccountView()
	{
		$this->load->view('delete-account');
	}
	public function DeleteAccount()
	{

		if ($this->session->has_userdata('login_session')) {
			$post = $this->session->userdata('login_session');
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

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			$this->email->from('youremail@gmail.com', 'SaveNotes');

			$this->email->to($post['email']);
			$this->email->subject('Delete Your Account from SaveNotes');
			$this->email->message($this->load->view('delete-account-mail', $data = array('id' => 1), true));
			if ($this->email->send()) {
				echo "success";
			}
		} else {
			echo "fail";
		}
	}
	public function DeleteAccountProcess($user_id)
	{

		if (!empty($user_id)) {
			if ($this->session->has_userdata('login_session')) {
				$session_data = $this->session->userdata('login_session');
				$this->cm->deleteData('tbl_login_history', 'user_id', $session_data['user_id'], null, null);
				if ($this->cm->deleteData('tbl_notes', 'user_id', $session_data['user_id'], null, null)) {
					if ($this->cm->deleteData('tbl_users', 'user_id', $session_data['user_id'], null, null)) {
						$array_msg = array('title' => 'Your Account Successfully Deleted', 'status' => 'success', 'msg' => 'Thank you for Visiting SaveNotes..');
						$this->session->set_flashdata('acccount_deleted', $array_msg);
						$this->session->unset_userdata('login_session');
						redirect('Home/');
					}
				} else {
					echo "Nital🤣🤣🤣";
				}
			} else {
				echo "failed";
			}
		} else {
			echo "Failed";
		}
	}

	public function DeleteAllNotesView()
	{
		$this->load->view('delete-all-notes');
	}
	public function DeleteAllNotes()
	{

		if ($this->session->has_userdata('login_session')) {
			$post = $this->session->userdata('login_session');
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

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			$this->email->from('youremail@gmail.com', 'SaveNotes');

			$this->email->to($post['email']);
			$this->email->subject('Delete All Notes from SaveNotes');
			$this->email->message($this->load->view('delete-all-notes-mail', $data = array('id' => 1), true));

			if ($this->email->send()) {
				echo "success";
				//$this->load->view('delete-all-notes');
			}
			else{
				echo "fail";
			}
		} else {
			echo "";
		}
	}

	public function DeleteAllNotesProcess($user_id)
	{

		if (!empty($user_id)) {
			if ($this->session->has_userdata('login_session')) {
				$session_data = $this->session->userdata('login_session');
				print_r($session_data);
				if ($this->cm->deleteData('tbl_notes', 'user_id', $session_data['user_id'], null, null)) {
					$array_msg = array('title' => 'All Notes Delete Successfully', 'status' => 'success', 'msg' => '');
					$this->session->set_flashdata('note', $array_msg);
					redirect('Notes');
				} else {
					echo "Nital🤣🤣🤣";
				}
			} else {
				echo "failed";
			}
		} else {
			echo "Failed";
		}
	}

	public function Logout()
	{
		$session = $this->session->userdata('login_session');
		$login_id = $session['login_id'];
		$data = array('logout_time' => date('Y-m-d H:i:s'), 'status' => 'Logged out');
		$this->cm->updateData('tbl_login_history', $data, 'history_id', $login_id, null, null);
		$this->session->sess_destroy();
		redirect('Home');
	}
	public function LogoutAllDevices()
	{
		$session_data = $this->session->userdata('login_session');
		$res = $this->cm->deleteData('tbl_user_login_tracking', 'user_id', $session_data['user_id'], 'token !=', $session_data['token']);	
		$array_msg = array('title' => 'All devices has been logged out', 'status' => 'success', 'msg' => '');
		$this->session->set_flashdata('note', $array_msg);
		redirect('Notes');
	}
	//request to reactivate account
	public function ReactivateAccountView()
	{
		$this->load->view('reactivate-account-request');
	}	
	public function ReactivateAccount()
	{
		//check this request is ajax request or not
		if($_POST)
		{
			//select user where email id enterd by user
			$data['result'] = $this->cm->SelectSingleData('email', $_POST['email'], 'tbl_users',null,null);
			if(!empty($data['result']))
			{
				//check user blocked or note
				$data['result1'] = $this->cm->SelectSingleData('email', $_POST['email'], 'tbl_users','blocked','1');
				if(!empty($data['result1']))
				{
					//if user is blocked then data store in tbl_accounts_reactivation table
					$userdata = array(
						'id' => null,
						'email' => $_POST['email']
					);
					//check user request already exits or not
					$data['result2'] = $this->cm->SelectSingleData('email', $_POST['email'], 'tbl_accounts_reactivation',null,null);
					if(!empty($data['result2']))
					{
						//if request is already exits then pending msg show
						echo "pending";
					}
					else{
						$this->cm->insertData('tbl_accounts_reactivation',$userdata);
						//yes means data sucessfully store in database table
						echo "yes";
					}
				}
				else{
					//if user account is not blocked then this return
					echo "notblock";
				}
			}
			else{
				//if user not exits in db then this message will return
				echo "acc_not_exists";
			}
		}
		else{
			echo "404 not found";
		}
	}
}
