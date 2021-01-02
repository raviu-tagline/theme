<?php
    class Home_Controller extends CI_Controller
    {
        
        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
           if(isset($_SESSION['userID']))
           {
                $data['header'] ="Home";
                $this->load->view('Home/index.php',$data);
           }
           else {
               $this->load->view('Login/index.php');
           }
        }
    }
?>