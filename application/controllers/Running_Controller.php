<?php
    class Running_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            if(isset($_SESSION['userID']))
            {
                $data['header'] ="running";
                $this->load->view('Running/index.php',$data);
            }
            else {
                $this->load->view("Login/index.php");
            }
        }

        public function runningsinglepost()
        {
            $data['header'] ="running";
            $this->load->view('Running/runningsinglepost.php',$data);
        }
    }
?>