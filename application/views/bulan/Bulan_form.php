<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Tbl_bulan</h3>
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
            <label for="int">Bulan Id <?php echo form_error('bulan_id') ?></label>
            <input type="text" class="form-control" name="bulan_id" id="bulan_id" placeholder="Bulan Id" value="<?php echo $bulan_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Bulan Nama <?php echo form_error('bulan_nama') ?></label>
            <input type="text" class="form-control" name="bulan_nama" id="bulan_nama" placeholder="Bulan Nama" value="<?php echo $bulan_nama; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('bulan') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>