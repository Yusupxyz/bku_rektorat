<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Tbl_pejabat</h3>
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
            <input type="hidden" class="form-control" name="pejabat_id" id="pejabat_id" placeholder="Pejabat Id" value="<?php echo $pejabat_id; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Jabatan <?php echo form_error('pejabat_jabatan') ?></label>
            <input type="text" class="form-control" name="pejabat_jabatan" id="pejabat_jabatan" placeholder="Pejabat Jabatan" value="<?php echo $pejabat_jabatan; ?>" readonly/>
        </div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('pejabat_nama') ?></label>
            <input type="text" class="form-control" name="pejabat_nama" id="pejabat_nama" placeholder="Pejabat Nama" value="<?php echo $pejabat_nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">NIP <?php echo form_error('pejabat_nip') ?></label>
            <input type="text" class="form-control" name="pejabat_nip" id="pejabat_nip" placeholder="Pejabat Nip" value="<?php echo $pejabat_nip; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pejabat') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>