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

        public function select_where($id,$tbl = "tbl_data")
        {
            $query = $this->db->get_where($tbl, array('reg_id' => $id));
            $result = $query->result();
            return $result;
        }
    }
?>