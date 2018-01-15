<div class="page-header">
    <h2>Data Laporan Penduduk</h2>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                List Data
                <a href="#widget1" data-toggle="collapse"><span class="fa fa-chevron-down" style="float: right"></span>
                </a>
            </div>
            <div id="widget1" class="panel-body collapse in">
                <?php
                $data=$this->session->flashdata('error');
                if($data!=""){ ?>
                    <div id="pesan-flash">
                        <div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong> Error! </strong> <?=$data;?>
                        </div>
                    </div>
                <?php } ?>
                <?php
                $data2=$this->session->flashdata('sukses');
                if($data2!=""){ ?>
                    <div id="pesan-error-flash">
                        <div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong> Succes! </strong> <?=$data2;?>
                        </div>
                    </div>
                <?php } ?>
                <?php
                $data3=$this->session->flashdata('warning');
                if($data3!=""){ ?>
                    <div id="pesan-error-flash">
                        <div class='alert alert-warning alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong> Warning! </strong> <?=$data3;?>
                        </div>
                    </div>
                <?php } ?>
                <div class="nav" style="margin-bottom: 10px">
                    <?php if ($ses_level != 'Pimpinan' and $ses_level != 'Pengunjung'){?>
                        <button data-toggle="modal" data-target="#data-tambah" class="btn btn-info col-md-2">
                            <span class="glyphicon glyphicon-plus"></span>
                            <span>Tambah Data</span>
                        </button>
                    <?php } ?>
                </div>
				<div class="nav" style="margin-bottom: 10px">
                    <div class="pull-right">
                        
                        <a href="<?php echo site_url('dtlp/export_print');?>">
                            <button class="btn btn-danger">
                                <span class="fa fa-file-pdf-o"></span> Pdf
                            </button>
                        </a>
                        <a href="<?php echo site_url('dtlp/export_excel');?>">
                            <button class="btn btn-primary">
                                <span class="fa fa-file-excel-o"></span> Excel
                            </button>
                        </a>
                    </div>
                </div>
                <table id="table" class="table penelitian table-bordered table-striped" width="100%">
                    <thead>
                    <tr>
                        <th width="4%">#</th>
                        <th width="10%">NO KK</th>
                        <th width="15%">NIK</th>
                        <th width="20%">NAMA<br>LENGKAP</th>
                        <th width="10%">Hub<br>Keluarga</th>
						<th width="12%">RT</th>
                        <th width="14%">Tanggal<br>Create</th>
						<th width="14%">Tanggal<br>Update</th>
                        <th width="10%" class="text-center">Opsi<br></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>NO KK</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Hub Keluarga</th>
                        <th>RT</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    $no = 0; foreach ($data_pendanaan as $data){ $no++						
									
                        ?>
						
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $data['no_kk'];?></td>
                            <td><?php echo $data['nik'];?></td>
                            <td><?php echo $data['nama_lengkap'];?></td>
							<td><?php echo $data['stat_hbkel'];?></td>
                            <td><?php echo $data['no_rt'];?></td>
                            <td><?php echo $data['tanggal_create'];?></td>
							<td><?php echo $data['tanggal_update'];?></td>
                                <td class="text-center">
                                    <?php if ($ses_level != 'Admin' and $ses_level != 'Super Admin'){?>
                                    <a href="<?php echo base_url('assets/pdf/'.$data['years_name'].'/'.$data['pdf'])?>" data-toggle="tooltip" data-placement ="top" title="lihat pdf" target="_blank"><span class="fa fa-file-pdf-o" style="font-size: 14pt;"> </span></a>
                                    <?php } ?>
                                    <?php if ($ses_level != 'Pimpinan' and $ses_level != 'Pengunjung'){?>
                                    <a href="<?php echo base_url()?>dtlp/detail_data/<?php echo $data['no_kk'];?>" data-toggle="tooltip" data-placement ="top" title="detail"><span class="glyphicon glyphicon-check" style="font-size: 14pt"></span></a>
                                    <a href="<?php echo base_url()?>dtlp/edit_data/<?php echo $data['no_kk'];?>" data-toggle="tooltip" data-placement ="top" title="edit"><span class="fa fa-edit ukuran" style="font-size: 14pt"></span></a>
                                    <a href="<?php echo base_url()?>dtlp/hapus_data/<?php echo $data['no_kk'];?>" onclick="return confirm('Yakin data dihapus')" data-toggle="tooltip" data-placement ="top" title="hapus"><span class="glyphicon glyphicon-trash" style="font-size: 12pt"></span></a>
                                    <?php } ?>
                                </td>
							
                        </tr>
							<?php }?>
					
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
<?php $this->load->view('dtlp/dtlp-tambah');?>