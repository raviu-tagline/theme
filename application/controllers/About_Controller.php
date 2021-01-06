<?php
    class About_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
        //    if(isset($_SESSION['userID']))
        //    {
                
        //    }
        //    else {
        //        $this->load->view('Login/index.php');
        //    }

           $data['header'] ="about";
           $this->load->view('About/index.php',$data);
        }
    }
?>