<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dtlp extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->cek_login();
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
    }

    private function cek_login(){
        if (!$this->session->userdata('ses_id')){
            $this->session->set_flashdata('error', 'Silahkan login terlebih dahulu');
            redirect('login');
        }
    }

    public function cek_user(){
        if ($this->session->userdata('ses_level') == 'Pengunjung' or $this->session->userdata('ses_level') == 'Pimpinan'){
            $this->session->set_flashdata('error','Maaf anda tidak bisa masuk kehalaman tersebut');
            redirect('dtlp');
        }
    }

    public function cek_pengunjung(){
        if ($this->session->userdata('ses_level') == 'Pengunjung'){
            $this->session->set_flashdata('error','Maaf anda tidak bisa masuk kehalaman tersebut');
            redirect('dtlp');
        }
    }

    public function index(){
        $data = array(
            'ses_level' => $this->session->userdata('ses_level'),
            'data_pendanaan' => $this->model->GetDtlp('order by nama_lengkap asc')->result_array(),
           'data_years' => $this->model->GetYears('order by stat_hbkel asc')->result_array(),
            'content' => 'dtlp/dtlp-data',
        );
        $this->load->view('template/site', $data);
    }

    public function simpan_data(){
        $this->cek_user();
        if (!$_POST['simpan']){
            $this->session->set_flashdata('warning', 'Tambah data belum dilakukan');
            redirect('dtlp');
        }
        $no_kk = $this->input->post('no_kk');
		$nik = $this->input->post('nik');
		$cek_kode_kk = $this->model->GetDtlp("where no_kk = '$no_kk'")->num_rows();
		$cek_kode_nik = $this->model->GetDtlp("where nik = '$nik'")->num_rows();
        if ($cek_kode_kk > 0){
            $this->session->set_flashdata('warning', 'No KK sudah ada');
            redirect('dtlp');
        }elseif ($cek_kode_nik > 0){
            $this->session->set_flashdata('warning', 'Nik sudah ada');
            redirect('user');
        }else {
            $data = array(
                'no_kk' => $no_kk,
                'nik' => $nik,
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'id_stat_hbkel' => $this->input->post('hub_keluarga'),
				'no_rt' => $this->input->post('no_rt'),
                'tanggal_create' => $this->input->post('tanggal_create'),
            );
			//print_r($data); die();
            $this->model->Simpan('data_penduduk', $data);
            $this->session->set_flashdata('sukses', 'Simpan data berhasil dilakukan');
            redirect('dtlp');
        }
    }

    public function edit_data($kode = 0){
        $this->cek_user();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('warning','Anda belum memilih data untuk di edit');
            redirect('dtlp');
        }
        $data_laporan = $this->model->GetDtlp("where no_kk = '$kode'")->row_array();

       // $tahun = $this->model->GetTotDtlp("where no_kk = '$kode'")->row_array();

        $data = array(
            'no_kk' => $data_laporan['no_kk'],
            'nik' => $data_laporan['nik'],
            'nama_lengkap' => $data_laporan['nama_lengkap'],
			'id_stat_hbkel' => $data_laporan['id_stat_hbkel'],
            'no_rt' => $data_laporan['no_rt'],
            'tanggal_create' => $data_laporan['tanggal_create'],
            
            'content' => 'dtlp/dtlp-edit',
        );
        $this->load->view('template/site',$data);
    }

    public function update_data(){
        $this->cek_user();
        if (!$_POST['update']){
            $this->session->set_flashdata('warning','Update data belum dilakukan');
            redirect('dtlp');
        }
        $no_kk = $this->input->post('no_kk');
        
        $data = array(
            'no_kk' => $no_kk,
            'nik' => $this->input->post('nik'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'id_stat_hbkel' => $this->input->post('hub_keluarga'),
			'no_rt' => $this->input->post('no_rt'),
            'tanggal_update' => $this->input->post('tanggal_update'),
        );
        $result = $this->model->Update('data_penduduk',$data,array('no_kk' => $no_kk));
        if ($result == 1){
            $this->session->set_flashdata('sukses', 'Simpan data berhasil dilakukan');
            redirect('dtlp');
        }else{
            $this->session->set_flashdata('error', 'Simpan data gagal dilakukan');
            redirect('dtlp');
        }
    }

    public function hapus_data($kode = 1){
        $this->cek_user();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('warning','Hapus data belum dilakukan');
            redirect('dtlp');
        }
        $data_laporan = $this->model->GetDtlp("where no_kk = '$kode'")->row_array();
        $result = $this->model->Hapus('data_penduduk',array('no_kk' => $kode));
      
        if ($result == 1){
            $this->session->set_flashdata('sukses','Hapus data berhasil dilakukan');
            redirect('dtlp');
        }else{
            $this->session->set_flashdata('error','Hapus data gagal dilakukan');
            redirect('dtlp');
        }

    }

    public function detail_data($kode = 0){
        $this->cek_user();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('warning','Anda belum memilih data untuk melihat detail data');
            redirect('dtlp');
        }
        $data_laporan = $this->model->GetDtlp("where no_kk = '$kode'")->row_array();
        $data = array(
            'no_kk' => $data_laporan['no_kk'],
            'nik' => $data_laporan['nik'],
            'nama_lengkap' => $data_laporan['nama_lengkap'],
			'stat_hbkel' => $data_laporan['stat_hbkel'],
            'no_rt' => $data_laporan['no_rt'],
            'tanggal_create' => $data_laporan['tanggal_create'],
			'tanggal_update' => $data_laporan['tanggal_update'],
            'content' => 'dtlp/dtlp-detail',
        );
        $this->load->view('template/site',$data);
    }

    public function export_excel(){
        $this->cek_pengunjung();
        $no_kk = $this->input->post('no_kk');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $pendanaan = $this->input->post('pendanaan');
        $no_rt = $this->input->post('no_rt');
        $result = $this->model->LikeDtlp($no_kk,$nama_lengkap,$no_rt,$pendanaan)->result_array();
        $data = array(
            'title' => 'Data Penduduk',
            'data_laporan' => $result,
        );
        $this->load->view('dtlp/dtlp-report-excel',$data);
    }

    public function export_pdf(){
        $this->cek_pengunjung();
        $no_kk = $this->input->post('no_kk');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $no_rt = $this->input->post('no_rt');
        $result = $this->model->LikeDtlp($no_kk,$nama_lengkap,$no_rt)->result_array();
		echo $result;
        ob_start();
        $data = array(
            'title' => 'Data Penduduk',
            'data_laporan' => $result,
        );
        $this->load->view('dtlp/dtlp-report-pdf', $data);
        $html = ob_get_clean();

        require_once ('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        $pdf->WriteHTML($html);
        $pdf->Output('Data Penduduk.pdf','D');
    }

    public function export_print(){
        $this->cek_pengunjung();
        $no_kk = $this->input->post('no_kk');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $no_rt = $this->input->post('no_rt');
        $result = $this->model->LikeDtlp($no_kk,$nama_lengkap,$no_rt)->result_array();
        $data = array(
            'title' => 'Data Penduduk',
            'data_laporan' => $result,
        );
        $this->load->view('dtlp/dtlp-report-pdf', $data);
    }

}
?>