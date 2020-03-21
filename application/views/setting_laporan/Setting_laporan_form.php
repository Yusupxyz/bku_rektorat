<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Tbl_setting_laporan</h3>
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
            <input type="hidden" class="form-control" name="sl_id" id="sl_id" placeholder="Sl Id" value="<?php echo $sl_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Setting <?php echo form_error('sl_setting') ?></label>
            <input type="text" class="form-control" name="sl_setting" id="sl_setting" placeholder="Sl Setting" value="<?php echo $sl_setting; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Data <?php echo form_error('sl_data') ?></label>
            <input type="text" class="form-control" name="sl_data" id="sl_data" placeholder="Sl Data" value="<?php echo $sl_data; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('setting_laporan') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>