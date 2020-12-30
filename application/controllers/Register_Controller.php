
<?php
    class Register_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->library('session');
        }
        
        public function index()
        {
            $data['header'] ="register";
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
                'trim|regex_match[/^[6-9][0-9]{9}$/]|is_unique[tbl_data.reg_mobile]',
                array(
                        'regex_match'=>'Check Your %s',
                        'is_unique' => 'The %s is already exist'
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
            
            $file = $this->get_image_data();

            $tmpArray = array(
                'reg_name' => $name, 
                'reg_email' => $mail, 
                'reg_pass' => $pass, 
                'reg_gender' => $gen, 
                'reg_birth_date' => $date, 
                'reg_mobile' => $num,
                'reg_address' => $add,
                'reg_image' => $file['upload_data']['file_name']
            );

            return $tmpArray;
        }

        private function get_image_data()
        {
            $config['upload_path']          = './images/uploads';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('imgUpload'))
            {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                $this->load->view('Register/index.php', $error);
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                return $data;
            }
        }
    }
?>