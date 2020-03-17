<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tbl Saldo Awal Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <table class="table">
	    <tr><td>Sa Id</td><td><?php echo $sa_id; ?></td></tr>
	    <tr><td>Sa Jumlah</td><td><?php echo $sa_jumlah; ?></td></tr>
	    <tr><td>Sa Id Bulan</td><td><?php echo $sa_id_bulan; ?></td></tr>
	    <tr><td>Sa Id Tahun</td><td><?php echo $sa_id_tahun; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('saldo_awal') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>