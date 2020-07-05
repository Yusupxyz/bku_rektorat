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
    <h3 align="center">DATA Tbl Transaksi</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Trx Id</th>
		<th>Trx Id Nomor Bukti</th>
		<th>Trx Mak</th>
		<th>Trx Penerima</th>
		<th>Trx Uraian</th>
		<th>Trx Jml Kotor</th>
		<th>Trx Ppn</th>
		<th>Trx Pph 21</th>
		<th>Trx Pph 22</th>
		<th>Trx Pph 23</th>
		<th>Trx Pph 4 2</th>
		<th>Trx Jml Bersih</th>
		<th>Trx Tanggal</th>
		<th>Trx Id Jenis Pembayaran</th>
		<th>Trx Id Metode Pembayaran</th>
		<th>Trx Id Unit</th>
		
            </tr><?php
            foreach ($transaksi_data as $transaksi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $transaksi->trx_id ?></td>
		      <td><?php echo $transaksi->trx_id_nomor_bukti ?></td>
		      <td><?php echo $transaksi->trx_mak ?></td>
		      <td><?php echo $transaksi->trx_penerima ?></td>
		      <td><?php echo $transaksi->trx_uraian ?></td>
		      <td><?php echo $transaksi->trx_jml_kotor ?></td>
		      <td><?php echo $transaksi->trx_ppn ?></td>
		      <td><?php echo $transaksi->trx_pph_21 ?></td>
		      <td><?php echo $transaksi->trx_pph_22 ?></td>
		      <td><?php echo $transaksi->trx_pph_23 ?></td>
		      <td><?php echo $transaksi->trx_pph_4_2 ?></td>
		      <td><?php echo $transaksi->trx_jml_bersih ?></td>
		      <td><?php echo $transaksi->trx_tanggal ?></td>
		      <td><?php echo $transaksi->trx_id_jenis_pembayaran ?></td>
		      <td><?php echo $transaksi->trx_id_metode_pembayaran ?></td>
		      <td><?php echo $transaksi->trx_id_unit ?></td>	
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