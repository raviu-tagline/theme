<?php
    class Home_Controller extends CI_Controller
    {
        
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function index()
        {
            $data['header'] ="Home";
            $this->load->view('Home/index.php',$data);
        }

        public function about()
        {
            $data['header'] ="about";
            $this->load->view('Home/about.php',$data);
        }

        public function contact()
        {
            $data['header'] ="contact";
            $this->load->helper('form');
            $this->load->view('Home/contact.php',$data);
        }

        public function blog()
        {
            $data['header'] ="blog";
            $this->load->view('Home/blog.php',$data);
        }

        public function running()
        {
            $data['header'] ="running";
            $this->load->view('Home/running.php',$data);
        }

        public function runningsinglepost()
        {
            $data['header'] ="running";
            $this->load->view('Home/runningsinglepost.php',$data);
        }

        public function blogsinglepost()
        {
            $data['header'] ="blog";
            $this->load->view('Home/blogsinglepost.php',$data);
        }

        public function register()
        {
            $data['header'] = "register";
            $this->load->helper('form','form_validation');
            $this->load->view('Home/register.php',$data);
        }

        public function insert_data()
        {
            $this->load->helper('form');

            $this->load->library('form_validation');

            $this->load->model('DbOperations');


            $collection['header'] = "register";
           
            $this->form_validation->set_rules('userMail','Email','trim|valid_email|is_unique[tbl_data.reg_email]','This %s already exist');
            $this->form_validation->set_rules('userCPass','Paasword','matches[userPass]');
            $this->form_validation->set_rules('userMobile','Mobile Number','exact_length[10]');
            

            $data = $this->data();


            
            $this->DbOperations->insert($data);
            $collection['msg'] = "Data Submited";
            
            $this->load->view('Home/register.php',$collection,$data);
        }

        private function data()
        {
            $name = $this->input->post('fullName');
            $num = $this->input->post('mobile');
            $pass = $this->input->post('userPass');
            $bdate = $this->input->post('userBirthDate');
            $add = $this->input->post('addr');
            $mail = $this->input->post('userMail');
            $gen = $this->input->post('gender');
            $date = $this->input->post('userBirthDate');

            $tmpArray = array('reg_name'=>$name, 'reg_email'=>$mail, 'reg_pass'=>$pass, 'reg_gender'=>$gen, 'reg_birth_date'=>$date, 'reg_mobile'=>$num, 'reg_address'=>$add);

            return $tmpArray;
        }
    }
?>