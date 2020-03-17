<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Nomor Bukti</h3>
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
            <input type="hidden" class="form-control" name="nb_id" id="nb_id" placeholder="Nb Id" value="<?php echo $nb_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nomor Bukti <?php echo form_error('nb_no') ?></label>
            <input type="text" class="form-control" name="nb_no" id="nb_no" placeholder="Nomor Bukti" value="<?php echo $nb_no; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('nb_tanggal') ?></label>
            <input type="date" class="form-control" name="nb_tanggal" id="nb_tanggal" placeholder="Tanggal" value="<?php echo $nb_tanggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="uraian">Uraian <?php echo form_error('uraian') ?></label>
            <textarea class="form-control" rows="3" name="uraian" id="uraian" placeholder="Uraian"><?php echo $uraian; ?></textarea>
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>