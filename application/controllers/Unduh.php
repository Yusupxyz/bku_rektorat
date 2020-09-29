<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Unduh extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Pejabat_model');
        $this->load->library('form_validation');
        $this->load->model('Bulan_model');
        $this->load->model('Tahun_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Pejabat_model');
    }

    public function index()
    {
        $data = array(
            'button' => 'Unduh',
            'action' => site_url('unduh/export'),
        );
        $data['bulan']=$this->Bulan_model->dd();
        $data['attribute'] = 'class="form-control" id="nb" required';
        if($this->input->get('bulan')){
            $data['trx_bulan'] = $this->input->get('bulan'); 
        }else{
            $data['trx_bulan'] = '';   
        }
        $data['title'] = 'Unduh';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'unduh/Unduh_form';
        $this->load->view('template/backend', $data);
    }

    
    // Export ke excel
    public function export()
    {
        $config['per_page'] = 10;
        $start = intval($this->input->get('start'));
        $q = urldecode($this->input->get('q', TRUE));

        $bulan = $this->Bulan_model->get_by_id($this->input->post('trx_bulan'))->bulan_nama; 
        $tahun=$this->Tahun_model->get_by_id($this->session->userdata('tahun_aktif'))->tahun_nama;
        $pejabat1=$this->Pejabat_model->get_by_id('1');
        $pejabat2=$this->Pejabat_model->get_by_id('2');

        if($this->input->get('bulan') && $this->session->userdata('tahun_aktif')){
            $saldo_awal = $this->Transaksi_model->get_saldo_awal($this->session->userdata('tahun_aktif'),$this->input->get('trx_bulan'))->saldo_awal;
        }else{
            $saldo_awal = '0';
        }
        $saldo_akhir = $this->Transaksi_model->get_saldo_akhir($this->session->userdata('tahun_aktif'),$this->input->get('trx_bulan'))->saldo_akhir;
        $sum_penerimaan = $this->Transaksi_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->get('bulan'))->penerimaan;
        $saldo_total=$saldo_awal+$sum_penerimaan;
        $bku_umum = $this->Transaksi_model->get_limit_data_bku($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'));
        $bku_tunai = $this->Transaksi_model->get_limit_data_bku_pembantu($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'),'2');
        $bku_bank = $this->Transaksi_model->get_limit_data_bku_pembantu($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'),'1');
        $bp_up = $this->Transaksi_model->get_limit_data_bku_pembantu2($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'),'1');
        $bp_lsb = $this->Transaksi_model->get_limit_data_bku_pembantu2($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'),'2');

        //----------------------------------------------------------------------------------------------------
        // BP KAS TUNAI
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle("BKU");;

        // Set document properties
        $spreadsheet->getProperties()->setCreator('Miteknologi Perkasa Abadi')
        ->setLastModifiedBy('Miteknologi Perkasa Abadi')
        ->setTitle('Laporan Excel Buku BKU')
        ->setSubject('Laporan Excel Buku BKU')
        ->setDescription('Hasil generate laporan buku aplikasi BKU.')
        ->setKeywords('buku bku')
        ->setCategory('laporan');

        $middle = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        );

        $bold = array(
            'font' => array(
                'bold' => true
            )
        );

        $underline = array(
            'font' => array(
                'underline' => true
            )
        );

        $border = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            )
        );

        $bcolor = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'd9e1f2')
            )
        );

        //JUDUL
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'PNBP NON-MODAL UNIVERITAS PALANGKA RAYA');
        $sheet->setCellValue('A2', 'BUKU KAS UMUM');
        $sheet->setCellValue('A3', 'BULAN '.strtoupper($bulan));
        $sheet->setCellValue('A5', 'KEMENTERIAN/LEMBAGA');
        $sheet->setCellValue('D5', ': KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN');
        $sheet->setCellValue('A6', 'UNIT ORGANISASI');
        $sheet->setCellValue('D6', ':  SEKRETARIAT JENDERAL');
        $sheet->setCellValue('A7', 'SATUAN KERJA');
        $sheet->setCellValue('D7', ': PNBP NON-MODAL UNIVERSITAS PALANGKA RAYA');
        $sheet->setCellValue('A8', 'TANGGAL DAN NOMOR DIPA');
        $sheet->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYAL');
        $sheet->setCellValue('A9', 'TAHUN ANGGARAN');
        $sheet->setCellValue('D9', ': '.$tahun);

        $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
        $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
        $spreadsheet->getActiveSheet()->mergeCells('A3:I3');
        $spreadsheet->getActiveSheet()->mergeCells('A5:C5');
        $spreadsheet->getActiveSheet()->mergeCells('A6:C6');
        $spreadsheet->getActiveSheet()->mergeCells('A7:C7');
        $spreadsheet->getActiveSheet()->mergeCells('A8:C8');
        $spreadsheet->getActiveSheet()->mergeCells('A9:C9');

        $sheet->getStyle("A1:I3")->applyFromArray($middle);
        $sheet->getStyle("A2:I2")->applyFromArray($bold);
        $sheet->getStyle("A3")->applyFromArray($underline);

        //ISI
        $sheet->setCellValue('H11', 'Saldo Awal');
        $sheet->setCellValue('I11', 'Rp '.number_format($saldo_awal));
        $sheet->setCellValue('H12', 'Saldo Akhir');
        $sheet->setCellValue('I12', 'Rp '.number_format($saldo_akhir));

        $sheet->getStyle("H11:I12")->applyFromArray($bold);
        $sheet->getStyle("H11:I12")->applyFromArray($border);

        //TABEL
        $sheet->setCellValue('B14', 'Tanggal');
        $sheet->setCellValue('C14', 'Nomor Bukti');
        $sheet->setCellValue('D14', 'MAK');
        $sheet->setCellValue('E14', 'Penerima');
        $sheet->setCellValue('F14', 'Uraian');
        $sheet->setCellValue('G14', 'Debet (Rp)');
        $sheet->setCellValue('H14', 'Kredit (Rp)');
        $sheet->setCellValue('I14', 'Saldo (Rp)');

        $sheet->getStyle("B14:I14")->applyFromArray($bold);
        $sheet->getStyle("B14:I14")->applyFromArray($bcolor);

        $i=15; 
        $saldo=$saldo_total;
        foreach ($bku_umum as $value)
        {
            $saldo=$saldo-$value->trx_jml_kotor;
            $sheet->setCellValue('B'.$i, $value->trx_tanggal);
            $sheet->setCellValue('C'.$i, $value->trx_nomor_bukti);
            $sheet->setCellValue('D'.$i, $value->trx_mak);
            $sheet->setCellValue('E'.$i, $value->trx_id_unit);
            $sheet->setCellValue('F'.$i, $value->trx_uraian);
            $sheet->setCellValue('G'.$i, '');
            $sheet->setCellValue('H'.$i, number_format($value->trx_jml_kotor));
            $sheet->setCellValue('I'.$i, number_format($saldo));
            
        }
        $sheet->getStyle("B15:I".$i++)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet->setCellValue('G'.$i, '');
        $sheet->setCellValue('H'.$i, '');
        $sheet->setCellValue('I'.$i++, '');

        $sheet->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet->setCellValue('G'.$i, '');
        $sheet->setCellValue('H'.$i, '');
        $sheet->setCellValue('I'.$i++, '');

        $sheet->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet->setCellValue('G'.$i, '');
        $sheet->setCellValue('H'.$i, '');
        $sheet->setCellValue('I'.$i, '');

        $sheet->getStyle("B".$temp.":I".$i)->applyFromArray($bold);
        $sheet->getStyle("B".$temp.":I".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
        //----------------------------------------------------------------------------------------------------
        
        //BP KAS TUNAI
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'BP KAS (TUNAI)');
        $spreadsheet->addSheet($myWorkSheet);
        $sheet2 = $spreadsheet->getSheetByName('BP KAS (TUNAI)');        ;
        $sheet2->setCellValue('A1', 'PNBP NON-MODAL UNIVERITAS PALANGKA RAYA');
        $sheet2->setCellValue('A2', 'BUKU PEMBANTU KAS (TUNAI)');
        $sheet2->setCellValue('A3', 'BULAN '.strtoupper($bulan));
        $sheet2->setCellValue('A5', 'KEMENTERIAN/LEMBAGA');
        $sheet2->setCellValue('D5', ': KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN');
        $sheet2->setCellValue('A6', 'UNIT ORGANISASI');
        $sheet2->setCellValue('D6', ':  SEKRETARIAT JENDERAL');
        $sheet2->setCellValue('A7', 'SATUAN KERJA');
        $sheet2->setCellValue('D7', ': PNBP NON-MODAL UNIVERSITAS PALANGKA RAYA');
        $sheet2->setCellValue('A8', 'TANGGAL DAN NOMOR DIPA');
        $sheet2->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYAL');
        $sheet2->setCellValue('A9', 'TAHUN ANGGARAN');
        $sheet2->setCellValue('D9', ': '.$tahun);

        $sheet2->mergeCells('A1:I1');
        $sheet2->mergeCells('A2:I2');
        $sheet2->mergeCells('A3:I3');
        $sheet2->mergeCells('A5:C5');
        $sheet2->mergeCells('A6:C6');
        $sheet2->mergeCells('A7:C7');
        $sheet2->mergeCells('A8:C8');
        $sheet2->mergeCells('A9:C9');

        $sheet2->getStyle("A1:I3")->applyFromArray($middle);
        $sheet2->getStyle("A2:I2")->applyFromArray($bold);
        $sheet2->getStyle("A3")->applyFromArray($underline);

        //ISI
        $sheet2->setCellValue('H11', 'Saldo Awal');
        $sheet2->setCellValue('I11', 'Rp '.number_format($saldo_awal));
        $sheet2->setCellValue('H12', 'Saldo Akhir');
        $sheet2->setCellValue('I12', 'Rp '.number_format($saldo_akhir));

        $sheet2->getStyle("H11:I12")->applyFromArray($bold);
        $sheet2->getStyle("H11:I12")->applyFromArray($border);

        //TABEL
        $sheet2->setCellValue('B14', 'Tanggal');
        $sheet2->setCellValue('C14', 'Nomor Bukti');
        $sheet2->setCellValue('D14', 'MAK');
        $sheet2->setCellValue('E14', 'Penerima');
        $sheet2->setCellValue('F14', 'Uraian');
        $sheet2->setCellValue('G14', 'Debet (Rp)');
        $sheet2->setCellValue('H14', 'Kredit (Rp)');
        $sheet2->setCellValue('I14', 'Saldo (Rp)');

        $sheet2->getStyle("B14:I14")->applyFromArray($bold);
        $sheet2->getStyle("B14:I14")->applyFromArray($bcolor);

        $i=15; 
        $saldo=$saldo_total;
        foreach ($bku_tunai as $transaksi2)
        {
            $saldo=$saldo-$transaksi2->trx_jml_kotor;
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('D'.$i, $transaksi2->trx_mak);
            $sheet2->setCellValue('E'.$i, $transaksi2->trx_id_unit);
            $sheet2->setCellValue('F'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('G'.$i, '');
            $sheet2->setCellValue('H'.$i, number_format($transaksi2->trx_jml_kotor));
            $sheet2->setCellValue('I'.$i, number_format($saldo));
            
        }
        $sheet2->getStyle("B15:I".$i++)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i++, '');

        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i++, '');

        $sheet2->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i, '');

        $sheet2->getStyle("B".$temp.":I".$i)->applyFromArray($bold);
        $sheet2->getStyle("B".$temp.":I".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet2->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
        //----------------------------------------------------------------------------------------------------

        //BP KAS BANK
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'BP KAS (BANK)');
        $spreadsheet->addSheet($myWorkSheet);
        $sheet2 = $spreadsheet->getSheetByName('BP KAS (BANK)');        ;
        $sheet2->setCellValue('A1', 'PNBP NON-MODAL UNIVERITAS PALANGKA RAYA');
        $sheet2->setCellValue('A2', 'BUKU PEMBANTU KAS (BANK)');
        $sheet2->setCellValue('A3', 'BULAN '.strtoupper($bulan));
        $sheet2->setCellValue('A5', 'KEMENTERIAN/LEMBAGA');
        $sheet2->setCellValue('D5', ': KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN');
        $sheet2->setCellValue('A6', 'UNIT ORGANISASI');
        $sheet2->setCellValue('D6', ':  SEKRETARIAT JENDERAL');
        $sheet2->setCellValue('A7', 'SATUAN KERJA');
        $sheet2->setCellValue('D7', ': PNBP NON-MODAL UNIVERSITAS PALANGKA RAYA');
        $sheet2->setCellValue('A8', 'TANGGAL DAN NOMOR DIPA');
        $sheet2->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYAL');
        $sheet2->setCellValue('A9', 'TAHUN ANGGARAN');
        $sheet2->setCellValue('D9', ': '.$tahun);

        $sheet2->mergeCells('A1:I1');
        $sheet2->mergeCells('A2:I2');
        $sheet2->mergeCells('A3:I3');
        $sheet2->mergeCells('A5:C5');
        $sheet2->mergeCells('A6:C6');
        $sheet2->mergeCells('A7:C7');
        $sheet2->mergeCells('A8:C8');
        $sheet2->mergeCells('A9:C9');

        $sheet2->getStyle("A1:I3")->applyFromArray($middle);
        $sheet2->getStyle("A2:I2")->applyFromArray($bold);
        $sheet2->getStyle("A3")->applyFromArray($underline);

        //ISI
        $sheet2->setCellValue('H11', 'Saldo Awal');
        $sheet2->setCellValue('I11', 'Rp '.number_format($saldo_awal));
        $sheet2->setCellValue('H12', 'Saldo Akhir');
        $sheet2->setCellValue('I12', 'Rp '.number_format($saldo_akhir));

        $sheet2->getStyle("H11:I12")->applyFromArray($bold);
        $sheet2->getStyle("H11:I12")->applyFromArray($border);

        //TABEL
        $sheet2->setCellValue('B14', 'Tanggal');
        $sheet2->setCellValue('C14', 'Nomor Bukti');
        $sheet2->setCellValue('D14', 'MAK');
        $sheet2->setCellValue('E14', 'Penerima');
        $sheet2->setCellValue('F14', 'Uraian');
        $sheet2->setCellValue('G14', 'Debet (Rp)');
        $sheet2->setCellValue('H14', 'Kredit (Rp)');
        $sheet2->setCellValue('I14', 'Saldo (Rp)');

        $sheet2->getStyle("B14:I14")->applyFromArray($bold);
        $sheet2->getStyle("B14:I14")->applyFromArray($bcolor);

        $i=15; 
        $saldo=$saldo_total;
        foreach ($bku_bank as $transaksi2)
        {
            $saldo=$saldo-$transaksi2->trx_jml_kotor;
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('D'.$i, $transaksi2->trx_mak);
            $sheet2->setCellValue('E'.$i, $transaksi2->trx_id_unit);
            $sheet2->setCellValue('F'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('G'.$i, '');
            $sheet2->setCellValue('H'.$i, number_format($transaksi2->trx_jml_kotor));
            $sheet2->setCellValue('I'.$i, number_format($saldo));
            
        }
        $sheet2->getStyle("B15:I".$i++)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i++, '');

        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i++, '');

        $sheet2->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i, '');

        $sheet2->getStyle("B".$temp.":I".$i)->applyFromArray($bold);
        $sheet2->getStyle("B".$temp.":I".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet2->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
        //----------------------------------------------------------------------------------------------------

        //BP UP
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'BP UP');
        $spreadsheet->addSheet($myWorkSheet);
        $sheet2 = $spreadsheet->getSheetByName('BP UP');        ;
        $sheet2->setCellValue('A1', 'PNBP NON-MODAL UNIVERITAS PALANGKA RAYA');
        $sheet2->setCellValue('A2', 'BUKU PEMBANTU UANG PERSEDIAAN');
        $sheet2->setCellValue('A3', 'BULAN '.strtoupper($bulan));
        $sheet2->setCellValue('A5', 'KEMENTERIAN/LEMBAGA');
        $sheet2->setCellValue('D5', ': KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN');
        $sheet2->setCellValue('A6', 'UNIT ORGANISASI');
        $sheet2->setCellValue('D6', ':  SEKRETARIAT JENDERAL');
        $sheet2->setCellValue('A7', 'SATUAN KERJA');
        $sheet2->setCellValue('D7', ': PNBP NON-MODAL UNIVERSITAS PALANGKA RAYA');
        $sheet2->setCellValue('A8', 'TANGGAL DAN NOMOR DIPA');
        $sheet2->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYAL');
        $sheet2->setCellValue('A9', 'TAHUN ANGGARAN');
        $sheet2->setCellValue('D9', ': '.$tahun);

        $sheet2->mergeCells('A1:I1');
        $sheet2->mergeCells('A2:I2');
        $sheet2->mergeCells('A3:I3');
        $sheet2->mergeCells('A5:C5');
        $sheet2->mergeCells('A6:C6');
        $sheet2->mergeCells('A7:C7');
        $sheet2->mergeCells('A8:C8');
        $sheet2->mergeCells('A9:C9');

        $sheet2->getStyle("A1:I3")->applyFromArray($middle);
        $sheet2->getStyle("A2:I2")->applyFromArray($bold);
        $sheet2->getStyle("A3")->applyFromArray($underline);

        //ISI
        $sheet2->setCellValue('H11', 'Saldo Awal');
        $sheet2->setCellValue('I11', 'Rp '.number_format($saldo_awal));
        $sheet2->setCellValue('H12', 'Saldo Akhir');
        $sheet2->setCellValue('I12', 'Rp '.number_format($saldo_akhir));

        $sheet2->getStyle("H11:I12")->applyFromArray($bold);
        $sheet2->getStyle("H11:I12")->applyFromArray($border);

        //TABEL
        $sheet2->setCellValue('B14', 'Tanggal');
        $sheet2->setCellValue('C14', 'Nomor Bukti');
        $sheet2->setCellValue('D14', 'MAK');
        $sheet2->setCellValue('E14', 'Penerima');
        $sheet2->setCellValue('F14', 'Uraian');
        $sheet2->setCellValue('G14', 'Debet (Rp)');
        $sheet2->setCellValue('H14', 'Kredit (Rp)');
        $sheet2->setCellValue('I14', 'Saldo (Rp)');

        $sheet2->getStyle("B14:I14")->applyFromArray($bold);
        $sheet2->getStyle("B14:I14")->applyFromArray($bcolor);

        $i=15; 
        $saldo=$saldo_total;
        foreach ($bp_up as $transaksi2)
        {
            $saldo=$saldo-$transaksi2->trx_jml_kotor;
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('D'.$i, $transaksi2->trx_mak);
            $sheet2->setCellValue('E'.$i, $transaksi2->trx_id_unit);
            $sheet2->setCellValue('F'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('G'.$i, '');
            $sheet2->setCellValue('H'.$i, number_format($transaksi2->trx_jml_kotor));
            $sheet2->setCellValue('I'.$i, number_format($saldo));
            
        }
        $sheet2->getStyle("B15:I".$i++)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i++, '');

        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i++, '');

        $sheet2->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i, '');

        $sheet2->getStyle("B".$temp.":I".$i)->applyFromArray($bold);
        $sheet2->getStyle("B".$temp.":I".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet2->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
        //----------------------------------------------------------------------------------------------------

        //BP LSB
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'BP LSB');
        $spreadsheet->addSheet($myWorkSheet);
        $sheet2 = $spreadsheet->getSheetByName('BP LSB');        ;
        $sheet2->setCellValue('A1', 'PNBP NON-MODAL UNIVERITAS PALANGKA RAYA');
        $sheet2->setCellValue('A2', 'BUKU PEMBANTU LS BENDAHARA');
        $sheet2->setCellValue('A3', 'BULAN '.strtoupper($bulan));
        $sheet2->setCellValue('A5', 'KEMENTERIAN/LEMBAGA');
        $sheet2->setCellValue('D5', ': KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN');
        $sheet2->setCellValue('A6', 'UNIT ORGANISASI');
        $sheet2->setCellValue('D6', ':  SEKRETARIAT JENDERAL');
        $sheet2->setCellValue('A7', 'SATUAN KERJA');
        $sheet2->setCellValue('D7', ': PNBP NON-MODAL UNIVERSITAS PALANGKA RAYA');
        $sheet2->setCellValue('A8', 'TANGGAL DAN NOMOR DIPA');
        $sheet2->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYAL');
        $sheet2->setCellValue('A9', 'TAHUN ANGGARAN');
        $sheet2->setCellValue('D9', ': '.$tahun);

        $sheet2->mergeCells('A1:I1');
        $sheet2->mergeCells('A2:I2');
        $sheet2->mergeCells('A3:I3');
        $sheet2->mergeCells('A5:C5');
        $sheet2->mergeCells('A6:C6');
        $sheet2->mergeCells('A7:C7');
        $sheet2->mergeCells('A8:C8');
        $sheet2->mergeCells('A9:C9');

        $sheet2->getStyle("A1:I3")->applyFromArray($middle);
        $sheet2->getStyle("A2:I2")->applyFromArray($bold);
        $sheet2->getStyle("A3")->applyFromArray($underline);

        //ISI
        $sheet2->setCellValue('H11', 'Saldo Awal');
        $sheet2->setCellValue('I11', 'Rp '.number_format($saldo_awal));
        $sheet2->setCellValue('H12', 'Saldo Akhir');
        $sheet2->setCellValue('I12', 'Rp '.number_format($saldo_akhir));

        $sheet2->getStyle("H11:I12")->applyFromArray($bold);
        $sheet2->getStyle("H11:I12")->applyFromArray($border);

        //TABEL
        $sheet2->setCellValue('B14', 'Tanggal');
        $sheet2->setCellValue('C14', 'Nomor Bukti');
        $sheet2->setCellValue('D14', 'MAK');
        $sheet2->setCellValue('E14', 'Penerima');
        $sheet2->setCellValue('F14', 'Uraian');
        $sheet2->setCellValue('G14', 'Debet (Rp)');
        $sheet2->setCellValue('H14', 'Kredit (Rp)');
        $sheet2->setCellValue('I14', 'Saldo (Rp)');

        $sheet2->getStyle("B14:I14")->applyFromArray($bold);
        $sheet2->getStyle("B14:I14")->applyFromArray($bcolor);

        $i=15; 
        $saldo=$saldo_total;
        foreach ($bp_lsb as $transaksi2)
        {
            $saldo=$saldo-$transaksi2->trx_jml_kotor;
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('D'.$i, $transaksi2->trx_mak);
            $sheet2->setCellValue('E'.$i, $transaksi2->trx_id_unit);
            $sheet2->setCellValue('F'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('G'.$i, '');
            $sheet2->setCellValue('H'.$i, number_format($transaksi2->trx_jml_kotor));
            $sheet2->setCellValue('I'.$i, number_format($saldo));
            
        }
        $sheet2->getStyle("B15:I".$i++)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i++, '');

        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i++, '');

        $sheet2->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet2->setCellValue('G'.$i, '');
        $sheet2->setCellValue('H'.$i, '');
        $sheet2->setCellValue('I'.$i, '');

        $sheet2->getStyle("B".$temp.":I".$i)->applyFromArray($bold);
        $sheet2->getStyle("B".$temp.":I".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet2->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
        //----------------------------------------------------------------------------------------------------

        $writer = new Xlsx($spreadsheet);
        $filename = 'BKU';
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

}

/* End of file Pejabat.php */
/* Location: ./application/controllers/Pejabat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-19 15:07:26 */
/* http://harviacode.com */