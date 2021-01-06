<?php
    class Blog_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $data['header'] ="blog";
            $this->load->view('Blog/index.php',$data);
        }

        public function blogsinglepost()
        {
            $data['header'] ="blog";
            $this->load->view('Blog/blogsinglepost.php',$data);
        }
    }
?>