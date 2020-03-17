<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tbl Nomor Bukti Detail</h3>
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
	    <tr><td>Nb Id</td><td><?php echo $nb_id; ?></td></tr>
	    <tr><td>Nb No</td><td><?php echo $nb_no; ?></td></tr>
	    <tr><td>Nb Tanggal</td><td><?php echo $nb_tanggal; ?></td></tr>
	    <tr><td>Uraian</td><td><?php echo $uraian; ?></td></tr>
	    <tr><td>Tbl Pengeluaran</td><td><?php echo $tbl_pengeluaran; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('nomor_bukti') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>