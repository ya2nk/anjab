<!DOCTYPE html>
<html> 
<head>
<style>
	@media print {
		.no-print {
			display:none;
		}
		tr.page-break  { page-break-before: always; }
	}
	.containerx {
		max-width:700px
	}
	body,table {
		font-size:11px;
	}
	td{
    	word-wrap:break-word
	}
	
</style>
</head>
<body>

 <div class="containers">
 <center><h2>INFORMASI JABATAN</h2></center>
	<table class="table-borderless" width="100%">
		<tr>
			<td width="25%">1. NAMA JABATAN</td>
			<td>: <?= @$row->nama_jabatan; ?></td>
		</tr>
		<tr>
			<td>2. KODE JABATAN</td>
			<td>: <?= @$row->kode_jabatan; ?></td>
		</tr>
		<tr>
			<td>3. UNIT KERJA</td>
			<td>: </td>
		</tr>
		<tr>
			
			<td>&nbsp;3.1. Eselon IV</td>
			
			<td>: <?= $row->nama_administrator; ?></td>
		</tr>
		<tr>
			
			<td>&nbsp;3.2. Eselon III</td>
			
			<td>: <?= $row->nama_jpt_pratama; ?></td>
		</tr>
		<tr>
			
			<td>&nbsp;3.3. Eselon II</td>
			
			<td>: <?= $row->nama_jpt_madya; ?></td>
		</tr>
		<tr>
			
			<td>&nbsp;3.4. Eselon I</td>
			
			<td>: -</td>
		</tr>
		
		<tr>
			<td colspan="2">4. Kedudukan Dalam Struktur Organisasi</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><img src="<?= @$image; ?>" width="600"></td>
		</tr>
		<tr>
			<td colspan="2">5. IKTISAR JABATAN</td>
		</tr>
		<tr>
			<td colspan="2" style="font-family:Courier New, Courier, monospace;padding-left:10px"><i><?= @$row->deskripsi_jabatan; ?></i></td>
		</tr>
		<tr>
			<td colspan="2">6. URAIAN TUGAS</td>
		</tr>
		<tr>				
			<td colspan="2" style="font-family:Courier New, Courier, monospace">
				<ol type="a">
					<?php if (isset($tugas_pokok)) : $i = 0; foreach ($tugas_pokok as $k=>$r) :  ?>
					<li>
						<i><?= $r->tugas_pokok; ?></i>
					<br>
					<b>Tahapan :</b>
					<?php $tahapan = json_decode($r->tahapan_kerja,true); if (is_array($tahapan)) : if (count($tahapan) > 0) : foreach ($tahapan as $thp) : ?>
						<ol>
							<li><i><?= $thp; ?></i></li>
						</ol>
					<?php endforeach; endif; endif; ?>
					</li>
					<?php $i++; endforeach; ?>
					<?php endif; ?>
				</ol>
			</td>
		</tr>
		<tr>
			<td colspan="2">7. BAHAN KERJA</td>
		</tr>				
		<tr>				
			<td colspan="2" style="padding-left:10px">
				<table width="100%" border="1" style="border-collapse:collapse">
					<tr style="background-color:#ccc">
						<th>NO</th>
						<th>BAHAN KERJA</th>
						<th>PENGGUNAAN DALAM TUGAS</th>
					</tr>
					<?php $bahan_Kerja = json_decode($row->bahan_kerja); if (count($bahan_Kerja) >0) : foreach($bahan_Kerja as $k=>$bh) : ?>
					<tr>
						<td><?= $k+1; ?></td>
						<td><?= $bh->bahan_kerja; ?></td>
						<td><?= $bh->penggunaan; ?></td>
					</tr>
					<?php endforeach; endif; ?>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">8. PERANGKAT KERJA</td>
		</tr>
		<tr>	
			<td style="padding-left:10px" colspan="2">
				<table width="100%" border="1" style="border-collapse:collapse">
					<tr style="background-color:#ccc">
						<th>NO</th>
						<th>BAHAN KERJA</th>
						<th>PENGGUNAAN DALAM TUGAS</th>
					</tr>
					<?php $perangkat = json_decode($row->perangkat_kerja); if (is_array($perangkat) && count($perangkat) >0) : foreach($perangkat as $k=>$pr) : ?>
					<tr>
						<td><?= $k+1; ?></td>
						<td><?= $pr->perangkat_kerja; ?></td>
						<td><?= $pr->penggunaan_perangkat; ?></td>
					</tr>
					<?php endforeach; endif; ?>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="2">9. HASIL KERJA</th>
		</tr>
		<tr>
			<td colspan="2" style="padding-left:10px">
				<table width="100%" border="1" style="border-collapse:collapse">
					<tr style="background-color:#ccc">
						<th>NO</th>
						<th>HASIL KERJA</th>
						<th>SATUAN HASIL KERJA</th>
					</tr>
					<?php if (isset($tugas_pokok)) : $i = 0; foreach ($tugas_pokok as $k=>$r) :  ?>
					<tr>
						<td><?= $k+1; ?></td>
						<td><?= $r->hasil_kerja_asli; ?></td>
						<td><?= $r->hasil_kerja; ?></td>
					</tr>
					<?php endforeach; endif; ?>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="2">10. TANGGUNG JAWAB</th>
		</tr>
		<tr>			
			<td style="padding-left:10px">
				<table style="font-family:font-family:Courier New, Courier, monospace;font-style:italic">
					<?php $tanggung_jawab = json_decode($row->tanggung_jawab); if (is_array($tanggung_jawab) && count($tanggung_jawab) >0) : foreach($tanggung_jawab as $k=>$tj) : ?>
					<tr>
						<td><?= $abjad[$k]; ?>. </td>
						<td><?= $tj->tanggung_jawab; ?></td>
									
					</tr>
					<?php endforeach; endif; ?>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="2">11. WEWENANG</th>
		</tr>
		<tr>
			<td colspan="2" style="padding-left:10px">
				<table style="font-family:font-family:Courier New, Courier, monospace;font-style:italic">
				<?php $wewenang = json_decode($row->wewenang); if (is_array($wewenang) && count($wewenang) >0) : foreach($wewenang as $k=>$w) : ?>
					<tr>
						<td><?= $abjad[$k]; ?>. </td>
						<td><?= $w->wewenang; ?></td>
					</tr>
				<?php endforeach; endif; ?>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="2">12. KORELASI JABATAN</th>
		</tr>
		<tr>
			<td colspan="2" style="padding-left:10px">
				<table width="100%" border="1" style="border-collapse:collapse">
					<tr style="background-color:#ccc">
						<th>NO</th>
						<th>JABATAN</th>
						<th>UNIT KERJA / Instansi</th>
						<th>DALAM HAL</th>
					</tr>
					<?php $korelasi = json_decode($row->korelasi_jabatan); if (is_array($korelasi) && count($korelasi) >0) : foreach($korelasi as $k=>$ko) : if ($ko->korelasi_jabatan == '') continue; ?>
					<tr>
						<td><?= $k+1; ?></td>
						<td><?= $jabatan[$ko->korelasi_jabatan]; ?></td>
						<td><?= $unit_kerja[$ko->korelasi_unit_kerja]; ?></td>
						<td><?= $ko->hal; ?></td>
						</tr>
					<?php endforeach; endif; ?>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">13. KONDISI LINGKUNGAN KERJA</td>
		</tr>
		<tr>
			<td colspan="2" style="padding-left:10px">
				<table width="100%" border="1" style="border-collapse:collapse">
					<tr style="background-color:#ccc">
							<th>NO</th>
							<th>ASPEK</th>
							<th width="300">FAKTOR</th>
									
					</tr>
					<?php if ($lingkungan) : foreach ($lingkungan as $k=>$l) :  ?>
					<tr>
						<td><?= $k+1; ?></td>
						<td><?= $l->aspek; ?></td>
						<td style="word-wrap:break-word"><?= str_replace('"','',$l->faktor); ?></td>
					</tr>
						<?php endforeach; endif; ?>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="2">14. RESIKO BAHAYA</th>
		</tr>
		<tr>
			<td colspan="2" style="padding-left:10px">
				<table width="100%" border="1" style="border-collapse:collapse">
					<tr style="background-color:#ccc">
						<th>NO</th>
						<th>FISIK/MENTAL</th>
						<th>PENYEBAB</th>
					</tr>
					<?php $resiko = json_decode($row->resiko_berbahaya); if (is_array($resiko) && count($resiko) >0) : foreach($resiko as $k=>$re) : ?>
					<tr>
						<td><?= $k+1; ?></td>
						<td><?= $re->fisik_mental; ?></td>
						<td><?= $re->penyebab; ?></td>
					</tr>
					<?php endforeach; endif; ?>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="2">15. SYARAT JABATAN</th>
		</tr>
		
		<?php if ($syarat)  : $jenis = ''; foreach ($syarat as $key=>$sya) : ?>
			<tr>
				<td style="padding-left:20px" valign="top"><?php if ($jenis != $sya->jenis) : ?><?= $abjad[$key]; ?>. <?= $sya->jenis; ?><?php endif; ?></td>
				<td style="font-family:font-family:font-family:Courier New, Courier, monospace;font-style:italic">: <?= $sya->syarat_jabatan; ?></td>
			</tr>
		<?php $jenis = $sya->jenis; endforeach; endif; ?>
			<tr>
				<td colspan="2" style="padding-left:20px"><?= @$abjad[$key+1]; ?>. Keterampilan Kerja</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px">
					<table style="font-family:font-family:font-family:Courier New, Courier, monospace;font-style:italic">
						<?php $keterampilan = json_decode($row->keterampilan_kerja); if(is_array($keterampilan)) : if (count($keterampilan) >0) : foreach($keterampilan as $k=>$ke) : ?>
						<tr>
							<td><?= $abjad[$k]; ?>.&nbsp;</td>
							<td><?= $keterampilan_kerja[$ke]; ?></td>
						</tr>
						<?php endforeach; endif; endif; ?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:20px"><?= @$abjad[$key+2]; ?>. Bakat Kerja</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px">
					<table style="font-family:font-family:font-family:Courier New, Courier, monospace;font-style:italic">
						<?php $bakat = json_decode($row->bakat_kerja); if(is_array($bakat)) : if (count($bakat) >0) : foreach($bakat as $k=>$ba) : ?>
						<tr>
							<td><?= $abjad[$k]; ?>.&nbsp;</td>
							<td><?= $bakat_kerja[$ba]; ?></td>
						</tr>
						<?php endforeach; endif; endif;?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:20px"><?= @$abjad[$key+3]; ?>. Temperamen Kerja</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px">
					<table style="font-family:font-family:font-family:Courier New, Courier, monospace;font-style:italic">
						<?php $temperamen = json_decode($row->temperamen_kerja); if(is_array($temperamen)) : if (count($temperamen) >0) : foreach($temperamen as $k=>$te) : ?>
						<tr>
							<td><?= $abjad[$k]; ?>.&nbsp;</td>
							<td><?= $temperamen_kerja[$te]; ?></td>
						</tr>
						<?php endforeach; endif; endif; ?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:20px"><?= @$abjad[$key+4]; ?>. Minat Kerja</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px">
					<table style="font-family:font-family:font-family:Courier New, Courier, monospace;font-style:italic">
						<?php $minat = json_decode($row->minat_kerja); if(is_array($minat)) : if (count($minat) >0) : foreach($minat as $k=>$mi) : ?>
						<tr>
							<td><?= $abjad[$k]; ?>.&nbsp;</td>
							<td><?= $minat_kerja[$mi]; ?></td>
						</tr>
						<?php endforeach; endif; endif;?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:20px"><?= @$abjad[$key+5]; ?>. Upaya Fisik</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px">
					<table style="font-family:font-family:font-family:Courier New, Courier, monospace;font-style:italic">
						<?php $upaya = json_decode($row->upaya_fisik); if(is_array($upaya)) : if (count($upaya) >0) : foreach($upaya as $k=>$up) : ?>
						<tr>
							<td><?= $abjad[$k]; ?>.&nbsp;</td>
							<td><?= $upaya_fisik[$up]; ?></td>
						</tr>
						<?php endforeach; endif; endif; ?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:20px"><?= @$abjad[$key+6]; ?>. Kondisi Fisik</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px" >
					<table width="60%">
						<tr>
							<td>a. Jenis Kelamin</td>
						
							<td>: <?= @$kondisi->jenis_kelamin; ?></td>
						</tr>
						<tr>
									<td>b. Umur</td>
									
									<td>: <?= @$kondisi->umur; ?></td>
								</tr>
								<tr>
									<td>c. Tinggi Badan</td>
									
									<td>: <?= @$kondisi->tinggi_badan; ?></td>
								</tr>
								<tr>
									<td>d. Berat Badan</td>
									
									<td>: <?= @$kondisi->berat_badan; ?></td>
								</tr>
								<tr>
									<td>e. Postur Badan</td>
									
									<td>: <?= @$kondisi->postur_badan; ?></td>
								</tr>
								<tr>
									<td>f. Penamilan</td>
									
									<td>: <?= @$kondisi->penampilan; ?></td>
								</tr>
							</table>
						</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:20px"><?= @$abjad[$key+7]; ?>. Fungsi Pekerjaan</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px">
							<table width="60%">
								<tr>
									<td>a. Hubungan dengan Data</td>
									
									<td>: <?= @$fungsi_kerja[$fungsi->data]; ?></td>
								</tr>
								<tr>
									<td>b. Hubungan dengan Orang</td>
									
									<td>: <?= @$fungsi_kerja[$fungsi->orang]; ?></td>
								</tr>
								<tr>
									<td>c. Hubungan dengan Benda</td>
									
									<td>: <?= @$fungsi_kerja[$fungsi->benda]; ?></td>
								</tr>
								
							</table>
						</td>
					</tr>
			<tr>
				<td colspan="2" style="padding-left:20px"><?= @$abjad[$key+8]; ?>. Pengalaman Kerja</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px"><i><?= $row->pengalaman_kerja; ?></i></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:20px"><?= @$abjad[$key+9]; ?>. Pengetahuan kerja</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px"><i><?= $row->pengetahuan_kerja; ?></i></td>
			</tr>
					<tr>
						<th>16. PRESTASI YANG DIHARAPKAN</th>
						<td><?= $row->prestasi_kerja; ?></td>
					</tr>
					<tr>
						<th>17. KELAS JABATAN</th>
						<td>: <?= $row->kelas_jabatan; ?></td>
					</tr>
	</table>
	<div class="clearfix"></div>
	<div id="test"></div>
	
</div>
<script>

	

</script>
</body>
</html>