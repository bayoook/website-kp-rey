<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Dashboard</h3>
        <?php if ($berhasil) { ?>
            <h6 class="text-success mb-0">Success import <?php echo $berhasil ?> data</h6>
        <?php } ?>
    </div>
    <div class="row" style="padding: 10px;">
        <div class="col d-xl-flex align-items-xl-center">
            <h4 style="margin: 0px;">Pilih Witel :  </h4>
            <div class="dropdown no-arrow">
                <button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><?= $nama ?></button>
                <div class="dropdown-menu shadow dropdown-menu-left animated--fade-in" role="menu" style="width:250px">
                    <p class="text-center dropdown-header">Witel</p>
                    <?php
                    foreach ($kota as $rows) { ?>
                        <a class="dropdown-item <?php if ($sel == $rows['Nick']) echo "disabled" ?>" role="presentation" href="<?= base_url() ?>admin/dashboard/<?= $rows['Nick'] ?>"><?= $rows['Nama'] ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:20px">
        <div class="col-lg-4 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">TTR Average Witel <?php echo $nama ?></h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas data-bs-chart='{"type":"bar",
                                            "data":{"labels":["DBS",
                                                              "DES",
                                                              "DGS"],
                                            "datasets":[{"label":"",
                                            "backgroundColor":"rgba(78, 115, 223, 0.05)",
                                            "borderColor":"rgba(78, 115, 223, 1)",
                                            "borderWidth":"3",
                                            "data":["<?php echo $dbs ?>",
                                                    "<?php echo $des ?>",
                                                    "<?php echo $dgs ?>"]}]},
                                            "options":{"maintainAspectRatio":false,
                                            "legend":{"display":false,
                                                        "position":"bottom",
                                                        "reverse":false},
                                            "title":{"display":false,
                                                        "position":"bottom",
                                                        "text":"TTR"},
                                            "scales":{"xAxes":[{"gridLines":{"color":"rgb(234, 236, 244)",
                                                                                "zeroLineColor":"rgb(234, 236, 244)",
                                                                                "drawBorder":false,
                                                                                "drawTicks":false,
                                                                                "borderDash":["1"],
                                                                                "zeroLineBorderDash":["1"],
                                                                                "drawOnChartArea":false},
                                                                                "ticks":{"fontColor":"#858796",
                                                                                        "beginAtZero":true,
                                                                                        "padding":20}}],
                                                        "yAxes":[{"gridLines":{"color":"rgb(234, 236, 244)",
                                                                                "zeroLineColor":"rgb(234, 236, 244)",
                                                                                "drawBorder":false,
                                                                                "drawTicks":false,
                                                                                "borderDash":["1"],
                                                                                "zeroLineBorderDash":["1"],
                                                                                "drawOnChartArea":true},
                                                                                "ticks":{"fontColor":"#858796",
                                                                                        "beginAtZero":true,
                                                                                        "padding":20}}]}}}'></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Compliance Witel <?php echo $nama ?></h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas data-bs-chart='{"type":"bar",
                                            "data":{"labels":["Comply",
                                                                "Not Comply"],
                                            "datasets":[{"label":"",
                                            "backgroundColor":"rgba(78, 115, 223, 0.05)",
                                            "borderColor":"rgba(78, 115, 223, 1)",
                                            "borderWidth":"3",
                                            "data":["<?php echo $comply ?>",
                                                    "<?php echo $nComply ?>"]}]},
                                            "options":{"maintainAspectRatio":false,
                                            "legend":{"display":false,
                                                        "position":"bottom",
                                                        "reverse":false},
                                            "title":{"display":false,
                                                        "position":"bottom",
                                                        "text":"TTR"},
                                            "scales":{"xAxes":[{"gridLines":{"color":"rgb(234, 236, 244)",
                                                                                "zeroLineColor":"rgb(234, 236, 244)",
                                                                                "drawBorder":false,
                                                                                "drawTicks":false,
                                                                                "borderDash":["1"],
                                                                                "zeroLineBorderDash":["1"],
                                                                                "drawOnChartArea":false},
                                                                                "ticks":{"fontColor":"#858796",
                                                                                        "beginAtZero":true,
                                                                                        "padding":20}}],
                                                        "yAxes":[{"gridLines":{"color":"rgb(234, 236, 244)",
                                                                                "zeroLineColor":"rgb(234, 236, 244)",
                                                                                "drawBorder":false,
                                                                                "drawTicks":false,
                                                                                "borderDash":["1"],
                                                                                "zeroLineBorderDash":["1"],
                                                                                "drawOnChartArea":true},
                                                                                "ticks":{"fontColor":"#858796",
                                                                                        "beginAtZero":true,
                                                                                        "padding":20}}]}}}'></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-left">
        <div class="bottomView">
            <div class="col">
                <a class="btn btn-primary btn-sm btn-icon-split" role="button" id="tampil" style="margin-bottom:1px;">
                    <span class="text-white-50 icon">
                        <i class="fas fa-table"></i>
                    </span>
                    <span class="text-white text" id="butSpan">Show Table</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row" id="table" style="display:none">
        <div class="col-12">
            <div class="card shadow mb-4" style="margin-top:20px">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Full Table</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable table-sm" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead class="text-center">
                                            <tr>
                                                <th style="vertical-align:middle;" rowspan="2">
                                                    Witel</th>
                                                <th style="vertical-align: middle;" rowspan="2">
                                                    Total</th>
                                                <th colspan="3">Customer Segment</th>
                                                <th colspan="3">Average TTR</th>
                                                <th style="vertical-align: middle;" rowspan="2">SLG</th>
                                                <th colspan="2">Compliance</th>
                                            </tr>
                                            <tr>
                                                <th>DBS</th>
                                                <th>DES</th>
                                                <th>DGS</th>
                                                <th>DBS</th>
                                                <th>DES</th>
                                                <th>DGS</th>
                                                <th>Comply</th>
                                                <th>Not Comply</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach ($kota as $row) {
                                                if ($row['Nama'] == 'SEMUA') continue; ?>
                                                <tr class="<?php if ($row['Nama'] == $nama) echo 'table-primary' ?> clickable-row" data-href="url:<?= base_url('admin/dashboard/') . $row['Nick']; ?>">
                                                    <td class="text-left"><?php echo $row['Nama'] ?></td>
                                                    <td><?php echo $row['DBS'] + $row['DES'] + $row['DGS'] ?></td>
                                                    <td><?php echo $row['DBS'] ?></td>
                                                    <td><?php echo $row['DES'] ?></td>
                                                    <td><?php echo $row['DGS'] ?></td>
                                                    <td><?php echo $row['AVG_DBS'] ?></td>
                                                    <td><?php echo $row['AVG_DES'] ?></td>
                                                    <td><?php echo $row['AVG_DGS'] ?></td>
                                                    <td>0</td>
                                                    <td><?php echo $row['COMPLY'] ?></td>
                                                    <td><?php echo $row['NOT_COMPLY'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow mb-4" id="table" style="margin-top:20px">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Average Table</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row" id="aaa">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable table-sm" id="" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Segment</th>
                                                <th>Average TTR</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td>1.</td>
                                                <td>DBS</td>
                                                <td><?= $kota['all']['AVG_DBS'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>DES</td>
                                                <td><?= $kota['all']['AVG_DES'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>DGS</td>
                                                <td><?= $kota['all']['AVG_DGS'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>