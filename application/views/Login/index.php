<?php
    $this->load->view("Layout/sub_header.php");
?>
    <div>
        <h1>Login Here</h1>
        <br>
        <?php
            $this->form_validation->set_error_delimiters("<p class='error'>",'</p>');
            echo validation_errors();
        ?>
        <?php echo form_open(base_url('authenticate'));?>
            <input type="text" name="userName" id="userName" placeholder="Enter username / mobile number" value="<?php echo set_value('userName')?>" />
            <input type="password" name="userPass" id="userPass" placeholder="Enter password" value="<?php //echo set_value('userName')?>" />
            <input type="submit" id='submit' name="submit" value="Submit" />
            <a href="<?php echo base_url("register")?>" >Create account ?</a>
        </form>
    </div>
<?php
    $this->load->view("Layout/sub_footer.php");
?>