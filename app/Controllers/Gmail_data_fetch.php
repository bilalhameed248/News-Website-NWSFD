<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gmail_data_fetch extends CI_Controller {
function __construct() {
        parent::__construct();
    }
	
	

  public function get_inbox_message()
  {
  	var_dump("OK");
  	die();
    $this->load->view('gmail_data_fetch');
  }
	
}


