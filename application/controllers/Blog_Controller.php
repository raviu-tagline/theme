<?php
    class Blog_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            if($_SESSION['userID'])
            {
                $data['header'] ="blog";
                $this->load->view('Blog/index.php',$data);
            }
            else {
                $this->load->view('Login/index.php');
            }
        }

        public function blogsinglepost()
        {
            $data['header'] ="blog";
            $this->load->view('Blog/blogsinglepost.php',$data);
        }
    }
?>