<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactUs extends CI_Controller {

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
	public function contactProcess()
	{
        
        
		if($_POST)
        {
            $post=$this->input->post();
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('message','Message','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->load->view('contact-us');
            }
            else{
                $email=$this->encrypt->encode($post['email']);
                $message=$this->encrypt->encode($post['message']);

                $userdata=array(
                    'con_id'=>null,
                    'email'=>$email,
                    'message'=>$message
                );

                if($this->cm->insertData('tbl_contact_us',$userdata))
                {
                $array_msg = array('title'=>'Contact Received','status'=>'success','msg'=>'We Will Reply soon as possible.'); 
                $this->session->set_flashdata('contact',$array_msg);
                 redirect('Home/Contact_Us');
                }
                else{
                    echo "o sheet ";
                }

            }
            
        }
	}

}
