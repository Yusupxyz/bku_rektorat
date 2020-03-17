<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Sub Kegiatan 2</h3>
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
            <label>Kegiatan</label>
                <select class="selectpicker form-control" name="kegiatan_id_1" id="kegiatan_id_1" data-placeholder="Pilih Sub Kegiatan" data-live-search="true" style="width: 100%;">
                   <option value="0">-- Pilih Sub Kegiatan -- </option>
                  <?php 
                    foreach ($kegiatan as $key => $value ) {
                      echo "<option value=\"$value->id_kegiatan_1\">($value->kode_kegiatan) $value->nama_kegiatan</option>";
                    }
                  ?>
               </select>
            
        </div>
	    <div class="form-group">
            <label for="varchar">Kode Kegiatan <?php echo form_error('kode_kegiatan') ?></label>
            <input type="text" class="form-control" name="kode_kegiatan" id="kode_kegiatan" placeholder="Kode Kegiatan" value="<?php echo $kode_kegiatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Kegiatan <?php echo form_error('nama_kegiatan') ?></label>
            <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama Kegiatan" value="<?php echo $nama_kegiatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Volume <?php echo form_error('volume') ?></label>
            <input type="text" class="form-control" name="volume" id="volume" placeholder="Volume" value="<?php echo $volume; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Satuan <?php echo form_error('satuan') ?></label>
            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jumlah <?php echo form_error('jumlah') ?></label>
            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
        </div>
	    <input type="hidden" name="id_kegiatan" value="<?php echo $id_kegiatan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kegiatan') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>