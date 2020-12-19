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
            <!-- <div class="col-md-3 text-right">
		        <?php echo anchor(site_url('transaksi/excel'), '<i class="fa fa-file-excel"></i> Download Excel', 'class="btn btn-success"'); ?>
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-5">
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
        <div class="row" style="display:none" id="my_div">
            <div class="col-md-6">
                <div class="form-group form-inline">
                    <label for="int">Pilih Unit :</label>
                    <?php
                        echo form_dropdown('unit', $dd_unit, $value_unit, $attribute3);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h5 id='top'>PNBP NON-MODAL UNIVERSITAS PALANGKA RAYA</h5>
                <H5><b><?= $bukutitle ?></b></H5>
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
                <h5><b>Saldo Awal : Rp <?= number_format($saldo_awal) ?></h5>
                <h5>Saldo Akhir : Rp <?= number_format($saldo_akhir) ?></b></h5>
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
            
            <?php $i=0; $saldo=0;
            foreach ($transaksi_data as $transaksi)
            {
                $saldo=$saldo+$transaksi->trx_penerimaan-$transaksi->trx_pengeluaran;
                ?>
                <tr>
                
                
			<td><?php echo $transaksi->trx_tanggal ?></td>
			<td><?php echo $transaksi->trx_nomor_bukti ?></td>
			<td><?php echo $transaksi->trx_mak ?></td>
			<td><?php echo $transaksi->trx_id_unit ?></td>
            <?php if($bukutitle=='BUKU KAS UNIT'){ ?>
                <td><?php echo substr($transaksi->trxu_uraian,0,50).'... ' ;?><a lass="btn" data-toggle="modal" href="#ModalView<?php echo $transaksi->trx_id;?>">detail</a></td>
            <?php }else{ ?>
			    <td><?php echo substr($transaksi->trx_uraian,0,50).'... ' ;?><a lass="btn" data-toggle="modal" href="#ModalView<?php echo $transaksi->trx_id;?>">detail</a></td>
            <?php } ?>
            <td style="text-align:right;"><?php echo 'Rp '.number_format($transaksi->trx_penerimaan) ?></td>
            <td style="text-align:right;"><?php echo 'Rp '.number_format($transaksi->trx_pengeluaran) ?></td>
            <td style="text-align:right;"><?php echo 'Rp '.number_format($saldo) ?></td>
		</tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="5" style="text-align:center;"><b>JUMLAH BULAN INI</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($saldo_total);?></b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($sum_pengeluaran);?></b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($saldo_total-$sum_pengeluaran);?></b></td>
            </tr>
            <tr>
            <td colspan="5" style="text-align:center;"><b>JUMLAH BULAN LALU</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($saldo_total_lalu);?></b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($sum_pengeluaran_lalu);?></b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($saldo_total_lalu-$sum_pengeluaran_lalu);?></b></td>
            </tr>
            <tr>
            <td colspan="5" style="text-align:center;"><b>JUMLAH S.D. BULAN INI</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($saldo_total_sd);?></b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($sum_pengeluaran_sd);?></b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($saldo_total_sd-$sum_pengeluaran_sd);?></b></td>
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