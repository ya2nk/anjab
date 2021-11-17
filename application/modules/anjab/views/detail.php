<div class="page-title">
    <div class="title_left">
        <h3>DETAIL JABATAN</h3>
    </div>
	
</div>
<div class="clearfix"></div>
	
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
				<h2>Detail Jabatan</h2>
				 <ul class="nav navbar-right panel_toolbox">
                      <li><a href="#" onclick="window.open('<?= site_url('anjab/detail/'.$row->id.'/cetak'); ?>','Cetak Anjab','width=700')"  class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
                      </li>
                    </ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table">
					<tr>
						<th width="4%">1.</th>
						<th width="20%">NAMA JABATAN</th>
						<td>:</td>
						<td><?= $row->nama_jabatan; ?></td>
					</tr>
					<tr>
						<th width="4%">2.</th>
						<th>KODE JABATAN</th>
						<td>:</td>
						<td><?= $row->kode_jabatan; ?></td>
					</tr>
					<tr>
						<th width="4%">3.</th>
						<th>UNIT KERJA</th>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>a. JPT Madya</td>
						<td>:</td>
						<td><?= $row->nama_jpt_madya; ?></td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>b. JPT Pratama</td>
						<td>:</td>
						<td><?= $row->nama_jpt_pratama; ?></td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>c. Administrator</td>
						<td>:</td>
						<td><?= $row->nama_administrator; ?></td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>d. Pengawas</td>
						<td>:</td>
						<td><?= $row->nama_pengawas; ?></td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>e. Pelaksana</td>
						<td>:</td>
						<td><?= $row->nama_pelaksana; ?></td>
					</tr>
					<tr>
						<th width="4%">4. </th>
						<th>IKTISAR JABATAN</th>
						<td>:</td>
						<td><?= $row->deskripsi_jabatan; ?></td>
					</tr>
					<tr>
						<th width="4%">5.</th>
						<th>SYARAT JABATAN</th>
						<td>:</td>
						<td></td>
					</tr>
					<?php if ($syarat)  : $jenis = ''; foreach ($syarat as $key=>$sya) : ?>
						<tr>
							<td width="4%"></td>
							<td><?php if ($jenis != $sya->jenis) : ?><?= $abjad[$key]; ?>. <?= $sya->jenis; ?><?php endif; ?></td>
							<td>:</td>
							<td><?= $sya->syarat_jabatan; ?></td>
					</tr>
					<?php $jenis = $sya->jenis; endforeach; endif; ?>
					<tr>
						<th width="4%">6.</th>
						<th>TUGAS POKOK</th>
						<td>:</td>
						<td>
							<table class="table table-bordered">
								<tr>
									<th>NO</th>
									<th>URAIAN TUGAS</th>
									<th>HASIL KERJA</th>
									<th>JUMLAH BEBAN DALAM 1 TAHUN</th>
									<th>WAKTU PENYELESAIAN (JAM)</th>
									<th>WAKTU EFEKTIF PENYELESAIAN</th>
									<th>KEBUTUHAN PEGAWAI 1250</th>
								</tr>
								<?php if ($tugas_pokok) : $waktu_efektif = 0; $kebutuhan = 0; foreach ($tugas_pokok as $k=>$r) :  ?>
								<tr>
									<td><?= $k+1; ?></td>
									<td><?= $r->tugas_pokok; ?></td>
									<td><?= $r->hasil_kerja; ?></td>
									<td align="center"><?= $r->jumlah_beban; ?></td>
									<td align="center"><?= $r->waktu_penyelesaian; ?></td>
									<td align="center"><?= $r->jumlah_beban*$r->waktu_penyelesaian; ?></td>
									<td align="center"><?= ($r->jumlah_beban*$r->waktu_penyelesaian)/1250; ?></td>
								</tr>
								<?php 
									$waktu_efektif += $r->jumlah_beban*$r->waktu_penyelesaian;
									$kebutuhan += ($r->jumlah_beban*$r->waktu_penyelesaian)/1250;
								endforeach; ?>
									<tr>
										<td colspan="5" align="right">JUMLAH</td>
										<td align="center"><?= $waktu_efektif; ?></td>
										<td align="center"><?= $kebutuhan; ?></td>
									</tr>
									<tr>
										<td colspan="6" align="right">JUMLAH PEGAWAI</td>
										<td align="center"><?= (int)$kebutuhan == 0 ? 1 : (int)$kebutuhan; ?></td>
										
									</tr>
								<?php endif; ?>
							</table>
						</td>
						
					</tr>
					<tr>
						<th width="4%">7.</th>
						<th>BAHAN KERJA</th>
						<td>:</td>
						<td>
							<table class="table table-bordered">
								<tr>
									<th>NO</th>
									<th>BAHAN KERJA</th>
									<th>PENGGUNAAN DALAM TUGAS</th>
								</tr>
								<?php $bahan_Kerja = json_decode($row->bahan_kerja); if(is_countable($bahan_Kerja) >0) : foreach($bahan_Kerja as $k=>$bh) : ?>
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
						<th width="4%">8.</th>
						<th>PERANGKAT KERJA</th>
						<td>:</td>
						<td>
							<table class="table table-bordered">
								<tr>
									<th>NO</th>
									<th>BAHAN KERJA</th>
									<th>PENGGUNAAN DALAM TUGAS</th>
								</tr>
								<?php $perangkat = json_decode($row->perangkat_kerja); if(is_countable($perangkat) >0) : foreach($perangkat as $k=>$pr) : ?>
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
						<th width="4%">9.</th>
						<th>TANGGUNG JAWAB</th>
						<td>:</td>
						<td>
							<table>
								
								<?php $tanggung_jawab = json_decode($row->tanggung_jawab); if(is_countable($tanggung_jawab) >0) : foreach($tanggung_jawab as $k=>$tj) : ?>
								<tr>
									<td><?= $abjad[$k]; ?>. </td>
									<td><?= $tj->tanggung_jawab; ?></td>
									
								</tr>
								<?php endforeach; endif; ?>
							</table>
						</td>
					</tr>
					<tr>
						<th width="4%">10.</th>
						<th>WEWENANG</th>
						<td>:</td>
						<td>
							<table>
								
								<?php $wewenang = json_decode($row->wewenang); if(is_countable($wewenang) >0) : foreach($wewenang as $k=>$w) : ?>
								<tr>
									<td><?= $abjad[$k]; ?>. </td>
									<td><?= $w->wewenang; ?></td>
									
								</tr>
								<?php endforeach; endif; ?>
							</table>
						</td>
					</tr>
					<tr>
						<th width="4%">11.</th>
						<th>KORELASI JABATAN</th>
						<td>:</td>
						<td>
							<table class="table table-bordered">
								<tr>
									<th>NO</th>
									<th>JABATAN</th>
									<th>UNIT KERJA / Instansi</th>
									<th>DALAM HAL</th>
								</tr>
								<?php $korelasi = json_decode($row->korelasi_jabatan); if(is_countable($korelasi) >0) : if(is_array($korelasi)) : foreach($korelasi as $k=>$ko) : if ($ko->korelasi_jabatan == '') continue; ?>
								<tr>
									<td><?= $k+1; ?></td>
									<td><?= @$jabatan[$ko->korelasi_jabatan]; ?></td>
									<td><?= @$unit_kerja[$ko->korelasi_unit_kerja]; ?></td>
									<td><?= $ko->hal; ?></td>
								</tr>
								<?php endforeach; endif; endif; ?>
							</table>
						</td>
					</tr>
					<tr>
						<th width="4%">12.</th>
						<th>KONDISI LINGKUNGAN KERJA</th>
						<td>:</td>
						<td>
							<table class="table table-bordered">
								<tr>
									<th>NO</th>
									<th>ASPEK</th>
									<th>FAKTOR</th>
									
								</tr>
								<?php if ($lingkungan) : foreach ($lingkungan as $k=>$l) :  ?>
								<tr>
									<td><?= $k+1; ?></td>
									<td><?= $l->aspek; ?></td>
									<td><?= $l->faktor; ?></td>
									
								</tr>
								<?php 
									
								endforeach; endif; ?>
							</table>
						</td>
						
					</tr>
					<tr>
						<th width="4%">13.</th>
						<th>RESIKO BAHAYA</th>
						<td>:</td>
						<td>
							<table class="table table-bordered">
								<tr>
									<th>NO</th>
									<th>FISIK/MENTAL</th>
									<th>PENYEBAB</th>
								</tr>
								<?php $resiko = json_decode($row->resiko_berbahaya); if(is_countable($resiko)) : foreach($resiko as $k=>$re) : ?>
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
						<th width="4%">14.</th>
						<th>SYARAT JABATAN LAIN</th>
						<td>:</td>
						<td></td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>a. Keterampilan Kerja</td>
						<td>:</td>
						<td>
							<table>
								
								<?php $keterampilan = json_decode($row->keterampilan_kerja);  if(is_countable($keterampilan) > 0 ) : if(is_array($keterampilan)) :  foreach($keterampilan as $k=>$ke) : ?>
								<tr>
									<td><?= $abjad[$k]; ?>.&nbsp;</td>
									<td><?= $keterampilan_kerja[$ke]; ?></td>
									
								</tr>
								<?php endforeach; endif; endif; ?>
							</table>
						</td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>b. Bakat Kerja</td>
						<td>:</td>
						<td>
							<table>
								
								<?php $bakat = json_decode($row->bakat_kerja); if(is_countable($bakat) >0) : if(is_array($bakat)) : foreach($bakat as $k=>$ba) : ?>
								<tr>
									<td><?= $abjad[$k]; ?>.&nbsp;</td>
									<td><?= $bakat_kerja[$ba]; ?></td>
									
								</tr>
								<?php endforeach; endif; endif;?>
							</table>
						</td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>c. Temperamen Kerja</td>
						<td>:</td>
						<td>
							<table>
								
								<?php $temperamen = json_decode($row->temperamen_kerja); if(is_countable($temperamen) >0) : if(is_array($temperamen)) :  foreach($temperamen as $k=>$te) : ?>
								<tr>
									<td><?= $abjad[$k]; ?>.&nbsp;</td>
									<td><?= $temperamen_kerja[$te]; ?></td>
									
								</tr>
								<?php endforeach; endif; endif;?>
							</table>
						</td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>d. Minat Kerja</td>
						<td>:</td>
						<td>
							<table>
								
								<?php $minat = json_decode($row->minat_kerja); if(is_countable($minat) >0) : if(is_array($minat)) : foreach($minat as $k=>$mi) : ?>
								<tr>
									<td><?= $abjad[$k]; ?>.&nbsp;</td>
									<td><?= $minat_kerja[$mi]; ?></td>
									
								</tr>
								<?php endforeach; endif; endif; ?>
							</table>
						</td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>e. Upaya Fisik</td>
						<td>:</td>
						<td>
							<table>
								
								<?php $upaya = json_decode($row->upaya_fisik); if(is_countable($upaya) >0) : if(is_array($upaya)) : foreach($upaya as $k=>$up) : ?>
								<tr>
									<td><?= $abjad[$k]; ?>.&nbsp;</td>
									<td><?= $upaya_fisik[$up]; ?></td>
									
								</tr>
								<?php endforeach; endif; endif; ?>
							</table>
						</td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>f. Kondisi Fisik</td>
						<td>:</td>
						<td>
							<table width="60%">
								<tr>
									<td>a. Jenis Kelamin</td>
									<td> : </td>
									<td><?= @$kondisi->jenis_kelamin; ?></td>
								</tr>
								<tr>
									<td>b. Umur</td>
									<td> : </td>
									<td><?= @$kondisi->umur; ?></td>
								</tr>
								<tr>
									<td>c. Tinggi Badan</td>
									<td> : </td>
									<td><?= @$kondisi->tinggi_badan; ?></td>
								</tr>
								<tr>
									<td>d. Berat Badan</td>
									<td> : </td>
									<td><?= @$kondisi->berat_badan; ?></td>
								</tr>
								<tr>
									<td>e. Postur Badan</td>
									<td> : </td>
									<td><?= @$kondisi->postur_badan; ?></td>
								</tr>
								<tr>
									<td>f. Penamilan</td>
									<td> : </td>
									<td><?= @$kondisi->penampilan; ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>g. Fungsi Pekerjaan</td>
						<td>:</td>
						<td>
							<table width="60%">
								<tr>
									<td>a. Hubungan dengan Data</td>
									<td> : </td>
									<td><?= @$fungsi_kerja[$fungsi->data]; ?></td>
								</tr>
								<tr>
									<td>b. Hubungan dengan Orang</td>
									<td> : </td>
									<td><?= @$fungsi_kerja[$fungsi->orang]; ?></td>
								</tr>
								<tr>
									<td>c. Hubungan dengan Benda</td>
									<td> : </td>
									<td><?= @$fungsi_kerja[$fungsi->benda]; ?></td>
								</tr>
								
							</table>
						</td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>h. Pengalaman Kerja</td>
						<td>:</td>
						<td><?= $row->pengalaman_kerja; ?></td>
					</tr>
					<tr>
						<td width="4%"></td>
						<td>i. Pengetahuan Kerja</td>
						<td>:</td>
						<td><?= $row->pengetahuan_kerja; ?></td>
					</tr>
					<tr>
						<th width="4%">15.</th>
						<th>PRESTASI YANG DIHARAPKAN</th>
						<td>:</td>
						<td><?= $row->prestasi_kerja; ?></td>
					</tr>
					<tr>
						<th width="4%">16.</th>
						<th>KELAS JABATAN</th>
						<td>:</td>
						<td><?= $row->kelas_jabatan; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>