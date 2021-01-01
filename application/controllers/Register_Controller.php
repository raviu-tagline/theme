
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

        public function insert_data($id = '', $data = '')
        {
            
            $collection['header'] = "register";
           
            $this->form_validation->set_rules('fullName', 'Name', 'trim|regex_match[/^[a-zA-Z]+/]', array('regex_match' => 'Your %s contains other then alphabets'));

            $this->form_validation->set_rules('userMail','Email',"callback_exist_check");
            $this->form_validation->set_rules('userPass', 'Password',   'trim'   );
            $this->form_validation->set_rules('userCPass',  'Confirm Paasword', 'trim|matches[userPass]',   array(   'matches'=>'The %s not match'    )  );
            $this->form_validation->set_rules('mobile',  'Mobile Number',  'trim|regex_match[/^[6-9][0-9]{9}$/]|callback_exist_check',
                array( 'regex_match'=>'Check Your %s'   )  );
            
            $this->form_validation->set_error_delimiters('<p class="error">','</p>');


            $data = $this->data();
            
            if($this->form_validation->run())
            {
                if($id != '' || $id != NULL)
                {
                    // $id = $this->encryption->decrypt($id);
                    $this->DbOperations->update($id, $data);
                    $data['header'] = 'data';
                    redirect(base_url('dashboard'));
                }
                else
                {
                    $this->DbOperations->insert($data);
                    $this->session->set_flashdata('suc_message','Data Inserted');
                    redirect(base_url('dashboard'));
                }
            }
            else
            {
                $this->load->view("Register/index.php");
            }
            
        }

        public function exist_check()
        {
            $id = $this->uri->segment('2');
            if($id === NULL)
            {
                $this->form_validation->set_rules('userMail','Mail','is_unique[tbl_data.reg_email]', array( 'is_unique' => '%s already exist'));
                $this->form_validation->set_rules('mobile','Mobile number','is_unique[tbl_data.reg_mobile]', array('is_unique' => '%s already exist'));
                if($this->form_validation->run())
                {
                    return TRUE;
                }
                else 
                {
                    $this->form_validation->set_error_delimiters('<p class="error">','</p>');
                }
            }
            else {
                $result = $this->DbOperations->select_where($id);
                // foreach ($result as $tmp):

                //     foreach ($tmp as $k => $v):

                //         if ($k == 'reg_email'):
                            
                //             $str = $v;
                //             break;

                //         endif;

                //     endforeach;

                // endforeach;

                $this->form_validation->set_rules('userMail','Mail',"matches[tbl_data.reg_email]", array('matches' => "%s already exist"));
                if($this->form_validation->run() == FALSE)
                {
                    return $this->form_validation->set_error_delimiters('<p class="error">','</p>');
                }
                else {
                    echo "True";
                    die;
                }
            }
        }

        public function update_data_view()
        {
            $id = $this->uri->segment('2');
            // $id = $this->encryption->decrypt($id);
            // echo "<p>{$id}</p>";
            $result = $this->DbOperations->select_where($id);
            $data['records'] = $result;
            $data['header'] = 'register';
            $data['id'] = $id;
            $this->load->view('Register/index.php',$data);
        }

        public function update_data()
        {
            $id = $this->uri->segment('2');
            // $data = $this->data();
            $this->insert_data($id);
            // $id = $this->encryption->decrypt($id);
            // $this->DbOperations->update($id, $data);
        }

        private function data()
        {
            // $this->form_validation->set_rules('userMail','Email','trim|valid_email|is_unique[tbl_data.reg_email]',array('is_unique'=>'This %s already exist'));
            // $this->form_validation->set_rules('userPass', 'Password',   'trim'   );
            // $this->form_validation->set_rules('userCPass',  'Confirm Paasword', 'trim|matches[userPass]',   array(   'matches'=>'The %s not match'    )  );
            // $this->form_validation->set_rules('mobile',  'Mobile Number',  'trim|regex_match[/^[6-9][0-9]{9}$/]|is_unique[tbl_data.reg_mobile]',
            //     array( 'regex_match'=>'Check Your %s',  'is_unique' => 'The %s is already exist'   )  );
            // $this->form_validation->set_error_delimiters('<p class="error">','</p>');

            $name = $this->input->post('fullName');
            $num = $this->input->post('mobile');
            $pass = $this->input->post('userPass');
            $bdate = $this->input->post('userBirthDate');
            $add = $this->input->post('addr');
            $mail = $this->input->post('userMail');
            $gen = $this->input->post('gender');
            $date = $this->input->post('userBirthDate');
            
            $file = $this->get_image_data();
            if($name && $num && $pass && $bdate && $add && $mail && $gen && $date && $file != FALSE)
            {
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
            else
            {
                echo "<pre>";
                echo $name." ".$num." ".$pass." ".$bdate." ".$add." ".$mail." ".$gen." ".$date." ".$file;
                echo "</pre>";
            }
        }

        private function get_image_data()
        {
            $config['upload_path'] = './images/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '0';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('imgUpload'))
            {
                $error = array('error' => $this->upload->display_errors());
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