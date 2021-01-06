<?php
    defined('BASEPATH') OR exit('No direct permission');
    class Validate
    {
        public function validate_user()
        {
            $CI =& get_instance();
			
            $login = FALSE;
            if($CI->session->userdata('userID'))
            {
                $login = TRUE;
            }
            if(($login==false && $CI->uri->segment(1)!='login'))
            {
                header("location: ".base_url("login"));
            }
        }
    }
?>