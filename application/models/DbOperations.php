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

        public function select($tbl = "tbl_data",$where = 'WHERE 1')
        {
            $query = $this->db->get($tbl);
            return $query->result();
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

        public function getById($id,$tbl = "tbl_data")
        {
            $query = $this->db->get_where($tbl, array('reg_id' => $id));
            return $query->result();
        }

        public function getByCondition($where = '', $tbl = 'tbl_data')
        {
            $str = 'select * from '.$tbl." ".$where;
            $query = $this->db->query($str);
            if($query->result())
            {
                return $query->result();
            }
            else
            {
                return False;
            }
        }

        public function getField($field, $tbl = 'tbl_data')
        {
            if($field == '')
            {
                $field = '*';
            }
            $str = "select $field from $tbl";
            $query = $this->db->query($str);
            // $result = $query->result();
            return $query->result();
        }

        // public function updateField($id)
    }
?>