<?php
    $this->load->view('Home/Layout/header.php',"Home");
?>
<div id="body" class="home">
    <div class="header">
        <div>
            <h1>RUN<br>THE STREETS OF QUEENS</h1>
            <span>
                <a href=" <?php echo base_url("contact");?>" class="email">Enter Email</a>
                <a href=" <?php echo base_url("contact");?>" class="signup">Sign Up</a></span>
            <img src="<?php echo base_url()?>images/runner.png" alt="">
        </div>
    </div>
    <div class="body"> 
        <div>
            <h1>WINNING</h1>
            <p>What’s more, they’re absolutely free! You can do a lot with them. You can modify them.</p>
            <a href=" <?php echo base_url("home/blog");?>" class="more">Read More</a>
        </div>
    </div>
</div>
<?php
    $this->load->view('Home/Layout/footer.php',"Home");
?>
