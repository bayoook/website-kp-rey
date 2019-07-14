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
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/untitled.css">
    <link href="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
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
                            <!-- <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                            <li class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in" role="menu">
                                    <h6 class="dropdown-header">alerts center</h6>
                                    <a class="d-flex align-items-center dropdown-item" href="#">
                                        <div class="mr-3">
                                            <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                        </div>
                                        <div><span class="small text-gray-500">December 12, 2019</span>
                                            <p>A new monthly report is ready to download!</p>
                                        </div>
                                    </a>
                                    <a class="d-flex align-items-center dropdown-item" href="#">
                                        <div class="mr-3">
                                            <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i>
                                            </div>
                                        </div>
                                        <div><span class="small text-gray-500">December 7, 2019</span>
                                            <p>$290.29 has been deposited into your account!</p>
                                        </div>
                                    </a>
                                    <a class="d-flex align-items-center dropdown-item" href="#">
                                        <div class="mr-3">
                                            <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                        </div>
                                        <div><span class="small text-gray-500">December 2, 2019</span>
                                            <p>Spending Alert: We've noticed unusually high spending for your account.
                                            </p>
                                        </div>
                                    </a><a class="text-center dropdown-item small text-gray-500" href="#">Show All
                                        Alerts</a>
                                </div>
                            </li>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                            <li class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-envelope fa-fw"></i><span class="badge badge-danger badge-counter">7</span></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in" role="menu">
                                    <h6 class="dropdown-header">alerts center</h6>
                                    <a class="d-flex align-items-center dropdown-item" href="#">
                                        <div class="dropdown-list-image mr-3"><img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">
                                            <div class="bg-success status-indicator"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate"><span>Hi there! I am wondering if you can help me
                                                    with a problem I've been having.</span></div>
                                            <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                                        </div>
                                    </a>
                                    <a class="d-flex align-items-center dropdown-item" href="#">
                                        <div class="dropdown-list-image mr-3"><img class="rounded-circle" src="assets/img/avatars/avatar2.jpeg">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate"><span>I have the photos that you ordered last
                                                    month!</span></div>
                                            <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                                        </div>
                                    </a>
                                    <a class="d-flex align-items-center dropdown-item" href="#">
                                        <div class="dropdown-list-image mr-3"><img class="rounded-circle" src="assets/img/avatars/avatar3.jpeg">
                                            <div class="bg-warning status-indicator"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate"><span>Last month's report looks great, I am very
                                                    happy with the progress so far, keep up the good work!</span></div>
                                            <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                                        </div>
                                    </a>
                                    <a class="d-flex align-items-center dropdown-item" href="#">
                                        <div class="dropdown-list-image mr-3"><img class="rounded-circle" src="assets/img/avatars/avatar5.jpeg">
                                            <div class="bg-success status-indicator"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate"><span>Am I a good boy? The reason I ask is
                                                    because someone told me that people say this to all dogs, even if
                                                    they aren't good...</span></div>
                                            <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                                        </div>
                                    </a><a class="text-center dropdown-item small text-gray-500" href="#">Show All
                                        Alerts</a>
                                </div>
                            </li>
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                            </li> -->
                            <!-- <div class="d-none d-sm-block topbar-divider"></div> -->
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
                                    <a class="dropdown-ite disabled" role="presentation" style="margin-top:-10px">
                                        <?= $user['status_name'] ?>
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
                <!-- <?php if (isset($_SESSION['msg_s'])) { ?>
                    <div class="container-fluid text-center"
                        style="background-color:aquamarine; margin-top:-23px; margin-bottom:10px; padding-top:20px; padding-bottom:3px">
                        <h4 style="margin-top:-10px"><?= $_SESSION['msg_s'] ?></h4>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['msg_f'])) { ?>
                    <div class="container-fluid text-center"
                        style="background-color:pink; margin-top:-23px; margin-bottom:10px; padding-top:20px; padding-bottom:3px">
                        <h4 style="margin-top:-10px"><?= $_SESSION['msg_f'] ?></h4>
                    </div>
                <?php } ?> -->
                <div class="flash-data-s" data-flashdata="<?= $_SESSION['msg_s']; ?>"></div>
                <div class="flash-data-f" data-flashdata="<?= $_SESSION['msg_f']; ?>"></div>