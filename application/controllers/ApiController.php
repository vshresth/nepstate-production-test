<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ApiController extends CI_Controller {
    function __construct()
	{
		
		parent::__construct();
		error_reporting(1);


		
		$this->load->library('form_validation');
		$this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        $this->db->reconnect();
        $this->data['uploads'] = base_url()."resources/uploads/";
		$this->data['assets'] = base_url()."resources/frontend/";	
		
	}

	public function getCitiesByCountry($id)
    {
    
            $listOfCities = $this->db->where('country_id', $id)->get('admin_cities')->result_object();
            if($listOfCities) {
                
                http_response_code(200);
                echo json_encode($listOfCities);
            }else{
                http_response_code(200);
                echo json_encode([]);
            }
         
    }





	public function sessionUnset()
	{

        unset($_SESSION["LISTYLOGIN"]);
		session_destroy();
		http_response_code(200);
        echo json_encode(1);

	}



	

}