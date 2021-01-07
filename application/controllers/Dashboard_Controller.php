
    <?php
    class Dashboard_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            $result = $this->DbOperations->select('tbl_data');
            $data = array("header" => 'data','records' => $result);
            $this->load->view('Dashboard/index.php',$data);
        }
        
        public function delete_data()
        {
            $id = $this->uri->segment('2');
            // $id = $this->encryption->decrypt($id);
            $this->DbOperations->delete($id);
            $data['header'] = "data";
            $data['records'] = $this->DbOperations->select();
            // $this->load->view('Dashboard/index.php',$data);
            redirect(base_url('data'));
        }

        public function getStatus($id = '', $status = '')
        {
            $id = $_REQUEST['id'];
            $status = $_REQUEST['value'];

            $data['id'] = $id;
            $data['value'] = $status;

            $tmp = array();
            $up = array('reg_status' => $status);
            $this->DbOperations->update($id, $up);
            if($status == "Active")
            {
                $data['value'] = "Deactive";
            }
            else
            {
                $data['value'] = 'Active';
            }
            
            $tmp = json_encode($data);
            
            $this->output->set_output($tmp);
        }

        public function filterData()
        {
            $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
            $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
            $gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
            $number = isset($_REQUEST['number']) ? $_REQUEST['number'] : '';
            $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
            $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';

            $where = " where";

            if($name != '')
            {
                $where .= " reg_name = '$name' and";
            }
            if($email != '')
            {
                $where .= " reg_email = '$email' and";
            }
            if($gender != '')
            {
                $where .= " reg_gender = '$gender' and";
            }
            if($number != '')
            {
                $where .= " reg_mobile = '$number' and";
            }
            if($address != '')
            {
                $where .= " reg_address = '$address' and";
            }
            if($status != '')
            {
                $where .= " reg_status = '$status' and";
            }
            
            $where = rtrim($where, ' and');

            $data = array('records' => $this->DbOperations->getByCondition($where));

            $this->load->view('Dashboard/getFilterData.php',$data);
        }
    }
?>