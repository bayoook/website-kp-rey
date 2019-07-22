                        <div class="card shadow">
                            <div class="card-header py-3 d-flex justify-content-between">
                                <p class="text-primary m-0 font-weight-bold">Table</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Customer Segment</th>
                                                <th>Service ID</th>
                                                <th>Top Priority</th>
                                                <th>TTR Customer</th>
                                                <th>Compliance</th>
                                                <th>Witel</th>
                                                <th>Regional</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach($data as $keys => $rows) { ?>
                                                <tr>
                                                    <td><?= $rows['cust_name']; ?></td>
                                                    <td><?= $rows['cust_segment']; ?></td>
                                                    <td><?= $rows['serv_id']; ?></td>
                                                    <td><?= $rows['top_prio']; ?></td>
                                                    <td><?= $rows['ttr_cust']; ?></td>
                                                    <td><?= $rows['compliance']; ?></td>
                                                    <td><?= $rows['witel']; ?></td>
                                                    <td><?= $rows['regional']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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