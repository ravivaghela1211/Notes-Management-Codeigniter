<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller
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

    public function SignupProcess()
    {
        $post = $this->input->post();

        if ($_POST) {
            /* Set validation rule for name field in the form */
            $this->form_validation->set_rules('username', 'Name', 'required|min_length[3]');

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_validate');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');


            if ($this->form_validation->run() == FALSE) {

                $this->load->view('SignUp');
            } else {
                $token=md5($post['email'].time());
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
                $data['emaildata']=array('token'=>$token,'username'=>$post['username']);
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");

                $this->email->from('youremail@gmail.com', 'SaveNotes');
                
                $this->email ->to($post['email']);
                $this->email->subject('Account Activation');
                $this->email->message($this->load->view('mail-format',$data, true));
              /*  $this->email->message('<h4>Please Click Following link For verifying And Activation Of Your account</h4>'.'<a href="http://[::1]/SaveNotes/Signup/EmailVerification?code='.$token.'"'.'>'.'Click here to verify</a>'.'<br>Powered by Ravi Vaghela');*/
               
                if ($this->email->send()) {
                    $this->session->set_flashdata('verify','We Have Send Account Activation link To your email </br>Without Activation You cannot login');
                   

                    $password=$this->encrypt->encode($post['password']);
                    
                    $userdata=array(
                        'user_id'=>null,
                        'username'=>$post['username'],
                        'email'=>$post['email'],
                        'psw'=>$password,
                        'token'=>$token,
                        'status'=>'0',

                    );

                    $this->cm->insertData('tbl_users',$userdata);
                    redirect('Home/Login');

                } else {
                    echo $this->email->print_debugger();
                    echo "mail not send";
                    $this->session->flashdata('msg','Something Wrong Please try again later');
                }
            }
        } else {
            echo "Nikal 😎😎";
        }
    }

    public function passwordValidation()
    {
        if($_POST)
        {
        if (preg_match_all('#[0-9]#', $_POST['psw']) && preg_match_all('#[a-z]#', $_POST['psw']) && preg_match_all('#[A-Z]#', $_POST['psw'])) {
            echo "success";
          }
          else{
            echo "fail"; 
          }
        }
          
    }
   
    public function email_validate()
    {
        $data = $this->input->post();
        $result = $this->cm->SelectSingleData('email', $data['email'], 'tbl_users',null,null);

        if (!empty($result)) {

            $this->form_validation->set_message('email_validate', 'Email Already Registered');
            return false;
        } else {
            return true;
        }
    }

    public function EmailVerification()
    {
        if (!empty($_GET['code']) && isset($_GET['code'])) 
        {
            $msg="";
          
            $code=$_GET['code'];
            $result = $this->cm->SelectSingleData('token',$code, 'tbl_users',null,null);
           
            if(!empty($result))
            {
                $result2 = $this->cm->SelectSingleData('token',$code,'tbl_users','status','0');  
                if(!empty($result2))
                {
                    $data=array('status'=>'1');
                    $result3 = $this->cm->updateTable('tbl_users','token',$code,$data);
                    $msg='<label style="color: green"'.'>Your Email Verify Sucessfully</br>Now you Can Login..</br><a href='."http://[::1]/SaveNotes/Home/Login".'>Click Here To Login</a>
                    </label>'; 
                    
                }
                else{
                    $msg='<label style="color: green"'.'>Your Email Already Activated....</br><a href='."http://[::1]/SaveNotes/Home/Login".'>Click Here To Login</a>
                          </label>'; 
                }

            }
            else{
                $msg='<h3 style="color: red"'.'>Wrong Activation Code</h3>';
            }
        $this->session->set_flashdata('msg',$msg);
         $this->load->view('verify');  
        }
        else{
            echo "nital 🤣🤣";
        }
    }
}
