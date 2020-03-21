<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Setting laporan</h3>
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
                <!-- <?php echo anchor(site_url('setting_laporan/create'),'<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?> -->
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right"><form action="<?php echo site_url('setting_laporan/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('setting_laporan'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" action="<?= site_url('setting_laporan/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
            <tr>
                <th>No</th>
		<th>Setting</th>
		<th>Data</th>
		<th>Aksi</th>
            </tr><?php
            foreach ($setting_laporan_data as $setting_laporan)
            {
                ?>
                <tr>
                
                
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $setting_laporan->sl_setting ?></td>
			<td><?php echo $setting_laporan->sl_data ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('setting_laporan/update/'.$setting_laporan->sl_id),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
         <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
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