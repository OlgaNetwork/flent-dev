<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/bd.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="<? echo $config['project_name']; ?>">
    <meta name="description" content="">
    <meta name="keywords" content="" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#CAFC55">

    <!-- CSS -->
    <script src="https://flent.ru/assets/js/bootstrap.min.js"></script>
    <link type="text/css" href="https://flent.ru/assets/css/root.css" rel="stylesheet">
    <link type="text/css" href="https://flent.ru/assets/css/app.css" rel="stylesheet">

    <title><? echo $page_title; ?></title>

</head>
<body>
    <main>
        <!-- Section -->        
        <div class=" h-100">

                <div class="row row-grid h-as100 h-100">
                    <!-- --------- central site block ----------- -->
                    <div class="col-12 col-lg-9 order-lg-2">


                     <!-- BLOCK PADDINGS CONTAINER -->
                    <section class="block-container block-login h-100 position-relative">


                            <!-- ------ section-header-menu ------ -->
                            <div class="section-header">
                                <div class="section-header__line align-items-center d-flex justify-content-between">
                                    <div class="d-flex d-lg-none">
                                        <div class="logo-header">
                                            <a href="/" class="d-flex">
                                                <img height="32" src="https://flent.ru/assets/img/logo.svg" alt="<? echo $config['project_name']; ?>">
                                            </a>
                                        </div>
                                    </div>

                                    <span class="menu-button d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#menuModal">         
                                        <svg width="26" height="23" viewBox="0 0 26 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="26" height="3" fill="#313632"/>
                                        <rect y="20" width="26" height="3" fill="#313632"/>
                                        <rect y="10" width="26" height="3" fill="#313632"/>
                                        </svg>
                                    </span>

                                </div>
                            </div>
                            <!-- ------ \ section-header-menu ------ -->

                            <div class="logo-block mb-5 d-none d-lg-block">
                               <a href="/"><img height="40" class="navbar-brand-light" src="https://flent.ru/assets/img/logo.svg" alt="<? echo $config['project_name']; ?>"></a>
                            </div> 

