<?php
    class Contact_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $data['header'] ="contact";
            $this->load->view('Contact/index.php',$data);
        }
    }
?>