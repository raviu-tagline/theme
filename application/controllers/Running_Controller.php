<?php
    class Running_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $data['header'] ="about";
            $this->load->view('Running/index.php',$data);
        }

        public function runningsinglepost()
        {
            $data['header'] ="running";
            $this->load->view('Running/runningsinglepost.php',$data);
        }
    }
?>