<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Data Transaksi</h3>
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
            <label for="enum">Trx Jenis <?php echo form_error('trx_jenis') ?></label>
            <?php
                echo form_dropdown('trx_jenis', $jenis, $trx_jenis, $attribute2);
            ?>
        </div>
        <div class="form-group">
            <label for="date">Tanggal Transaksi<?php echo form_error('trx_tanggal') ?></label>
            <input type="date" class="form-control" name="trx_tanggal" id="trx_tanggal" placeholder="Trx Tanggal" value="<?php echo $trx_tanggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nomor Bukti <?php echo form_error('trx_nomor_bukti') ?></label>
            <input type="text" class="form-control" name="trx_nomor_bukti" id="trx_nomor_bukti" placeholder="Trx Nomor Bukti" value="<?php echo $trx_nomor_bukti; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">MAK <?php echo form_error('trx_mak') ?></label>
            <input type="text" class="form-control" name="trx_mak" id="trx_mak" placeholder="Trx Mak" value="<?php echo $trx_mak; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Penerima <?php echo form_error('trx_id_unit') ?></label>
            <input type="text" class="form-control" name="trx_id_unit" id="trx_id_unit" placeholder="Trx Id Unit" value="<?php echo $trx_id_unit; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Uraian <?php echo form_error('trx_uraian') ?></label>
            <textarea class="form-control" rows="5" name="trx_uraian" id="trx_uraian" placeholder="Uraian"><?php echo $trx_uraian; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="double">Jumlah Kotor <?php echo form_error('trx_jml_kotor') ?></label>
            <input type="number" class="form-control" name="trx_jml_kotor" id="trx_jml_kotor" placeholder="Trx Jml Kotor" value="<?php echo $trx_jml_kotor; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">PPN <?php echo form_error('trx_ppn') ?></label>
            <input type="number" class="form-control" name="trx_ppn" id="trx_ppn" placeholder="Trx Ppn" value="<?php echo $trx_ppn; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">PPH 21 <?php echo form_error('trx_pph_21') ?></label>
            <input type="number" class="form-control" name="trx_pph_21" id="trx_pph_21" placeholder="Trx Pph 21" value="<?php echo $trx_pph_21; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">PPH 22 <?php echo form_error('trx_pph_22') ?></label>
            <input type="number" class="form-control" name="trx_pph_22" id="trx_pph_22" placeholder="Trx Pph 22" value="<?php echo $trx_pph_22; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Trx Pph 23 <?php echo form_error('trx_pph_23') ?></label>
            <input type="number" class="form-control" name="trx_pph_23" id="trx_pph_23" placeholder="Trx Pph 23" value="<?php echo $trx_pph_23; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">PPH 4(2) <?php echo form_error('trx_pph_4_2') ?></label>
            <input type="number" class="form-control" name="trx_pph_4_2" id="trx_pph_4_2" placeholder="Trx Pph 4 2" value="<?php echo $trx_pph_4_2; ?>" />
        </div>
        <div class="form-group" style="display:none" id="div_penerimaan">
            <label for="double">Penerimaan <?php echo form_error('trx_penerimaan') ?></label>
            <input type="number" class="form-control" name="trx_penerimaan" id="trx_penerimaan" placeholder="Trx Penerimaan" value="<?php echo $trx_penerimaan; ?>" />
        </div>
	    <div class="form-group" style="display:none" id="div_pengeluaran">
            <label for="double">Pengeluaran <?php echo form_error('trx_pengeluaran') ?></label>
            <input type="number" class="form-control" name="trx_pengeluaran" id="trx_pengeluaran" placeholder="Trx Pengeluaran" value="<?php echo $trx_pengeluaran; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Jenis Pembayaran <?php echo form_error('trx_id_jenis_pembayaran') ?></label>
            <?php
                echo form_dropdown('trx_id_jenis_pembayaran', $jp, $trx_id_jenis_pembayaran, $attribute);
            ?>
        </div>
	    <div class="form-group">
            <label for="int">Metode Pembayaran <?php echo form_error('trx_id_metode_pembayaran') ?></label>
            <?php
                echo form_dropdown('trx_id_metode_pembayaran', $mp, $trx_id_metode_pembayaran, $attribute);
            ?>
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>