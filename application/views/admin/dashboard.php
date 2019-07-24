<div class="row d-flex mt-n3" style="padding: 0px">
    <div class="col-md-5 col-sm-12 d-flex align-items-center justify-content-start mt-2">
        <h4 style="margin: 0px;">Pilih Regional :  </h4>
        <div class="dropdown no-arrow" style="max-width:160px">
            <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><?php if ($regional == 'all') echo "Semua";
                                                                                                                            else foreach ($all['regional_list'] as $keys => $row) if ($keys + 1 == $regional) echo "Regional " . $row['regional'] ?></button>
            <div class="dropdown-menu shadow dropdown-menu-left animated--fade-in" role="menu">
                <p class="text-center dropdown-header">Witel</p>
                <a class="text-center dropdown-item <?php if ($regional == 'all') echo "disabled" ?>" role="presentation" href="<?= base_url($url) ?>/dashboard/<?= $type ?>/all">Semua</a>
                <?php
                foreach ($all['regional_list'] as $keys => $rows) { ?>
                    <a class="text-center dropdown-item <?php if ($regional == $keys + 1) echo "disabled" ?>" role="presentation" href="<?= base_url($url) ?>/dashboard/<?= $type . '/' . ($keys + 1) ?>">Regional <?= $rows['regional'] ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col mt-2">
        <form class="d-sm-flex align-items-center justify-content-end" method="post" action="<?= base_url($url) ?>/filter_cal/<?= "$type/$regional" ?>">
            <h6 style="margin: 0px;">Filter&nbsp;Tanggal&nbsp;:&nbsp;&nbsp;</h6>
            <div class="input-group" style="max-width:160px">
                <input type="date" required class="form-control" name='start' value="<?= $start ?>" min="<?= $min ?>" max="<?= $max ?>" />
            </div>
            <h6 style="margin: 0px;">&nbsp;&nbsp;to&nbsp;:&nbsp;</h6>
            <div class="input-group" style="max-width:160px">
                <input type="date" required class="form-control" name='end' value="<?= $end ?>" min="<?= $min ?>" max="<?= $max ?>" />
            </div>
            <input class="btn btn-primary btn-sm ml-2" type="submit" value="OK">
        </form>
    </div>
</div>
<div class="row" style="margin-top:20px">
    <div class="col-lg-8 col-xl-8">
        <div class="card shadow">
            <div class="card-header d-flex py-3 justify-content-between align-items-center">
                <h6 class=" m-0 font-weight-bold text-primary">Average TTR Customer Segment</h6>
                <button class="btn-sm m-0 btn-info small" name="chart"></button> 
            </div>
            <div class="card-body cb-chart" style="height:360px">
                <div class="chart-area">
                    <canvas data-bs-chart='{"type":"<?=$type_chart?>",
                            "data":{"labels":[
                                <?php if ($regional == 'all') {
                                    foreach ($all['regional_list'] as $keys => $rows) {
                                        if ($keys == 0)
                                            echo '"';
                                        else
                                            echo ',"';
                                        echo 'Regional ' . $rows['regional'];
                                        echo '"';
                                    }
                                } else {
                                    foreach ($all['regional_list'][$regional - 1]['witel_list'] as $keys => $rows) {
                                        if ($keys == 0)
                                            echo '"';
                                        else
                                            echo ',"';
                                        echo $rows['witel'];
                                        echo '"';
                                    }
                                } ?>
                                ],
                            "datasets":[{"label":"DBS","backgroundColor":"rgba(78, 114, 223, 1.0)","borderColor":"white","data":[
                                <?php if ($regional == 'all') {
                                    foreach ($all['regional_list'] as $keys => $rows) {
                                        if ($keys == 0)
                                            echo '"';
                                        else
                                            echo ',"';
                                        echo number_format($rows['ttr_dbs'], 2, '.', '');
                                        echo '"';
                                    }
                                } else {
                                    foreach ($all['regional_list'][$regional - 1]['witel_list'] as $keys => $rows) {
                                        if ($keys == 0)
                                            echo '"';
                                        else
                                            echo ',"';
                                        echo number_format($rows['ttr_dbs'], 2, '.', '');
                                        echo '"';
                                    }
                                } ?>
                                ]},
                            {"label":"DES","backgroundColor":"rgba(223, 78, 78, 1.0)","borderColor":"white","data":[
                                <?php if ($regional == 'all') {
                                    foreach ($all['regional_list'] as $keys => $rows) {
                                        if ($keys == 0)
                                            echo '"';
                                        else
                                            echo ',"';
                                        echo number_format($rows['ttr_des'], 2, '.', '');
                                        echo '"';
                                    }
                                } else {
                                    foreach ($all['regional_list'][$regional - 1]['witel_list'] as $keys => $rows) {
                                        if ($keys == 0)
                                            echo '"';
                                        else
                                            echo ',"';
                                        echo number_format($rows['ttr_des'], 2, '.', '');
                                        echo '"';
                                    }
                                } ?>
                                ]},
                            {"label":"DGS","backgroundColor":"rgba(98, 223, 78, 1.0)","borderColor":"white","data":[
                                <?php if ($regional == 'all') {
                                    foreach ($all['regional_list'] as $keys => $rows) {
                                        if ($keys == 0)
                                            echo '"';
                                        else
                                            echo ',"';
                                        echo number_format($rows['ttr_dgs'], 2, '.', '');
                                        echo '"';
                                    }
                                } else {
                                    foreach ($all['regional_list'][$regional - 1]['witel_list'] as $keys => $rows) {
                                        if ($keys == 0)
                                            echo '"';
                                        else
                                            echo ',"';
                                        echo number_format($rows['ttr_dgs'], 2, '.', '');
                                        echo '"';
                                    }
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
    <!-- <div class="col-lg-4 col-xl-4">
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
        </div> -->
    <div class="col-lg-4 col-xl-4">
        <div class="card shadow">
            <div class="card-header d-flex py-3 justify-content-between align-items-center">
                <h6 class=" m-0 font-weight-bold text-primary">Ranking Table</h6>
                <button class="btn-sm m-0 btn-info small" name="ranking"></button> 
            </div>
            <div class="card-body cb-table-ranking" style="height:360px">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row" id="aaa">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable table-sm" id="tableRank" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Average TTR</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <?php if ($regional == 'all') {
                                            foreach ($all['regional_list'] as $keys => $rows) { ?>
                                                <tr class="text-center">
                                                    <td><?php if(strcasecmp($rows['regional'],'nas')) echo 'Regional' ?> <?= $rows['regional'] ?></td>
                                                    <td><?= number_format($rows['ttr_avg'], 2) ?></td>
                                                </tr>
                                            <?php }
                                        } else
                                            foreach ($all['regional_list'][$regional - 1]['witel_list'] as $keys => $rows) { ?>
                                            <tr>
                                                <td><?= $rows['witel'] ?></td>
                                                <td class="text-center"><?= number_format($rows['ttr_avg'], 2) ?></td>
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
<!-- <div class="row text-left">
    <div class="bottomView">
        <div class="col">
            <a class="btn btn-primary btn-sm btn-icon-split" role="button" id="tampil" style="margin-bottom:1px;">
                <span class="text-white-50 icon">
                    <i class="fas fa-table"></i>
                </span>
                <span class="text-white text" id="button_show_hide"></span>
            </a>
        </div>
    </div>
</div> -->
<div class="row" id="table_show" style="display:">
    <div class="col-12">
        <div class="card shadow" style="margin-top:20px">
            <div class="card-header d-flex py-3 justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Full Table</h6>
                <button class="btn-sm m-0 btn-info small" name="full"></button> 
            </div>
            <div class="card-body cb-table-full">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable table-sm" id="full_table" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="vertical-align:middle;" rowspan="2">
                                                Witel</th>
                                            <th style="vertical-align: middle;" rowspan="2">
                                                Total Tiket</th>
                                            <th colspan="3">Customer Segment</th>
                                            <th colspan="4">Average TTR</th>
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
                                            <tr>
                                                <td class="text-left"><?php if(strcasecmp($row['regional'],'nas')) echo 'Regional' ?> <?= $row['regional'] ?></td>
                                                <td><?= $row['dbs'] + $row['des'] + $row['dgs'] ?></td>
                                                <td><?= $row['dbs'] ?></td>
                                                <td><?= $row['des'] ?></td>
                                                <td><?= $row['dgs'] ?></td>
                                                <td><?= number_format($row['ttr_dbs'], 2) ?></td>
                                                <td><?= number_format($row['ttr_des'], 2) ?></td>
                                                <td><?= number_format($row['ttr_dgs'], 2) ?></td>
                                                <td><?= number_format($row['ttr_avg'], 2) ?></td>
                                                <td><?= $row['com'] ?></td>
                                                <td><?= $row['not_com'] ?></td>
                                            </tr>
                                        <?php } else
                                        foreach ($all['regional_list'][$regional - 1]['witel_list'] as $row) { ?>
                                            <tr>
                                                <td class="text-left"><?= $row['witel'] ?></td>
                                                <td><?= $row['dbs'] + $row['des'] + $row['dgs'] ?></td>
                                                <td><?= $row['dbs'] ?></td>
                                                <td><?= $row['des'] ?></td>
                                                <td><?= $row['dgs'] ?></td>
                                                <td><?= number_format($row['ttr_dbs'], 2) ?></td>
                                                <td><?= number_format($row['ttr_des'], 2) ?></td>
                                                <td><?= number_format($row['ttr_dgs'], 2) ?></td>
                                                <td><?= number_format($row['ttr_avg'], 2) ?></td>
                                                <td><?= $row['com'] ?></td>
                                                <td><?= $row['not_com'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>Total</th>
                                            <?php if ($regional == 'all') { ?>
                                                <th><?= $all['dbs'] + $all['des'] + $all['dgs'] ?></th>
                                                <th><?= $all['dbs'] ?></th>
                                                <th><?= $all['des'] ?></th>
                                                <th><?= $all['dgs'] ?></th>
                                                <th><?= number_format($all['ttr_dbs'], 2) ?></th>
                                                <th><?= number_format($all['ttr_des'], 2) ?></th>
                                                <th><?= number_format($all['ttr_dgs'], 2) ?></th>
                                                <th><?= number_format($all['ttr_avg'], 2) ?></th>
                                                <th><?= $all['com'] ?></th>
                                                <th><?= $all['not_com'] ?></th>
                                            <?php } else { ?>
                                                <th><?= $all['regional_list'][$regional - 1]['dbs'] + $all['regional_list'][$regional - 1]['des'] + $all['regional_list'][$regional - 1]['dgs'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['dbs'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['des'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['dgs'] ?></th>
                                                <th><?= number_format($all['regional_list'][$regional - 1]['ttr_dbs'], 2) ?></th>
                                                <th><?= number_format($all['regional_list'][$regional - 1]['ttr_des'], 2) ?></th>
                                                <th><?= number_format($all['regional_list'][$regional - 1]['ttr_dgs'], 2) ?></th>
                                                <th><?= number_format($all['regional_list'][$regional - 1]['ttr_avg'], 2) ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['com'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['not_com'] ?></th>
                                            <?php } ?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9">
        <div class="card shadow" style="margin-top:20px">
            <div class="card-header d-flex py-3 justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Top Priority Table</h6>
                <button class="btn-sm m-0 btn-info small" name="priority"></button> 
            </div>
            <div class="card-body cb-table-priority">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable table-sm" id="top_prio_table" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="vertical-align:middle;" rowspan="2">
                                                Witel</th>
                                            <th colspan="8"><?= ucfirst($type) ?></th>
                                        </tr>
                                        <tr>
                                            <th>TOP20 DGS</th>
                                            <th>TOP20 DES</th>
                                            <th>TOP100 DBS</th>
                                            <th>TOP100 DGS</th>
                                            <th>TOP200 DES</th>
                                            <th>OTHERS DGS</th>
                                            <th>OTHERS DES</th>
                                            <th>OTHERS DBS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if ($regional == 'all')
                                            foreach ($all['regional_list'] as $row) { ?>
                                            <tr>
                                                <td class="text-left">Regional <?= $row['regional'] ?></td>
                                                <td><?= $row['t20dgs'] ?></td>
                                                <td><?= $row['t20des'] ?></td>
                                                <td><?= $row['t100dbs'] ?></td>
                                                <td><?= $row['t100dgs'] ?></td>
                                                <td><?= $row['t200des'] ?></td>
                                                <td><?= $row['odgs'] ?></td>
                                                <td><?= $row['odes'] ?></td>
                                                <td><?= $row['odbs'] ?></td>
                                            </tr>
                                        <?php } else
                                        foreach ($all['regional_list'][$regional - 1]['witel_list'] as $row) { ?>
                                            <tr class="<?php if ($row['witel'] == $nama) echo 'table-primary' ?>">
                                                <td class="text-left"><?= $row['witel'] ?></td>
                                                <td><?= $row['t20dgs'] ?></td>
                                                <td><?= $row['t20des'] ?></td>
                                                <td><?= $row['t100dbs'] ?></td>
                                                <td><?= $row['t100dgs'] ?></td>
                                                <td><?= $row['t200des'] ?></td>
                                                <td><?= $row['odgs'] ?></td>
                                                <td><?= $row['odes'] ?></td>
                                                <td><?= $row['odbs'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>Total</th>
                                            <?php if ($regional == 'all') { ?>
                                                <th><?= $all['t20dgs'] ?></th>
                                                <th><?= $all['t20des'] ?></th>
                                                <th><?= $all['t100dbs'] ?></th>
                                                <th><?= $all['t100dgs'] ?></th>
                                                <th><?= $all['t200des'] ?></th>
                                                <th><?= $all['odgs'] ?></th>
                                                <th><?= $all['odes'] ?></th>
                                                <th><?= $all['odbs'] ?></th>
                                            <?php } else { ?>
                                                <th><?= $all['regional_list'][$regional - 1]['t20dgs'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['t20des'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['t100dbs'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['t100dgs'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['t200des'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['odgs'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['odes'] ?></th>
                                                <th><?= $all['regional_list'][$regional - 1]['odbs'] ?></th>
                                            <?php } ?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow" id="table" style="margin-top:20px">
            <div class="card-header d-flex py-3 justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Average TTR Table</h6>
                <button class="btn-sm m-0 btn-info small" name="average"></button> 
            </div>
            <div class="card-body cb-table-average">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row" id="">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable table-sm" id="" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
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
                                    <tfoot>
                                        <tr class="text-center">
                                            <th colspan="2">All Segment</th>
                                            <th><?php
                                                if ($regional == 'all')
                                                    echo number_format($all['ttr_avg'], 2);
                                                else
                                                    echo number_format($all['regional_list'][$regional - 1]['ttr_avg'], 2) ?></th>
                                        </tr>
                                    </tfoot>
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