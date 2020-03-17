<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Menu Detail</h3>
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
	    <tr><td>Sort</td><td><?php echo $sort; ?></td></tr>
	    <tr><td>Level</td><td><?php echo $level; ?></td></tr>
	    <tr><td>Parent Id</td><td><?php echo $parent_id; ?></td></tr>
	    <tr><td>Icon</td><td><?php echo $icon; ?></td></tr>
	    <tr><td>Label</td><td><?php echo $label; ?></td></tr>
	    <tr><td>Link</td><td><?php echo $link; ?></td></tr>
	    <tr><td>Id</td><td><?php echo $id; ?></td></tr>
	    <tr><td>Id Menu Type</td><td><?php echo $id_menu_type; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('menu') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>