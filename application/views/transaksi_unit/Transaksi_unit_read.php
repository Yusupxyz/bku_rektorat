<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tbl Transaksi Unit Detail</h3>
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
	    <tr><td>Trxu Id</td><td><?php echo $trxu_id; ?></td></tr>
	    <tr><td>Trxu Nomor Bukti</td><td><?php echo $trxu_nomor_bukti; ?></td></tr>
	    <tr><td>Trxu Mak</td><td><?php echo $trxu_mak; ?></td></tr>
	    <tr><td>Trxu Uraian</td><td><?php echo $trxu_uraian; ?></td></tr>
	    <tr><td>Trxu Jml Kotor</td><td><?php echo $trxu_jml_kotor; ?></td></tr>
	    <tr><td>Trxu Ppn</td><td><?php echo $trxu_ppn; ?></td></tr>
	    <tr><td>Trxu Pph 21</td><td><?php echo $trxu_pph_21; ?></td></tr>
	    <tr><td>Trxu Pph 22</td><td><?php echo $trxu_pph_22; ?></td></tr>
	    <tr><td>Trxu Pph 23</td><td><?php echo $trxu_pph_23; ?></td></tr>
	    <tr><td>Trxu Pph 4 2</td><td><?php echo $trxu_pph_4_2; ?></td></tr>
	    <tr><td>Trxu Jml Bersih</td><td><?php echo $trxu_jml_bersih; ?></td></tr>
	    <tr><td>Trxu Tanggal</td><td><?php echo $trxu_tanggal; ?></td></tr>
	    <tr><td>Trxu Id Jenis Pembayaran</td><td><?php echo $trxu_id_jenis_pembayaran; ?></td></tr>
	    <tr><td>Trxu Id Metode Pembayaran</td><td><?php echo $trxu_id_metode_pembayaran; ?></td></tr>
	    <tr><td>Trxu Id Unit</td><td><?php echo $trxu_id_unit; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('transaksi_unit') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>