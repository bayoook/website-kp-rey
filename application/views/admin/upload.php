                    <div class="row">
                        <div class="col-xl-4" style="max-width: 435px;">
                            <div class="row">
                                <div class="col" style="margin-bottom: 21px;">
                                    <form method="post" enctype="multipart/form-data" action="<?= base_url() ?>admin/upload_file/datin">
                                        <div class="card shadow">
                                            <div class="card-header text-center">
                                                <h1><i class="fas fa-file-excel text-success"></i></h1>
                                                <h2>Silahkan upload file <strong>Datin</strong></h2>
                                            </div>
                                            <div class="card-body text-center">
                                                <div class="input-group-append" style="">
                                                    <div class="custom-file">
                                                        <input accept=".xls" required="required" name="uploadfile" type="file" id="inputGroupFile01" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label text-left" id="labelDatin" for="inputGroupFile01"></label>
                                                    </div>
                                                </div>
                                                <h6 class="mt-2 ml-2 text-success text-left">* File yang bisa diupload hanya .xls</h6>
                                            </div>
                                            <div class="card-footer text-center p-0">
                                                <input class="p-2 btn-success btn-block rounded-bottom" id="upload" type="submit" value="Upload" style="" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="margin-bottom: 21px;">
                                    <form method="post" enctype="multipart/form-data" action="<?= base_url() ?>admin/upload_file/pots">
                                        <div class="card shadow">
                                            <div class="card-header text-center">
                                                <h1><i class="fas fa-file-excel text-primary"></i></h1>
                                                <h2>Silahkan upload file <strong>Pots</strong></h2>
                                            </div>
                                            <div class="card-body text-center">
                                                <div class="input-group-append" style="">
                                                    <div class="custom-file">
                                                        <input accept=".xls" required="required" name="uploadfile" type="file" id="inputGroupFile02" class="custom-file-input" aria-describedby="inputGroupFileAddon02">
                                                        <label class="custom-file-label text-left" id="labelPots" for="inputGroupFile02"></label>
                                                    </div>
                                                </div>
                                                <h6 class="mt-2 ml-2 text-primary text-left">* File yang bisa diupload hanya .xls</h6>
                                            </div>
                                            <div class="card-footer text-center p-0">
                                                <input class="p-2 btn-primary btn-block rounded-bottom" id="upload" type="submit" value="Upload" style="" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="max-width: 700px;">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between">
                                    <p class="text-primary m-0 font-weight-bold">History Upload</p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Jumlah Data</th>
                                                    <th>Tipe Data</th>
                                                    <th>Tanggal</th>
                                                    <th>Jam</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php foreach ($history as $keys => $rows) {
                                                    $tanggal_ = $rows['tanggal'];
                                                    $tanggal_ = strtotime($tanggal_);
                                                    $tanggal = date('d F Y', $tanggal_);
                                                    $jam = date('H:i:s', $tanggal_);
                                                    ?>
                                                    <tr>
                                                        <td><?= ($rows['akhir'] - $rows['awal'] + 1); ?></td>
                                                        <td><?= ucwords($rows['type']); ?></td>
                                                        <td><?= $tanggal; ?></td>
                                                        <td><?= $jam; ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url() ?>admin/hide_table/<?= $rows['id'] ?>/<?php if($rows['status'] == 'hide') echo 'show' ?>" class="btn btn-info btn-sm">
                                                                <i class="far fa-eye<?php if($rows['status'] == 'hide') echo '-slash' ?>"></i>
                                                            </a>
                                                            <a href="<?= base_url() ?>admin/delete_history/<?= $rows['id'] ?>" class="btn btn-danger btn-sm">
                                                                <i class=" far fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-success btn-icon-split" role="button"></a>
                    <script type="text/javascript">
                        var file1 = document.getElementById("inputGroupFile01");
                        var file2 = document.getElementById("inputGroupFile02");
                        file1.onchange = ubahNama1;
                        file2.onchange = ubahNama2;

                        function ubahNama1() {
                            fileName1 = file1.files[0].name;
                            $(this).next('#labelDatin').html(fileName1);
                        }

                        function ubahNama2() {
                            fileName2 = file2.files[0].name;
                            $(this).next('#labelPots').html(fileName2);
                        }
                    </script>
                    </div>