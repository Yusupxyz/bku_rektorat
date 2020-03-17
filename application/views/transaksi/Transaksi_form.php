<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Transasksi</h3>
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
            <div class="col-xs-12 col-md-6">
                    <input type="hidden" class="form-control" name="trx_id" id="trx_id" placeholder="Trx Id" value="<?php echo $trx_id; ?>" />
                <div class="form-group">
                    <label for="date">Tanggal <?php echo form_error('trx_tanggal') ?></label>
                    <input type="date" class="form-control" name="trx_tanggal" id="trx_tanggal" placeholder="Tanggal" value="<?php echo $trx_tanggal; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Nomor Bukti <?php echo form_error('trx_id_nomor_bukti') ?></label>
                    <?php
                        echo form_dropdown('trx_id_nomor_bukti', $no_bukti, $trx_id_nomor_bukti, $attribute);
                    ?>
                </div>
                <div class="form-group">
                    <label for="varchar">MAK <?php echo form_error('trx_mak') ?></label>
                    <input type="text" class="form-control" name="trx_mak" id="trx_mak" placeholder="MAK" value="<?php echo $trx_mak; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Penerima <?php echo form_error('trx_penerima') ?></label>
                    <input type="text" class="form-control" name="trx_penerima" id="trx_penerima" placeholder="Penerima" value="<?php echo $trx_penerima; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Uraian <?php echo form_error('trx_uraian') ?></label>
                    <input type="text" class="form-control" name="trx_uraian" id="trx_uraian" placeholder="Uraian" value="<?php echo $trx_uraian; ?>" />
                </div>
                <div class="form-group">
                    <label for="double">Jumlah Kotor <?php echo form_error('trx_jml_kotor') ?></label>
                    <input type="text" class="form-control" name="trx_jml_kotor2" id="trx_jml_kotor2" placeholder="Jumlah Kotor" value="<?php echo $trx_jml_kotor; ?>" />
                    <input type="hidden" class="form-control" name="trx_jml_kotor" id="trx_jml_kotor" placeholder="Jumlah Kotor" value="<?php echo $trx_jml_kotor; ?>" />
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
                <div class="form-group">
                    <label for="int">Unit <?php echo form_error('trx_id_unit') ?></label>
                    <?php
                        echo form_dropdown('trx_id_unit', $unit, $trx_id_unit, $attribute);
                    ?>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <label for="double">Pajak</label>
                    <div class="form-group form-inline">
                        <label for="double">PPN&emsp;&emsp;&nbsp;  <?php echo form_error('trx_ppn') ?></label>
                        <input type="checkbox" id="trx_ppnc" name="trx_ppnc">
                        <input type="text" class="form-control" name="trx_ppn" id="trx_ppn" placeholder="PPN" value="<?php echo $trx_ppn; ?>" readonly />
                    </div>
                    <div class="form-group form-inline">
                        <label for="double">PPH 21&emsp; <?php echo form_error('trx_pph_21') ?></label>
                        <input type="checkbox" id="trx_pph_21c" name="trx_pph_21c" >
                        <input type="text" class="form-control" name="trx_pph_21" id="trx_pph_21" placeholder="PPH 21" value="<?php echo $trx_pph_21; ?>" readonly />
                    </div>
                    <div class="form-group form-inline">
                        <label for="double">PPH 22&emsp; <?php echo form_error('trx_pph_22') ?></label>
                        <input type="checkbox" id="trx_pph_22c" name="trx_pph_22c" >
                        <input type="text" class="form-control" name="trx_pph_22" id="trx_pph_22" placeholder="PPH 22" value="<?php echo $trx_pph_22; ?>" readonly />
                    </div>
                    <div class="form-group form-inline">
                        <label for="double">PPH 23&emsp; <?php echo form_error('trx_pph_23') ?></label>
                        <input type="checkbox" id="trx_pph_23c" name="trx_pph_23c" >
                        <input type="text" class="form-control" name="trx_pph_23" id="trx_pph_23" placeholder="PPH 23" value="<?php echo $trx_pph_23; ?>" readonly />
                    </div>
                    <div class="form-group form-inline">
                        <label for="double">PPH 4(2)&nbsp;&nbsp; <?php echo form_error('trx_pph_4_2') ?></label>
                        <input type="checkbox" id="trx_pph_4_2c" name="trx_pph_4_2c" >
                        <input type="text" class="form-control" name="trx_pph_4_2" id="trx_pph_4_2" placeholder="PPH 4(2)" value="<?php echo $trx_pph_4_2; ?>" readonly />
                    </div>
                  
                </div>
            </div>
	        </form>
            </div>
        </div>
    </div>
</div>

