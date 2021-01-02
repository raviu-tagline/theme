<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RNRNR Running</title>

    <!-- Theme Styles and jQueries -->

    <link rel="stylesheet" href="<?php echo base_url("style/style.css")?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("style/mobile.css")?>">
    <script src="<?php echo base_url("js/mobile.js")?>" type="text/javascript"></script>
    
    <!-- Styles and jQueries of bootstrap  -->

    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->

    <!-- jQueries for modal -->

    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

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

                    <?php /*
                    <?php $class = isset($header) && $header == "register" ? "selected" : "" ?>
                    <li class='<?php echo $class; ?>'>
                        <a href=" <?php echo base_url("register");?>">Register</a>
                    </li> */ ?>

                    <?php $class = isset($header) && $header == "data" ? "selected" : "" ?>
                    <li class='<?php echo $class; ?>'>
                        <a href=" <?php echo base_url("dashboard");?>">Data</a>
                    </li>

                    <?php $class = isset($header) && $header == 'login' ? 'selected' : "" ?>
                    <li class='<?php echo $class; ?>'>
                        <a href=" <?php echo base_url("login");?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>