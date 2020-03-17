

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('deactivate_heading');?></h3>
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
            <p><?php echo lang('deactivate_subheading');?></p>
              
                <?php echo form_open("auth/deactivate/".$user->id);?>

					  <p>
					  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
					    <input type="radio" name="confirm" value="yes" checked="checked" />
					    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
					    <input type="radio" name="confirm" value="no" />
					  </p>

					  <?php echo form_hidden($csrf); ?>
					  <?php echo form_hidden(array('id'=>$user->id)); ?>

					  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'), 'class="btn bg-purple"');?></p>

					<?php echo form_close();?>

            </div>
        </div>
    </div>
</div>

