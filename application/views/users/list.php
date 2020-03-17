<style type="text/css">
	.table>thead>tr>td, .table>tbody>tr>td{
		padding-left: 8px;
	}
</style>
<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List Users</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
              <i class="fa fa-refresh"></i></button>
          </div>
      </div>

      <div class="box-body">
     
        <form id="myform" method="post" onsubmit="return false">

           <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-12 col-md-4">
            	<p><?php echo anchor('auth/create_user', '<i class="fa fa-plus"></i> '.lang('index_create_user_link'), 'class="btn bg-purple"')?> </p>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
            	
            </div>
        </div>
        <div class="table-responsive">
	        <table cellpadding="0" cellspacing="10" id="mytable" class="table table-striped">
				<thead>
					<tr>
					<th><?php echo lang('index_fname_th');?></th>
					<th><?php echo lang('index_lname_th');?></th>
					<th><?php echo lang('index_email_th');?></th>
					<th nowrap="nowrap"><?php echo lang('index_groups_th');?></th>
					<th><?php echo lang('index_status_th');?></th>
					<th><?php echo lang('index_action_th');?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($users as $user):?>
					<tr>
			            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
						<td nowrap="nowrap">
							<?php $myArray = array();?>
							<?php foreach ($user->groups as $group):?>
								<?php $myArray[] = anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?>
			                <?php endforeach?>
								<?= implode( ', ', $myArray );?>

						</td>
						<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link'), 'class="btn btn-success btn-xs"') : anchor("auth/activate/". $user->id, lang('index_inactive_link'), 'class="btn btn-danger  btn-xs"');?></td>
						<td><?php echo anchor("auth/edit_user/".$user->id, '<i class="fa fa-user-edit"></i>', 'class="btn btn-warning btn-xs" data-toogle="tooltip" title="Edit User"') ;
						echo " ";
						 echo anchor('users/delete/'.$user->id, '<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'users/delete/'.$user->id.'\')" data-toggle="tooltip" title="Delete"');?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
         </div>
        </form>

      </div>
    </div>
  </div>
</div>
     
