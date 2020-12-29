
<?php
    $this->load->view('Home/Layout/header.php',"register");
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

        <?php echo form_open(base_url('insert_data'),$data); ?>

        <input type="text" id="txtName" name="fullName" placeholder="Enter Full Name" value="<?php echo set_value('fullName')?>" required/>

        <br/>

        <input type="email" id="txtMail" name="userMail" placeholder="Enter Email" value="<?php echo set_value('userMail')?>" required/>

        <br/>

        <input type="password" id="txtPass" name="userPass" placeholder="Enter Pass" value="<?php echo set_value('userMail')?>" required/>

        <br/>

        <input type="password" id="txtCPass" name="userCPass" placeholder="Confirm Your Password" value="<?php echo set_value('userMail')?>" required/>

        <br/>

        <div class="radio">
            <input type="radio" id="rdbMale" name="gender" Value="Male" <?php echo (set_value('gender') == 'Male') ? "checked" : "";?> /> 
            <label>Male</label>

            <input type="radio" id="rdbFemale" name="gender" Value="Female" <?php echo (set_value('gender') == 'Female') ? "checked" : "";?> /> 
            <label>Female</label>
        </div>
        <br/>

        <input type="date" id="txtBDate" name="userBirthDate" value="<?php echo set_value('userBirthDate')?>" required/>

        <br/>

        <input type="number" id="txtMobile" name="mobile" placeholder="Enter Your Mobile Number" value="<?php echo set_value('mobile')?>" required/>

        <br/>
        
        <textarea name='addr' cols='50' rows='7' placeholder='Enter address' required><?php echo set_value('addr')?></textarea>
        <br>
        
        <input type="file" id="imgUpload" name='imgUpload' accept='image/*' />

        <input id='submit' value='submit' type='submit'/>
        
        </form>
        
    </div>
</div>

<?php
    $this->load->view('Home/Layout/footer.php',"register");
?>