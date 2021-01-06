
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
            $result =  $this->DbOperations->select('tbl_country');
            $data = array("header" => 'register','info' => $result);
            $this->load->view('Register/index.php',$data);
        }

        public function insert_data($id = '', $data = '')
        {
            
            /*if($id != '' && $id != NULL && is_numeric($id))
            {
                echo "Id ::: ".$id." data :::: ".$data;
                // $id = $this->encryption->decode($id);
            }*/
           
            $this->form_validation->set_rules('fullName', 'Name', 'trim|regex_match[/^[a-zA-Z]+/]', array('regex_match' => 'Your %s contains other then alphabets'));

            $this->form_validation->set_rules('userMail','Email',"trim|callback_exist_check");
            $this->form_validation->set_rules('userPass', 'Password',   'trim'   );
            $this->form_validation->set_rules('userCPass',  'Confirm Paasword', 'trim|matches[userPass]',   array(   'matches'=>'The %s not match'    )  );
            $this->form_validation->set_rules('mobile',  'Mobile Number',  'trim|regex_match[/^[6-9][0-9]{9}$/]',
                array( 'regex_match'=>'Check Your %s'   )  );
            
            $this->form_validation->set_error_delimiters('<p class="error">','</p>');

            $data = array();

            if($this->form_validation->run() == FALSE)
            {
                $data['header'] = "register";
                if($id != '' && $id != NULL &&  is_numeric($id))
                {
                    $record = $this->DbOperations->getById($id);
                    $data['records'] = $record;
                }
                else
                {
                    $data['records'] = '';
                }
                $this->load->view("Register/index.php",$data);
            }
            else
            {
                $data['records'] = $this->data();

                if($id == '' || $id == NULL)
                {
                    $this->DbOperations->insert($data);
                    $this->session->set_flashdata('suc_message','Data Inserted');
                }
                else
                {
                    $this->DbOperations->update($id, $data['records']);
                    $this->session->set_flashdata('suc_message','Data Updated');
                    $data['header'] = 'data';
                }
                echo "Operations performed";
                // header('location:'.base_url('dashboard'));
                $this->load->view("Dashboard/index.php");
            }
        }

        public function exist_check($str = '')
        {
            $id = $this->uri->segment('2');
            
            if($id == NULL)
            {
                //Code for validate email at time of insert.

                $where = ' where reg_email = '."'$str'";
                $result = $this->DbOperations->getByCondition($where);

                if(isset($result))
                {
                    $this->form_validation->set_message('exist_check','{field} already exist');
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
            else 
            {
                //Code for validate email at time of update.

                $where = ' where reg_email = '."'$str' and reg_id = $id";
                $result = $this->DbOperations->getByCondition($where);

                if( ! empty($result))
                {
                    return TRUE;
                }
                else
                {
                    $this->form_validation->set_message('exist_check','{field} already exist');
                    return FALSE;
                }
            }
        }

        public function check_mail($email = '')
        {
            echo "Line : 155 Email is already taken ::: ".$email;
            $info = $_REQUEST['userMail'];
            echo "<br>Line : 157 ".$info;
            // die;
            if($info == $email)
            {
                echo "<br>Line : 161 Returns true";
                return TRUE;
            }
            else
            {
                echo "Returns FALSE";
                return FALSE;
            }
        }
        public function update_data_view()
        {
            $id = $this->uri->segment('2');
            // $id = $this->encryption->decrypt($id);
            // echo "<p>{$id}</p>";
            $result = $this->DbOperations->getById($id);
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

        public function getState($cid = '')
        {
            $id = $_REQUEST['id'];
            $where = " where country_id = $id";
            $data = array('info' => $this->DbOperations->getByCondition($where, 'tbl_state'));
            return $this->load->view('Register/getState.php',$data);
        }

        public function getCity($sid = '')
        {
            $id = $_REQUEST['id'];
            $where = " where state_id = $id";
            $data = array('info' => $this->DbOperations->getByCondition($where, 'tbl_city'));
            return $this->load->view('Register/getCity.php',$data);
        }
    }
?>