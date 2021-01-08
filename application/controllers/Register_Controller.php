
<?php
    class Register_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            // $this->load->view('Register/index.php');
            // $this->load->library('session');
        }
        
        public function init()
        {
            $country =  $this->DbOperations->select('tbl_country');
            $status = $this->DbOperations->select('tbl_status');

            $data['header'] = 'register';
            $data['country'] = $country;
            $data['status'] = $status;
            return $data;
        }

        public function index()
        {
            $data = $this->init();
            $this->load->view('Register/index.php',$data);
        }

        public function insert_data($id = '', $data = '')
        {
            $this->form_validation->set_rules('fullName', 'Name', 'trim|regex_match[/^[a-zA-Z]+/]', array('regex_match' => 'Your %s contains other then alphabets'));

            $this->form_validation->set_rules('userMail','Email',"trim|callback_exist_check");
            $this->form_validation->set_rules('userPass', 'Password',   'trim|min_length[8]', array('min_length' => '%s length must be 8 characters or above'));
            $this->form_validation->set_rules('userCPass',  'Confirm Paasword', 'trim|matches[userPass]',   array(   'matches'=>'The %s not match'    )  );
            $this->form_validation->set_rules('mobile',  'Mobile Number',  'trim|regex_match[/^[6-9][0-9]{9}$/]',
                array( 'regex_match'=>'Check Your %s'   )  );
            
            $this->form_validation->set_error_delimiters('<p class="error">','</p>');

            $data = array();
            $data = $this->init();
            if($this->form_validation->run() == FALSE)
            {
                $data['header'] = "register";
                if(!empty($id) && is_numeric($id))
                {
                    // $record = $this->DbOperations->getById($id);
                    // $data['records'] = $record;
                    $data['records'] = $this->DbOperations->getById($id);
                    var_dump($data['records']);
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
                    $this->DbOperations->insert($data['records']);
                    $this->session->set_flashdata('suc_message','Data Inserted');
                }
                else
                {
                    $this->DbOperations->update($id, $data['records']);
                    $this->session->set_flashdata('suc_message','Data Updated');
                    $data['header'] = 'data';
                }
                // echo "Operations performed";
                header('location:'.base_url('data'));
                // $this->load->view("Dashboard/index.php",$data);
            }
        }

        public function exist_check($str = '')
        {
            $id = $this->uri->segment('2');
            
            if($id == NULL)
            {
                //Code for validate email at time of insert.

                $where = array('reg_email' => "'$str'");
                $result = $this->DbOperations->getByCondition($where);
                $data['result'] = $result;

                if($result !== FALSE)
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

                $where = array('reg_email' => "'$str'", 'reg_id' => $id);
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
            
            $info =  $this->DbOperations->select('tbl_country');

            // $id = $this->encryption->decrypt($id);
            // echo "<p>{$id}</p>";

            // $where = array('reg_id' => $id);
            $result = $this->DbOperations->getById($id);

            $data = $this->init();

            $data['info'] = $info;
            $data['records'] = $result;
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
            $name = $this->input->post('fullName');
            $num = $this->input->post('mobile');
            $pass = $this->input->post('userPass');
            $bdate = $this->input->post('userBirthDate');
            $add = $this->input->post('addr');
            $mail = $this->input->post('userMail');
            $gen = $this->input->post('gender');
            $date = $this->input->post('userBirthDate');
            $cntry = $this->input->post('ddlCountry');
            $stat = $this->input->post('ddlState');
            $ct = $this->input->post('ddlCity');
            $st = $this->input->post('ddlStatus');
            
            $file = $this->get_image_data();

            $tmpArray = array(
                'reg_name' => $name, 
                'reg_email' => $mail, 
                'reg_pass' => $pass, 
                'reg_gender' => $gen, 
                'reg_birth_date' => $date, 
                'reg_mobile' => $num,
                'country_id' => $cntry,
                'state_id' => $stat,
                'city_id' => $ct,
                'reg_address' => $add,
                'reg_image' => $file['upload_data']['file_name'],
                'status_id' => $st
            );

            return $tmpArray;
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

        public function getState($id = '')
        {
            if($id == '')
            {
                $id = $_REQUEST['id'];
            }
            // $where = " where country_id = $id";
            $where = array('country_id'=> $id);
            $fields = array('state_id','state_name');
           
            $data['info'] = $this->DbOperations->getFieldsByCondition($fields, 'tbl_state', $where);

            $this->load->view('Register/getState.php',$data);
        }

        public function getCity($id = '')
        {
            if($id == '')
            {
                $id = $_REQUEST['id'];
            }
            // $where = " where state_id = $id";
            $where = array('state_id' => $id);
            $fields = array('city_id','city_name');

            $data = array('info' => $this->DbOperations->getFieldsByCondition($fields, 'tbl_city', $where));
            $this->load->view('Register/getCity.php',$data);
        }
    }
?>