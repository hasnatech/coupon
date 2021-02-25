<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Coupon</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-style.css') ?>">

    <!--// Required Javascript Files //-->
    <script src="<?php echo base_url('assets/js/angular.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/main.js') ?>"></script>
</head>

<body class="">
    <!-- <div class="wrapper"> -->
    <?php if (!empty($this->session->userdata('logged_in'))) { ?>
    <nav>
        <div class="logo"></div>
        <div class="menu">
            <ul>
                <li><a href="<?php echo base_url('/admin') ?>">Home</a></li>
                <li><a href="<?php echo base_url('/user') ?>">User</a></li>
                <li><a href="<?php echo base_url('/admin/logout') ?>">Logout</a></li>
            </ul>
        </div>
    </nav>
    <?php } ?>
    <div class="space-50"></div>