<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Detail Transaksi Unit</h3>
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
        <input type="hidden" class="form-control" name="trxu_id" id="trxu_id" placeholder="Trx Nomor Bukti" value="<?php echo $trxu_id; ?>" />
	    
	    <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('trxu_tanggal') ?></label>
            <input type="date" class="form-control" name="trxu_tanggal" id="trxu_tanggal" placeholder="Trxu Tanggal" value="<?php echo $trxu_tanggal; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Nomor Bukti <?php echo form_error('trxu_nomor_bukti') ?></label>
            <?php
                echo form_dropdown('trxu_nomor_bukti', $nb, $trxu_nomor_bukti, $attribute2);
            ?>
        </div>
	    <div class="form-group">
            <label for="varchar">MAK <?php echo form_error('trxu_mak') ?></label>
            <input type="text" class="form-control" name="trxu_mak" id="trxu_mak" placeholder="Trxu Mak" value="<?php echo $trxu_mak; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Penerima <?php echo form_error('trxu_id_unit') ?></label>
            <?php
                echo form_dropdown('trxu_id_unit', $unit, $trxu_id_unit, $attribute);
            ?>
        </div>
	    <div class="form-group">
            <label for="varchar">Uraian <?php echo form_error('trxu_uraian') ?></label>
            <textarea class="form-control" rows="5" name="trxu_uraian" id="trxu_uraian" placeholder="Uraian"><?php echo $trxu_uraian; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="double">Jml Kotor <?php echo form_error('trxu_jml_kotor') ?></label>
            <input type="number" class="form-control" name="trxu_jml_kotor" id="trxu_jml_kotor" placeholder="Trxu Jml Kotor" value="<?php echo $trxu_jml_kotor; ?>" min="0"/>
        </div>
	    <div class="form-group">
            <label for="double">PPn <?php echo form_error('trxu_ppn') ?></label>
            <input type="number" class="form-control" name="trxu_ppn" id="trxu_ppn" placeholder="Trxu Ppn" value="<?php echo $trxu_ppn; ?>" min="0"/>
        </div>
	    <div class="form-group">
            <label for="double">PPh 21 <?php echo form_error('trxu_pph_21') ?></label>
            <input type="number" class="form-control" name="trxu_pph_21" id="trxu_pph_21" placeholder="Trxu Pph 21" value="<?php echo $trxu_pph_21; ?>" min="0"/>
        </div>
	    <div class="form-group">
            <label for="double">PPh 22 <?php echo form_error('trxu_pph_22') ?></label>
            <input type="number" class="form-control" name="trxu_pph_22" id="trxu_pph_22" placeholder="Trxu Pph 22" value="<?php echo $trxu_pph_22; ?>" min="0"/>
        </div>
	    <div class="form-group">
            <label for="double">PPh 23 <?php echo form_error('trxu_pph_23') ?></label>
            <input type="number" class="form-control" name="trxu_pph_23" id="trxu_pph_23" placeholder="Trxu Pph 23" value="<?php echo $trxu_pph_23; ?>" min="0"/>
        </div>
	    <div class="form-group">
            <label for="double">PPh 4(2) <?php echo form_error('trxu_pph_4_2') ?></label>
            <input type="number" class="form-control" name="trxu_pph_4_2" id="trxu_pph_4_2" placeholder="Trxu Pph 4 2" value="<?php echo $trxu_pph_4_2; ?>" min="0"/>
        </div>
	    <div class="form-group">
            <label for="double">Jumlah Bersih <?php echo form_error('trxu_jml_bersih') ?></label>
            <input type="number" class="form-control" name="trxu_jml_bersih" id="trxu_jml_bersih" placeholder="Trxu Jml Bersih" value="<?php echo $trxu_jml_bersih; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Jenis Pembayaran <?php echo form_error('trxu_id_jenis_pembayaran') ?></label>
            <?php
                echo form_dropdown('trxu_id_jenis_pembayaran', $jp, $trxu_id_jenis_pembayaran, $attribute);
            ?>
        </div>
	    <div class="form-group">
            <label for="int">Metode Pembayaran <?php echo form_error('trxu_id_metode_pembayaran') ?></label>
            <?php
                echo form_dropdown('trxu_id_metode_pembayaran', $mp, $trxu_id_metode_pembayaran, $attribute);
            ?>
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('transaksi_unit') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>