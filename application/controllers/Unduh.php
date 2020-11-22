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
        $this->load->model('Buku_pembantu_model');
        $this->load->model('Buku_pembantu2_model');
    }

    public function index()
    {
        $data = array(
            'button' => 'Unduh',
            'action' => site_url('unduh/export'),
        );
        $data['bulan']=$this->Bulan_model->dd();
        $data['attribute'] = 'class="form-control" id="nb" required';
        if($this->input->post('trx_bulan')){
            $data['trx_bulan'] = $this->input->post('trx_bulan'); 
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

        if($this->input->post('trx_bulan') && $this->session->userdata('tahun_aktif')){
            $saldo_awal = $this->Transaksi_model->get_saldo_awal($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->saldo_awal;
        }else{
            $saldo_awal = '0';
        }
        $saldo_akhir = $this->Transaksi_model->get_saldo_akhir($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->saldo_akhir;
        $sum_penerimaan = $this->Transaksi_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->penerimaan;
        $saldo_total=$saldo_awal+$sum_penerimaan;
        $bku_umum = $this->Transaksi_model->get_limit_data_bku($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'));
        $bku_tunai = $this->Transaksi_model->get_limit_data_bku_pembantu($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),'2');
        $bku_bank = $this->Transaksi_model->get_limit_data_bku_pembantu($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),'1');
        $bp_up = $this->Transaksi_model->get_limit_data_bku_pembantu2($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),'1');
        $bp_lsb = $this->Transaksi_model->get_limit_data_bku_pembantu2($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),'2');
        // echo $this->db->last_query();

        $bku_tbp = $this->Transaksi_model->get_limit_data_bku_pembantu($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),'3');
        $bp_pajak = $this->Transaksi_model->get_limit_data_bku_pajak_pungut($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'));
        $bp_pajak_setor = $this->Transaksi_model->get_limit_data_bku_pajak_setor($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'));
        $pajak_bulan_lalu = $this->Transaksi_model->get_limit_data_bku_pajak_lalu($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),(int)$this->input->post('trx_bulan'));
        $pajak_tahun_ini = $this->Transaksi_model->get_limit_data_bku_pajak_bulan($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'));
        $pajak_sd = $this->Transaksi_model->get_limit_data_bku_pajak_sd($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'));

        $saldo_awal = $this->Transaksi_model->get_saldo_awal($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->saldo_awal;
        $saldo_awal_lalu = $this->Transaksi_model->get_saldo_awal($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')-1)->saldo_awal;
        $saldo_awal_sd = $this->Transaksi_model->get_saldo_awal_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->saldo_awal;
        $saldo_akhir = $this->Transaksi_model->get_saldo_akhir($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->saldo_akhir;
        $sum_pengeluaran = $this->Transaksi_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->jmlh_kotor;
        $sum_pengeluaran_lalu = $this->Transaksi_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1)->jmlh_kotor;
        $sum_pengeluaran_sd = $this->Transaksi_model->get_jk_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->jmlh_kotor;
        $sum_penerimaan = $this->Transaksi_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->penerimaan;
        $sum_penerimaan_lalu = $this->Transaksi_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1)->penerimaan;
        $sum_penerimaan_sd = $this->Transaksi_model->get_penerimaan_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->penerimaan;
        $saldo_total=$sum_penerimaan;
        $saldo_total_lalu=$sum_penerimaan_lalu;
        $saldo_total_sd=$sum_penerimaan_sd;

        //tunai
        $sum_penerimaan_tunai = $this->Buku_pembantu_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),2)->penerimaan;
        $sum_penerimaan_lalu_tunai = $this->Buku_pembantu_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1,2)->penerimaan;
        $sum_penerimaan_sd_tunai = $this->Buku_pembantu_model->get_penerimaan_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),2)->penerimaan;
        $sum_pengeluaran_tunai = $this->Buku_pembantu_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),2)->jmlh_kotor;
        $sum_pengeluaran_lalu_tunai = $this->Buku_pembantu_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1,2)->jmlh_kotor;
        $sum_pengeluaran_sd_tunai = $this->Buku_pembantu_model->get_jk_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),2)->jmlh_kotor;

        //bank
        $sum_pengeluaran_bank = $this->Buku_pembantu_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),1)->jmlh_kotor;
        $sum_pengeluaran_lalu_bank = $this->Buku_pembantu_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1,1)->jmlh_kotor;
        $sum_pengeluaran_sd_bank = $this->Buku_pembantu_model->get_jk_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),1)->jmlh_kotor;
        $sum_penerimaan_bank = $this->Buku_pembantu_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),1)->penerimaan;
        $sum_penerimaan_lalu_bank = $this->Buku_pembantu_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1,1)->penerimaan;
        $sum_penerimaan_sd_bank = $this->Buku_pembantu_model->get_penerimaan_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),1)->penerimaan;
        
        //bptbp
        $sum_pengeluaran_bptbp = $this->Buku_pembantu_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),3)->jmlh_kotor;
        $sum_pengeluaran_lalu_bptbp = $this->Buku_pembantu_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1,3)->jmlh_kotor;
        $sum_pengeluaran_sd_bptbp = $this->Buku_pembantu_model->get_jk_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),3)->jmlh_kotor;
        $sum_penerimaan_bptbp = $this->Buku_pembantu_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),3)->penerimaan;
        $sum_penerimaan_lalu_bptbp = $this->Buku_pembantu_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1,3)->penerimaan;
        $sum_penerimaan_sd_bptbp = $this->Buku_pembantu_model->get_penerimaan_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),3)->penerimaan;

        //up
        $sum_pengeluaran_up = $this->Buku_pembantu2_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),1)->jmlh_kotor;
        $sum_pengeluaran_lalu_up = $this->Buku_pembantu2_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1,1)->jmlh_kotor;
        $sum_pengeluaran_sd_up = $this->Buku_pembantu2_model->get_jk_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),1)->jmlh_kotor;
        $sum_penerimaan_up = $this->Buku_pembantu2_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),1)->penerimaan;
        $sum_penerimaan_lalu_up = $this->Buku_pembantu2_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1,1)->penerimaan;
        $sum_penerimaan_sd_up = $this->Buku_pembantu2_model->get_penerimaan_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),1)->penerimaan;

        //lsb
        $sum_pengeluaran_lsb = $this->Buku_pembantu2_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),2)->jmlh_kotor;
        $sum_pengeluaran_lalu_lsb = $this->Buku_pembantu2_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1,2)->jmlh_kotor;
        $sum_pengeluaran_sd_lsb = $this->Buku_pembantu2_model->get_jk_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),2)->jmlh_kotor;
        $sum_penerimaan_lsb = $this->Buku_pembantu2_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),2)->penerimaan;
        $sum_penerimaan_lalu_lsb = $this->Buku_pembantu2_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan')==''?'':$this->input->post('trx_bulan')-1,2)->penerimaan;
        $sum_penerimaan_sd_lsb = $this->Buku_pembantu2_model->get_penerimaan_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'),2)->penerimaan;

        //pajak
        if ($this->Transaksi_model->get_saldo_awal_pajak($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))){
            $saldo_awal_pajak = $this->Transaksi_model->get_saldo_awal_pajak($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'))->saldo_awal;
        }else{
            $saldo_awal_pajak = 0;
        }        
        $saldo_pungut = $this->Transaksi_model->get_saldo_pungut($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'));
        $saldo_pungut_lalu = $this->Transaksi_model->get_saldo_pungut_lalu($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'));
        $saldo_pungut_sd = $this->Transaksi_model->get_saldo_pungut_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'));
        // echo $this->db->last_query();
        $saldo_setor = $this->Transaksi_model->get_saldo_setor($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'));
        $saldo_setor_bulan_lalu = $this->Transaksi_model->get_saldo_setor_lalu($this->session->userdata('tahun_aktif'),(int)$this->input->post('trx_bulan'));
        $saldo_setor_sd = $this->Transaksi_model->get_saldo_setor_sd($this->session->userdata('tahun_aktif'),$this->input->post('trx_bulan'));
        $saldo_akhir_pajak=$saldo_pungut-$saldo_setor;
        $saldo_akhir_lalu=$saldo_pungut_lalu-$saldo_setor_bulan_lalu;
        $saldo_akhir_sd=$saldo_pungut_sd-$saldo_setor_sd;
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

        $italic = array(
            'font' => array(
                'italic' => true
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

        $borderSamping = array(
            'borders' => array(
                'left' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
                'right' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            )
        );

        $borderBot = array(
            'borders' => array(
                'bottom' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                )
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
        $sheet->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYA');
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
        $saldo=0;
        
        foreach ($bku_umum as $value)
        {
            $saldo=$saldo+$value->trx_penerimaan-$value->trx_pengeluaran;
            $sheet->setCellValue('B'.$i, $value->trx_tanggal);
            $sheet->setCellValue('C'.$i, $value->trx_nomor_bukti);
            $sheet->setCellValue('D'.$i, $value->trx_mak);
            $sheet->setCellValue('E'.$i, $value->trx_id_unit);
            $sheet->setCellValue('F'.$i, $value->trx_uraian);
            $sheet->setCellValue('G'.$i, number_format($value->trx_penerimaan));
            $sheet->setCellValue('H'.$i, number_format($value->trx_pengeluaran));
            $sheet->setCellValue('I'.$i++, number_format($saldo));
        }
        if (count($bku_umum)<1) $i++;

        $sheet->getStyle("B15:I".$i)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet->setCellValue('G'.$i, number_format($saldo_total));
        $sheet->setCellValue('H'.$i, number_format($sum_pengeluaran));
        $sheet->setCellValue('I'.$i++, number_format($saldo_total-$sum_pengeluaran));

        $sheet->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet->setCellValue('G'.$i, number_format($saldo_total_lalu));
        $sheet->setCellValue('H'.$i, number_format($sum_pengeluaran_lalu));
        $sheet->setCellValue('I'.$i++, number_format($saldo_total_lalu-$sum_pengeluaran_lalu));

        $sheet->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet->setCellValue('G'.$i, number_format($saldo_total_sd));
        $sheet->setCellValue('H'.$i, number_format($sum_pengeluaran_sd));
        $sheet->setCellValue('I'.$i, number_format($saldo_total_sd-$sum_pengeluaran_sd));

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
        $sheet2->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYA');
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
        $saldo=0;
        foreach ($bku_tunai as $transaksi2)
        {
           $saldo=$saldo+$transaksi2->trx_penerimaan-$transaksi2->trx_pengeluaran;
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('D'.$i, $transaksi2->trx_mak);
            $sheet2->setCellValue('E'.$i, $transaksi2->trx_id_unit);
            $sheet2->setCellValue('F'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('G'.$i, number_format($transaksi2->trx_penerimaan));
            $sheet2->setCellValue('H'.$i, number_format($transaksi2->trx_pengeluaran));
            $sheet2->setCellValue('I'.$i++, number_format($saldo));
            
        }
        if (count($bku_tunai)<1) $i++;

        $sheet2->getStyle("B15:I".$i)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_tunai));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_tunai));
        $sheet2->setCellValue('I'.$i++, number_format($sum_penerimaan_tunai-$sum_pengeluaran_tunai));

        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_lalu_tunai));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_lalu_tunai));
        $sheet2->setCellValue('I'.$i++, number_format($sum_penerimaan_lalu_tunai-$sum_pengeluaran_lalu_tunai));

        $sheet2->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_sd_tunai));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_sd_tunai));
        $sheet2->setCellValue('I'.$i, number_format($sum_penerimaan_sd_tunai-$sum_pengeluaran_sd_tunai));


        $sheet2->getStyle("B".$temp.":I".$i)->applyFromArray($bold);
        $sheet2->getStyle("B".$temp.":I".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet2->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet2->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet2->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet2->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet2->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet2->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet2->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet2->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
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
        $sheet2->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYA');
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
        $saldo=0;
        foreach ($bku_bank as $transaksi2)
        {
           $saldo=$saldo+$transaksi2->trx_penerimaan-$transaksi2->trx_pengeluaran;
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('D'.$i, $transaksi2->trx_mak);
            $sheet2->setCellValue('E'.$i, $transaksi2->trx_id_unit);
            $sheet2->setCellValue('F'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('G'.$i, number_format($transaksi2->trx_penerimaan));
            $sheet2->setCellValue('H'.$i, number_format($transaksi2->trx_pengeluaran));
            $sheet2->setCellValue('I'.$i++, number_format($saldo));
            
        }
        if (count($bku_bank)<1) $i++;

        $sheet2->getStyle("B15:I".$i)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_bank));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_bank));
        $sheet2->setCellValue('I'.$i++, number_format($sum_penerimaan_bank-$sum_pengeluaran_bank));

        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_lalu_bank));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_lalu_bank));
        $sheet2->setCellValue('I'.$i++, number_format($sum_penerimaan_lalu_bank-$sum_pengeluaran_lalu_bank));

        $sheet2->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_sd_bank));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_sd_bank));
        $sheet2->setCellValue('I'.$i, number_format($sum_penerimaan_sd_bank-$sum_pengeluaran_sd_bank));

        $sheet2->getStyle("B".$temp.":I".$i)->applyFromArray($bold);
        $sheet2->getStyle("B".$temp.":I".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet2->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet2->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet2->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet2->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet2->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet2->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet2->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet2->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
        //----------------------------------------------------------------------------------------------------


        //BP TRANSFER BP
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'BP TRANSFER BP');
        $spreadsheet->addSheet($myWorkSheet);
        $sheet2 = $spreadsheet->getSheetByName('BP TRANSFER BP');        ;
        $sheet2->setCellValue('A1', 'PNBP NON-MODAL UNIVERITAS PALANGKA RAYA');
        $sheet2->setCellValue('A2', 'BUKU PEMBANTU TRANSFER BENDAHARA PENGELUARAN');
        $sheet2->setCellValue('A3', 'BULAN '.strtoupper($bulan));
        $sheet2->setCellValue('A5', 'KEMENTERIAN/LEMBAGA');
        $sheet2->setCellValue('D5', ': KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN');
        $sheet2->setCellValue('A6', 'UNIT ORGANISASI');
        $sheet2->setCellValue('D6', ':  SEKRETARIAT JENDERAL');
        $sheet2->setCellValue('A7', 'SATUAN KERJA');
        $sheet2->setCellValue('D7', ': PNBP NON-MODAL UNIVERSITAS PALANGKA RAYA');
        $sheet2->setCellValue('A8', 'TANGGAL DAN NOMOR DIPA');
        $sheet2->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYA');
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
        $saldo=0;
        foreach ($bku_tbp as $transaksi2)
        {
           $saldo=$saldo+$transaksi2->trx_penerimaan-$transaksi2->trx_pengeluaran;
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('D'.$i, $transaksi2->trx_mak);
            $sheet2->setCellValue('E'.$i, $transaksi2->trx_id_unit);
            $sheet2->setCellValue('F'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('G'.$i, number_format($transaksi2->trx_penerimaan));
            $sheet2->setCellValue('H'.$i, number_format($transaksi2->trx_pengeluaran));
            $sheet2->setCellValue('I'.$i++, number_format($saldo));
            
        }
        if (count($bku_tbp)<1) $i++;

        $sheet2->getStyle("B15:I".$i)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_bptbp));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_bptbp));
        $sheet2->setCellValue('I'.$i++, number_format($sum_penerimaan_bptbp-$sum_pengeluaran_bptbp));

        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_lalu_bptbp));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_lalu_bptbp));
        $sheet2->setCellValue('I'.$i++, number_format($sum_penerimaan_lalu_bptbp-$sum_pengeluaran_lalu_bptbp));

        $sheet2->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_sd_bptbp));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_sd_bptbp));
        $sheet2->setCellValue('I'.$i, number_format($sum_penerimaan_sd_bptbp-$sum_pengeluaran_sd_bptbp));

        $sheet2->getStyle("B".$temp.":I".$i)->applyFromArray($bold);
        $sheet2->getStyle("B".$temp.":I".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet2->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet2->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet2->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet2->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet2->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet2->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet2->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet2->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
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
        $sheet2->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYA');
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
        $saldo=0;
        foreach ($bp_up as $transaksi2)
        {
           $saldo=$saldo+$transaksi2->trx_penerimaan-$transaksi2->trx_pengeluaran;
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('D'.$i, $transaksi2->trx_mak);
            $sheet2->setCellValue('E'.$i, $transaksi2->trx_id_unit);
            $sheet2->setCellValue('F'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('G'.$i, number_format($transaksi2->trx_penerimaan));
            $sheet2->setCellValue('H'.$i, number_format($transaksi2->trx_pengeluaran));
            $sheet2->setCellValue('I'.$i++, number_format($saldo));
            
        }
        if (count($bp_up)<1) $i++;

        $sheet2->getStyle("B15:I".$i)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_up));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_up));
        $sheet2->setCellValue('I'.$i++, number_format($sum_penerimaan_up-$sum_pengeluaran_up));

        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_lalu_up));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_lalu_up));
        $sheet2->setCellValue('I'.$i++, number_format($sum_penerimaan_lalu_up-$sum_pengeluaran_lalu_up));

        $sheet2->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_sd_up));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_sd_up));
        $sheet2->setCellValue('I'.$i, number_format($sum_penerimaan_sd_up-$sum_pengeluaran_sd_up));

        $sheet2->getStyle("B".$temp.":I".$i)->applyFromArray($bold);
        $sheet2->getStyle("B".$temp.":I".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet2->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet2->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet2->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet2->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet2->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet2->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet2->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet2->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
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
        $sheet2->setCellValue('D8', ': JL. YOS SUDARSO PALANGKA RAYA');
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
        $saldo=0;
        foreach ($bp_lsb as $transaksi2)
        {
           $saldo=$saldo+$transaksi2->trx_penerimaan-$transaksi2->trx_pengeluaran;
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('D'.$i, $transaksi2->trx_mak);
            $sheet2->setCellValue('E'.$i, $transaksi2->trx_id_unit);
            $sheet2->setCellValue('F'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('G'.$i, number_format($transaksi2->trx_penerimaan));
            $sheet2->setCellValue('H'.$i, number_format($transaksi2->trx_pengeluaran));
            $sheet2->setCellValue('I'.$i++, number_format($saldo));
            
        }
        if (count($bp_lsb)<1) $i++;

        $sheet2->getStyle("B15:I".$i)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN INI');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_lsb));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_lsb));
        $sheet2->setCellValue('I'.$i++, number_format($sum_penerimaan_lsb-$sum_pengeluaran_lsb));

        $sheet2->setCellValue('F'.$i, 'JUMLAH BULAN LALU');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_lalu_lsb));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_lalu_lsb));
        $sheet2->setCellValue('I'.$i++, number_format($sum_penerimaan_lalu_lsb-$sum_pengeluaran_lalu_lsb));

        $sheet2->setCellValue('F'.$i, 'JUMLAH S.D BULAN INI');
        $sheet2->setCellValue('G'.$i, number_format($sum_penerimaan_sd_lsb));
        $sheet2->setCellValue('H'.$i, number_format($sum_pengeluaran_sd_lsb));
        $sheet2->setCellValue('I'.$i, number_format($sum_penerimaan_sd_lsb-$sum_pengeluaran_sd_lsb));

        $sheet2->getStyle("B".$temp.":I".$i)->applyFromArray($bold);
        $sheet2->getStyle("B".$temp.":I".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet2->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet2->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet2->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet2->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet2->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet2->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet2->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet2->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
        //----------------------------------------------------------------------------------------------------

        //BP PAJAK
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'BP PAJAK');
        $spreadsheet->addSheet($myWorkSheet);
        $sheet2 = $spreadsheet->getSheetByName('BP PAJAK');        ;
        $sheet2->setCellValue('A1', 'PNBP Belanja Modal Universitas Palangka Raya');
        $sheet2->setCellValue('A2', 'Buku Pembantu Pajak');
        $sheet2->setCellValue('A3', 'Bulan '.strtoupper($bulan).' '.$tahun);
        $sheet2->setCellValue('A5', 'KN/Lembaga');
        $sheet2->setCellValue('C5', ':  Kementerian Pendidikan dan Kebudayaan');
        $sheet2->setCellValue('A6', 'Unit Organisasi');
        $sheet2->setCellValue('C6', ':  Sekretariat Jenderal');
        $sheet2->setCellValue('A7', 'Satker/SKS');
        $sheet2->setCellValue('C7', ': PNBP Universitas Palangka Raya');
        $sheet2->setCellValue('A8', 'Lokasi');
        $sheet2->setCellValue('C8', ':  Kota Palangka Raya');
        $sheet2->setCellValue('A9', 'Tempat');
        $sheet2->setCellValue('C8', ':  Palangka Raya');
        $sheet2->setCellValue('A10', 'Tanggal & Nomor DIPA');
        $sheet2->setCellValue('C10', ':');
        $sheet2->setCellValue('A11', 'Tahun Anggaran');
        $sheet2->setCellValue('C11', ': '.$tahun);
        $sheet2->setCellValue('A12', 'KPPN Pembayar');
        $sheet2->setCellValue('C12', ':  KANWIL XVII Palangka Raya');

        $sheet2->mergeCells('A1:J1');
        $sheet2->mergeCells('A2:J2');
        $sheet2->mergeCells('A3:J3');
        $sheet2->mergeCells('A5:B5');
        $sheet2->mergeCells('A6:B6');
        $sheet2->mergeCells('A7:B7');
        $sheet2->mergeCells('A8:B8');
        $sheet2->mergeCells('A9:B9');
        $sheet2->mergeCells('A10:B10');
        $sheet2->mergeCells('A11:B11');
        $sheet2->mergeCells('A12:B12');

        $sheet2->getStyle("A1:J3")->applyFromArray($middle);
        $sheet2->getStyle("A1:J3")->applyFromArray($bold);

        //ISI
        $sheet2->setCellValue('H12', 'Saldo Awal');
        $sheet2->setCellValue('I12', 'Rp '.number_format($saldo_awal_pajak));
        $sheet2->setCellValue('H13', 'Saldo Akhir');
        $sheet2->setCellValue('I13', 'Rp '.number_format($saldo_akhir_pajak));

        //TABEL
        $sheet2->setCellValue('A15', 'Tanggal');
        $sheet2->setCellValue('B15', 'No Bukti');
        $sheet2->setCellValue('C15', 'Uraian');
        $sheet2->setCellValue('D15', 'Debit');
        $sheet2->setCellValue('I15', 'Kredit');
        $sheet2->setCellValue('J15', 'Saldo');

        $sheet2->setCellValue('D16', 'PPN');
        $sheet2->setCellValue('E16', 'PPh 21');
        $sheet2->setCellValue('F16', 'PPh 22');
        $sheet2->setCellValue('G16', 'PPh 23');
        $sheet2->setCellValue('H16', 'PPh 4(2)');

        $sheet2->mergeCells('D15:H15');
        $sheet2->getStyle("D15:H15")->applyFromArray($middle);
        $sheet2->getStyle("A15:J16")->applyFromArray($bold);
        $sheet2->getStyle("A15:J16")->applyFromArray($bcolor);

        $i=17; 
        $saldo=0;
        foreach ($bp_pajak as $transaksi2)
        {
            $pajak=$transaksi2->trx_ppn+$transaksi2->trx_pph_21+$transaksi2->trx_pph_22+$transaksi2->trx_pph_23+$transaksi2->trx_pph_4_2;
            $saldo=$saldo+$pajak;
           
            $sheet2->setCellValue('A'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('D'.$i, $transaksi2->trx_ppn);
            $sheet2->setCellValue('E'.$i, $transaksi2->trx_pph_21);
            $sheet2->setCellValue('F'.$i, $transaksi2->trx_pph_22);
            $sheet2->setCellValue('G'.$i, $transaksi2->trx_pph_23);
            $sheet2->setCellValue('H'.$i, $transaksi2->trx_pph_4_2);
            $sheet2->setCellValue('I'.$i, '');
            $sheet2->setCellValue('J'.$i++, number_format($pajak));
            
        }
        if (count($bp_pajak)<1) $i++;

        foreach ($bp_pajak_setor as $transaksi3)
        {
            $pajak=$transaksi3->trx_ppn+$transaksi3->trx_pph_21+$transaksi3->trx_pph_22+$transaksi3->trx_pph_23+$transaksi3->trx_pph_4_2;
            $saldo=$saldo-$pajak;
            
            $sheet2->setCellValue('A'.$i, $transaksi2->trx_tanggal);
            $sheet2->setCellValue('B'.$i, $transaksi2->trx_nomor_bukti);
            $sheet2->setCellValue('C'.$i, $transaksi2->trx_uraian);
            $sheet2->setCellValue('D'.$i, '');
            $sheet2->setCellValue('E'.$i, '');
            $sheet2->setCellValue('F'.$i, '');
            $sheet2->setCellValue('G'.$i, '');
            $sheet2->setCellValue('H'.$i, '');
            $sheet2->setCellValue('I'.$i, number_format($pajak));
            $sheet2->setCellValue('J'.$i++, number_format($saldo));
            
        }
        if (count($bp_pajak)<1) $i++;

        $sheet2->getStyle("A17:J".$i)->applyFromArray($border);
        $temp=$i;
        //FOOTER
        $sheet2->setCellValue('C'.$i, 'JUMLAH BULAN INI');
        $sheet2->setCellValue('D'.$i, number_format($pajak_tahun_ini->ppn));
        $sheet2->setCellValue('E'.$i, number_format($pajak_tahun_ini->pph21));
        $sheet2->setCellValue('F'.$i, number_format($pajak_tahun_ini->pph22));
        $sheet2->setCellValue('G'.$i, number_format($pajak_tahun_ini->pph23));
        $sheet2->setCellValue('H'.$i, number_format($pajak_tahun_ini->pph42));
        $sheet2->setCellValue('H'.$i, number_format($saldo_setor));
        $sheet2->setCellValue('J'.$i++, number_format($saldo_akhir_pajak));

        $sheet2->setCellValue('C'.$i, 'JUMLAH BULAN LALU');
        $sheet2->setCellValue('D'.$i, number_format($pajak_bulan_lalu->ppn));
        $sheet2->setCellValue('E'.$i, number_format($pajak_bulan_lalu->pph21));
        $sheet2->setCellValue('F'.$i, number_format($pajak_bulan_lalu->pph22));
        $sheet2->setCellValue('G'.$i, number_format($pajak_bulan_lalu->pph23));
        $sheet2->setCellValue('H'.$i, number_format($pajak_bulan_lalu->pph42));
        $sheet2->setCellValue('H'.$i, number_format($saldo_setor_bulan_lalu));
        $sheet2->setCellValue('J'.$i++, number_format($saldo_akhir_lalu));

        $sheet2->setCellValue('C'.$i, 'JUMLAH S.D BULAN INI');
        $sheet2->setCellValue('D'.$i, number_format($pajak_sd->ppn));
        $sheet2->setCellValue('E'.$i, number_format($pajak_sd->pph21));
        $sheet2->setCellValue('F'.$i, number_format($pajak_sd->pph22));
        $sheet2->setCellValue('G'.$i, number_format($pajak_sd->pph23));
        $sheet2->setCellValue('H'.$i, number_format($pajak_sd->pph42));
        $sheet2->setCellValue('H'.$i, number_format($saldo_setor_sd));
        $sheet2->setCellValue('J'.$i, number_format($saldo_akhir_sd));

        $sheet2->getStyle("A".$temp.":J".$i)->applyFromArray($bold);
        $sheet2->getStyle("A".$temp.":J".$i++)->applyFromArray($bcolor);
        $j=$i+2;
        //FOOTER
        $sheet2->setCellValue('C'.$j++, 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C'.$j++, 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C'.$j, 'PNBP Belanja Non Modal');
        $j=$j+4;
        $sheet2->setCellValue('C'.$j, $pejabat1->pejabat_nama);
        $namaj=$j++;
        $sheet2->setCellValue('C'.$j, 'NIP. '.$pejabat1->pejabat_nip);

        $k=$i+1;
        $sheet2->setCellValue('F'.$k, 'Palangka Raya, ');
        $k=$k+2;
        $sheet2->setCellValue('F'.$k, 'BPP PNBP');
        $k=$k+5;
        $sheet2->setCellValue('F'.$k, $pejabat2->pejabat_nama);
        $namak=$k++;
        $sheet2->setCellValue('F'.$k, 'NIP. '.$pejabat2->pejabat_nip);

        $sheet2->getStyle("C".$namaj.":F".$namak)->applyFromArray($bold);
        //----------------------------------------------------------------------------------------------------

        //LPJ
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'LPJ');
        $spreadsheet->addSheet($myWorkSheet);
        $sheet2 = $spreadsheet->getSheetByName('LPJ');        ;
        $sheet2->setCellValue('A1', 'LAPORAN PERTANGGUNGJAWABAN BENDAHARA PENGELUARAN PEMBANTU');
        $sheet2->setCellValue('A2', 'Bulan '.strtoupper($bulan).' '.$tahun);
        $sheet2->setCellValue('A4', 'KN/Lembaga');
        $sheet2->setCellValue('D4', ':  Kementerian Pendidikan dan Kebudayaan');
        $sheet2->setCellValue('H4', 'Tgl. No. SP DIPA');
        $sheet2->setCellValue('J4', ':');
        $sheet2->setCellValue('A5', 'Unit Organisasi');
        $sheet2->setCellValue('D5', ':  Sekretariat Jenderal');
        $sheet2->setCellValue('A6', 'Satker/SKS');
        $sheet2->setCellValue('D6', ': PNBP Universitas Palangka Raya');
        $sheet2->setCellValue('H6', 'Tahun Anggaran');
        $sheet2->setCellValue('J6', ': '.$tahun);
        $sheet2->setCellValue('A7', 'Lokasi');
        $sheet2->setCellValue('D7', ':  Kota Palangka Raya');
        $sheet2->setCellValue('A8', 'Tempat');
        $sheet2->setCellValue('D8', ':  Palangka Raya');
        $sheet2->setCellValue('A9', 'Alamat');
        $sheet2->setCellValue('D9', ': Kampus UPR Tunjung Nyaho, Jl. Yos Sudarso Palangka Raya');

        $sheet2->mergeCells('A1:M1');
        $sheet2->mergeCells('A2:M2');

        $sheet2->getStyle("A1:M2")->applyFromArray($middle);
        $sheet2->getStyle("A1:M2")->applyFromArray($bold);

        //ISI
        $sheet2->setCellValue('A11', 'I.');
        $sheet2->setCellValue('B11', 'Keadaan pembukuan Bulan Pelaporan dengan saldo akhir pada Buku Kas Umum sebesar ');
        $sheet2->setCellValue('B12', 'dan Nomor Bukti terakhir Nomor:');

        //TABEL
        $sheet2->setCellValue('B13', 'No');
        $sheet2->setCellValue('C13', 'Jenis Buku Pembantu');
        $sheet2->setCellValue('F13', 'Saldo Awal');
        $sheet2->setCellValue('H13', 'Penambahan');
        $sheet2->setCellValue('J13', 'Pengurangan');
        $sheet2->setCellValue('L13', 'Saldo Akhir');

        $sheet2->setCellValue('B14', '1');
        $sheet2->setCellValue('C14', '2');
        $sheet2->setCellValue('F14', '3');
        $sheet2->setCellValue('H14', '4');
        $sheet2->setCellValue('J14', '5');
        $sheet2->setCellValue('L14', '6');

        $sheet2->mergeCells('C13:E13');
        $sheet2->mergeCells('F13:G13');
        $sheet2->mergeCells('H13:I13');
        $sheet2->mergeCells('J13:K13');
        $sheet2->mergeCells('L13:M13');
        $sheet2->mergeCells('C14:E14');
        $sheet2->mergeCells('F14:G14');
        $sheet2->mergeCells('H14:I14');
        $sheet2->mergeCells('J14:K14');
        $sheet2->mergeCells('L14:M14');
        $sheet2->getStyle("B13:M14")->applyFromArray($middle);
        $sheet2->getStyle("B13:M14")->applyFromArray($bold);
        $sheet2->getStyle("B14:M14")->applyFromArray($italic);
        $sheet2->getStyle("B14:M14")->applyFromArray($bcolor);
        $sheet2->getStyle("B13:M15")->applyFromArray($border);

        $sheet2->setCellValue('B15', 'A.');
        $sheet2->setCellValue('C15', 'BP Kas');
        $sheet2->setCellValue('F15', 'Rp');
        $sheet2->setCellValue('G15', '');
        $sheet2->setCellValue('H15', 'Rp');
        $sheet2->setCellValue('I15', '');
        $sheet2->setCellValue('J15', 'Rp');
        $sheet2->setCellValue('K15', '');
        $sheet2->setCellValue('L15', 'Rp');
        $sheet2->setCellValue('M15', '');

        $sheet2->setCellValue('C16', '1. BP Kas Tunai');
        $sheet2->setCellValue('F16', 'Rp');
        $sheet2->setCellValue('G16', '');
        $sheet2->setCellValue('H16', 'Rp');
        $sheet2->setCellValue('I16', '');
        $sheet2->setCellValue('J16', 'Rp');
        $sheet2->setCellValue('K16', '');
        $sheet2->setCellValue('L16', 'Rp');
        $sheet2->setCellValue('M16', '');

        $sheet2->setCellValue('C17', '2. BP Kas Bank');
        $sheet2->setCellValue('F17', 'Rp');
        $sheet2->setCellValue('G17', '');
        $sheet2->setCellValue('H17', 'Rp');
        $sheet2->setCellValue('I17', '');
        $sheet2->setCellValue('J17', 'Rp');
        $sheet2->setCellValue('K17', '');
        $sheet2->setCellValue('L17', 'Rp');
        $sheet2->setCellValue('M17', '');

        $sheet2->getStyle("B16:B17")->applyFromArray($borderSamping);
        $sheet2->getStyle("C16:E17")->applyFromArray($borderSamping);
        $sheet2->getStyle("F16:G17")->applyFromArray($borderSamping);
        $sheet2->getStyle("H16:I17")->applyFromArray($borderSamping);
        $sheet2->getStyle("J16:K17")->applyFromArray($borderSamping);
        $sheet2->getStyle("L16:M17")->applyFromArray($borderSamping);

        $sheet2->setCellValue('B18', 'B.');
        $sheet2->setCellValue('C18', 'BP Selain Kas');
        $sheet2->setCellValue('F18', 'Rp');
        $sheet2->setCellValue('G18', '');
        $sheet2->setCellValue('H18', 'Rp');
        $sheet2->setCellValue('I18', '');
        $sheet2->setCellValue('J18', 'Rp');
        $sheet2->setCellValue('K18', '');
        $sheet2->setCellValue('L18', 'Rp');
        $sheet2->setCellValue('M18', '');

        $sheet2->getStyle("B18:M18")->applyFromArray($bold);
        $sheet2->getStyle("B18:M18")->applyFromArray($border);

        $sheet2->setCellValue('C19', '1. BP UP *)');
        $sheet2->setCellValue('C20', '- Belanja MA');
        $sheet2->setCellValue('F20', 'Rp');
        $sheet2->setCellValue('G20', '');
        $sheet2->setCellValue('H20', 'Rp');
        $sheet2->setCellValue('I20', '');
        $sheet2->setCellValue('J20', 'Rp');
        $sheet2->setCellValue('K20', '');
        $sheet2->setCellValue('L20', 'Rp');
        $sheet2->setCellValue('M20', '');

        $sheet2->setCellValue('C21', '- Pengembalian Sisa UP');
        $sheet2->setCellValue('F21', 'Rp');
        $sheet2->setCellValue('G21', '');
        $sheet2->setCellValue('H21', 'Rp');
        $sheet2->setCellValue('I21', '');
        $sheet2->setCellValue('J21', 'Rp');
        $sheet2->setCellValue('K21', '');
        $sheet2->setCellValue('L21', 'Rp');
        $sheet2->setCellValue('M21', '');

        $sheet2->setCellValue('C22', '2. BP LS-Bendahara');
        $sheet2->setCellValue('C23', '- Pembayaran atas LS-Bendahara');
        $sheet2->setCellValue('F23', 'Rp');
        $sheet2->setCellValue('G23', '');
        $sheet2->setCellValue('H23', 'Rp');
        $sheet2->setCellValue('I23', '');
        $sheet2->setCellValue('J23', 'Rp');
        $sheet2->setCellValue('K23', '');
        $sheet2->setCellValue('L23', 'Rp');
        $sheet2->setCellValue('M23', '');

        $sheet2->setCellValue('C24', '- Setoran atas LS-Bendahara');
        $sheet2->setCellValue('F24', 'Rp');
        $sheet2->setCellValue('G24', '');
        $sheet2->setCellValue('H24', 'Rp');
        $sheet2->setCellValue('I24', '');
        $sheet2->setCellValue('J24', 'Rp');
        $sheet2->setCellValue('K24', '');
        $sheet2->setCellValue('L24', 'Rp');
        $sheet2->setCellValue('M24', '');

        $sheet2->setCellValue('C25', '3. BP Pajak');
        $sheet2->setCellValue('F25', 'Rp');
        $sheet2->setCellValue('G25', '');
        $sheet2->setCellValue('H25', 'Rp');
        $sheet2->setCellValue('I25', '');
        $sheet2->setCellValue('J25', 'Rp');
        $sheet2->setCellValue('K25', '');
        $sheet2->setCellValue('L25', 'Rp');
        $sheet2->setCellValue('M25', '');

        $sheet2->setCellValue('C26', '4. BP Voucher');
        $sheet2->setCellValue('F26', 'Rp');
        $sheet2->setCellValue('G26', '');
        $sheet2->setCellValue('H26', 'Rp');
        $sheet2->setCellValue('I26', '');
        $sheet2->setCellValue('J26', 'Rp');
        $sheet2->setCellValue('K26', '');
        $sheet2->setCellValue('L26', 'Rp');
        $sheet2->setCellValue('M26', '');

        $sheet2->getStyle("B19:B26")->applyFromArray($borderSamping);
        $sheet2->getStyle("C19:E26")->applyFromArray($borderSamping);
        $sheet2->getStyle("F19:G26")->applyFromArray($borderSamping);
        $sheet2->getStyle("H19:I26")->applyFromArray($borderSamping);
        $sheet2->getStyle("J19:K26")->applyFromArray($borderSamping);
        $sheet2->getStyle("L19:M26")->applyFromArray($borderSamping);
        $sheet2->getStyle("B26:M26")->applyFromArray($borderBot);

        $sheet2->setCellValue('B27', '*)');
        $sheet2->setCellValue('C27', 'Jumlah pengurangan sudah termasuk kuitansi UP yang belum di SPM-kan sebesar Rp ,-');
        
        $sheet2->setCellValue('A28', 'II.');
        $sheet2->setCellValue('B28', 'Keadaan Kas pada akhir Bulan Pelaporan');
        $sheet2->setCellValue('B29', '1.');
        $sheet2->setCellValue('C29', 'Uang Tunai di Brankas');
        $sheet2->setCellValue('F29', 'Rp.');
        $sheet2->setCellValue('G29', '');
        $sheet2->setCellValue('B30', '2.');
        $sheet2->setCellValue('C30', 'Uang di Rekening Bank');
        $sheet2->setCellValue('F30', 'Rp.');
        $sheet2->setCellValue('G30', '');
        $sheet2->setCellValue('H30', '(+)');
        $sheet2->setCellValue('B31', '3.');
        $sheet2->setCellValue('C31', 'Jumlah Kas');
        $sheet2->setCellValue('F31', 'Rp.');
        $sheet2->setCellValue('G31', '');
        $sheet2->getStyle("C30:G30")->applyFromArray($borderBot);

        $sheet2->setCellValue('A32', 'III.');
        $sheet2->setCellValue('B32', 'Selisih Kas');
        $sheet2->setCellValue('B33', '1.');
        $sheet2->setCellValue('C33', 'Saldo Akhir BP Kas (I.A.1 kol 6)');
        $sheet2->setCellValue('F33', 'Rp.');
        $sheet2->setCellValue('G33', '');
        $sheet2->setCellValue('B34', '2.');
        $sheet2->setCellValue('C34', 'Jumlah Kas (II.3)');
        $sheet2->setCellValue('F34', 'Rp.');
        $sheet2->setCellValue('G34', '');
        $sheet2->setCellValue('H34', '(-)');
        $sheet2->setCellValue('B35', '3.');
        $sheet2->setCellValue('C35', 'Jumlah Kas');
        $sheet2->setCellValue('F35', 'Rp.');
        $sheet2->setCellValue('G35', '');
        $sheet2->getStyle("C34:G34")->applyFromArray($borderBot);

        $sheet2->setCellValue('A36', 'IV.');
        $sheet2->setCellValue('B36', 'Penjelasan selisih kas (apabila ada) :');
        $sheet2->setCellValue('B37', '1.');
        $sheet2->setCellValue('C37', 'Nihil');
        $sheet2->setCellValue('B38', '2.');
        $sheet2->setCellValue('C38', '');
        $sheet2->mergeCells('C37:M37');
        $sheet2->mergeCells('C38:M38');

        
        //FOOTER
        $sheet2->setCellValue('C42', 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C43', 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C44', 'PNBP Belanja Non Modal');
        $sheet2->setCellValue('C48', $pejabat1->pejabat_nama);
        $sheet2->setCellValue('C49', 'NIP. '.$pejabat1->pejabat_nip);

        $sheet2->setCellValue('G41', 'Palangka Raya, ............. 2020');
        $sheet2->setCellValue('G43', 'BPP PNBP');
        $sheet2->setCellValue('G48', $pejabat2->pejabat_nama);
        $sheet2->setCellValue('G49', 'NIP. '.$pejabat2->pejabat_nip);

        $sheet2->getStyle("C48:G48")->applyFromArray($bold);
        //----------------------------------------------------------------------------------------------------

        //BERITA ACARA
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'BAR');
        $spreadsheet->addSheet($myWorkSheet);
        $sheet2 = $spreadsheet->getSheetByName('BAR');        ;
        $sheet2->setCellValue('A1', 'BERITA ACARA PEMERIKSAAN KAS');
        $sheet2->setCellValue('A2', 'BENDAHARA PENGELUARAN PEMBANTU');
        $sheet2->setCellValue('A4', 'Pada hari ini  tanggal  kami selaku Pejabat Pembuat Komitmen telah melakukan pemeriksaan kas BPP dengan saldo akhir pada Buku Kas Umum sebesar NIHIL dan bukti terakhir nomor : 0000/PNBP NON MODAL-UPR/2020.');
        $sheet2->setCellValue('A7', 'Adapun hasil pemeriksaan kas sebagai berikut:');

        $sheet2->mergeCells('A1:M1');
        $sheet2->mergeCells('A2:M2');
        $sheet2->mergeCells('A4:M6');

        $sheet2->getStyle("A1:M2")->applyFromArray($middle);
        $sheet2->getStyle("A1:M2")->applyFromArray($bold);
        $sheet2->getStyle('A4')->getAlignment()->setWrapText(true);

        //ISI
        $sheet2->setCellValue('A8', 'I.');
        $sheet2->setCellValue('B8', 'Hasil Pemeriksaan Pembukuan BPP :');
        $sheet2->setCellValue('B9', 'A.');
        $sheet2->setCellValue('C9', 'Saldo Kas (yang belum dipertanggungjawabkan BPP)');
        $sheet2->setCellValue('C10', '1. Saldo BP Kas (Tunai)');
        $sheet2->setCellValue('G10', 'Rp.');
        $sheet2->setCellValue('H10', '');
        $sheet2->setCellValue('C11', '2. Saldo BP Kas (Bank)');
        $sheet2->setCellValue('G11', 'Rp.');
        $sheet2->setCellValue('H11', '');
        $sheet2->setCellValue('I11', '(+)');
        $sheet2->setCellValue('C12', '3. Jumlah (A.1+A.2)');
        $sheet2->setCellValue('J12', 'Rp.');
        $sheet2->setCellValue('K12', '');

        $sheet2->getStyle("A8:C9")->applyFromArray($bold);
        $sheet2->getStyle("C11:H11")->applyFromArray($borderBot);
        $sheet2->getStyle("J12:K12")->applyFromArray($borderBot);

        $sheet2->setCellValue('B13', 'B.');
        $sheet2->setCellValue('C13', 'Saldo Kas Tersebut pada huruf A, terdiri dari:');
        $sheet2->setCellValue('C14', '1. Saldo BP UP');
        $sheet2->setCellValue('G14', 'Rp.');
        $sheet2->setCellValue('H14', '');
        $sheet2->setCellValue('C15', '2. Saldo BP LS Bendahara');
        $sheet2->setCellValue('G15', 'Rp.');
        $sheet2->setCellValue('H15', '');
        $sheet2->setCellValue('I15', '(+)');
        $sheet2->setCellValue('C16', '3. Jumlah (B.1+B.2)');
        $sheet2->setCellValue('J16', 'Rp.');
        $sheet2->setCellValue('K16', '');

        $sheet2->getStyle("B13:C13")->applyFromArray($bold);
        $sheet2->getStyle("C15:H15")->applyFromArray($borderBot);
        $sheet2->getStyle("J16:K16")->applyFromArray($borderBot);

        $sheet2->setCellValue('B17', 'C.');
        $sheet2->setCellValue('C17', 'Selisih Pembukuan (A.3-B.5)');
        $sheet2->setCellValue('L17', 'Rp.');
        $sheet2->setCellValue('M17', '');

        $sheet2->getStyle("B17:C17")->applyFromArray($bold);

        $sheet2->setCellValue('A19', 'II.');
        $sheet2->setCellValue('B19', 'Hasil Pemeriksaan Kas');
        $sheet2->setCellValue('B20', 'A.');
        $sheet2->setCellValue('C20', 'Kas yang Dikuasai BPP :');
        $sheet2->setCellValue('B21', '1.');
        $sheet2->setCellValue('C21', 'Uang Tunai di Brankas');
        $sheet2->setCellValue('C22', 'Uang Kertas');
        $sheet2->setCellValue('C23', '- Pecahan Rp. 100.000,-');
        $sheet2->setCellValue('D23', ':');
        $sheet2->setCellValue('E23', '0');
        $sheet2->setCellValue('F23', 'lembar');
        $sheet2->setCellValue('G23', 'Rp');
        $sheet2->setCellValue('H23', '0');
        $sheet2->setCellValue('C24', '- Pecahan Rp. 50.000,-');
        $sheet2->setCellValue('D24', ':');
        $sheet2->setCellValue('E24', '0');
        $sheet2->setCellValue('F24', 'lembar');
        $sheet2->setCellValue('G24', 'Rp');
        $sheet2->setCellValue('H24', '0');
        $sheet2->setCellValue('C25', '- Pecahan Rp. 20.000,-');
        $sheet2->setCellValue('D25', ':');
        $sheet2->setCellValue('E25', '0');
        $sheet2->setCellValue('F25', 'lembar');
        $sheet2->setCellValue('G25', 'Rp');
        $sheet2->setCellValue('H25', '0');
        $sheet2->setCellValue('C26', '- Pecahan Rp. 10.000,-');
        $sheet2->setCellValue('D26', ':');
        $sheet2->setCellValue('E26', '0');
        $sheet2->setCellValue('F26', 'lembar');
        $sheet2->setCellValue('G26', 'Rp');
        $sheet2->setCellValue('H26', '0');
        $sheet2->setCellValue('C27', '- Pecahan Rp. 5.000,-');
        $sheet2->setCellValue('D27', ':');
        $sheet2->setCellValue('E27', '0');
        $sheet2->setCellValue('F27', 'lembar');
        $sheet2->setCellValue('G27', 'Rp');
        $sheet2->setCellValue('H27', '0');
        $sheet2->setCellValue('C28', '- Pecahan Rp. 2.000,-');
        $sheet2->setCellValue('D28', ':');
        $sheet2->setCellValue('E28', '0');
        $sheet2->setCellValue('F28', 'lembar');
        $sheet2->setCellValue('G28', 'Rp');
        $sheet2->setCellValue('H28', '0');
        $sheet2->setCellValue('C29', '- Pecahan Rp. 1.000,-');
        $sheet2->setCellValue('D29', ':');
        $sheet2->setCellValue('E29', '0');
        $sheet2->setCellValue('F29', 'lembar');
        $sheet2->setCellValue('G29', 'Rp');
        $sheet2->setCellValue('H29', '0');
        $sheet2->setCellValue('C30', 'Uang Logam');
        $sheet2->setCellValue('C31', '- Pecahan Rp. 1.000,-');
        $sheet2->setCellValue('D31', ':');
        $sheet2->setCellValue('E31', '0');
        $sheet2->setCellValue('F31', 'keping');
        $sheet2->setCellValue('G31', 'Rp');
        $sheet2->setCellValue('H31', '0');
        $sheet2->setCellValue('C32', '- Pecahan Rp. 500,-');
        $sheet2->setCellValue('D32', ':');
        $sheet2->setCellValue('E32', '0');
        $sheet2->setCellValue('F32', 'keping');
        $sheet2->setCellValue('G32', 'Rp');
        $sheet2->setCellValue('H32', '0');
        $sheet2->setCellValue('C33', '- Pecahan Rp. 200,-');
        $sheet2->setCellValue('D33', ':');
        $sheet2->setCellValue('E33', '0');
        $sheet2->setCellValue('F33', 'keping');
        $sheet2->setCellValue('G33', 'Rp');
        $sheet2->setCellValue('H33', '0');
        $sheet2->setCellValue('C34', '- Pecahan Rp. 100,-');
        $sheet2->setCellValue('D34', ':');
        $sheet2->setCellValue('E34', '0');
        $sheet2->setCellValue('F34', 'keping');
        $sheet2->setCellValue('G34', 'Rp');
        $sheet2->setCellValue('H34', '0');
        $sheet2->setCellValue('C35', '- Pecahan Rp. 50,-');
        $sheet2->setCellValue('D35', ':');
        $sheet2->setCellValue('E35', '0');
        $sheet2->setCellValue('F35', 'keping');
        $sheet2->setCellValue('G35', 'Rp');
        $sheet2->setCellValue('H35', '0');
        $sheet2->setCellValue('C36', 'Jumlah Uang Tunai');
        $sheet2->setCellValue('J36', 'Rp');
        $sheet2->setCellValue('K36', '');
        $sheet2->setCellValue('B37', '2.');
        $sheet2->setCellValue('C37', 'Uang di Rekening Bank');
        $sheet2->setCellValue('J37', 'Rp');
        $sheet2->setCellValue('K37', '');
        $sheet2->setCellValue('L37', '(+)');
        $sheet2->setCellValue('B38', '3.');
        $sheet2->setCellValue('C38', 'Jumlah Kas (A.1+A.2)');
        $sheet2->setCellValue('L38', 'Rp');
        $sheet2->setCellValue('M38', '');

        $sheet2->getStyle("A19:C20")->applyFromArray($bold);
        $sheet2->getStyle("C35:H35")->applyFromArray($borderBot);
        $sheet2->getStyle("C37:K37")->applyFromArray($borderBot);

        $sheet2->setCellValue('A40', 'III.');
        $sheet2->setCellValue('B40', 'Selisih Kas');
        $sheet2->setCellValue('B41', '1.');
        $sheet2->setCellValue('C41', 'Saldo BP Kas (I.A.1)');
        $sheet2->setCellValue('G41', 'Rp');
        $sheet2->setCellValue('H41', '');
        $sheet2->setCellValue('B42', '2.');
        $sheet2->setCellValue('C42', 'Jumlah Kas (II.A.3)');
        $sheet2->setCellValue('G42', 'Rp');
        $sheet2->setCellValue('H42', '');
        $sheet2->setCellValue('J42', '(+)');
        $sheet2->setCellValue('B43', '3.');
        $sheet2->setCellValue('C43', 'Selisih Kas (A.1 - A.2)');
        $sheet2->setCellValue('J43', 'Rp');
        $sheet2->setCellValue('K43', '');

        $sheet2->getStyle("A40:B40")->applyFromArray($bold);
        $sheet2->getStyle("C42:H42")->applyFromArray($borderBot);

        $sheet2->setCellValue('A45', 'IV.');
        $sheet2->setCellValue('B45', 'Penjelasan selisih pembukuan dan/atau selisih kas (apabila ada) :');
        $sheet2->setCellValue('B46', '1.');
        $sheet2->setCellValue('C46', 'Selisih Pembukuan (IC)');
        $sheet2->setCellValue('C47', '');
        $sheet2->setCellValue('B48', '2.');
        $sheet2->setCellValue('C48', 'Selisih Kas (III.3)');
        $sheet2->setCellValue('C49', '');

        $sheet2->getStyle("A45:B45")->applyFromArray($bold);
       
        //FOOTER
        $sheet2->setCellValue('C52', 'Mengetahui/Menyetujui, ');
        $sheet2->setCellValue('C53', 'Pejabat Pembuat Komitmen');
        $sheet2->setCellValue('C54', 'PNBP Belanja Non Modal');
        $sheet2->setCellValue('C58', $pejabat1->pejabat_nama);
        $sheet2->setCellValue('C59', 'NIP. '.$pejabat1->pejabat_nip);

        $sheet2->setCellValue('G51', 'Palangka Raya, ............. 2020');
        $sheet2->setCellValue('G53', 'BPP PNBP');
        $sheet2->setCellValue('G58', $pejabat2->pejabat_nama);
        $sheet2->setCellValue('G59', 'NIP. '.$pejabat2->pejabat_nip);

        $sheet2->getStyle("C58:G58")->applyFromArray($bold);
        $sheet2->getStyle("F51:H59")->applyFromArray($middle);
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