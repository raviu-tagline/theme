<?php
    class Dashboard_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            if(isset($_SESSION['userID']))
            {
                $result = $this->DbOperations->select('tbl_data');
                $data = array("header" => 'data','records' => $result);
                $this->load->view('Dashboard/index.php',$data);
            }
            else 
            {
                $this->load->view('Login/index.php');
            }
        }
        
        public function delete_data()
        {
            $id = $this->uri->segment('2');
            // $id = $this->encryption->decrypt($id);
            $this->DbOperations->delete($id);
            $data['header'] = "data";
            $data['records'] = $this->DbOperations->select();
            // $this->load->view('Dashboard/index.php',$data);
            redirect(base_url('dashboard'));
        }
    }
?>