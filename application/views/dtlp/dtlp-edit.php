<div class="page-header">
    <h2>Data Penduduk</h2>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Data
                <a href="#widget1" data-toggle="collapse"><span class="fa fa-chevron-down" style="float: right"></span>
                </a>
            </div>
            <div id="widget1" class="panel-body collapse in">
                <div class="modal-dialog">
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
                    <form action="<?php echo site_url('dtlp/update_data')?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="no_kk" value="<?php echo $no_kk;?>">
                        <input type="hidden" name="no_rt" value="<?php echo $no_rt;?>">
                         <div class="modal-body">
                            <div class="form-group">
                                <label>No KK</label>
                                <input type="text" name="no_kk1" class="form-control" required value="<?php echo $no_kk;?>">
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <textarea name="nik" class="form-control" required><?php echo $nik;?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $nama_lengkap;?>">
                            </div>
							<div class="form-group">
								<label>Hubungan Keluarga</label>
								<select name="hub_keluarga" class="form-control"  >
									<option value="">Pilih</option>
									<?php $no = 1; foreach ($data_years as $data) { $no++ ?>
									<option value="<?php echo $data['id_stat_hbkel'];?>"><?php echo $data['stat_hbkel'];?></option>
									<?php } ?>
								</select>
							</div>
                            <div class="form-group">
                                <label>NO RT</label>
                                <input type="number" name="no_rt" class="form-control" value="<?php echo $no_rt;?>" required>
                            </div>
                            <div class="form-group">
								<label>Tanggal Update</label>
								<input type="text" name="tanggal_update" placeholder="Format Tanggal(Tahun-Bulan-Tanggal)" class="form-control" required>
                       
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger ">Reset</button>
                            <button type="button" class="btn btn-warning " data-dismiss="modal" onclick="history.back();">Batal
                            </button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>