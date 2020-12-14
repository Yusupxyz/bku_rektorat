<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Transaksi Tahun <?= $tahun_aktif; ?> </h3>
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
                <?php echo anchor(site_url('transaksi/create'),'<i class="fa fa-plus"></i> Transaksi', 'class="btn bg-purple"'); ?>
                <?php echo anchor(site_url('transaksi_unit/create'),'<i class="fa fa-plus"></i> Pengeluaran Unit', 'class="btn bg-red"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
            <a href="#myModal" data-toggle="modal" class="btn btn-success"><i class="fa fa-file-excel"></i> Import</a>

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
            <div class="col-md-3">
                <div class="form-group form-inline">
                    <label for="int">Bulan :</label>
                    <?php
                        echo form_dropdown('trx_bulan', $bulan, $trx_bulan, $attribute2);
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group form-inline">
                    <label for="int">Nomor Bukti :</label>
                    <?php
                        echo form_dropdown('trx_nomor_bukti', $no_bukti, $trx_nomor_bukti, $attribute);
                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-left">
        <div class="col-md-12 alert alert-success" role="alert">

                <h5 ><b>Total Pemasukan : Rp <?= number_format($saldo->saldo_awal)?><br>
                Total Pengeluaran : Rp <?= number_format($saldo->saldo_akhir)?></b></h5>
                <hr>
                <h4><b>Saldo Akhir : Rp <?= number_format($saldo->saldo_awal-$saldo->saldo_akhir)?></b></h4>
            </div>
        </div>
        <a href="<?= $url ?>" class="btn bg-<?= $color ?>"><?= $teks ?></a>

        <form method="post" action="<?= site_url('transaksi/deletebulk');?>" id="formbulk">
        <font size="1">
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%;">
            <tr> 
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
		    <th>Penerimaan</th>
		    <th>Pengeluaran</th>
		    <th>Saldo</th>
		    <th>Jenis Pembayaran</th>
		    <th>Metode Pembayaran</th>
		    <th>Aksi</th>
            </tr><?php
            $i=0;
            foreach ($transaksi_data as $transaksi)

            { 
                $pajak=$transaksi->trx_ppn+$transaksi->trx_pph_21+$transaksi->trx_pph_22+$transaksi->trx_pph_23+$transaksi->trx_pph_4_2;
                $saldo_awal=$transaksi->trx_penerimaan+$saldo_akhir;
                $saldo_akhir=$saldo_awal-$transaksi->trx_pengeluaran;

                ?>
                <tr style="background-color:#f2efed" >
                
                
			<td><?php echo $transaksi->trx_tanggal ?></td>
			<td ><?php echo $transaksi->trx_nomor_bukti ?></td>
			<td><?php echo $transaksi->trx_mak ?></td>
            <?php if ($transaksi->trx_fk_unit=='0'){ ?>
                <td><?php echo substr($transaksi->trx_id_unit,0,50).'... ' ;?><a lass="btn" data-toggle="modal" href="#ModalView2<?php echo $transaksi->trx_id;?>">detail</a></td>
            <?php }else{ ?>
                <td><?php echo substr($transaksi->nama,0,50).'... ' ;?><a lass="btn" data-toggle="modal" href="#ModalView2<?php echo $transaksi->trx_id;?>">detail</a></td>
            <?php } ?>
            <td><?php echo substr($transaksi->trx_uraian,0,50).'... ' ;?><a lass="btn" data-toggle="modal" href="#ModalView<?php echo $transaksi->trx_id;?>">detail</a></td>
			<td><?php echo 'Rp '.number_format($transaksi->trx_jml_kotor) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_ppn) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_pph_21) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_pph_22) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_pph_23) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_pph_4_2) ?></td>
            <td><?php echo 'Rp '.number_format($pajak) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_jml_bersih) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_penerimaan) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi->trx_pengeluaran) ?></td>
            <td><?php echo 'Rp '.number_format($saldo_akhir) ?></td>
			<td><?php echo $transaksi->jp_nama ?></td>
			<td><?php echo $transaksi->mp_nama ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('transaksi/update/'.$transaksi->trx_id),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
				echo ' '; 
				echo anchor(site_url('transaksi/delete/'.$transaksi->trx_id),' <i class="fa fa-trash"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirmdelete(\'transaksi/delete/'.$transaksi->trx_id.'\')"  data-toggle="tooltip" title="Delete" '); 
				?>
			</td>
		</tr>
        <?php
            $saldo_akhir2=0; $x=1;
            foreach ($transaksi_unit[$i++] as $transaksi2)

            { 
                $x++;
                $pajak=$transaksi2->trxu_ppn+$transaksi2->trxu_pph_21+$transaksi2->trxu_pph_22+$transaksi2->trxu_pph_23+$transaksi2->trxu_pph_4_2;
                $saldo_awal2=$saldo_awal+$saldo_akhir2;
                $saldo_akhir2=$saldo_awal2-$transaksi2->trxu_jml_kotor;

                ?>
                 
                <tr style="<?= $style ?>">
                
		<!-- <td  style="width: 10px;padding-left: 8px;"><input type="checkbox" name="id" value="<?= $transaksi2->trxu_id;?>" />&nbsp;</td> -->
                <!-- <td><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Unit</button>
  <div id="demo" class="collapse">
    Lorem 
  </div></td> -->
			<!-- <td width="80px"><?php echo ++$start ?></td> -->
			<td><?php echo $transaksi2->trxu_tanggal ?></td>
			<td ></td>
			<td><?php echo $transaksi2->trxu_mak ?></td>
            <td><?php echo substr($transaksi2->nama,0,50).'... ' ;?><a lass="btn" data-toggle="modal" href="#ModalView2<?php echo $transaksi2->trx_id;?>">detail</a></td>
			<td><?php echo substr($transaksi2->trxu_uraian,0,50).'... ' ;?><a lass="btn" data-toggle="modal" href="#ModalView<?php echo $transaksi2->trxu_id;?>">detail</a></td>
			<td><?php echo 'Rp '.number_format($transaksi2->trxu_jml_kotor) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi2->trxu_ppn) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi2->trxu_pph_21) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi2->trxu_pph_22) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi2->trxu_pph_23) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi2->trxu_pph_4_2) ?></td>
            <td><?php echo 'Rp '.number_format($pajak) ?></td>
            <td><?php echo 'Rp '.number_format($transaksi2->trxu_jml_bersih) ?></td>
            <td></td>
            <td></td>
            <td></td>
            <!-- <td><?php echo 'Rp '.number_format($saldo_akhir2) ?></td> -->
			<td><?php echo $transaksi2->jp_nama ?></td>
			<td><?php echo $transaksi2->mp_nama ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('transaksi_unit/update/'.$transaksi2->trxu_id),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
				echo ' '; 
				echo anchor(site_url('transaksi_unit/delete/'.$transaksi2->trxu_id),' <i class="fa fa-trash"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirmdelete(\'transaksi_unit/delete/'.$transaksi2->trxu_id.'\')"  data-toggle="tooltip" title="Delete" '); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
                <?php
            }
            ?>
        </table></font>
         <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
                <!-- <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button> -->
                 <a href="#" class="btn bg-yellow">Total Record : <?php echo $total_rows ?></a>
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

<?php $i=0; foreach ($transaksi_data as $transaksi) :
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
        <?php foreach ($transaksi_unit[$i++] as $transaksi2) :
              $transaksi_id=$transaksi2->trxu_id;
              $transaksi_uraian=$transaksi2->trxu_uraian;
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
	<?php endforeach;?>

    <?php $j=0;  foreach ($transaksi_data as $transaksi) :
              $transaksi_id=$transaksi->trx_id;
              if ($transaksi->trx_fk_unit=='0'){
                $trx_id_unit=$transaksi->trx_id_unit;
              }else{
                $trx_id_unit=$transaksi->nama;
              }
            ?>
	<!--Modal View-->
        <div class="modal fade" id="ModalView2<?php echo $transaksi_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Tampil penerima</h4>
                    </div>
                    <div class="modal-body">       
							       <p><?= $trx_id_unit?></p> 
                               
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ($transaksi_unit[$j++] as $transaksi2) :
              $transaksi_id=$transaksi2->trxu_id;
              if ($transaksi2->trx_id_unit==''){
                $trxu_id_unit=$transaksi2->trx_id_unit;
              }else{
                $trxu_id_unit=$transaksi2->nama;
              }
            ?>
	<!--Modal View-->
        <div class="modal fade" id="ModalView2<?php echo $transaksi_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Tampil penerima</h4>
                    </div>
                    <div class="modal-body">       
							       <p><?= $trxu_id_unit?></p> 
                               
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
	<?php endforeach;?>

	<?php endforeach;?>

    
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Import Excel</h4>
        </div>
        <form action="<?php echo site_url('transaksi/import'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <label>Ambil file (.xls/.xlsx/.csv) </label>
            <input type="file" class="form-control" name="file" accept=".xlsx, .xls, .csv" />
            <h6><i>Template file import excel yang diterima. <a href="<?php echo site_url('assets/template/template.xlsx'); ?>"> Unduh. </a></i></h6>
        </div>
        <div class="modal-footer">
        <a href="#myModal2" data-toggle="modal" class="btn btn-success">Import</a>
            <!-- <button type="submit" class="btn btn-success">Import</button> -->
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- alert modal -->
  <div class="modal" id="myModal2" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Alert!</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><i>Data akan dihapus dan ditimpa dengan data baru yang diimport. 
        Apa Anda yakin untuk melakukan impot?</i></p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Lanjutkan Import</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>

  </div>
</div>

