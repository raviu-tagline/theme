<?php
    $this->load->view('Home/Layout/header.php',"blog");
?>
<div id="body">
	<div>
		<h1>Blog</h1>
		<ul>
			<li>
				<img src="<?php echo base_url()?>images/blog-image1.png" alt="">
				<div>
					<h1>PREPARING FOR A MARATHON</h1>
					<p>Our website templates are created with inspiration, checked for quality and originality and meticulously sliced and coded. What’s more, they’re absolutely free! You can do a lot with them. You can modify them...</p>
					<a href=" <?php echo base_url("blogsinglepost");?>" class="more">keep Reading</a>
				</div>
			</li>
			<li>
				<img src="<?php echo base_url()?>images/blog-image2.png" alt="">
				<div>
					<h1>ASIDE FROM RUNNING</h1>
					<p>Our website templates are created with inspiration, checked for quality and originality and meticulously sliced and coded. What’s more, they’re absolutely free! You can do a lot with them. You can modify them...</p>
					<a href="<?php echo base_url("blogsinglepost");?>" class="more">keep Reading</a>
				</div>
			</li>
			<li>
				<img src="<?php echo base_url()?>images/blog-image3.png" alt="">
				<div>
					<h1>WINNING IS EVERYTHING</h1>
					<p>Our website templates are created with inspiration, checked for quality and originality and meticulously sliced and coded. What’s more, they’re absolutely free! You can do a lot with them. You can modify them...</p>
					<a href="<?php echo base_url("blogsinglepost");?>" class="more">keep Reading</a>
				</div>
			</li>
			<li>
				<img src="<?php echo base_url()?>images/blog-image4.png" alt="">
				<div>
					<h1>RUNNING AND CROSSFIT</h1>
					<p>Our website templates are created with inspiration, checked for quality and originality and meticulously sliced and coded. What’s more, they’re absolutely free! You can do a lot with them. You can modify them...</p>
					<a href="<?php echo base_url("blogsinglepost");?>" class="more">keep Reading</a>
				</div>
			</li>
		</ul>
	</div>
</div>
<?php
    $this->load->view('Home/Layout/footer.php',"blog");
?>