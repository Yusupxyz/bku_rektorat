<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Tbl_saldo_awal</h3>
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
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Sa Id <?php echo form_error('sa_id') ?></label>
            <input type="text" class="form-control" name="sa_id" id="sa_id" placeholder="Sa Id" value="<?php echo $sa_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Sa Jumlah <?php echo form_error('sa_jumlah') ?></label>
            <input type="text" class="form-control" name="sa_jumlah" id="sa_jumlah" placeholder="Sa Jumlah" value="<?php echo $sa_jumlah; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Sa Id Bulan <?php echo form_error('sa_id_bulan') ?></label>
            <input type="text" class="form-control" name="sa_id_bulan" id="sa_id_bulan" placeholder="Sa Id Bulan" value="<?php echo $sa_id_bulan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Sa Id Tahun <?php echo form_error('sa_id_tahun') ?></label>
            <input type="text" class="form-control" name="sa_id_tahun" id="sa_id_tahun" placeholder="Sa Id Tahun" value="<?php echo $sa_id_tahun; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('saldo_awal') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>