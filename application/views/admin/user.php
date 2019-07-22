
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <p class="text-primary m-0 font-weight-bold">Employee Info</p>
                        <a class="btn btn-success btn-sm d-none d-sm-inline-block btn-icon-split" role="button"
                            href="<?= base_url() ?>admin/ubah/tambah" style="margin-bottom:1px;">
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
                                        <td><img class="rounded-circle mr-2" width="30" height="30"
                                                src="<?= base_url() . 'uploads/' ?><?php if ($rows['photo'] != "" or $rows['photo'] != null) echo $rows['photo'];
                                                                                                                                            else echo "avatar-default.png"; ?>">
                                            <?= $rows['username'] ?></td>
                                        <td><?= $rows['first_name'] . ' ' . $rows['last_name'] ?></td>
                                        <td><?= $rows['email'] ?></td>
                                        <td><?= $rows['nama_status'] ?>
                                        </td>
                                        <td><?= $rows['alamat'] ?></td>
                                        <td><?= $rows['no_telp'] ?></td>
                                        <td class="text-center d-flex justify-content-around">
                                            <a href="<?= base_url() ?>admin/ubah/edit/<?= $rows['id'] ?>"
                                                class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                                            <a href="<?= base_url() ?>admin/delete_user/<?= $rows['id'] ?>"
                                                class="btn btn-danger btn-sm <?php if ($rows['id'] == $user['id']) echo "disabled" ?> delete-button"
                                                value="<?= $rows['username'] ?>" status="user"><i class=" far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>