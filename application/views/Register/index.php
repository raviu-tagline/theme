
<?php
    $this->load->view('Layout/header.php',"register");
?>
<?php

    $tmpArr = array();

    if(isset($records))
    {
        foreach($records as $array)
        {
            foreach($array as $key => $val)
            {
                $tmpArr[$key] = $val;
            }
        }
    }
    else
    {
        $tmpArr = NULL;
    }
?>


<div id="body" class="contact">
    <div>
        <h1>Register Here</h1>
        <br/>

        <?php 
            if($this->session->flashdata('suc_message') != NULL)
            {
                echo "<br/>";
                echo "<p class='msg'>".$this->session->flashdata('suc_message')."</p>";
            }
        ?>

        <?php 
            $this->form_validation->set_error_delimiters("<p class='error'>",'</p>');
            echo validation_errors();
        ?>

        <?php $data = array('enctype' => 'multipart/form-data'); ?>

        <?php 
            if(isset($tmpArr))
            {
                // $id = $this->encryption->encrypt($id);
                echo form_open(base_url('update_data/').$id,$data);
            }
            else
            {
                echo form_open(base_url('insert_data'),$data);
            }
        ?>

        <input type="text" id="txtName" name="fullName" placeholder="Enter Full Name" value="<?php echo set_value('fullName') ? set_value('fullName') : (
            isset($tmpArr['reg_name']) ? $tmpArr['reg_name'] : "");?>" required/>

        <br/>

        <input type="email" id="txtMail" name="userMail" placeholder="Enter Email" value="<?php echo set_value('userMail') ? set_value('userMail') : (
                isset($tmpArr['reg_email']) ? $tmpArr['reg_email'] : "");?>" required/>

        <br/>

        <input type="password" id="txtPass" name="userPass" placeholder="Enter Pass" value="<?php echo set_value('userPass') ? set_value('userPass') : (
                isset($tmpArr['reg_pass']) ? $tmpArr['reg_pass'] : "");?>" required/>

        <br/>

        <input type="password" id="txtCPass" name="userCPass" placeholder="Confirm Your Password" value="<?php echo set_value('userCPass') ? set_value('userCPass') : (
            isset($tmpArr['reg_pass']) ? $tmpArr['reg_pass'] : "");?>" required/>

        <br/>

        <div class="radio">
            <input type="radio" id="rdbMale" name="gender" Value="Male" <?php echo (set_value('gender') == 'Male') ? "checked" : (
                isset($tmpArr['reg_gender']) && $tmpArr['reg_gender'] == 'Male' ? 'checked' : "");?> /> 
            <label>Male</label>

            <input type="radio" id="rdbFemale" name="gender" Value="Female" <?php echo (set_value('gender') == 'Female') ? "checked" : (
                isset($tmpArr['reg_gender']) && $tmpArr['reg_gender'] == 'Female' ? 'checked' : "");?> /> 
            <label>Female</label>
        </div>
        <br/>

        <input type="date" id="txtBDate" name="userBirthDate" value="<?php echo set_value('userBirthDate') ? set_value('userBirthDate') : (
            isset($tmpArr['reg_birth_date']) ? $tmpArr['reg_birth_date'] : "");?>" required/>

        <br/>

        <input type="number" id="txtMobile" name="mobile" placeholder="Enter Your Mobile Number" value="<?php echo set_value('mobile') ? set_value('mobile') : (
            isset($tmpArr['reg_mobile']) ? $tmpArr['reg_mobile'] : "");?>" required/>

        <br/>
        
        <textarea name='addr' cols='50' rows='7' placeholder='Enter address' required><?php echo set_value('addr') ? set_value('addr') : (
            isset($tmpArr['reg_address']) ? $tmpArr['reg_address'] : "");?></textarea>
        <br>
        
        <input type="file" id="imgUpload" name='imgUpload' accept='image/*' required/>

        <input id='submit' value='submit' type='submit'/>
        
        </form>
        
    </div>
</div>

<?php
    $this->load->view('Layout/footer.php',"register");
?>