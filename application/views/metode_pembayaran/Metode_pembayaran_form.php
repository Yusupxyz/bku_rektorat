<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Metode Pembayaran</h3>
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
            <input type="hidden" class="form-control" name="mp_id" id="mp_id" placeholder="Mp Id" value="<?php echo $mp_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Metode Pembayaran<?php echo form_error('md_nama') ?></label>
            <input type="text" class="form-control" name="md_nama" id="md_nama" placeholder="Md Nama" value="<?php echo $md_nama; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('metode_pembayaran') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>