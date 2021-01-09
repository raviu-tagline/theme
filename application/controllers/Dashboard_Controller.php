
    <?php
    class Dashboard_Controller extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            if($_SESSION['userID'] == NULL)
            {
                die;
            }

            $fields = array('reg_id','reg_name','reg_email','reg_gender','td.status_id',
            'reg_birth_date', 'reg_mobile','country_name',
            'state_name','city_name','reg_address','reg_image','status_name');

            $join = array('tbl_country','tbl_state','tbl_city','tbl_status');
            $where = array();
            $order = array('reg_name' => 'asc');
            
            $result = $this->DbOperations->getJoinData($fields,$tbl = 'tbl_data', $join, $where, $order);
            $country = $this->DbOperations->select('tbl_country');
            $status = $this->DbOperations->select('tbl_status');

            // $data = array("header" => 'data','records' => $result);
            $data['header'] = 'data';
            $data['records'] = $result;
            $data['country'] = $country;
            $data['status'] = $status;
            
            $this->load->view('Dashboard/index.php',$data);
        }
        
        public function delete_data()
        {
            $id = $_REQUEST['id'];
            // $id = $this->encryption->decrypt($id);
            if($this->DbOperations->delete($id))
            {
                $data['header'] = "data";
                $data['records'] = $this->DbOperations->select();
            }
            else{
                return FALSE;
            }
            // $this->load->view('Dashboard/index.php',$data);
            // redirect(base_url('data'));
        }

        public function getStatus($id = '', $status = '')
        {
            $id = $_REQUEST['id'];
            $status_id = $_REQUEST['value'];

            if($status_id == 1)
            {
                $status_id = 2;
            }
            else if($status_id == 2)
            {
                $status_id = 1;
            }

            $up = array('status_id' => $status_id);
            $this->DbOperations->update($id, $up);

            $where = array('status_id' => $status_id);
            $status_res = $this->DbOperations->select('tbl_status', $where);
            $tmp = array();

            $data['id'] = $id;
            $data['value'] = $status_id;
            $data['status'] = $status_res[0]['status_name'];
            
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
            $country = isset($_REQUEST['country']) ? $_REQUEST['country'] : '';
            $state = isset($_REQUEST['state']) ? $_REQUEST['state'] : '';
            $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : '';

            $join = array('tbl_country', 'tbl_state', 'tbl_city', 'tbl_status');

            $fields = array(
                'reg_id','reg_name','reg_email','reg_gender',
                'reg_birth_date', 'reg_mobile','reg_address',
                'reg_image','status_name','country_name','state_name','city_name'
            );

            if($name != '')
            {
                $where['td.reg_name'] = $name;
            }

            if($email != '')
            {
                $where['td.reg_email'] = $email;
            }

            if($gender != '')
            {
                $where['td.reg_gender'] = $gender;
            }

            if($number != '')
            {
                $where['td.reg_mobile'] = $number;
            }

            if($address != '')
            {
                $where['td.reg_address'] = $address;
            }

            if($status != '')
            {
                $where['td.status_id'] = $status;
            }

            if($country != '')
            {
                $where['td.country_id'] = $country;
            }

            if($state != '')
            {
                $where['td.state_id'] = $state;
            }

            if($city != '')
            {
                $where['td.city_id'] = $city;
            }

            if(empty($where))
            {
                $where = array();
            }

            $data['records'] = $this->DbOperations->getJoinData($fields, 'tbl_data', $join, $where);

            $this->load->view('Dashboard/getFilterData.php',$data);
        }
    }
?>