<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Kontrol Transaksi Tahun</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
              <i class="fa fa-refresh"></i></button>
          </div>
      </div>

      <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('nomor_bukti/create'),'<i class="fa fa-plus"></i> Tambah Nomor Bukti', 'class="btn bg-purple"'); ?>
                <?php echo anchor(site_url('transaksi/create'),'<i class="fa fa-plus"></i> Tambah Transaksi', 'class="btn bg-green"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
		<!-- <?php echo anchor(site_url('transaksi/printdoc'), '<i class="fa fa-print"></i> Print Preview', 'class="btn bg-maroon"'); ?> -->
		<?php echo anchor(site_url('transaksi/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?><form action="<?php echo site_url('transaksi/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('transaksi'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="int">Total Penerimaan : <mark style="color:red">Rp 0 </mark> </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group form-inline">
                    <label for="int">Nomor Bukti :</label>
                    <?php
                        echo form_dropdown('trx_id_nomor_bukti', $no_bukti, $trx_id_nomor_bukti, $attribute);
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <label for="int">Tanggal Nomor Bukti : <mark style="color:blue">date </mark> </label>
            </div>
            <div class="col-md-4">
                <label for="int">Total Pengeluaran : <mark style="color:blue">Rp 0 </mark> </label>
            </div>
        </div>

        <form method="post" action="<?= site_url('transaksi/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
            <tr>
                <th style="width: 10px;"><input type="checkbox" name="selectall" /></th>
                <th>No</th>
                <th>Tanggal</th>
		    <th>No. Bukti</th>
		    <th>MAK</th>
		    <th>Penerima</th>
		    <th>Uraian</th>
		    <th>Jumlah Kotor</th>
		    <th>PPn</th>
		    <th>PPh 21</th>
		    <th>PPh 22</th>
		    <th>PPh 23</th>
		    <th>PPh 4(2)</th>
		    <th>Jumlah Pajak</th>
		    <th>Jumlah Bersih</th>
		    <th>Jenis Pembayaran</th>
		    <th>Metode Pembayaran</th>
		    <th>Unit</th>
		    <th>Aksi</th>
            </tr><?php
            foreach ($transaksi_data as $transaksi)
            {
                $pajak=$transaksi->trx_ppn+$transaksi->trx_pph_21+$transaksi->trx_pph_22+$transaksi->trx_pph_23+$transaksi->trx_pph_4_2;
                ?>
                <tr>
                
		<td  style="width: 10px;padding-left: 8px;"><input type="checkbox" name="id" value="<?= $transaksi->trx_id;?>" />&nbsp;</td>
                
			<td width="40px"><?php echo ++$start ?></td>
			<td><?php echo $transaksi->trx_tanggal ?></td>
			<td><?php echo $transaksi->nb_no ?></td>
			<td><?php echo $transaksi->trx_mak ?></td>
			<td><?php echo $transaksi->trx_penerima ?></td>
			<td><?php echo $transaksi->trx_uraian ?></td>
			<td><?php echo 'Rp '.number_format($transaksi->trx_jml_kotor) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_ppn) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_pph_21) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_pph_22) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_pph_23) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_pph_4_2) ?></td>
            <td><?php echo 'Rp '.number_format($pajak) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_jml_bersih) ?></td>
			<td><?php echo $transaksi->jp_nama ?></td>
			<td><?php echo $transaksi->mp_nama ?></td>
			<td><?php echo $transaksi->deskripsi ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('transaksi/read/'.$transaksi->trx_id),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"'); 
				echo ' '; 
				echo anchor(site_url('transaksi/update/'.$transaksi->trx_id),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
				echo ' '; 
				echo anchor(site_url('transaksi/delete/'.$transaksi->trx_id),' <i class="fa fa-trash"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirmdelete(\'transaksi/delete/'.$transaksi->trx_id.'\')"  data-toggle="tooltip" title="Delete" '); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
         <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
                 <a href="#" class="btn bg-yellow">Total Transaksi : <?php echo $total_rows ?></a>
            </div>
        </div>
        </form>
        <div class="row">
            <div class="col-md-6">
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        <form method="post" action="<?= site_url('transaksi/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
            <tr>
            <th>No</th>
            <th>Uraian</th>
            <th>Pengeluaran</th>
            </tr>
            <tr>              
			<td width="40px">1.</td>
			<td>Pajak PPn</td>
			<td><?php  ?></td>
		    </tr>
            <tr>              
			<td width="40px">2.</td>
			<td>Pajak PPh 21</td>
			<td><?php  ?></td>
		    </tr>
            <tr>              
			<td width="40px">3.</td>
			<td>Pajak PPh 22</td>
			<td><?php  ?></td>
		    </tr>
            <tr>              
			<td width="40px">4.</td>
			<td>Pajak PPh 23</td>
			<td><?php  ?></td>
		    </tr>
            <tr>              
			<td width="40px">5.</td>
			<td>Pajak PPh 4(2) </td>
			<td><?php  ?></td>
		    </tr>
        </table>
    </div>
    </div>
  </div>
</div>