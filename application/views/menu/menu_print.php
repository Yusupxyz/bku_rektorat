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
    <h3 align="center">DATA Menu</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Sort</th>
		<th>Level</th>
		<th>Parent Id</th>
		<th>Icon</th>
		<th>Label</th>
		<th>Link</th>
		<th>Id</th>
		<th>Id Menu Type</th>
		
            </tr><?php
            foreach ($menu_data as $menu)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $menu->sort ?></td>
		      <td><?php echo $menu->level ?></td>
		      <td><?php echo $menu->parent_id ?></td>
		      <td><?php echo $menu->icon ?></td>
		      <td><?php echo $menu->label ?></td>
		      <td><?php echo $menu->link ?></td>
		      <td><?php echo $menu->id ?></td>
		      <td><?php echo $menu->id_menu_type ?></td>	
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