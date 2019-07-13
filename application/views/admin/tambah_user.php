            <div class="container-fluid" style="margin-top:30px">
                <div class="card shadow" style="max-width:850px;">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <p class="text-primary m-0 font-weight-bold">Detail User</p>
                        <a class="btn btn-danger btn-sm d-none d-sm-inline-block btn-icon-split" role="button" href="<?= base_url() ?>admin/user" style="margin-bottom:1px;">
                            <span class="text-white-50 icon">
                                <i class="fas fa-times"></i>
                            </span>
                        </a>
                    </div>
                    <form id="ganti_gambar" method="POST" enctype="multipart/form-data" action="<?= base_url() ?>admin/ganti_gambar/<?= $user_edit['id'] ?>/<?php if ($title == 'Tambah User') echo 'tambah';
                                                                                                                                                            else echo 'edit/' . $user_edit['id'] . '' ?>">
                        <input type="file" id="selectedFile" style="display: none;" name="photo" value="submit" onchange="gantiGambar()">
                    </form>
                    <form id="hapus_gambar" method="POST" enctype="multipart/form-data" action="<?= base_url() ?>admin/delete_image/<?= $user_edit['id'] ?>">
                        <button id="deletedFile" style="display: none;"value="submit"></button>
                    </form>
                    <!-- <?php print_r($_SESSION); ?> -->

                    <?php if (isset($_SESSION['msg_f'])) { ?>
                        <div class="container-fluid text-center" style="background-color:pink; margin-bottom:-49px; padding-top:20px; padding-bottom:3px">
                            <h4 style="margin-top:-10px"><?= $_SESSION['msg_f'] ?></h4>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['msg_s'])) { ?>
                        <div class="container-fluid text-center" style="background-color:aquamarine; margin-bottom:-49px; padding-top:20px; padding-bottom:3px">
                            <h4 style="margin-top:-10px"><?= $_SESSION['msg_s'] ?></h4>
                        </div>
                    <?php } ?>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>admin/<?php if ($title == 'Tambah User') echo 'proses_tambah_user';
                                                                                                            else echo 'proses_edit_user/' . $user_edit['id'] . '' ?>">
                            <input style="opacity: 0;position: absolute;">
                            <input type="password" style="opacity: 0;position: absolute;">
                            <div class="p-5">
                                <div class="form-group row">
                                    <div class="col-md-3" style="align-items:center; display:flex">
                                        <strong style="margin:0px">Username (*)</strong>
                                    </div>
                                    <div class="col">
                                        <input class="form-control form-control-user" type="text" name="username" value="<?= $user_edit['username'] ?>" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3" style="align-items:center; display:flex">
                                        <strong style="margin:0px">Email (*)</strong>
                                    </div>
                                    <div class="col">
                                        <input class="form-control form-control-user" type="text" name="email" value="<?= $user_edit['email'] ?>" /></div>
                                </div>
                                <?php if ($title == 'Tambah User') { ?>
                                    <div class="form-group row">
                                        <div class="col-md-3" style="align-items:center; display:flex">
                                            <strong style="margin:0px">Password (*)</strong>
                                        </div>
                                        <div class="col"><input class="form-control form-control-user" type="password" name="password" /></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3" style="align-items:center; display:flex">
                                            <strong style="margin:0px">Retype Password (*)</strong>
                                        </div>
                                        <div class="col"><input class="form-control form-control-user" type="password" name="retype_password" /></div>
                                    </div>
                                <?php } ?>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-3" style="align-items:center; display:flex">
                                        <strong style="margin:0px">First Name</strong>
                                    </div>
                                    <div class="col"><input class="form-control form-control-user" type="text" name="first_name" value="<?= $user_edit['first_name'] ?>" /></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3" style="align-items:center; display:flex">
                                        <strong style="margin:0px">Last Name</strong>
                                    </div>
                                    <div class="col"><input class="form-control form-control-user" type="text" name="last_name" value="<?= $user_edit['last_name'] ?>" /></div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-3" style="align-items:center; display:flex">
                                        <strong style="margin:0px">No HP</strong>
                                    </div>
                                    <div class="col"><input class="form-control form-control-user" type="text" name="no_telp" value="<?= $user_edit['no_telp'] ?>" /></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3" style="align-items:center; display:flex">
                                        <strong style="margin:0px">Alamat</strong>
                                    </div>
                                    <div class="col">
                                        <textarea class="form-control form-control-user" rows="4" name="alamat"><?= $user_edit['alamat'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-3" style="align-items:center; display:flex" style="padding:20px">
                                        <strong class="mb-3">Photo</strong>
                                    </div>
                                    <?php if ($title == 'Edit User') { ?>
                                        <div class="col-lg-2">
                                            <img id="image_profile" class="rounded-circle" src="<?= base_url() ?>uploads/<?php if (isset($_SESSION['photo_se']))
                                                                                                                                echo $_SESSION['photo_se'];
                                                                                                                            else if ($user_edit['photo'] != "" or $user_edit['photo'] != null)
                                                                                                                                echo $user_edit['photo'];
                                                                                                                            else
                                                                                                                                echo 'avatar-default.png' ?>" width="100" height="100">
                                            <input name="photo" value="<?php if ($_SESSION['photo_se']) echo $_SESSION['photo_se'];
                                                                        else echo $user_edit['photo'] ?>" hidden>
                                        </div>
                                        <div class="col flex d-flex align-items-center text-center">
                                            <div class=row>
                                                <div class="col flex d-flex align-items-center text-center" style="padding:10px">
                                                    <input class="btn btn-info btn-md" type="button" onclick="document.getElementById('selectedFile').click();" value="Change Image">
                                                </div>
                                                <div class="col flex d-flex align-items-center text-center" style="padding:10px">
                                                    <input class="btn btn-danger btn-md" type="button" onclick="document.getElementById('deletedFile').click();" value="Delete Image">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col">
                                            <input class="form-control form-control-user" type="file" name="photo" value="<?= base_url() . 'uploads/' . $user_edit['photo'] ?>" />
                                        </div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-3" style="align-items:center; display:flex">
                                        <strong style="margin:0px">Status (*)</strong>
                                    </div>
                                    <div class="col">
                                        <select class="form-control form-control-user" name="status">
                                            <option value="3">Pilih Status</option>
                                            <?php foreach ($status as $rows) { ?>
                                                <option value="<?= $rows['id_status'] ?>" <?php if ($rows['id_status'] == $user_edit['status']) echo "selected"; ?>><?= $rows['nama'] ?>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block text-white btn-user" style="margin-top:50px" type="submit">Save Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                function gantiGambar() {
                    document.getElementById('ganti_gambar').submit();
                }
            </script>