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
    <h3 align="center">DATA Tbl Transaksi Unit</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Trxu Id</th>
		<th>Trxu Nomor Bukti</th>
		<th>Trxu Mak</th>
		<th>Trxu Uraian</th>
		<th>Trxu Jml Kotor</th>
		<th>Trxu Ppn</th>
		<th>Trxu Pph 21</th>
		<th>Trxu Pph 22</th>
		<th>Trxu Pph 23</th>
		<th>Trxu Pph 4 2</th>
		<th>Trxu Jml Bersih</th>
		<th>Trxu Tanggal</th>
		<th>Trxu Id Jenis Pembayaran</th>
		<th>Trxu Id Metode Pembayaran</th>
		<th>Trxu Id Unit</th>
		
            </tr><?php
            foreach ($transaksi_unit_data as $transaksi_unit)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $transaksi_unit->trxu_id ?></td>
		      <td><?php echo $transaksi_unit->trxu_nomor_bukti ?></td>
		      <td><?php echo $transaksi_unit->trxu_mak ?></td>
		      <td><?php echo $transaksi_unit->trxu_uraian ?></td>
		      <td><?php echo $transaksi_unit->trxu_jml_kotor ?></td>
		      <td><?php echo $transaksi_unit->trxu_ppn ?></td>
		      <td><?php echo $transaksi_unit->trxu_pph_21 ?></td>
		      <td><?php echo $transaksi_unit->trxu_pph_22 ?></td>
		      <td><?php echo $transaksi_unit->trxu_pph_23 ?></td>
		      <td><?php echo $transaksi_unit->trxu_pph_4_2 ?></td>
		      <td><?php echo $transaksi_unit->trxu_jml_bersih ?></td>
		      <td><?php echo $transaksi_unit->trxu_tanggal ?></td>
		      <td><?php echo $transaksi_unit->trxu_id_jenis_pembayaran ?></td>
		      <td><?php echo $transaksi_unit->trxu_id_metode_pembayaran ?></td>
		      <td><?php echo $transaksi_unit->trxu_id_unit ?></td>	
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