<?php if (!defined('BASEPATH')) die();
class Main extends CI_Controller {

   public function index() {
   	  $viewInput = array();
   	  $viewInput['error'] = '';
   	  $viewInput['info'] = '';
   	  $viewInput['loggedInUserRole'] = '';
      $this->load->view('include/header',$viewInput);
      $this->load->view('templates/login',$viewInput);
      $this->load->view('include/footer');
	}
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
