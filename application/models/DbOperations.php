<?php
    class DbOperations extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }

        public function insert($data, $tbl = 'tbl_data')
        {
            if($this->db->insert($tbl, $data))
            {
                return TRUE;
            }
        }

        public function select($tbl = "tbl_data",$where = array())
        {
            $this->db->where($where);
            $query = $this->db->get($tbl);
            return $query->result_array();
        }

        public function update($id, $data, $tbl = 'tbl_data')
        {
           $this->db->where('reg_id', $id);
           $this->db->update($tbl, $data);
        }

        public function delete($id,$tbl = "tbl_data")
        {
            $query = $this->db->select('reg_image')->where('reg_id', $id)->get($tbl);
            $result = $query->row();
            $img = '';
            foreach($result as $key => $val)
            {
                $img = $val;    
            }
            if($this->db->delete($tbl,"reg_id = ".$id))
            {
                $path = base_url('images/uploads/').$img;
                delete_files($path);
                return TRUE;
            }
        }

        public function getById($id,$tbl = "tbl_data", $where)
        {
            $query = $this->db->get_where($tbl, $where);
            return $query->row_array();
        }

        public function getByCondition($where, $tbl = 'tbl_data')
        {

            $str = 'select * from '.$tbl." where ";
            foreach($where as $key => $val)
            {
                $str .= " $key = $val and";
            }

            $str = trim($str, ' and');
            
            $query = $this->db->query($str);

            if($query->result())
            {
                return $query->result_array();
            }
            else
            {
                return False;
            }
        }

        public function getFieldsByCondition($field = array(), $tbl = 'tbl_data',$where = array())
        {
            $flds = '';
            $cnd = '';
            $str = '';

            if(!empty($field))
            {
                foreach($field as $key => $val)
                {
                    $flds .= "$val, ";
                }
            }

            if(!empty($where))
            {
                $cnd = ' where';
                foreach($where as $key => $val)
                {
                    $cnd .= " $key = '$val' and";
                }

                $cnd = rtrim($cnd, 'and');
            }

            $flds = rtrim($flds, ', ');

            $str = "select $flds from $tbl $cnd";
            $query = $this->db->query($str);

            return $query->result_array();
        }

        public function getJoinData($field = array(), $tbl = 'tbl_data', $join = array(), $where = array(), $order = array())
        {
            $flds = '';

            if(!empty($field))
            {
                foreach($field as $key => $val)
                {
                    $flds .= "$val, ";
                }
            }

            foreach($order as $key => $val)
            {
                $col_name = $key;
                $order_by = $val;
            }

            $flds = rtrim($flds, ', ');
            $this->db->select("$flds");
            $this->db->from("$tbl as td");

            $this->db->join($join[0]." as td0","td.country_id = td0.country_id");
            $this->db->join($join[1]." as td1","td.state_id = td1.state_id");
            $this->db->join($join[2]." as td2","td.city_id = td2.city_id");
            $this->db->join($join[3]." as td3","td.status_id = td3.status_id");
            $this->db->where($where);
            $this->db->order_by($col_name, $order_by);
            
            $result = $this->db->get();
            return $result->result_array();
        }
    }
?>