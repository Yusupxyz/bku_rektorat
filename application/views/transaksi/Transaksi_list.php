<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Kontrol Transaksi Tahun <?= $tahun_aktif; ?></h3>
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
                <label for="int">Total Penerimaan : <mark style="color:red">Rp <?= number_format($penerimaan) ?> </mark> </label>
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
                <label for="int">Tanggal Nomor Bukti : <mark style="color:blue"><?= $tgl ?></mark> </label>
            </div>
            <div class="col-md-4">
                <label for="int">Total Pengeluaran : <mark style="color:blue">Rp <?= number_format($pengeluaran) ?></mark> </label>
            </div>
        </div>

        <form method="post" action="<?= site_url('transaksi/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px; font-size=1px" style="width:100%">
            <tr>
                <!-- <th style="width: 10px;"><input type="checkbox" name="selectall" /></th> -->
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
                
		<!-- <td  style="width: 10px;padding-left: 8px;"><input type="checkbox" name="id" value="<?= $transaksi->trx_id;?>" />&nbsp;</td> -->
                
			<td width="40px"><?php echo ++$start ?></td>
			<td><?php echo $transaksi->trx_tanggal ?></td>
			<td><?php echo $transaksi->nb_no ?></td>
			<td><?php echo substr_replace($transaksi->trx_mak, ' ', 13, 0); ?></td>
			<td><?php echo $transaksi->trx_penerima ?></td>
			<td><?php echo substr($transaksi->trx_uraian,0,50).'... ' ;?><a lass="btn" data-toggle="modal" href="#ModalView<?php echo $transaksi->trx_id;?>">detail</a></td>
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
        <div class="row">
            <div class="col-md-6">
                <label for="int">Setor Pajak </label>
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
			<td>Setor PPn</td>
			<td><?= 'Rp '.number_format($ppn) ?></td>
		    </tr>
            <tr>              
			<td width="40px">2.</td>
			<td>Setor PPh 21</td>
			<td><?= 'Rp '.number_format($pph21) ?></td>
		    </tr>
            <tr>              
			<td width="40px">3.</td>
			<td>Setor PPh 22</td>
			<td><?= 'Rp '.number_format($pph22) ?></td>
		    </tr>
            <tr>              
			<td width="40px">4.</td>
			<td>Setor PPh 23</td>
			<td><?= 'Rp '.number_format($pph23) ?></td>
		    </tr>
            <tr>              
			<td width="40px">5.</td>
			<td>Setor PPh 4(2) </td>
			<td><?= 'Rp '.number_format($pph42) ?></td>
		    </tr>
        </table>
    </div>
    </div>
  </div>
</div>

<?php foreach ($transaksi_data as $transaksi) :
              $transaksi_id=$transaksi->trx_id;
              $transaksi_uraian=$transaksi->trx_uraian;
            ?>
	<!--Modal View-->
        <div class="modal fade" id="ModalView<?php echo $transaksi_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Tampil Uraian</h4>
                    </div>
                    <div class="modal-body">       
							       <p><?= $transaksi_uraian?></p> 
                               
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
	<?php endforeach;?>