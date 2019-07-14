            <form id="ganti_gambar" method="POST" enctype="multipart/form-data"
                action="<?= base_url() ?>admin/ganti_gambar/<?= $user['id'] ?>">
                <input type="file" id="selectedFile" style="display: none;" name="photo" value="submit"
                    onchange="gantiGambar()">
            </form>
            <form id="hapus_gambar" method="POST" enctype="multipart/form-data"
                action="<?= base_url() ?>admin/delete_image/<?= $user['id'] ?>">
                <button id="deletedFile" style="display: none;" value="submit"></button>
            </form>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Profile</h3>
                <form name="form" method="POST" enctype="multipart/form-data"
                    action="<?= base_url() ?>admin/proses_edit_user/<?= $user['id'] ?>/profile">
                    <div class="row mb-3">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-5">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Detail User</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label
                                                            for="username"><strong>Username</strong></label><input
                                                            class="form-control" type="text"
                                                            value="<?= $user['username'] ?>" name="username"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label for="email"><strong>Email
                                                                Address</strong></label><input class="form-control"
                                                            type="text" value="<?= $user['email'] ?>" name="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label for="first_name"><strong>First
                                                                Name</strong></label><input class="form-control"
                                                            type="text" value="<?= $user['first_name'] ?>"
                                                            name="first_name"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label for="last_name"><strong>Last
                                                                Name</strong></label><input class="form-control"
                                                            type="text" value="<?= $user['last_name'] ?>"
                                                            name="last_name"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label for="first_name"><strong>No
                                                                Telpon</strong></label><input class="form-control"
                                                            type="text" value="<?= $user['no_telp'] ?>" name="no_telp">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label
                                                            for="first_name"><strong>Status&nbsp;</strong><strong
                                                                class="text-danger">(Uneditable)</strong></label><input
                                                            readonly class="form-control" type="text"
                                                            value="<?= $user['status_name'] ?>" name=""></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label
                                                            for="first_name"><strong>Alamat</strong></label><textarea
                                                            class="form-control" type="text" rows="4"
                                                            name="alamat"><?= $user['alamat'] ?></textarea></div>
                                                </div>
                                            </div>
                                            <div class="form-group text-right" style="margin-top:20px">
                                                <button class="btn btn-primary btn-sm" type="submit">Save
                                                    Settings</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                    <img id="image_profile" class="rounded-circle mb-3 mt-4"
                                        src="<?= base_url() ?>uploads/<?php if (isset($_SESSION['photo_se']))
                                                                                                                                echo $_SESSION['photo_se'];
                                                                                                                            else if ($user['photo'] != "" or $user['photo'] != null)
                                                                                                                                echo $user['photo'];
                                                                                                                            else
                                                                                                                                echo 'avatar-default.png' ?>" width="160"
                                        height="160">
                                    <div class="mb-3">
                                        <input name="photo" value="<?php if (isset($_SESSION['photo_se'])) echo $_SESSION['photo_se'];
                                                                    else echo $user['photo'] ?>" hidden>
                                        <input class="btn btn-primary btn-sm" type="button"
                                            onclick="document.getElementById('selectedFile').click();"
                                            value="Change Image">
                                        <input class="btn btn-danger btn-sm" type="button"
                                            onclick="document.getElementById('deletedFile').click();"
                                            value="Delete Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                        function gantiGambar() {
                            document.getElementById('ganti_gambar').submit();
                        }
                        </script>
                    </div>
                </form>
            </div>