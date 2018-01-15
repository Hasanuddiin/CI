<div class="page-header">
    <h2>Data Penduduk</h2>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detail Data
                <a href="#widget1" data-toggle="collapse"><span class="fa fa-chevron-down" style="float: right"></span>
                </a>
            </div>
            <div id="widget1" class="panel-body collapse in">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th width="20%">No KK</th>
                            <th width="3%">:</th>
                            <th><?php if ($no_kk != null){echo $no_kk;}else {echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <th>:</th>
                            <th><?php if ($nik != null ){ echo $nik; } else {echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>:</th>
                            <th><?php if ($nama_lengkap != null ){ echo $nama_lengkap; } else { echo '-'; }?></th>
                        </tr>
                        <tr>
                            <th>Hub. Keluarga</th>
                            <th>:</th>
                            <th><?php if ($stat_hbkel != null ){ echo $stat_hbkel; } else{echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>RT</th>
                            <th>:</th>
                            <th><?php if ($no_rt != null ){ echo $no_rt; } else{echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Tanggal Create</th>
                            <th>:</th>
                            <th><?php if ($tanggal_create != null ){ echo $tanggal_create; } else{echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Tanggal Update</th>
                            <th>:</th>
                            <th><?php if ($tanggal_update != null ){ echo $tanggal_update; } else{echo '-';}?></th>
                        </tr>
                    </table>
                    
                    <button class="btn btn-warning" onclick="history.back()"> KEMBALI</button>
                </div>
            </div>
        </div>
    </div>
</div>