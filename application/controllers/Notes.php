<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notes extends CI_Controller
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
		if ($this->session->has_userdata('login_session')) {
			$session_data = $this->session->userdata('login_session');
			
			$result['notes'] = $this->cm->SelectSingleData('user_id', $session_data['user_id'], 'tbl_notes', null, null);
			$this->load->view('notes', $result);
		} else {
			redirect('Home/Login');
		}
	}

	/*load add notes view using this function*/
	public function addNotes()
	{
		if ($this->session->has_userdata('login_session')) {
			$this->load->view('add-notes');
		} else {
			redirect('Home/Login');
		}
	}
	/*add notes to database using this function*/
	public function addNotesProcess()
	{

		if ($this->session->has_userdata('login_session')) {

			if ($_POST) {
				$post = $this->input->post();
				$session_data = $this->session->userdata('login_session');
				$user_id = $session_data['user_id'];

				$note_title = $this->encrypt->encode($post['note_title']);
				$note_body = $this->encrypt->encode($post['note_body']);
				$create_date = date("h:i:sa");

				$data = array(
					'note_id' => null,
					'user_id' => $user_id,
					'title' => $note_title,
					'note' =>  $note_body,

				);
				if ($this->cm->insertData('tbl_notes', $data)) {
					$array_msg = array('title' => 'Note Added Successfully', 'status' => 'success', 'msg' => '');
					$this->session->set_flashdata('note', $array_msg);
					redirect('Notes');
				} else {
					echo "error";
				}
			} else {
				echo "error";
			}
		} else {
			redirect('Home/Login');
		}
	}


	public function deleteNotes($note_id)
	{
		if(!empty($note_id))
		{
			if ($this->session->has_userdata('login_session')) {
			$session_data = $this->session->userdata('login_session');
			if($this->cm->deleteData('tbl_notes','note_id',$note_id,'user_id',$session_data['user_id']))
			{
				$array_msg = array('title' => 'Note Delete Successfully', 'status' => 'success', 'msg' => '');
				$this->session->set_flashdata('note', $array_msg);
				redirect('Notes');
			}
			else{
				echo "Nital🤣🤣🤣";
			}

			}
		}
	}

	public function updateNotes($note_id)
	{

		if(!empty($note_id))
		{
		if ($this->session->has_userdata('login_session')) {
		$session_data = $this->session->userdata('login_session');
		$result['notes'] = $this->cm->SelectSingleData('user_id', $session_data['user_id'], 'tbl_notes', 'note_id', $note_id);
		$this->load->view('update-notes',$result);

		} else {
			redirect('Home/Login');
		}
	}	
    }
   	public function updateNotesProcess()
	{
		if ($this->session->has_userdata('login_session')) {

			if ($_POST) {
				$post = $this->input->post();
				$session_data = $this->session->userdata('login_session');
				$user_id = $session_data['user_id'];

				$note_title = $this->encrypt->encode($post['note_title']);
				$note_body = $this->encrypt->encode($post['note_body']);
				

				$data = array(
					
					'title' => $note_title,
					'note' =>  $note_body,
					

				);
				
				if ($this->cm->updateData('tbl_notes',$data,'note_id',$post['note_id'],'user_id',$user_id)) {
					$array_msg = array('title' => 'Note Update Successfully', 'status' => 'success', 'msg' => '');
					$this->session->set_flashdata('note', $array_msg);
					redirect('Notes');
				} else {
					echo "error";
				}
			} else {
				echo "error";
			}
		} else {
			redirect('Home/Login');
		}
	}


	//download notes in pdf
	public function downloadNotes($note_id = null)
	{

		 if ($this->session->has_userdata('login_session')) {
			$session_data = $this->session->userdata('login_session');
			$mpdf = new \Mpdf\Mpdf();
			if($note_id !=null)
			{
				$result['notes'] = $this->cm->SelectSingleData('user_id', $session_data['user_id'], 'tbl_notes', 'note_id', $note_id);	
				$html = $this->load->view('mypdf',$result,true);
		          $mpdf->WriteHTML($html);
		          $mpdf->Output('your_note.pdf','D');
			}
			else{
				$result['notes'] = $this->cm->SelectSingleData('user_id', $session_data['user_id'], 'tbl_notes', null, null);	
				 $html = $this->load->view('mypdf',$result,true);
		          $mpdf->WriteHTML($html);
		          $mpdf->Output('your_all_notes.pdf','D');

			}
			
			
		} else {
			redirect('Home/Login');
		}
		 
          
	}
}
?>
