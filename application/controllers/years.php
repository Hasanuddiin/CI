<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Years extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->cek_login();
        $this->load->helper(array('form','url','file'));
        $this->load->library('form_validation');
    }

    private function cek_login(){
        if (!$this->session->userdata('ses_id')){
            $this->session->set_flashdata('error', 'Silahkan login terlebih dahulu');
            redirect('login');
        }
    }

    public function cek_user(){
        if ($this->session->userdata('ses_level') == 'Pengunjung'){
            $this->session->set_flashdata('error','Maaf anda tidak masuk kehalaman tersebut');
            redirect('years');
        }
    }

    public function index(){
        $data = array(
            'status' => 'new',
            'id_stat_hbkel' => '',
            'stat_hbkel' => '',
            'data_years' => $this->model->GetYears("order by stat_hbkel asc")->result_array(),
            'content' => 'years/years-data'
        );
        $this->load->view('template/site', $data);
    }

    public function edit_years($kode = 0){
        $this->cek_user();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('error','Maaf anda memilih data untuk di edit');
            redirect('years');
        }
        $patch = $this->model->GetYears("where id_stat_hbkel = '$kode'")->result_array();
        $data = array(
            'status' => 'old',
            'id_stat_hbkel' => $patch[0]['id_stat_hbkel'],
            'stat_hbkel' => $patch[0]['stat_hbkel'],
            'data_years' => $this->model->GetYears("where id_stat_hbkel != '$kode' order by stat_hbkel asc")->result_array(),
            'content' => 'years/years-data'
        );
        $this->load->view('template/site', $data);
    }

    public function save_years(){
        $this->cek_user();
        if (!$_POST['save']){
            $this->session->set_flashdata('error','Anda belum melaukan tambah atau edit data');
            redirect('years');
        }
        $this->form_validation->set_rules('id_stat_hbkel', 'id_stat_hbkel');
        $this->form_validation->set_rules('stat_hbkel', 'stat_hbkel','required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $status = $_POST['status'];
        if ($status == 'new') {
            $stat_hbkel = $_POST['stat_hbkel'];
            $cek = $this->db->query("select * from hubungan_keluarga WHERE stat_hbkel = '$stat_hbkel'")->num_rows();
            if ($cek > 0) {
                $this->session->set_flashdata('error', "Data Sudah ada");
                redirect('years');
            }else if ($this->form_validation->run()==FALSE){
                $this->session->set_flashdata('error', validation_errors()."Simpan Data Gagal Dilakukan");
                redirect('years');
            }else {
                $data = array(
                    'id_stat_hbkel' => $_POST['id_stat_hbkel'],
                    'stat_hbkel' => $_POST['stat_hbkel'],
                );
                $this->model->Simpan('hubungan_keluarga', $data);
                $this->session->set_flashdata('sukses', "Simpan Data Berhasil dilakukan");
                $path = './assets/pdf/'.$stat_hbkel;
                if (!is_dir($path)){
                    mkdir($path, 0777, TRUE);
                }
                redirect('years');
            }
        }else{
            $id_stat_hbkel = $_POST['id_stat_hbkel'];
            $stat_hbkel = $_POST['stat_hbkel'];
            //$stat_hbkel2 = $_POST['stat_hbkel2'];
            //$path2 = './assets/pdf/'.$stat_hbkel2;
            $path1 = './assets/pdf/'.$stat_hbkel;
            $cek = $this->db->query("select * from hubungan_keluarga WHERE stat_hbkel = '$stat_hbkel'")->num_rows();
            if ($cek > 0) {
                $data = array(
                    'id_stat_hbkel' => $id_stat_hbkel,
                    'stat_hbkel' => $stat_hbkel,
                );
                $this->db->replace('hubungan_keluarga',$data);
                if (is_dir($path2)){
                    rmdir($path2);
                }
                if (!is_dir($path1)) {
                    mkdir($path1, 0777, TRUE);
                }
                $this->session->set_flashdata('warning', "Data sudah ada otomatis update data tersebut");
                redirect('years');
            }elseif ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('error', "Update Data Gagal Dilakukan");
                redirect('years');
            }else {
                $data = array(
                    'stat_hbkel' => $_POST['stat_hbkel'],
                );
                if (!is_dir($path1)) {
                    mkdir($path1, 0777, TRUE);
                }
                $this->model->Update('hubungan_keluarga', $data, array('id_stat_hbkel' => $id_stat_hbkel));
                $this->session->set_flashdata('sukses', "Update Data Berhasil dilakukan");
                redirect('years');
            }
        }
    }
    public function delete_years($kode = 1){
        $this->cek_user();
        $tampil = $this->model->GetYears("where id_stat_hbkel = '$kode'")->row_array();
        if ($this->uri->segment(3) == null){
            $this->session->set_flashdata('error', 'Maaf anda belum memilih data untuk dihapus');
            redirect('years');
        }
        $result = $this->model->Hapus('hubungan_keluarga', array('id_stat_hbkel' => $kode));
        if ($result == 1){
            $this->session->set_flashdata('sukses',"Delete Data Berhasil dilakukan");
            $path = './assets/pdf/'.$tampil['stat_hbkel'];
            if (is_dir($path)){
                rmdir($path);
            }
            redirect('years');
        }else{
            $this->session->set_flashdata('error',"Delete Data Gagal dilakukan");
            redirect('years');
        }
    }

    public function export_excel(){
        $this->cek_user();
        $data = array(
            'title' => 'Data Hubungan Keluarga',
            'data_years' => $this->model->GetYears()->result_array(),
        );
        $this->load->view('years/years-laporan-excel',$data);
    }

    public function export_pdf(){
        $this->cek_user();
        ob_start();
        $data = array(
            'title' => 'Data Tahun Penelitian',
            'data_years' => $this->model->GetYears()->result_array(),
        );
        $this->load->view('years/years-laporan-pdf', $data);
        $html = ob_get_clean();

        require_once ('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        $pdf->WriteHTML($html);
        $pdf->Output('Data Tahun Penelitian.pdf','D');
    }

    public function export_print(){
        $this->cek_user();
        $data = array(
            'title' => 'Data Tahun Penelitian',
            'data_years' => $this->model->GetYears()->result_array(),
        );
        $this->load->view('years/years-laporan-pdf', $data);
    }
}
?>