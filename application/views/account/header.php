<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php
            if ($title)
                echo $title;
            else
                echo 'No Title' ?>
        - <?= $_SESSION['IMPORTANT_P'] ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">

</head>

<body class="bg-gradient-primary" style="background-image: linear-gradient(to bottom, #F00000, #b31217)">
    <div class="flash-data-s" data-flashdata="<?= $_SESSION['msg_s']; ?>"></div>
    <div class="flash-data-f" data-flashdata="<?= $_SESSION['msg_f']; ?>"></div>