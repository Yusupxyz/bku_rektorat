<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Jenis Pembayaran</h3>
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
            <input type="hidden" class="form-control" name="jp_id" id="jp_id" placeholder="Jp Id" value="<?php echo $jp_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenis Pembayaran <?php echo form_error('jp_nama') ?></label>
            <input type="text" class="form-control" name="jp_nama" id="jp_nama" placeholder="Jp Nama" value="<?php echo $jp_nama; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jenis_pembayaran') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>