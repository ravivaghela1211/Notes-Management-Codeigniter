<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('Common_Model', 'cm');
 
    }
    public function index()
      {
          $mpdf = new \Mpdf\Mpdf();
          $html = $this->load->view('mypdf',[],true);
          $mpdf->WriteHTML($html);
          $mpdf->Output(); // opens in browser
          // $mpdf->Output('welcome.pdf','D'); // it downloads the file into the user system.
      }
	// public function index(){
        
       
    //     $result['users'] = $this->cm->SelectSingleData(null, null, 'ci_sessions', null, null);
    //     echo "<pre>";
    //     print_r( $result['users']);
    //     foreach($result['users'] as $ab)
    //     {
    //        echo  $ab->data."<br>";
    //     }
    //    // $this->load->view('Admin/deactivate-mail-format');

    //    /* $this->load->view('delete-account-mail');*/
    //   // $msg = 'admin@123';

       
    //     //$encrypted_string = $this->encrypt->encode($msg);

      

    //     //echo $msg."<br>";
    //    // echo  $encrypted_string."<br>";


    // }

    // public function email()
    // {
    //     $data['emaildata']=array('token'=>'dghsnbzcbvlksbscmz','username'=>'Ravi VAghela');
    //     $this->load->view('mail-format',$data);
    // }
    // public function login_history()
    // {
    //     $this->load->library('user_agent');

    //     if ($this->agent->is_browser()) {
    //         $broser_name = $this->agent->browser() . ' ' . $this->agent->version();
    //     } elseif ($this->agent->is_robot()) {
    //         $broser_name = $this->agent->robot();
    //     } elseif ($this->agent->is_mobile()) {
    //         $broser_name = $this->agent->mobile();
    //     } else {
    //         $broser_name = 'Unidentified User Agent';
    //     }

        
    //     $login_history_data = array(
    //         'history_id'  => null,
    //         'user_id'   => '1',
    //         'browser_name' => $broser_name,
    //         'platform_name' => $this->agent->platform(),
    //         'login_time' => date('Y-m-d H:i:s'),
            
    //         'status' => 'Active'
    //     );
    //     $data=$this->cm->insertData('tbl_login_history', $login_history_data);
    //     print_r($data);

    // }
}
