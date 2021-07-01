<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLogin extends CI_Controller {

		function __construct()
		{
			parent::__construct();

			$this->load->model('Common_Model', 'cm');
		}
		public function index()
		{
			if($this->session->has_userdata('admin_login_session'))
			{
				redirect('Admin/Home');
			}
			else{
			$this->load->view('Admin/login');
			}
		}


		public function  AdminLoginProcess()
		{
			if (!$this->input->is_ajax_request()) {
				echo 'No direct script is allowed';
				die;
			}
			if ($_POST) {
				$post = $this->input->post();
				$result = $this->cm->SelectSingleData('email', $post['email'], 'tbl_admin', null, null);
	
				if (!empty($result)) {
					$password = $this->encrypt->decode($result[0]->psw);
	
					if ($password == $post['password']) {
							$array_msg = array('title' => 'Login Success', 'status' => 'success', 'msg' => '');
							$this->session->set_flashdata('login', $array_msg);
							
							$admindata = array(
								'username'  => $result[0]->username,
								'email'     => $result[0]->email,
								'user_id'   => $result[0]->admin_id,
								
							);
							$this->session->set_userdata('admin_login_session', $admindata);
							echo "yes";
	
					}
					else{
						
						echo "Username or Password  are incorrect";

					}		
							
				}else{
					echo "Username or Password  are incorrect";
				}
			} else {
				echo "404 not found";
			}
		}
		public function AdminLogout()
		{
			$this->session->unset_userdata('admin_login_session');
			$this->load->view('Admin/login');
		}
}