<?php
    class Home_Controller extends CI_Controller
    {
        
        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
           $data['header'] ="home";
           $this->load->view('Home/index.php',$data);
        }
    }
?>