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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/untitled.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css">
    
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
            style="background-image: url('none');">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Telkom</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a
                            class="nav-link <?php if ($title == 'Dashboard') echo "active disabled"; ?>"
                            href="<?= base_url() ?>admin/dashboard"><i
                                class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item" role="presentation"><a
                            class="nav-link <?php if ($title == 'Profile') echo "active disabled"; ?>"
                            href="<?= base_url() ?>admin/profile"><i class="fas fa-user"></i><span>Profile</span></a>
                    </li>
                    <li class="nav-item" role="presentation"><a
                            class="nav-link <?php if ($title == 'User') echo "active disabled"; ?>"
                            href="<?= base_url() ?>admin/user"><i class="fas fa-user-circle"></i><span>User</span></a>
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link"
                            href="<?= base_url() ?>forgot-password.html"><i class="fas fa-key"></i><span>Forgotten
                                Password</span></a></li>
                    <li class="nav-item" role="presentation"><a
                            class="nav-link <?php if ($title == 'Upload') echo "active"; ?>"
                            href="<?= base_url() ?>admin/upload"><i class="fas fa-file-upload"></i><span>File
                                Upload</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form
                            class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                                    placeholder="Search for ...">
                                <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i
                                            class="fas fa-search"></i></button></div>
                            </div>
                        </form>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                    data-toggle="dropdown" aria-expanded="false" href="#"><i
                                        class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small"
                                                type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0"
                                                    type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                            <li class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false"
                                    href="#">
                                    <span
                                        class="d-none d-lg-inline mr-2 text-gray-600 small text-right"><?= $user['first_name'] . ' ' . $user['last_name'] ?></span>
                                    <img class="border rounded-circle img-profile"
                                        src="<?= base_url() . 'uploads/' ?><?php if ($user['photo'] != "" or $user['photo'] != null)
                                                                                                                            echo $user['photo'];
                                                                                                                        else
                                                                                                                            echo 'avatar-default.png' ?>">
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                    <a class="dropdown-item disabled" role="presentation">
                                        <strong><?= $user['username'] ?></strong>
                                    </a>
                                    <a class="dropdown-item text-success disabled" role="presentation"
                                        style="margin-top:-10px">
                                        <?= $user['email'] ?>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item " role="presentation"
                                        href="<?= base_url() ?>admin/profile/<?= $user['id'] ?>">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Edit Profile
                                    </a>
                                    <a class="dropdown-item user-logout" role="presentation"
                                        href="<?= base_url() ?>admin/logout">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout
                                    </a>
                                </div>
                            </li>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="flash-data-s" data-flashdata="<?= $_SESSION['msg_s']; ?>"></div>
                <div class="flash-data-f" data-flashdata="<?= $_SESSION['msg_f']; ?>"></div>