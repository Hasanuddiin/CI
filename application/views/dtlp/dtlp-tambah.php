<div id="data-tambah" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah Data Penduduk</h4>
            </div>
            <form action="<?php echo site_url('dtlp/simpan_data')?>" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>NO KK</label>
                        <input type="text" name="no_kk" placeholder ="Masukan Angka" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" placeholder ="Masukan Angka" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control">
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
						<label>RT</label>				  
						<input type="number" class="form-control" id="no_rt" name="no_rt" placeholder="Tambah RT"  required>  
					</div>
                    <div class="form-group">
                        <label>Tanggal Create</label>
                        <input type="text" name="tanggal_create" placeholder="Format Tanggal(Tahun-Bulan-Tanggal)" class="form-control" required>
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            format: 'DD MMMM YYYY HH:mm'
        });

        $('#datepicker').datetimepicker({
            format: 'DD MMMM YYYY'
        });

        $('#timepicker').datetimepicker({
            format: 'HH:mm'
        });
    });
</script>