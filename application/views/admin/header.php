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
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">

</head>

<body id="page-top" class="">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background-image: linear-gradient(to bottom, #F00000, #b31217)">
            <div class="container-fluid d-flex flex-column p-0 sticky-top">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Telkom</span></div>
                </a>
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <!-- <hr class="sidebar-divider my-0"> -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?php if ($title == 'Dashboard Datin' or $title == 'Dashboard Pots') echo "active";
                                            else echo "collapsed" ?>" href="#" data-toggle="collapse" data-target="#collapseDashboard" aria-expanded="true" aria-controls="collapseDashboard">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                        <div id="collapseDashboard" class="collapse <?php if ($title == 'Dashboard Datin' or $title == 'Dashboard Pots') echo "show"; ?>" aria-labelledby="headingCollapse" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <!-- <h6 class="collapse-header">Testing</h6> -->
                                <a class="collapse-item <?php if ($title == 'Dashboard Datin') echo "active"; ?>" href="<?= base_url("$url/dashboard/datin") ?>">Datin</a>
                                <a class="collapse-item <?php if ($title == 'Dashboard Pots') echo "active"; ?>" href="<?= base_url("$url/dashboard/pots") ?>">Pots</a>
                            </div>
                        </div>

                    </li>
                    <?php
                    foreach ($menu as $keys => $rows) {
                        $url2 = $rows['url'];
                        ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php if ($title == $rows['title']) echo "active"; ?>" href="<?= base_url("$url/$url2") ?>">
                                <i class="fas fa-fw <?= $rows['icon'] ?>"></i>
                                <span><?= $rows['nama'] ?></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <h3 class="text-dark mt-2 ml-2"><?= $title; ?></h3>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">

                            <li class="nav-item dropdown no-arrow" role="presentation">
                            <li class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                    <span class="d-none d-lg-inline mr-2 text-gray-600 small text-right"><?= $user['first_name'] . ' ' . $user['last_name'] ?></span>
                                    <img class="border rounded-circle img-profile" src="<?= base_url() . 'uploads/' ?><?php if ($user['photo'] != "" or $user['photo'] != null)
                                                                                                                            echo $user['photo'];
                                                                                                                        else
                                                                                                                            echo 'avatar-default.png' ?>">
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                    <a class="dropdown-item disabled" role="presentation">
                                        <strong><?= $user['username'] ?></strong>
                                    </a>
                                    <a class="dropdown-item text-success disabled" role="presentation" style="margin-top:-10px">
                                        <?= $user['email'] ?>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item " role="presentation" href="<?= base_url("$url/profile") ?>">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Edit Profile
                                    </a>
                                    <a class="dropdown-item user-logout" role="presentation" href="<?= base_url("$url/logout") ?>">
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

                <div class="container-fluid">