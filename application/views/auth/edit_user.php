<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('edit_user_heading');?></h3>
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
            <p><?php echo lang('edit_user_subheading');?></p>
              <?php 
                if($message != ""){
              ?>
                <div id="infoMessage" class="callout callout-danger"><?php echo $message;?></div> <?php } ?>
                  <?php echo form_open(uri_string());?>

                    <div class="form-group">
                          <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
                          <?php echo form_input($first_name);?>
                    </div>

                    <div class="form-group">
                          <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
                          <?php echo form_input($last_name);?>
                    </div>

                    <div class="form-group">
                          <?php echo lang('edit_user_company_label', 'company');?> <br />
                          <?php echo form_input($company);?>
                    </div>

                    <div class="form-group">
                          <?php echo lang('edit_user_phone_label', 'phone');?> <br />
                          <?php echo form_input($phone);?>
                    </div>

                    <div class="form-group">
                          <?php echo lang('edit_user_password_label', 'password');?> <br />
                          <?php echo form_input($password);?>
                    </div>

                    <div class="form-group">
                          <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
                          <?php echo form_input($password_confirm);?>
                    </div>

                    <?php if ($this->ion_auth->is_admin()): ?>
                      <div class="form-group">
                        <h3><?php echo lang('edit_user_groups_heading');?></h3>
                        <?php foreach ($groups as $group):?>
                          <div class="checkbox">
                            <label class="col-md-3">
                            <?php
                                $gID=$group['id'];
                                $checked = null;
                                $item = null;
                                foreach($currentGroups as $grp) {
                                    if ($gID == $grp->id) {
                                        $checked= ' checked="checked"';
                                    break;
                                    }
                                }
                            ?>
                            <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                            <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                            </label>
                            </div>
                        <?php endforeach?>
                        </div>
                    <?php endif ?>

                    <?php echo form_hidden('id', $user->id);?>
                    <?php echo form_hidden($csrf); ?>
                    <div class="row">
                      <div class="col-md-12" style="margin-top:10px;">
                      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn bg-purple clearfix" style="clear:both"');?></p>
                      </div>
                    </div>
                <?php echo form_close();?>

            </div>
        </div>
    </div>
</div>
