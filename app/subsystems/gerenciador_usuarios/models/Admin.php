<?php

require_once(__DIR__ . "/SelectMain.php");

require_once('../src/PHPMailer.php');
require_once('../src/SMTP.php');
require_once('../src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Admin extends SelectMain
{
    public function __construct()
    {
        parent::__construct();
    }
    
}
