
<link rel="stylesheet" href="<?= base_url();?>assets/plugins/iconpicker/css/bootstrap-iconpicker.css"/>
<style type="text/css">
.input-group-addon{
    padding:0px;
}
</style>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Menu</h3>
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
        <form action="<?php echo $action; ?>" method="post">
	   
        <div class="form-group">
            <!-- <label for="int">Sort <?php echo form_error('sort') ?></label> -->
            <?php 
                if($sort == ""){
                    $sort = "1";
                }
                if($level == ""){
                    $level = "2";
                }
            ?>

            <input type="hidden" class="form-control" name="sort" id="sort" placeholder="Sort" value="<?php echo $sort; ?>" />
        </div>
	    <div class="form-group">
            <!-- <label for="int">Level <?php echo form_error('level') ?></label> -->
            <input type="hidden" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" />
        </div>
	    
          <div class="form-group">
                <label>Parent</label>
                <select class="selectpicker form-control" name="parent_id" id="parent_id" data-placeholder="Select a Parent" data-live-search="true" style="width: 100%;">
                   <option value="0">-- Pilih Parent -- </option>
                  <?php 
                    foreach ($parent as $key => $value) {
                       echo "<option value=\"$value->id_menu\"".(($value->id_menu==$parent_id)?'selected="selected"':"")." >$value->label</option>";
                    }
                  ?>
                 
                </select>
          </div>

	    <div class="form-group input-group">
            <label for="varchar">Icon <?php echo form_error('icon') ?></label>
            <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
             <span class="input-group-addon" style="padding:0px;border:none">
                <button class="btn bg-purple btn-flat" data-icon="<?php echo $icon; ?>" role="iconpicker" data-rows="10" data-cols="10" id="target" style="margin-top:25px;padding: 7px"></button>
            </span>
        </div>
        
	    <div class="form-group">
            <label for="varchar">Label <?php echo form_error('label') ?></label>
            <input type="text" class="form-control" name="label" id="label" placeholder="Label" value="<?php echo $label; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Link <?php echo form_error('link') ?></label>
            <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="<?php echo $link; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Id <?php echo form_error('id') ?></label>
            <input type="text" class="form-control" name="id" id="id" placeholder="Id" value="<?php echo $id; ?>" />
        </div>
	    <!-- <div class="form-group">
            <label for="int">Menu Type <?php echo form_error('id_menu_type') ?></label>
            <input type="text" class="form-control" name="id_menu_type" id="id_menu_type" placeholder="Id Menu Type" value="<?php echo $id_menu_type; ?>" />
        </div> -->
        <div class="form-group">
                <label>Menu Type</label>
                <select class="form-control" name="id_menu_type" id="id_menu_type" data-placeholder="Select a Menu Type" style="width: 100%;">
                  <?php 
                    foreach ($menu_type as $key => $value) {
                       echo "<option value=\"$value->id_menu_type\"".(($value->id_menu_type==$id_menu_type)?'selected="selected"':"")." >$value->type</option>";
                    }
                  ?>
                 
                </select>
              </div>
              <div class="form-group">
                <label>Groups / Role </label>
                <select class="form-control selectpicker" multiple="multiple" data-placeholder="Select a Groups" style="width: 100%;" name="id_groups" id="id_groups" data-live-search="true" data-selected="1,2" onchange="getval(this)">
                   <?php 
                    foreach ($groups as $key => $val) {
                       echo "<option value=\"$val->id\">$val->name</option>";
                    }
                  ?>
                </select>
              </div>
              <input type="hidden" id="id_groupss" name="id_groupss" class="form-control"></input>
        	    <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>" /> 
        	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        	    <a href="<?php echo site_url('cms/menu/side-menu') ?>" class="btn btn-default">Cancel</a>
        	</form>
         </div>
        </div>
    </div>
</div>
