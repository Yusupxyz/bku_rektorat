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
    <h3 align="center">DATA Kegiatan Sub</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Kegiatan 1</th>
		<th>Id Kegiatan</th>
		<th>Kode Kegiatan</th>
		<th>Nama Kegiatan</th>
		<th>Volume</th>
		<th>Satuan</th>
		<th>Jumlah</th>
		
            </tr><?php
            foreach ($kegiatan_sub_data as $kegiatan_sub)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kegiatan_sub->id_kegiatan_1 ?></td>
		      <td><?php echo $kegiatan_sub->id_kegiatan ?></td>
		      <td><?php echo $kegiatan_sub->kode_kegiatan ?></td>
		      <td><?php echo $kegiatan_sub->nama_kegiatan ?></td>
		      <td><?php echo $kegiatan_sub->volume ?></td>
		      <td><?php echo $kegiatan_sub->satuan ?></td>
		      <td><?php echo $kegiatan_sub->jumlah ?></td>	
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