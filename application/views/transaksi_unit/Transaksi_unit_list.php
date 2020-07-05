<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Tbl_transaksi_unit</h3>
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
                <?php echo anchor(site_url('transaksi_unit/create'),'<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right"><form action="<?php echo site_url('transaksi_unit/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('transaksi_unit'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" action="<?= site_url('transaksi_unit/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
            <tr>
                <th style="width: 10px;"><input type="checkbox" name="selectall" /></th>
                <th>No</th>
		<th>Trxu Id</th>
		<th>Trxu Nomor Bukti</th>
		<th>Trxu Mak</th>
		<th>Trxu Uraian</th>
		<th>Trxu Jml Kotor</th>
		<th>Trxu Ppn</th>
		<th>Trxu Pph 21</th>
		<th>Trxu Pph 22</th>
		<th>Trxu Pph 23</th>
		<th>Trxu Pph 4 2</th>
		<th>Trxu Jml Bersih</th>
		<th>Trxu Tanggal</th>
		<th>Trxu Id Jenis Pembayaran</th>
		<th>Trxu Id Metode Pembayaran</th>
		<th>Trxu Id Unit</th>
		<th>Action</th>
            </tr><?php
            foreach ($transaksi_unit_data as $transaksi_unit)
            {
                ?>
                <tr>
                
		<td  style="width: 10px;padding-left: 8px;"><input type="checkbox" name="id" value="<?= $transaksi_unit->trxu_id;?>" />&nbsp;</td>
                
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $transaksi_unit->trxu_id ?></td>
			<td><?php echo $transaksi_unit->trxu_nomor_bukti ?></td>
			<td><?php echo $transaksi_unit->trxu_mak ?></td>
			<td><?php echo $transaksi_unit->trxu_uraian ?></td>
			<td><?php echo $transaksi_unit->trxu_jml_kotor ?></td>
			<td><?php echo $transaksi_unit->trxu_ppn ?></td>
			<td><?php echo $transaksi_unit->trxu_pph_21 ?></td>
			<td><?php echo $transaksi_unit->trxu_pph_22 ?></td>
			<td><?php echo $transaksi_unit->trxu_pph_23 ?></td>
			<td><?php echo $transaksi_unit->trxu_pph_4_2 ?></td>
			<td><?php echo $transaksi_unit->trxu_jml_bersih ?></td>
			<td><?php echo $transaksi_unit->trxu_tanggal ?></td>
			<td><?php echo $transaksi_unit->trxu_id_jenis_pembayaran ?></td>
			<td><?php echo $transaksi_unit->trxu_id_metode_pembayaran ?></td>
			<td><?php echo $transaksi_unit->trxu_id_unit ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('transaksi_unit/read/'.$transaksi_unit->trxu_id),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"'); 
				echo ' '; 
				echo anchor(site_url('transaksi_unit/update/'.$transaksi_unit->trxu_id),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
				echo ' '; 
				echo anchor(site_url('transaksi_unit/delete/'.$transaksi_unit->trxu_id),' <i class="fa fa-trash"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirmdelete(\'transaksi_unit/delete/'.$transaksi_unit->trxu_id.'\')"  data-toggle="tooltip" title="Delete" '); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
         <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button> <a href="#" class="btn bg-yellow">Total Record : <?php echo $total_rows ?></a>
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