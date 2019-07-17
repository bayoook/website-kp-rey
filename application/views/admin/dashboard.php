<!-- <?php print_r($user) ?> -->
<!-- <?php print_r($user) ?> -->
<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Dashboard</h3>
        <?php if ($berhasil) { ?>
            <h6 class="text-success mb-0">Success import <?php echo $berhasil ?> data</h6>
        <?php } ?>
    </div>
    <div class="row" style="padding: 10px;">
        <div class="col d-xl-flex align-items-xl-center">
            <h4 style="margin: 0px;">Pilih Regional :  </h4>
            <div class="dropdown no-arrow">
                <button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><?php if ($regional == 'all') echo "Semua"; else foreach ($all['regional_list'] as $keys => $row) if ($keys + 1 == $regional) echo "Regional ".$row['regional'] ?></button>
                <div class="dropdown-menu shadow dropdown-menu-left animated--fade-in" role="menu">
                    <p class="text-center dropdown-header">Witel</p>
                    <a class="text-center dropdown-item <?php if ($regional == 'all') echo "disabled" ?>" role="presentation" href="<?= base_url() ?>admin/dashboard/datin/all">Semua</a>
                    <?php
                    foreach ($all['regional_list'] as $keys => $rows) { ?>
                        <a class="text-center dropdown-item <?php if ($regional == $keys + 1) echo "disabled" ?>" role="presentation" href="<?= base_url() ?>admin/dashboard/datin/<?= $keys + 1 ?>">Regional <?= $rows['regional'] ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:20px">
        <div class="col-lg-4 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Average TTR Customer Segment</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas data-bs-chart='{"type":"bar",
                            "data":{"labels":[
                                <?php foreach ($all['regional_list'] as $keys => $rows) {
                                    if ($keys == 0)
                                        echo '"';
                                    else
                                        echo ',"';
                                    echo "Reg " . $rows['regional'];
                                    echo '"';
                                } ?>
                                ],
                            "datasets":[{"label":"DES","backgroundColor":"#4e73df","borderColor":"transparent","data":[
                                <?php foreach ($all['regional_list'] as $keys => $rows) {
                                    if ($keys == 0)
                                        echo '"';
                                    else
                                        echo ',"';
                                    echo number_format($rows['ttr_dbs'], 2);
                                    echo '"';
                                } ?>
                                ]},
                            {"label":"DBS","backgroundColor":"#df4e4e","borderColor":"transparent","data":[
                                <?php foreach ($all['regional_list'] as $keys => $rows) {
                                    if ($keys == 0)
                                        echo '"';
                                    else
                                        echo ',"';
                                    echo number_format($rows['ttr_des'], 2);
                                    echo '"';
                                } ?>
                                ]},
                            {"label":"DBS","backgroundColor":"#62df4e","borderColor":"transparent","data":[
                                <?php foreach ($all['regional_list'] as $keys => $rows) {
                                    if ($keys == 0)
                                        echo '"';
                                    else
                                        echo ',"';
                                    echo number_format($rows['ttr_dgs'], 2);
                                    echo '"';
                                } ?>
                                ]}]},
                            "options":{"maintainAspectRatio":false,
                                "legend":{"display":true,"position":"bottom","reverse":false},
                                "title":{"display":false},
                                "scales":{"xAxes":[{"ticks":{"beginAtZero":true}}],
                                        "yAxes":[{"ticks":{"beginAtZero":true}}]}}}'>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Jumlah Customer Segment</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas data-bs-chart='{"type":"bar",
                            "data":{"labels":[
                                <?php foreach ($all['regional_list'] as $keys => $rows) {
                                    if ($keys == 0)
                                        echo '"';
                                    else
                                        echo ',"';
                                    echo "Reg " . $rows['regional'];
                                    echo '"';
                                } ?>
                                ],
                            "datasets":[{"label":"DES","backgroundColor":"#4e73df","borderColor":"transparent","data":[
                                <?php foreach ($all['regional_list'] as $keys => $rows) {
                                    if ($keys == 0)
                                        echo '"';
                                    else
                                        echo ',"';
                                    echo $rows['dbs'];
                                    echo '"';
                                } ?>
                                ]},
                            {"label":"DBS","backgroundColor":"#df4e4e","borderColor":"transparent","data":[
                                <?php foreach ($all['regional_list'] as $keys => $rows) {
                                    if ($keys == 0)
                                        echo '"';
                                    else
                                        echo ',"';
                                    echo $rows['des'];
                                    echo '"';
                                } ?>
                                ]},
                            {"label":"DBS","backgroundColor":"#62df4e","borderColor":"transparent","data":[
                                <?php foreach ($all['regional_list'] as $keys => $rows) {
                                    if ($keys == 0)
                                        echo '"';
                                    else
                                        echo ',"';
                                    echo $rows['dgs'];
                                    echo '"';
                                } ?>
                                ]}]},
                            "options":{"maintainAspectRatio":false,
                                "legend":{"display":true,"position":"bottom","reverse":false},
                                "title":{"display":false},
                                "scales":{"xAxes":[{"ticks":{"beginAtZero":true}}],
                                        "yAxes":[{"ticks":{"beginAtZero":true}}]}}}'>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Ranking</h6>
                </div>
                <div class="card-body" style="min-height:360px">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row" id="aaa">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable table-sm" id="tableRank" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Average TTR</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach ($all['regional_list'] as $keys => $rows) { ?>
                                                <tr>
                                                    <td>Regional <?= $rows['regional'] ?></td>
                                                    <td><?php echo number_format($rows['ttr_avg'], 2) ?></td>
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
                                                <th colspan="4">Average TTR</th>
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
                                                <th>ALL</th>
                                                <th>Comply</th>
                                                <th>Not Comply</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php if ($regional == 'all')
                                                foreach ($all['regional_list'] as $row) { ?>
                                                <tr class="<?php if ($row['regional'] == $nama) echo 'table-primary' ?>">
                                                    <td class="text-left">Regional <?php echo $row['regional'] ?></td>
                                                    <td><?php echo $row['dbs'] + $row['des'] + $row['dgs'] ?></td>
                                                    <td><?php echo $row['dbs'] ?></td>
                                                    <td><?php echo $row['des'] ?></td>
                                                    <td><?php echo $row['dgs'] ?></td>
                                                    <td><?php echo number_format($row['ttr_dbs'], 2) ?></td>
                                                    <td><?php echo number_format($row['ttr_des'], 2) ?></td>
                                                    <td><?php echo number_format($row['ttr_dgs'], 2) ?></td>
                                                    <td><?php echo number_format($row['ttr_avg'], 2) ?></td>
                                                    <td>0</td>
                                                    <td><?php echo $row['com'] ?></td>
                                                    <td><?php echo $row['not_com'] ?></td>
                                                </tr>
                                            <?php } else
                                            foreach ($all['regional_list'][$regional - 1]['witel_list'] as $row) { ?>
                                                <tr class="<?php if ($row['witel'] == $nama) echo 'table-primary' ?>">
                                                    <td class="text-left"><?php echo $row['witel'] ?></td>
                                                    <td><?php echo $row['dbs'] + $row['des'] + $row['dgs'] ?></td>
                                                    <td><?php echo $row['dbs'] ?></td>
                                                    <td><?php echo $row['des'] ?></td>
                                                    <td><?php echo $row['dgs'] ?></td>
                                                    <td><?php echo number_format($row['ttr_dbs'], 2) ?></td>
                                                    <td><?php echo number_format($row['ttr_des'], 2) ?></td>
                                                    <td><?php echo number_format($row['ttr_dgs'], 2) ?></td>
                                                    <td><?php echo number_format($row['ttr_avg'], 2) ?></td>
                                                    <td>0</td>
                                                    <td><?php echo $row['com'] ?></td>
                                                    <td><?php echo $row['not_com'] ?></td>
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
                                                <td><?php
                                                    if ($regional == 'all')
                                                        echo number_format($all['ttr_dbs'], 2);
                                                    else
                                                        echo number_format($all['regional_list'][$regional - 1]['ttr_dbs'], 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>DES</td>
                                                <td><?php
                                                    if ($regional == 'all')
                                                        echo number_format($all['ttr_des'], 2);
                                                    else
                                                        echo number_format($all['regional_list'][$regional - 1]['ttr_des'], 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>DGS</td>
                                                <td><?php
                                                    if ($regional == 'all')
                                                        echo number_format($all['ttr_dgs'], 2);
                                                    else
                                                        echo number_format($all['regional_list'][$regional - 1]['ttr_dgs'], 2) ?></td>
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