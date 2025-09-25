<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Cookies extends ADMIN_Controller {

    public function updateUserCountry($countryId)
	{   

        echo 'test';
        die;
	
		setcookie("user_country_id", $countryId, 0, "/");
        redirect('/');
	}

}