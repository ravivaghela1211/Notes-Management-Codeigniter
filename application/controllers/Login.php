<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Common_Model', 'cm');
      
    }

    public function index()
    {
        if ($_POST) {
            $post = $this->input->post();


            $result = $this->cm->SelectSingleData('email', $post['email'], 'tbl_users', null, null);

            if (!empty($result)) {
                $password = $this->encrypt->decode($result[0]->psw);

                if ($password == $post['password']) {
                    $result['status'] = $this->cm->SelectSingleData('email', $post['email'], 'tbl_users', 'status', '1');

                    if (!empty($result['status'])) {
                        $result['block'] = $this->cm->SelectSingleData('email', $post['email'], 'tbl_users', 'blocked', '1');
                        if(empty($result['block']))
                        {
                        $array_msg = array('title' => 'Login Success', 'status' => 'success', 'msg' => 'Continue.. to SaveNotes.');
                        $this->session->set_flashdata('login', $array_msg);



                        /*Store login history to login_history table*/
                        $this->load->library('user_agent');

                        if ($this->agent->is_browser()) {
                            $broser_name = $this->agent->browser() . ' ' . $this->agent->version();
                        } elseif ($this->agent->is_robot()) {
                            $broser_name = $this->agent->robot();
                        } elseif ($this->agent->is_mobile()) {
                            $broser_name = $this->agent->mobile();
                        } else {
                            $broser_name = 'Unidentified User Agent';
                        }


                        $login_history_data = array(
                            'history_id'  => null,
                            'user_id'   => $result[0]->user_id,
                            'browser_name' => $broser_name,
                            'platform_name' => $this->agent->platform(),
                            'login_time' => date('Y-m-d H:i:s'),

                            'status' => 'Active'
                        );
                        $insertData = $this->cm->insertData('tbl_login_history', $login_history_data);
                       
                        $token = md5($result[0]->username.time().rand(1111,11111111));
                        $userdata = array(
                            'username'  => $result[0]->username,
                            'email'     => $result[0]->email,
                            'user_id'   => $result[0]->user_id,
                            'token'     => $token,
                            'login_id'  => $insertData
                        );
                        $this->session->set_userdata('login_session', $userdata);

                        //
                        $login_tracking_data =  array(
                            'id' => null,
                            'user_id' => $result[0]->user_id,
                            'token' => $token
                        );
                        $login_tracking = $this->cm->insertData('tbl_user_login_tracking', $login_tracking_data);
                        if($login_tracking)
                        {
                            echo "sucess";
                        }
                        
                        }
                        else{
                            echo "Your Account is blocked ";
                        }
                    } else {
                        $this->session->set_flashdata('login', 'Your Account is not verified Please Verify Account..');
                        echo "Your Account is not verified Please Verify Account.";
                        /*print message in ajax response*/
                    }
                } else {
                    $this->session->set_flashdata('login', 'Username or Password are incorrect');
                    echo "Username or Password are incorrect";
                }
            } else {
                $this->session->set_flashdata('login', 'Username or Password  are incorrect');
                echo "Username or Password  are incorrect";
            }
        } else {
            echo "404 not found";
        }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|callback_email_validate');
        if ($this->form_validation->run() == FALSE) {

            echo "emailnotvalid";
        }
        else{
            $post = $this->input->post();
            $result['user'] = $this->cm->SelectSingleData('email', $post['email'], 'tbl_users', null, null);
            $psw = $this->encrypt->decode($result['user'][0]->psw);
            
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'ravivaghela7014@gmail.com', // change it to yours
                'smtp_pass' => 'ravi@7014', // change it to yours
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );
            
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            $this->email->from('ravivaghela7014@gmail.com', 'SaveNotes');
            
            $this->email ->to($post['email']);
            $this->email->subject('Forgot Password');

            
            $this->email->message('Your SaveNotes Account Password : '.$psw);
         
           
            if ($this->email->send()) {
             echo "success";
            }

                
                
        }
    }
    public function email_validate()
    {
        $data = $this->input->post();
        $result = $this->cm->SelectSingleData('email', $data['email'], 'tbl_users',null,null);

        if (!empty($result)) {
            return true;
            
        } else {
            
            $this->form_validation->set_message('email_validate', 'Email not exists in our database');
            return false;
        }
    }
}
