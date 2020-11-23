<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Excel</h3>
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
            <input type="hidden" class="form-control" name="pejabat_id" id="pejabat_id" placeholder="Pejabat Id"  />
        </div>
        <div class="form-group">
            <label for="varchar">Bulan</label>
            <?php
                echo form_dropdown('trx_bulan', $bulan, $trx_bulan, $attribute);
            ?>
        </div>
	  
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pejabat') ?>" class="btn btn-default">Batal</a>
	</form>
         </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Excel Unit</h3>
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
        <form action="<?php echo $action2; ?>" method="post">
	    <div class="form-group">
            <input type="hidden" class="form-control" name="pejabat_id" id="pejabat_id" placeholder="Pejabat Id"  />
        </div>
        <div class="form-group">
            <label for="varchar">Unit</label>
            <?php
                echo form_dropdown('trx_unit', $unit, '', $attribute2);
            ?>
        </div>
        <div class="form-group">
            <label for="varchar">Bulan</label>
            <?php
                echo form_dropdown('trx_bulan', $bulan, $trx_bulan, $attribute);
            ?>
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pejabat') ?>" class="btn btn-default">Batal</a>
	</form>
         </div>
        </div>
    </div>
</div>