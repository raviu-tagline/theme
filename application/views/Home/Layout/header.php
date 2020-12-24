<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RNRNR Running</title>
    <link rel="stylesheet" href="<?php echo base_url("style/style.css")?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("style/mobile.css")?>">
    <script src="<?php echo base_url("js/mobile.js")?>" type="text/javascript"></script>
</head>
<body>
    
    <div id="page">
        <div id="header">
            <div id="navigation">
                <span id="mobile-navigation">&nbsp;</span>
                <a href="<?php echo base_url("home");?>" class="logo"><img src="<?php echo base_url()?>images/logo.png" alt=""></a>
                <ul id="menu">
                    <?php $class = isset($header) && $header == "Home" ? "selected" : "" ?>
                    <li class='<?php echo $class; ?>'>
                        <a href=" <?php echo base_url("home");?>">Home</a>
                    </li>

                    <?php $class = isset($header) && $header == "about" ? "selected" : "" ?>
                    <li class='<?php echo $class; ?>'>
                        <a href=" <?php echo base_url("about");?>"> About</a>
                    </li>

                    <?php $class = isset($header) && $header == "running" ? "selected" : "" ?>
                    <li class='<?php echo $class; ?>'>
                        <a href=" <?php echo base_url("running");?>">Running</a>
                        <ul>
                            <li>
                                <a href=" <?php echo base_url("runningsinglepost");?>">Running single post</a>
                            </li>
                        </ul>
                    </li>

                    <?php $class = isset($header) && $header == "blog" ? "selected" : "" ?>
                    <li class='<?php echo $class; ?>'>
                        <a href=" <?php echo base_url("blog");?>">Blog</a>
                        <ul>
                            <li>
                                <a href=" <?php echo base_url("blogsinglepost");?>">blog single post</a>
                            </li>
                        </ul>
                    </li>

                    <?php $class = isset($header) && $header == "contact" ? "selected" : "" ?>
                    <li class='<?php echo $class; ?>'>
                        <a href=" <?php echo base_url("contact");?>">Contact</a>
                    </li>

                    <?php $class = isset($header) && $header == "register" ? "selected" : "" ?>
                    <li class='<?php echo $class; ?>'>
                        <a href=" <?php echo base_url("register");?>">Register</a>
                    </li>
                </ul>
            </div>
        </div>