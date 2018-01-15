<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=report_dtlp.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1">
    <thead>
    <tr>
        <th colspan="5"><h2><?php echo $title;?></h2></th>
    </tr>
    <tr>
        <th align="center">No</th>
        <th>No KK</th>
        <th>NIK</th>
        <th>Nama Lengkap</th>
        <th>Hubungan Keluarga</th>
        <th>No RT</th>
        <th>Tanggal Create</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach($data_laporan as $data) { ?>
        <tr>
            <td align="center"><?php echo $i; ?></td>
            <td align="center"><?php echo $data['no_kk']; ?></td>
            <td align="center"><?php echo $data['nik']; ?></td>
            <td align="center"><?php echo $data['nama_lengkap']; ?></td>
            <td align="center"><?php echo $data['stat_hbkel']; ?></td>
            <td align="center"><?php echo $data['no_rt']; ?></td>
            <td align="center"><?php echo $data['tanggal_create']; ?></td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>