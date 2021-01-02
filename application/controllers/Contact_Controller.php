<?php
    class Contact_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            if(isset($_SESSION['userID']))
            {
                $data['header'] ="contact";
                $this->load->view('Contact/index.php',$data);
            }
            else {
                $this->load->view('Login/index.php');
            }
        }
    }
?>