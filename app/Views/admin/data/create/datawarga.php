	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;

	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	.str { 
		mso-number-format:\@; 
	}
	</style>
	  <?php
	  $filename = date('Y-m-d-His'). '-Data-warga';
      header("Content-type: application/vnd-ms-excel");
      header("Content-Disposition: attachment; filename=$filename.xls");
      ?>
	<center>
		<h3>DATA WARGA<br/></h3>
			
	</center>

	<table border="1">
		<tr>			<th>No</th>
                        <th>Nkk</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Jk</th>
                        <th>Tmp. Lahir</th>
                        <th>Tgl. Lahir</th>
                        <th>Warga negara</th>
                        <th>Agama</th>
                        <th>Status</th>
                        <th>Pend</th>
                        <th>Kerjaan</th>
                        <th>Prov</th>
                        <th>Kab</th>
                        <th>Kec</th>
                        <th>Kelurahan</th>
                        <th>Alamat</th>
                        <th>HP</th>
                        <th>SHDK</th>
                        <th>Foto</th>
                        <th>Ket</th>
                    </tr>
		<?php 
		$no = 1;
		foreach ($warga as $d) :
		
		?>
		<tr>
			<td><?= $no++; ?></td>
			<td class="str"><?= $d['nkk']; ?></td>
			<td class="str"><?= $d['nik']; ?></td>
			<td><?= $d['nama']; ?></td>
			<td><?= $d['jk']; ?></td>
			<td><?= $d['tmp_lahir']; ?></td>
			<td class="str"><?= $d['tgl_lahir']; ?></td>
			<td><?= $d['kwng']; ?></td>
			<td><?= $d['agama']; ?></td>
			<td><?= $d['status']; ?></td>
			<td><?= $d['pend']; ?></td>
			<td><?= $d['kerjaan']; ?></td>
			<td><?= $d['prov']; ?></td>
			<td><?= $d['kab']; ?></td>
			<td><?= $d['kec']; ?></td>
			<td><?= $d['kelurahan']; ?></td>
			<td><?= $d['alamat']; ?></td>
			<td class="str"><?= $d['hp']; ?></td>
			<td><?= $d['shdk']; ?></td>
			<td><?= $d['foto']; ?></td>
			<td><?= $d['ket']; ?></td>
			
		</tr>
		<?php endforeach;?>
	</table>

