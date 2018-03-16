<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->insert($this->get_ip());
		$this->load->view('welcome_message');
	}

	public function get_ip()
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	        //ip pass from proxy
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }else{
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}

	public function request()
	{
		$this->insert($this->get_ip());
		$result = $this->Mdl_hit->get();
        return $this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function insert($ip)
	{		
		if ($this->Mdl_hit->check_ip($ip)) {
			return TRUE;
		}else{
			$this->Mdl_hit->insert($ip);
		}
	}

	public function clear()
	{
		$this->Mdl_hit->clear();
	}

}
