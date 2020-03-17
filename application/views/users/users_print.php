<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Users</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Ip Address</th>
		<th>Username</th>
		<th>Password</th>
		<th>Salt</th>
		<th>Email</th>
		<th>Activation Code</th>
		<th>Forgotten Password Code</th>
		<th>Forgotten Password Time</th>
		<th>Remember Code</th>
		<th>Created On</th>
		<th>Last Login</th>
		<th>Active</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Company</th>
		<th>Phone</th>
		
            </tr><?php
            foreach ($users_data as $users)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $users->ip_address ?></td>
		      <td><?php echo $users->username ?></td>
		      <td><?php echo $users->password ?></td>
		      <td><?php echo $users->salt ?></td>
		      <td><?php echo $users->email ?></td>
		      <td><?php echo $users->activation_code ?></td>
		      <td><?php echo $users->forgotten_password_code ?></td>
		      <td><?php echo $users->forgotten_password_time ?></td>
		      <td><?php echo $users->remember_code ?></td>
		      <td><?php echo $users->created_on ?></td>
		      <td><?php echo $users->last_login ?></td>
		      <td><?php echo $users->active ?></td>
		      <td><?php echo $users->first_name ?></td>
		      <td><?php echo $users->last_name ?></td>
		      <td><?php echo $users->company ?></td>
		      <td><?php echo $users->phone ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>