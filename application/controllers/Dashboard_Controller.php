<?php
    class Dashboard_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            $data['header'] ="data";
            $result = $this->DbOperations->select('tbl_data');
            $record["rec"] = array($result);
            $this->load->view('Dashboard/index',$data,$record);
        }

        public function update_data_view()
        {
            $id = $this->uri->segment('2');
            $id = $this->encryption->decrypt($id);
            $query = $this->db->get_where('tbl_data',array('reg_id' => $id));
            $data['id'] = $id;
            $data['header'] = "register";
            $data['records'] = $query->result();
            $this->load->view('Register/index',$data);
        }

        public function update_data()
        {
            $id = $this->uri->segment('2');
            $id = $this->encryption->decrypt($id);

            $data = $this->data();

            $this->DbOperations->update($id,$data);

            redirect("dashboard");
        }
        public function delete_data()
        {
            $id = $this->uri->segment('2');
            $id = $this->encryption->decrypt($id);
            $this->DbOperations->delete($id);

            $data['records'] = $this->DbOperations->select();
            $this->load->view('Dashboard/index.php',$data);
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
            
            // $file = $this->get_image_data();

            $tmpArray = array(
                'reg_name' => $name, 
                'reg_email' => $mail, 
                'reg_pass' => $pass, 
                'reg_gender' => $gen, 
                'reg_birth_date' => $date, 
                'reg_mobile' => $num,
                'reg_address' => $add
                // 'reg_image' => $file['upload_data']['file_name']
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