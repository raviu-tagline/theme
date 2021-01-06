<?php
    class Login_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            unset($_SESSION['userID']);
            $data['header'] = 'login';
            $this->load->view('Login/index.php',$data);
        }
        public function authentication()
        {
            if($_SESSION['userID'])
            {
                $this->load->view("Home/index.php");
            }
            $this->form_validation->set_rules('userName','ID','trim|callback_authenticate_id');
            $this->form_validation->set_rules('userPass','Pass','trim|callback_authenticate_pass');

            $this->form_validation->set_error_delimiters('<p class="error">','</p>');
            
            if($this->form_validation->run() == FALSE)
            {
                $data['header'] = 'login';
                $this->load->view("Login/index.php",$data);
            }
            else 
            {
                $_SESSION['userID'] = $this->input->post('userName');
                $data['header'] = "data";
                redirect(base_url('home'));
                $this->load->view("Dashboard/index.php",$data);
                header("location:".base_url("data"));
            }
        }

        public function authenticate_id($str = '')
        {
            if(!is_numeric($str))
            {
                $where = " where reg_email = '$str'"; // and reg_pass = '$pass'
            }
            else {
                $where = " where reg_mobile = '$userName'"; //and reg_pass = '$pass'
            }

            $result = $this->DbOperations->getByCondition($where);

            if(!empty($result))
            {
                // $data['header'] = 'data';
                // $this->load->view("Dashboard/index.php",$data);

                return TRUE;
            }
            else 
            {
                $this->form_validation->set_message('authenticate_id','Invalid User ID / Password');
                return FALSE;
            }
        }

        public function authenticate_pass($str = '')
        {
            $where = " where reg_pass = '$str'";
            $result = $this->DbOperations->getByCondition($where);

            if(isset($result))
            {
                return TRUE;
            }
            else 
            {
                $this->form_validation->set_message('authenticate_pass','Invalid Password');
                return FALSE;
            }
        }
    }
?>