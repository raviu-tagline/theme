<?php
    $this->load->view('Home/Layout/header.php',"register");
?>
<?php
    // $m = '';
    // if(issset($msg))
    //     $m = $msg;
?>
<div id="body" class="contact">
    <div>
        <h1>Register Here</h1>
        <?php echo validation_errors();?>
        <?php echo form_open(base_url('insert_data')); ?>

        <input type="text" id="txtName" name="fullName" placeholder="Enter Full Name" required/>

        <br/>

        <input type="email" id="txtMail" name="userMail" placeholder="Enter Email" required/>

        <br/>

        <input type="password" id="txtPass" name="userPass" placeholder="Enter Pass" required/>

        <br/>

        <input type="password" id="txtCPass" name="userCPass" placeholder="Confirm Your Password" required/>

        <br/>

        <div class="radio">
            <input type="radio" id="rdbMale" name="gender" Value="Male" /> 
            <label>Male</label>

            <input type="radio" id="rdbFemale" name="gender" Value="Female" /> 
            <label>Female</label>
        </div>
        <br/>

        <input type="date" id="txtBDate" name="userBirthDate" required/>

        <br/>

        <input type="number" id="txtMobile" name="mobile" placeholder="Enter Your Mobile Number" required/>

        <br/>
        
        <textarea name='addr' cols='50' rows='7' placeholder='Enter address' value="" required></textarea>
        <br>
        
        <input id='submit' value='submit' type='submit'/>
        
        </form>
        
    </div>
</div>
<?php
    $this->load->view('Home/Layout/footer.php',"register");
?>