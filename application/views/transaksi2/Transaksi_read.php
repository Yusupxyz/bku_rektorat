<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tbl Transaksi Detail</h3>
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
        <table class="table">
	    <tr><td>Trx Id</td><td><?php echo $trx_id; ?></td></tr>
	    <tr><td>Trx Id Nomor Bukti</td><td><?php echo $trx_id_nomor_bukti; ?></td></tr>
	    <tr><td>Trx Mak</td><td><?php echo $trx_mak; ?></td></tr>
	    <tr><td>Trx Penerima</td><td><?php echo $trx_penerima; ?></td></tr>
	    <tr><td>Trx Uraian</td><td><?php echo $trx_uraian; ?></td></tr>
	    <tr><td>Trx Jml Kotor</td><td><?php echo $trx_jml_kotor; ?></td></tr>
	    <tr><td>Trx Ppn</td><td><?php echo $trx_ppn; ?></td></tr>
	    <tr><td>Trx Pph 21</td><td><?php echo $trx_pph_21; ?></td></tr>
	    <tr><td>Trx Pph 22</td><td><?php echo $trx_pph_22; ?></td></tr>
	    <tr><td>Trx Pph 23</td><td><?php echo $trx_pph_23; ?></td></tr>
	    <tr><td>Trx Pph 4 2</td><td><?php echo $trx_pph_4_2; ?></td></tr>
	    <tr><td>Trx Jml Bersih</td><td><?php echo $trx_jml_bersih; ?></td></tr>
	    <tr><td>Trx Tanggal</td><td><?php echo $trx_tanggal; ?></td></tr>
	    <tr><td>Trx Id Jenis Pembayaran</td><td><?php echo $trx_id_jenis_pembayaran; ?></td></tr>
	    <tr><td>Trx Id Metode Pembayaran</td><td><?php echo $trx_id_metode_pembayaran; ?></td></tr>
	    <tr><td>Trx Id Unit</td><td><?php echo $trx_id_unit; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('transaksi') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>