<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Buku Kas Umum Tahun <?= $tahun_aktif; ?></h3>
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
              </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
		        <?php echo anchor(site_url('transaksi/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group form-inline">
                    <label for="int">Pilih Jenis Laporan :</label>
                    <?php
                        echo form_dropdown('buku', $buku, $value_buku, $attribute);
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-inline">
                    <label for="int">Pilih Bulan :</label>
                    <?php
                        echo form_dropdown('bulan', $dd_bulan, $value_bulan, $attribute2);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h5>PNBP NON-MODAL UNIVERSITAS PALANGKA RAYA</h5>
                <H5><b><?= 'BUKU' ?></b></H5>
                <h5>BULAN <?= strtoupper($bulan) ?></h5>
            </div>
            <div class="col-md-12">
            <table style="border:none"?>
            <?php foreach ($set_lap as $key => $value) { ?>
                <tr>
                    <td><?= strtoupper($value->sl_setting)?>&nbsp;&nbsp;</td>
                    <td>:&nbsp;&nbsp;</td>
                    <td><?= strtoupper($value->sl_data)?></td>
                </tr>
            <?php }?>
            </table>
            </div>
            <div class="col-md-12 text-right">
                <h5><b>Saldo Awal : Rp <?= number_format($sa) ?></h5>
                <h5>Saldo Akhir : Rp <?= number_format($sak) ?></b></h5>
            </div>
        </div>                     

        <form method="post" action="<?= site_url('transaksi/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px; font-size=1px;" style="width:100%">
            <tr>
                <th>Tanggal</th>
		    <th>No. Bukti</th>
		    <th>MAK</th>
		    <th>Penerima</th>
		    <th>Uraian</th>
		    <th>Debet (Rp)</th>
		    <th>Kredit</th>
		    <th>Saldo (Rp)</th>
            </tr>
            <tr>
                <td colspan="5" style="text-align:center;"><b>Saldo Awal</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($sa);?></b></td>
                <td style="text-align:right;"><b><?php echo 'Rp ';?></b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($sa);?></b></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align:center;"><b>Kas</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($sum_jml_kotor);?></b></td>
                <td style="text-align:right;"><b><?php echo 'Rp ';?></b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($saldo);?></b></td>
            </tr>
            
            <?php $i=0;
            foreach ($transaksi_data as $transaksi)
            {
                $pajak=$transaksi->trx_ppn+$transaksi->trx_pph_21+$transaksi->trx_pph_22+$transaksi->trx_pph_23+$transaksi->trx_pph_4_2;
                ?>
                <tr>
                
                
			<td><?php echo $transaksi->trx_tanggal ?></td>
			<td><?php echo $transaksi->nb_no ?></td>
			<td><?php echo $transaksi->trx_mak ?></td>
			<td><?php echo $transaksi->trx_penerima ?></td>
			<td><?php echo substr($transaksi->trx_uraian,0,50).'... ' ;?><a lass="btn" data-toggle="modal" href="#ModalView<?php echo $transaksi->trx_id;?>">detail</a></td>
			<td style="text-align:right;"></td>
            <td style="text-align:right;"><?php echo 'Rp '.number_format($transaksi->trx_jml_kotor) ?></td>
            <td style="text-align:right;"><?php echo 'Rp '.number_format($persaldo[$i++]) ?></td>
		</tr>
                <?php
            }
            ?>
            <tr>
        <td colspan="5" style="text-align:center;"><b>Jumlah</b></td>
        <td style="text-align:right;"><?php echo 'Rp '.number_format($saldo);?></td>
        <td style="text-align:right;"><?php echo 'Rp '.number_format($sum_jml_kotor);?></td>
        <td style="text-align:right;"><?php echo 'Rp '.number_format($sak);?></td>
    </tr>
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