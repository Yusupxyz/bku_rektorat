<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users Detail</h3>
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
	    <tr><td>Ip Address</td><td><?php echo $ip_address; ?></td></tr>
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>Password</td><td><?php echo $password; ?></td></tr>
	    <tr><td>Salt</td><td><?php echo $salt; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Activation Code</td><td><?php echo $activation_code; ?></td></tr>
	    <tr><td>Forgotten Password Code</td><td><?php echo $forgotten_password_code; ?></td></tr>
	    <tr><td>Forgotten Password Time</td><td><?php echo $forgotten_password_time; ?></td></tr>
	    <tr><td>Remember Code</td><td><?php echo $remember_code; ?></td></tr>
	    <tr><td>Created On</td><td><?php echo $created_on; ?></td></tr>
	    <tr><td>Last Login</td><td><?php echo $last_login; ?></td></tr>
	    <tr><td>Active</td><td><?php echo $active; ?></td></tr>
	    <tr><td>First Name</td><td><?php echo $first_name; ?></td></tr>
	    <tr><td>Last Name</td><td><?php echo $last_name; ?></td></tr>
	    <tr><td>Company</td><td><?php echo $company; ?></td></tr>
	    <tr><td>Phone</td><td><?php echo $phone; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('users') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>