<?php
    defined('BASEPATH') OR exit('No direct permission');
    class Validate
    {
    
        private $CI;
        private $login;

        public function validate_user()
        {
            $this->CI =& get_instance();

            if($this->CI->session->userdata('userID') == NULL)
            {
                $this->login = FALSE;
            }

            if(($this->CI !== NULL) && ($this->CI->session->userdata('userID') != NULL))
            {
                $this->login = TRUE;
            }

            if(($this->login === FALSE && $this->CI->uri->segment(1)!='login' && $this->CI->uri->segment(1)!='register'))
            {
                header("location: ".base_url("login"));
            }
        }
    }
?>