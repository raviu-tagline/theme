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
    }
?>