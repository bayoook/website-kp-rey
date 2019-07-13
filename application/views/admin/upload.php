                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">File Upload</h3>
                    </div>
                    <div class="row">
                        <div class="col" style="margin-bottom: 21px;">
                            <form method="post" enctype="multipart/form-data" action="<?= base_url() ?>admin/upload_file">
                                <div class="input-group-append" style="width: 435px;">
                                    <div class="custom-file">
                                        <input required="required" name="uploadfile" type="file" id="inputGroupFile02" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" id="labeldata" for="inputGroupFile02"></label>
                                    </div>
                                    <div>
                                        <input class="btn btn-primary" id="upload" type="submit" value="Upload" style="margin-left: 14px;" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a class="btn btn-success btn-icon-split" role="button"></a>
                <script type="text/javascript">
                    var file = document.getElementById("inputGroupFile02");
                    file.onchange = ubahNama;

                    function ubahNama() {
                        fileName = file.files[0].name;
                        $(this).next('.custom-file-label').html(fileName);
                    }
                </script>