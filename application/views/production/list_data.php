<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <h2>Data Produksi</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title font-bold">
                    <h5>Filter</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <?php
                    $id_factory = (!empty($_GET['id_factory'])) ? $_GET['id_factory'] : null;
                    $id_shift = (!empty($_GET['id_shift'])) ? $_GET['id_shift'] : null;
                    $date_start = (!empty($_GET['date_start'])) ? $_GET['date_start'] : null;
                    $date_end = (!empty($_GET['date_end'])) ? $_GET['date_end'] : null;
                    $min_total = (!empty($_GET['min_total'])) ? $_GET['min_total'] : null;
                ?>
                <div class="ibox-content" style="overflow: auto;">
                    <div class="col-md-12">
                        <div class="form-group"><label class="col-sm-2 control-label">Pabrik</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="id_factory">
                                    <option value=""> -- Pilih Pabrik -- </option>
                                    <?php foreach($factory as $v) { ?>
                                    <option <?php if($v['id_factory'] == $id_factory) { echo 'selected'; } ?> value="<?php echo $v['id_factory'];?>"><?php echo $v['name'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group"><label class="col-sm-2 control-label">Shift</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="id_shift">
                                    <option value=""> -- Pilih Shift -- </option>
                                    <?php foreach($shift as $v) { ?>
                                    <option <?php if($v['id_shift'] == $id_shift) { echo 'selected'; } ?> value="<?php echo $v['id_shift'];?>"><?php echo $v['name'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group"><label class="col-sm-2 control-label">Range Tanggal</label>
                            <div class="col-sm-10">
                                <div class="input-daterange input-group m-b" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="date_start" value="<?php echo $date_start;?>">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control" name="date_end" value="<?php echo $date_end;?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group"><label class="col-sm-2 control-label">Min Total Produksi</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control m-b" name="min_total" value="<?php echo $min_total;?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-xs btn-warning" onclick="filter()">
                                    <i class="fa fa-search"></i> Filter
                                </button>
                                <?php if(!empty($_GET)) { ?>
                                <button class="btn btn-xs btn-danger" onclick="remove_filter()">
                                    <i class="fa fa-times"></i> Remove
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title font-bold">
                    <h5>List Data Produksi</h5>
                    <div class="ibox-tools">
                    <button class="btn btn-xs btn-primary" onclick="show_modal()"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                    <button class="btn btn-xs btn-success" onclick="show_modal()"><i class="fa fa-plus"></i> Tambah Data</button>
                    </div>
                </div>
                <div class="ibox-content" style="overflow: auto;">
                    <table class="table table-responsive table-hovered table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pabrik</th>
                                <th>Tgl Produksi</th>
                                <th>Shift</th>
                                <th>Total Produksi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;foreach($production as $v) { ?>
                            <tr>
                                <td><?php echo $no++;?></td>
                                <td><?php echo $v['factory_name'];?></td>
                                <td><?php echo date('D, d-M-Y', strtotime($v['date']));?></td>
                                <td><?php echo $v['shift_name'];?></td>
                                <td><?php echo $v['total'];?></td>
                                <td><button onclick="show_modal()" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="m-t-none m-b">Detail Data Produksi</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function show_modal() {
        $('#modal-form').modal('show');
    }
    function filter() {
        id_fc = $('select[name="id_factory"]').val();
        id_sf = $('select[name="id_shift"]').val();
        dt_start = $('input[name="date_start"]').val();
        dt_end = $('input[name="date_end"]').val();
        min_total = $('input[name="min_total"]').val();
        
        window.location.href = 
        '<?php echo base_url()?>production?id_factory='+id_fc+
        '&id_shift='+id_sf+'&date_start='+dt_start+
        '&date_end='+dt_end+'&min_total='+min_total;
    }

    function remove_filter() {
        $('select[name="id_factory"]').val('');
        $('select[name="id_shift"]').val('');
        $('input[name="date_start"]').val('');
        $('input[name="date_end"]').val('');
        $('input[name="min_total"]').val('');
        window.location.href = '<?php echo base_url()?>production';
    }
</script>