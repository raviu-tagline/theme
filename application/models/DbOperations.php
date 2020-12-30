<?php
    class DbOperations extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }

        public function insert($data)
        {
            if($this->db->insert("tbl_data", $data))
            {
                return TRUE;
            }
        }

        public function select($tbl = "tbl_data",$where = 'WHERE 1')
        {
            $query = $this->db->get($tbl);
            $result = $query->result();
            return $result;
        }

        public function update($id,$data)
        {
           $this->db->where('reg_id', $id);
           $this->db->update('tbl_data',$data);
        }

        public function delete($id,$tbl = "tbl_data")
        {
            if($this->db->delete($tbl,"reg_id = ".$id))
            {
                return TRUE;
            }
        }
    }
?>