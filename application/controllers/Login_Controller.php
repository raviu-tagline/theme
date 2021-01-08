<?php
    class Login_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            $_SESSION['userID'] = NULL;
            // $data['header'] = 'login';
            $this->load->view('Login/index.php');
        }
        public function authentication()
        {
            echo $this->input->post('userName');
            echo "<br>".$this->input->post('userPass')."<br>";
            // die;
            $this->form_validation->set_rules('userName','User Name','trim|required', array('required' => '%s is required'));
            $this->form_validation->set_rules('userPass','Password','trim|required', array('required' => '%s is required'));

            $this->form_validation->set_error_delimiters('<p class="error">','</p>');
            
            if($this->form_validation->run() == FALSE)
            {
                echo "Validate";
                die;
                // $data['header'] = 'login';
                $this->load->view("Login/index.php");
            }
            else 
            {
                echo "Invalid";
                // die;//
                $_SESSION['userID'] = $this->input->post('userName');
                $data['header'] = "data";
                redirect(base_url('home'));
                $this->load->view("Dashboard/index.php",$data);
                header("location:".base_url("data"));
            }

            if($_SESSION['userID'])
            {
                $this->load->view("Home/index.php");
            }
        }

        /*public function authenticate_id($str = '')
        {
            echo "Authenticate ID::";
            die;
            if(!is_numeric($str))
            {
                $where = array('reg_email' => "'$str'"); // and reg_pass = '$pass'
            }
            else {
                $where = array('reg_mobile' => "'$userName'"); //and reg_pass = '$pass'
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
            echo "Authenticate Pass::";
            die;
            $where['reg_pass'] = "'$str'";
            $result = $this->DbOperations->getByCondition($where);

            if(isset($result))
            {
                return TRUE;
            }
            else 
            {
                $this->form_validation->set_message('authenticate_pass','Invalid User ID / Password');
                return FALSE;
            }
        }*/
    }
?>