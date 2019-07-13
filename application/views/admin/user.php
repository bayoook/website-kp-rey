            <?php if ($_SESSION['msg_s']) { ?>
                <div class="container-fluid text-center" style="background-color:aquamarine; margin-top:-23px; margin-bottom:10px; padding-top:20px; padding-bottom:3px">
                    <h4 style="margin-top:-10px"><?= $_SESSION['msg_s'] ?></h4>
                </div>
            <?php } ?>
            <?php if ($_SESSION['msg_f']) { ?>
                <div class="container-fluid text-center" style="background-color:pink; margin-top:-23px; margin-bottom:10px; padding-top:20px; padding-bottom:3px">
                    <h4 style="margin-top:-10px"><?= $_SESSION['msg_f'] ?></h4>
                </div>
            <?php } ?>
            <div class="container-fluid" style="margin-bottom:100px">
                <h3 class="text-dark mb-4">Team</h3>
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <p class="text-primary m-0 font-weight-bold">Employee Info</p>
                        <a class="btn btn-success btn-sm d-none d-sm-inline-block btn-icon-split" role="button" href="<?= base_url() ?>admin/ubah/tambah" style="margin-bottom:1px;">
                            <span class="text-white-50 icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text-white text">Tambah User</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Alamat</th>
                                        <th>No Telpon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($user_all as $rows) { ?>
                                        <tr>
                                            <td><img class="rounded-circle mr-2" width="30" height="30" src="<?= base_url() . 'uploads/' ?><?php if ($rows['photo']!="" or $rows['photo']!=null)
                                                                                                                                                echo $rows['photo'];
                                                                                                                                            else echo "avatar-default.png";?>"> <?= $rows['username'] ?></td>
                                            <td><?= $rows['first_name'] . ' ' . $rows['last_name'] ?></td>
                                            <td><?= $rows['email'] ?></td>
                                            <td><?php foreach ($status as $row) if ($rows['status'] == $row['id_status']) echo $row['nama'] ?>
                                            </td>
                                            <td><?= $rows['alamat'] ?></td>
                                            <td><?= $rows['no_telp'] ?></td>
                                            <td class="text-center d-flex justify-content-around">
                                                <a href="<?= base_url() ?>admin/ubah/edit/<?= $rows['id'] ?>" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                                                <a href="<?= base_url() ?>admin/delete_user/<?= $rows['id'] ?>" class="btn btn-danger btn-sm <?php if ($rows['id'] == $user['id']) echo "disabled" ?>" onclick="if(confirm('Apakah yakin Hapus user <?php echo $rows['username']; ?>?')) commentDelete(1); return false"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>