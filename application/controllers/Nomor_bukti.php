<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nomor_bukti extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Nomor_bukti_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'nomor_bukti?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'nomor_bukti?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'nomor_bukti';
            $config['first_url'] = base_url() . 'nomor_bukti';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Nomor_bukti_model->total_rows($q);
        $nomor_bukti = $this->Nomor_bukti_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'nomor_bukti_data' => $nomor_bukti,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Nomor Bukti';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Nomor Bukti' => '',
        ];
        $data['code_js'] = 'nomor_bukti/codejs';
        $data['page'] = 'nomor_bukti/Nomor_bukti_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Nomor_bukti_model->get_by_id($id);
        if ($row) {
            $data = array(
		'nb_id' => $row->nb_id,
		'nb_no' => $row->nb_no,
		'nb_tanggal' => $row->nb_tanggal,
		'uraian' => $row->uraian,
		'tbl_pengeluaran' => $row->tbl_pengeluaran,
	    );
        $data['title'] = 'Nomor Bukti';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'nomor_bukti/Nomor_bukti_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nomor_bukti'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('nomor_bukti/create_action'),
	    'nb_id' => set_value('nb_id'),
	    'nb_no' => set_value('nb_no'),
	    'nb_tanggal' => set_value('nb_tanggal'),
	    'uraian' => set_value('uraian'),
	);
        $data['title'] = 'Nomor Bukti';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'nomor_bukti/Nomor_bukti_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nb_id' => $this->input->post('nb_id',TRUE),
		'nb_no' => $this->input->post('nb_no',TRUE),
		'nb_tanggal' => $this->input->post('nb_tanggal',TRUE),
        'uraian' => $this->input->post('uraian',TRUE),
        'nb_id_tahun' =>  $this->session->userdata('tahun_aktif'),
	    );
if(! $this->Nomor_bukti_model->is_exist($this->input->post('nb_id'))){
                $this->Nomor_bukti_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, nb_id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Nomor_bukti_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('nomor_bukti/update_action'),
		'nb_id' => set_value('nb_id', $row->nb_id),
		'nb_no' => set_value('nb_no', $row->nb_no),
		'nb_tanggal' => set_value('nb_tanggal', $row->nb_tanggal),
		'uraian' => set_value('uraian', $row->uraian),
        'tbl_pengeluaran' => set_value('tbl_pengeluaran', $row->tbl_pengeluaran),

	    );
            $data['title'] = 'Nomor Bukti';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'nomor_bukti/Nomor_bukti_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nomor_bukti'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('nb_id', TRUE));
        } else {
            $data = array(
		'nb_id' => $this->input->post('nb_id',TRUE),
		'nb_no' => $this->input->post('nb_no',TRUE),
		'nb_tanggal' => $this->input->post('nb_tanggal',TRUE),
		'uraian' => $this->input->post('uraian',TRUE),
		'tbl_pengeluaran' => $this->input->post('tbl_pengeluaran',TRUE),
	    );

            $this->Nomor_bukti_model->update($this->input->post('nb_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('nomor_bukti'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Nomor_bukti_model->get_by_id($id);

        if ($row) {
            $this->Nomor_bukti_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('nomor_bukti'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nomor_bukti'));
        }
    }

    public function deletebulk(){
        $delete = $this->Nomor_bukti_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nb_id', 'nb id', 'trim|required');
	$this->form_validation->set_rules('nb_no', 'nb no', 'trim|required');
	$this->form_validation->set_rules('nb_tanggal', 'nb tanggal', 'trim|required');
	$this->form_validation->set_rules('uraian', 'uraian', 'trim|required');
	// $this->form_validation->set_rules('tbl_pengeluaran', 'tbl pengeluaran', 'trim|required|numeric');

	$this->form_validation->set_rules('nb_id', 'nb_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_nomor_bukti.xls";
        $judul = "tbl_nomor_bukti";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nb Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Nb No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nb Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Uraian");
	xlsWriteLabel($tablehead, $kolomhead++, "Tbl Pengeluaran");

	foreach ($this->Nomor_bukti_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nb_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nb_no);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nb_tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->uraian);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tbl_pengeluaran);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

  public function printdoc(){
        $data = array(
            'nomor_bukti_data' => $this->Nomor_bukti_model->get_all(),
            'start' => 0
        );
        $this->load->view('nomor_bukti/nomor_bukti_print', $data);
    }

}

/* End of file Nomor_bukti.php */
/* Location: ./application/controllers/Nomor_bukti.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-14 14:32:38 */
/* http://harviacode.com */