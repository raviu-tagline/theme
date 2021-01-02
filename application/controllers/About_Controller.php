<?php
    class About_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
           if(isset($_SESSION['userID']))
           {
                $data['header'] ="about";
                $this->load->view('About/index.php',$data);
           }
           else {
               $this->load->view('Login/index.php');
           }
        }
    }
?>