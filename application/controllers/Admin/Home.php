<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


	function __construct()
	{
		parent::__construct();

		$this->load->model('Common_Model', 'cm');
	}

	public function index()
	{

		if ($this->session->has_userdata('admin_login_session')) {

			$data['active_users']=$this->cm->countRow('tbl_users','status','1');
			$data['inactive_users']=$this->cm->countRow('tbl_users','status','0');
			$data['all_users']=$this->cm->countRow('tbl_users',null,null);
			$data['contacts']=$this->cm->countRow('tbl_contact_us',null,null);
			$data['reactivate']=$this->cm->countRow('tbl_accounts_reactivation',null,null);
			$data['feedbacks']=$this->cm->countRow('tbl_feedbacks',null,null);
			$this->load->view('Admin/index',$data);
		} else {
			redirect('Admin/AdminLogin');
		}
	}
	
	
	
}
