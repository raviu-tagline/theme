<?php
    class Contact_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $data['header'] ="contact";
            $this->load->view('Contact/index.php',$data);
        }

        public function submit()
        {
            $array = array();
            
            $this->form_validation->set_rules('name','Name','trim|required', array('required' => '%s must required'));
            $this->form_validation->set_rules('email','EMail ID','trim|required|is_unique[tbl_contact.con_mail]',array(
                'is_unique' => '%s already exist',
                'required' => '%s must required'
            ));

            $this->form_validation->set_rules('chkContact','Option','trim|required', array('required' => '%s must select'));
            $this->form_validation->set_rules('gender','Gender','trim|required', array('required' => '%s must select'));
            $this->form_validation->set_rules('addr','Address','trim|required', array('required' => '%s must required'));
            $this->form_validation->set_rules('imgUpload','Image','trim|required', array('required' => '%s must required'));

            $this->form_validation->set_rules('number','Mobile Number','trim|required|is_unique[tbl_contact.con_number]|regex_match[/^[6-9][0-9]{9}$/]', array(
                'is_unique' => '%s already exist',
                'regex_matches' => '%s not valid',
                'required' => '%s must required'
            ));

            
            if($this->form_validation->run() == FALSE)
            {
                $array = array(
                    'name_err' => form_error('name'), 
                    'mail_err' => form_error('email'),
                    'chk_err' => form_error('chkContact'),
                    'rdb_err' => form_error('gender'),
                    'addr_err' => form_error('addr'),
                    'num_err' => form_error('number'),
                    'img_err' => form_error('imgUpload'),
                    'values' => ''
                );
            }
            else
            {
                $config['upload_path'] = './images/uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '0';
                $config['max_width'] = '0';
                $config['max_height'] = '0';

                $this->load->library('upload', $config);

                $data = $this->data();

                if ($this->upload->do_upload('imgUpload'))
                {
                    $file = $this->upload->data();
                    $data['con_image'] = $file['file_name'];
                    
                    if($this->DbOperations->insert($data, 'tbl_contact'))
                    {
                        $array['values'] = "Successfully insert data";
                    }
                    else 
                    {
                        $array['values'] = "Error while insert";
                    }
                }
                else
                {
                    $array['error'] = $this->upload->display_errors();
                }
            }

            $this->output->set_output(json_encode($array));
        }

        public function data()
        {
            $tmp = array();

            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $number = $this->input->post('number');
            $chkValues = $_REQUEST['chk'];
            $gen = $this->input->post('gender');
            $addr = $this->input->post('addr');
            $file = $this->upload->data();

            $tmp = array(
                'con_name' => $name,
                'con_mail' => $email,
                'con_number' => $number,
                'con_type' => $chkValues,
                'con_address' => $addr
            );

            return $tmp;
        }
    }
?>