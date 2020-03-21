<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Tbl_saldo_akhir</h3>
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
            <input type="hidden" class="form-control" name="sak_id" id="sak_id" placeholder="Sak Id" value="<?php echo $sak_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Sak Jumlah <?php echo form_error('sak_jumlah') ?></label>
            <input type="number" class="form-control" name="sak_jumlah" id="sak_jumlah" placeholder="Sak Jumlah" value="<?php echo $sak_jumlah; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('saldo_akhir') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>