<?php
    class Register_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $data['header'] ="about";
            $this->load->view('Register/index.php',$data);
        }

        public function insert_data()
        {
            $collection['header'] = "register";
           
            $this->form_validation->set_rules(
                'userMail',
                'Email',
                'trim|valid_email|is_unique[tbl_data.reg_email]',
                array(
                        'is_unique'=>'This %s already exist'
                    )
            );

            $this->form_validation->set_rules(
                'userPass',
                'Password',
                'trim'
            );

            $this->form_validation->set_rules(
                'userCPass',
                'Confirm Paasword',
                'trim|matches[userPass]',
                array(
                        'matches'=>'The %s not match'
                    )
            );

            $this->form_validation->set_rules(
                'mobile',
                'Mobile Number',
                'trim|regex_match[/^[6-9][0-9]{9}$/]',
                array(
                        'regex_match'=>'Check Your %s'
                    )
            );

            $this->form_validation->set_rules(
                'imgUpload',
                'Image',
                'required',
                array(
                        'required' => 'The %s is not properly uploaded'
                )
            );

            $this->form_validation->set_error_delimiters('<p class="error">','</p>');

            $data = $this->data();

            if($this->form_validation->run() == FALSE)
            {
                $this->load->view("Register/index.php");
            }
            else
            {
                $this->DbOperations->insert($data);
                $collection['msg'] = "Data Submited";
                $this->session->set_flashdata('suc_message','Data Inserted');
                redirect(base_url('register'));
            }
            
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

            $tmpArray = array(
                'reg_name'=>$name, 
                'reg_email'=>$mail, 
                'reg_pass'=>$pass, 
                'reg_gender'=>$gen, 
                'reg_birth_date'=>$date, 
                'reg_mobile'=>$num, 
                'reg_address'=>$add
            );

            return $tmpArray;
        }
    }
?>