<div class="page-title">
    <div class="title_left">
        <h3>FORM JABATAN</h3>
    </div>
	
</div>
<div class="clearfix"></div>
	<form id="fm" class="form-horizontal form-label-left">
		<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
					<h2>Form Jabatan</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a href="javascript:void(0)" onclick="saveForm()"  class="btn btn-success"><i class="fa fa-save"></i> Simpan</a></li>
						<li><a href="#" onclick="history.back()" class="btn btn-warning"><i class="fa fa-times"></i> Batal</a></li>
                    </ul>
					<div class="clearfix"></div>
				  </div>
				   <div class="x_content">
					  
						<?= _input('id',[],@$id,'hidden'); ?>
						<input type="hidden" name="jpt_madya" value="<?=@$row->jpt_madya;?>">
						<input type="hidden" name="jpt_pratama" value="<?=@$row->jpt_pratama;?>">
						<input type="hidden" name="administrator" value="<?=@$row->administrator;?>">
						<input type="hidden" name="pengawas" value="<?=@$row->pengawas;?>">
						<input type="hidden" name="pelaksana" value="<?=@$row->pelaksana;?>">
						
						<?= _input('unit_kerja',[],@$row->id_unit_kerja,'hidden'); ?>
						
						<div class="form-group">
							
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Nama Jabatan<span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php  //generate_select_input($jabatan,'--Pilih Jabatan--',["name"=>"id_jabatan","class"=>"form-control select3",'onchange'=>'changeJabatan(this)'],@$row->id_jabatan); ?>
								<?php $this->load->view('tablepicker',['id'=>'jabatan-input','name'=>'id_jabatan','columns'=>['Kode Jabatan','Nama Jabatan'],
												'type'=>'text','url'=>site_url('master_jabatan/get_picker'),'value_text'=>@$jabatanRow->nama_jabatan,'value'=>@$row->id_jabatan]); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode Jabatan<span class="required">*</span></label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= input_text('kode_jabatan',['class'=>'form-control col-md-12 col-xs-12']); ?>
							</div>
						</div>
						<div class="form-group">
						
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><h4>Unit Kerja</h4><span class="required">*</span></label>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">JPT Madya</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?= generate_select_input($unit_kerja,'--Pilih Unit Kerja--',["name"=>"jpt_madya","class"=>"form-control","disabled"=>'disabled'],@$row->jpt_madya); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">JPT Pratama</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jpt_pratama" id="jpt_pratama" onchange="unitKerjaSelect(this,'#administrator')" disabled>
								</select>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Administrator</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="administrator" id="administrator" onchange="unitKerjaSelect(this,'#pengawas')" disabled>
								</select>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pengawas</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="pengawas" id="pengawas" onchange="unitKerjaSelect(this,'#pelaksana')" disabled>
								</select>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pelaksana</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="pelaksana" id="pelaksana" disabled>
								</select>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tugas Pokok<span class="required">*</span></label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								 <table id="tugas_pokok_table" class="table table-striped table-bordered" width="100%">
									<thead>
										<tr>
										<th>No</th>
											<th>Uraian Tugas</th>
											<th width="15%">Hasil kerja</th>
											<th width="15%">Jumlah <br>Beban kerja</th>
											<th width="15%">Waktu <br>Penyelesaian</th>
											
										</tr>
									</thead>
					  
								</table>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bahan Kerja<span class="required">*</span></label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<table class="table table-bordered" id="bahan_kerja">
									<thead>
										<tr>
											<th>No</th>
											<th>Bahan Kerja</th>
											<th>Penggunaan dalam tugas</th>
											<th><button class="btn btn-primary btn-sm" type="button" onclick="tambahBahanKerja()"><i class="fa fa-plus"></i></button></th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; if (isset($row->bahan_kerja)): $bahan = json_decode($row->bahan_kerja); if(is_countable($bahan) > 0) :  foreach ($bahan as $bh) : ?>
											<tr><td><?= $no; ?></td>
							     				<td><input type='text' name='bahan_kerja[]' class='form-control' value="<?= $bh->bahan_kerja; ?>"></td>
								 				<td><input type='text' name='penggunaan[]' class='form-control' value="<?= $bh->penggunaan; ?>"></td>
								 				<td><button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button</td></tr>
										<?php $no++; endforeach; endif; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Perangkat Kerja<span class="required">*</span></label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<table class="table table-bordered" id="perangkat_kerja">
									<thead>
										<tr>
											<th>No</th>
											<th>Bahan Kerja</th>
											<th>Penggunaan dalam tugas</th>
											<th><button class="btn btn-primary btn-sm" type="button" onclick="tambahPerangkatKerja()"><i class="fa fa-plus"></i></button></th>
										</tr>
									</thead>
									<tbody>
										<?php $no_p = 1; if (isset($row->perangkat)): $perangkat = json_decode($row->perangkat_kerja); if(is_countable($perangkat) > 0) :  foreach ($perangkat as $pe) : ?>
											<tr><td><?= $no_p; ?></td>
							     				<td><input type='text' name='perangkat_kerja[]' class='form-control' value="<?= $pe->perangkat_kerja; ?>"></td>
								 				<td><input type='text' name='penggunaan_perangkat[]' class='form-control' value="<?= $pe->penggunaan_perangkat; ?>"></td>
								 				<td><button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button</td></tr>
										<?php $no_p++; endforeach; endif; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggung Jawab<span class="required">*</span></label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<table class="table table-bordered" id="tanggung_jawab">
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggung Jawab</th>
											<th><button class="btn btn-primary btn-sm" type="button" onclick="tambahTanggungJawab()"><i class="fa fa-plus"></i></button></th>
										</tr>
									</thead>
									<tbody>
										<?php $no_t = 1; if (isset($row->tanggung_jawab)): $tanggung_jawab = json_decode($row->tanggung_jawab); if(is_countable($tanggung_jawab) > 0) :  foreach ($tanggung_jawab as $ta) : ?>
											<tr>
												<td><?= $no_t; ?></td>
												<td><input type='text' name='tanggung_jawab[]' class='form-control' value='<?= $ta->tanggung_jawab; ?>'></td>
												
												<td><button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button></td>
											</tr>
										<?php $no_t++; endforeach; endif; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Wewenang<span class="required">*</span></label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<table class="table table-bordered" id="wewenang">
									<thead>
										<tr>
											<th>No</th>
											<th>Wewenang</th>
											<th><button class="btn btn-primary btn-sm" type="button" onclick="tambahWewenang()"><i class="fa fa-plus"></i></button></th>
										</tr>
									</thead>
									<tbody>
										<?php $no_w = 1; if (isset($row->wewenang)): $wewenang = json_decode($row->wewenang); if(is_countable($wewenang) > 0) :  foreach ($wewenang as $we) : ?>
											<tr>
												<td><?= $no_w; ?></td>
												<td><input type='text' name='wewenang[]' class='form-control' value='<?= $we->wewenang; ?>'></td>
												
												<td><button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button></td>
											</tr>
										<?php $no_w++; endforeach; endif; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Korelasi Jabatan lain<span class="required">*</span></label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<table class="table table-bordered" id="korelasi">
									<thead>
										<tr>
											<th width="30%">Jabatan</th>
											<th width="30%">Unit Kerja</th>
											<th>Dalam Hal</th>
											<th><button class="btn btn-primary btn-sm" type="button" onclick="tambahKorelasi()"><i class="fa fa-plus"></i></button></th>
										</tr>
									</thead>
									<tbody>
										<?php if (isset($row->korelasi_jabatan)): $korelasi = json_decode($row->korelasi_jabatan); if(is_countable($korelasi) > 0) :  foreach ($korelasi as $ko) : ?>
										<tr class="master">
											<td>
												<input type='text' class='form-control autocomplete' value="<?= @$jabatan[$ko->korelasi_jabatan]; ?>"><input type="hidden" name="korelasi_jabatan[]" class="korelasi_jabatan" value="<?= @$ko->korelasi_jabatan; ?>">
												<?php //generate_select_input($jabatan,'--Pilih Jabatan--',["name"=>"korelasi_jabatan[]","class"=>"form-control"],@$ko->korelasi_jabatan); ?>
											</td>
											<td>
												<select name="korelasi_unit_kerja[]" class="form-control">
													<option value="0">--Pilih Unit Kerja--</option>
													<?= printTree(buildTree($parent),0,null,@$ko->korelasi_unit_kerja,['id','unit_kerja']); ?>
												</select>
											</td>
											<td>
												<?= input_text('hal[]',['class'=>'form-control col-md-12 col-xs-12'],$ko->hal); ?>
											</td>
											<td>
												<button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button>
											</td>
										</tr>
										<?php endforeach; else : ?>
										<tr class="master">
											<td>
												<input type='text' class='form-control autocomplete'><input type="hidden" name="korelasi_jabatan[]" class="korelasi_jabatan">
												<?php //generate_select_input($jabatan,'--Pilih Jabatan--',["name"=>"korelasi_jabatan[]","class"=>"form-control"]); ?>
											</td>
											<td>
												<select name="korelasi_unit_kerja[]" class="form-control">
													<option value="0">--Pilih Unit Kerja--</option>
													<?= printTree(buildTree($parent),0,null,@$row->parent,['id','unit_kerja']); ?>
												</select>
											</td>
											<td>
												<?= input_text('hal[]',['class'=>'form-control col-md-12 col-xs-12']); ?>
											</td>
											<td>
												<button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button>
											</td>
										</tr>
										<?php endif; else : ?>
											<tr class="master">
											<td>
												<input type='text' class='form-control autocomplete'><input type="hidden" name="korelasi_jabatan[]" class="korelasi_jabatan">
												<?php //generate_select_input($jabatan,'--Pilih Jabatan--',["name"=>"korelasi_jabatan[]","class"=>"form-control"]); ?>
											</td>
											<td>
												<select name="korelasi_unit_kerja[]" class="form-control">
													<option value="0">--Pilih Unit Kerja--</option>
													<?= printTree(buildTree($parent),0,null,@$row->parent,['id','unit_kerja']); ?>
												</select>
											</td>
											<td>
												<?= input_text('hal[]',['class'=>'form-control col-md-12 col-xs-12']); ?>
											</td>
											<td>
												<button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button>
											</td>
										</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resiko Bahaya<span class="required">*</span></label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<table class="table table-bordered" id="resiko">
									<thead>
										<tr>
											<th>No</th>
											<th>Fisik/Mental</th>
											<th>Penyebab</th>
											<th><button class="btn btn-primary btn-sm" type="button" onclick="tambahResiko()"><i class="fa fa-plus"></i></button></th>
										</tr>
									</thead>
									<tbody>
										<?php $no_r = 1; if (isset($row->resiko)): $resiko = json_decode($row->resiko_berbahaya); if(is_countable($resiko) > 0) :  foreach ($resiko as $re) : ?>
											<tr>
												<td><?= $no_r; ?></td>
												<td><input type='text' name='fisik_mental[]' class='form-control' value='<?= $re->fisik_mental; ?>'></td>
												<td><input type='text' name='penyebab[]' class='form-control' value='<?= $re->penyebab; ?>'></td>
												<td><button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button></td>
											</tr>
										<?php $no_r++; endforeach; endif; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><h4>Syarat Jabatan lain</h4></label>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keterampilan</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= generate_select_input($keterampilan,null,["name"=>"keterampilan[]","class"=>"form-control multiselect","multiple"=>'multiple'],@json_decode($row->keterampilan_kerja,true)); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bakat Kerja</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= generate_select_input($bakat_kerja,null,["name"=>"bakat_kerja[]","class"=>"form-control multiselect","multiple"=>'multiple'],@json_decode($row->bakat_kerja,true)); ?>
							</div>
								
						</div>
							<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Temperamen Kerja</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= generate_select_input($temperamen_kerja,null,["name"=>"temperamen[]","class"=>"form-control multiselect","multiple"=>'multiple'],@json_decode($row->temperamen_kerja,true)); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Minat Kerja</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= generate_select_input($minat_kerja,null,["name"=>"minat_kerja[]","class"=>"form-control multiselect","multiple"=>'multiple'],@json_decode($row->minat_kerja,true)); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Upaya Fisik</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= generate_select_input($upaya_fisik,null,["name"=>"upaya_fisik[]","class"=>"form-control multiselect","multiple"=>'multiple'],@json_decode($row->upaya_fisik,true)); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pengalaman Kerja</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= textarea('pengalaman_kerja',["class"=>"form-control col-md-12 col-xs-12"],@$row->pengalaman_kerja); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pengetahuan Kerja</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= textarea('pengetahuan_kerja',["class"=>"form-control col-md-12 col-xs-12"],@$row->pengetahuan_kerja); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kondisi Fisik</label>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="first-name">Jenis Kelamin</label>
							  <div class="col-md-3 col-sm-3 col-xs-12">
								  <?= input_text('kondisi_fisik[jenis_kelamin]',['class'=>'form-control col-md-12 col-xs-12'],@$kondisi->jenis_kelamin);  ?>
							  </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="first-name">Umur</label>
							  <div class="col-md-3 col-sm-3 col-xs-12">
								<?= input_text('kondisi_fisik[umur]',['class'=>'form-control col-md-12 col-xs-12'],@$kondisi->umur);  ?>
							  </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="first-name">Tinggi badan</label>
							  <div class="col-md-3 col-sm-3 col-xs-12">
								<?= input_text('kondisi_fisik[tinggi_badan]',['class'=>'form-control col-md-12 col-xs-12'],@$kondisi->tinggi_badan);  ?>
							  </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="first-name">Berat badan</label>
							  <div class="col-md-3 col-sm-3 col-xs-12">
								<?= input_text('kondisi_fisik[berat_badan]',['class'=>'form-control col-md-12 col-xs-12'],@$kondisi->berat_badan);  ?>
							  </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="first-name">Postur badan</label>
							  <div class="col-md-3 col-sm-3 col-xs-12">
								<?= input_text('kondisi_fisik[postur_badan]',['class'=>'form-control col-md-12 col-xs-12'],@$kondisi->postur_badan);  ?>
							  </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="first-name">Penampilan</label>
							  <div class="col-md-3 col-sm-3 col-xs-12">
								<?= input_text('kondisi_fisik[penampilan]',['class'=>'form-control col-md-12 col-xs-12'],@$kondisi->penampilan);  ?>
							  </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fungsi Pekerjaan</label>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="first-name">Hubungan Dengan Data</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= generate_select_input($fungsi_kerja,'--Fungsi Kerja--',["name"=>"fungsi_kerja[data]","class"=>"form-control"],@$fungsi->data); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="first-name">Hubungan Dengan Orang</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= generate_select_input($fungsi_kerja,'--Fungsi Kerja--',["name"=>"fungsi_kerja[orang]","class"=>"form-control"],@$fungsi->orang); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1" for="first-name">Hubungan Dengan Benda</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<?= generate_select_input($fungsi_kerja,'--Fungsi Kerja--',["name"=>"fungsi_kerja[benda]","class"=>"form-control"],@$fungsi->benda); ?>
							</div>
								
						</div>
					
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Prestasi Kerja yang diharapkan</label>
							  <div class="col-md-6 col-sm-6 col-xs-12">
								   <div class="radio">
                            <label>
                              <input type="radio" class="flat" checked name="prestasi_kerja" value="baik" <?php if(isset($row->prestasi_kerja)){if($row->prestasi_kerja == 'baik'){echo 'checked';}} ?>> Baik
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" class="flat" name="prestasi_kerja" value="sangat baik" <?php if(isset($row->prestasi_kerja)){if($row->prestasi_kerja == 'sangat baik'){echo 'checked';}} ?>> Sangat Baik
                            </label>
                          </div>
							  </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kelas Jabatan</label>
							  <div class="col-md-3 col-sm-3 col-xs-12">
								<?= input_text('kelas_jabatan',['class'=>'form-control col-md-12 col-xs-12'],@$row->kelas_jabatan);  ?>
							  </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jumlah saat ini</label>
							  <div class="col-md-3 col-sm-3 col-xs-12">
								<?= _input('jumlah_saat_ini',['class'=>'form-control col-md-12 col-xs-12'],@$row->jumlah_saat_ini,'number');  ?>
							  </div>
						</div>
				   </div>
				</div>
			  </div>
		</div>
	</form>	
	<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<a href="javascript:void(0)" class="modal-close pull-right" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times"></i>
					</a>
					<h4 class="modal-title" id="myModalLabel">Form Tugas Pokok Jabatan</h4>
				</div>
			<div class="modal-body">
								...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-rounded btn-primary" onclick="saveForm()">Save changes</button>
			</div>
			</div>
		</div>
	</div>
	
<link href="<?= base_url('assets/vendors/jquery-ui/jquery-ui.min.css'); ?>" rel="stylesheet">
<script src="<?= base_url('assets/vendors/jquery-ui/jquery-ui.min.js'); ?>"></script>
<?= load_datatable(); ?>
<script>
	var table;
	var no = parseInt(<?= $no; ?>);; 
	var no_p = parseInt(<?= $no_p; ?>); 
	var no_t = parseInt(<?= $no_t; ?>);;
	var no_w = parseInt(<?= $no_w; ?>);;
	var no_r = parseInt(<?= $no_r; ?>);;
	 
	CURRENT_URL = '<?= site_url('anjab'); ?>';
	var form = $('#fm');
	var autocomplete_opt ={ minLength: 2,source: '<?= site_url('master_jabatan/autocomplete'); ?>',
							select: function( event, ui ) {
								//alert(ui.item.id);
								$(this).parent().find('.korelasi_jabatan').val(ui.item.id);
								//alert($(this).parent().find('.korelasi_jabatan').val());
							}};
	$(function(){
		form.validate({
			rules : {
				id_jabatan : {
					required : true
				}
			}
		});
		
		$('.select2').select2({
			ajax: {
				url: '<?= site_url('master_jabatan/select'); ?>',
				data: function (params) {
					var query = {
						search: params.term,
						page: params.page || 1
					}

					// Query parameters will be ?search=[term]&page=[page]
					return query;
				}
			}
		});
		
		$('.select3').select2();
		$('.select3').on('select2:select', onSelectSelect2);
		$( ".autocomplete" ).autocomplete(autocomplete_opt);
		$('#jabatan-input').on("tablepicker:pick",function(e,row){
			//console.log(row);
			$('#kode_jabatan').val(row.value);
		})
	});	
	
	<?php if ($row) : ?>
		var jpt_pratama = parseInt(<?= $row->jpt_pratama; ?>);
		var administrator = parseInt(<?= $row->administrator; ?>);
		var pengawas = parseInt(<?= $row->pengawas; ?>);
		var pelaksana = parseInt(<?= $row->pelaksana; ?>);
		
		unitKerjaSelect({value:<?= $row->jpt_madya; ?>},'#jpt_pratama',jpt_pratama);
		unitKerjaSelect({value:<?= $row->jpt_pratama; ?>},'#administrator',administrator);
		unitKerjaSelect({value:<?= $row->administrator; ?>},'#pengawas',pengawas);
		unitKerjaSelect({value:<?= $row->pengawas; ?>},'#pelaksana',pelaksana);
		changeJabatan({value:<?= isset($row->id_jabatan) ? $row->id_jabatan : 0 ; ?>});
	<?php endif; ?>
	
	<?php if (isset($row->id_jabatan)) : ?>
		onSelectSelect2({params:{data:{id:<?=$row->id_jabatan;?>}}});
	<?php endif; ?>
		
		
	function unitKerjaSelect(that,target,$value=0)
	{
		$.post('<?= site_url('unit_kerja/select'); ?>',{id:that.value},function(result){
			$(target).empty();
			if ($value == 0){
				if (target == '#jpt_pratama'){
					$('#administrator').empty();
					$('#pengawas').empty();
					$('#pelaksana').empty();
				}
			
				if (target == '#administrator'){
					$('#pengawas').empty();
					$('#pelaksana').empty();
				}
			
				if (target == '#pengawas'){
					$('#pelaksana').empty();
				}
			}
			
			$(target).html('<option value="">-- Pilih Unit Kerja --</option>');
			if (result.length > 0){
				
				
				$.each(result,function(k,v){
					var selected = "";
					if (v.value == $value){
						selected = "selected";
					}
					$(target).append('<option value="'+v.value+'" '+selected+'>'+v.text+'</option>');
				});
			}
		},'json');
		//$('#unit_kerja').val(that.value);
	}
	
	function tambahBahanKerja()
	{
		
		$('#bahan_kerja').append("<tr><td>"+no+"</td>"+
							     "<td><input type='text' name='bahan_kerja[]' class='form-control'></td>"+
								 "<td><input type='text' name='penggunaan[]' class='form-control'></td>"+
								 "<td><button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button</td></tr>");
		no++;
	}
	
	function tambahPerangkatKerja()
	{
		
		$('#perangkat_kerja').append("<tr><td>"+no_p+"</td>"+
							     "<td><input type='text' name='perangkat_kerja[]' class='form-control'></td>"+
								 "<td><input type='text' name='penggunaan_perangkat[]' class='form-control'></td>"+
								 "<td><button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button</td></tr>");
		no_p++;
	}
	
	function tambahResiko()
	{
		
		$('#resiko').append("<tr><td>"+no_r+"</td>"+
							     "<td><input type='text' name='fisik_mental[]' class='form-control'></td>"+
								 "<td><input type='text' name='penyebab[]' class='form-control'></td>"+
								 "<td><button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button</td></tr>");
		no_r++;
	}
	
	function tambahTanggungJawab()
	{
		
		$('#tanggung_jawab').append("<tr><td>"+no_t+"</td>"+
							     "<td><input type='text' name='tanggung_jawab[]' class='form-control'></td>"+
								 "<td><button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button</td></tr>");
		no_t++;
	}
	
	function tambahWewenang()
	{
		
		$('#wewenang').append("<tr><td>"+no_w+"</td>"+
							     "<td><input type='text' name='wewenang[]' class='form-control'></td>"+
								 "<td><button class='btn btn-danger btn-sm' type='button' onclick='removeBahanKerja(this)'><i class='fa fa-times'></i></button</td></tr>");
		no_w++;
	}
	
	function tambahKorelasi()
	{
		var row = $('#korelasi tbody>tr:last').clone();
		row.find("input:text").val("");
		row.insertAfter('#korelasi tbody>tr:last');
		$('.autocomplete',row).autocomplete(autocomplete_opt);
        return false;
	}
	
	function removeBahanKerja(that)
	{
		$(that).closest('tr').remove();
	}
	
	function saveForm()
	{
		if(form.valid()){
			$.post('<?= site_url('anjab/save'); ?>',form.serialize()).done(function(result){
				if (result == 'success'){
					$.confirm({
						title: 'Konfirmasi!',
						content: 'Data Berhasil Disimpan',
						buttons: {
							confirm: function(){
								location.href = '<?= site_url('anjab'); ?>';
							},
							cancel: function () {
								location.href = '<?= site_url('anjab'); ?>'
							},
			
						}
					});
					
				} else {
					$.alert(result);
				}
			}).fail(function(xhr){
				$.alert(xhr.responseText);
			});
		}
	}
	
	function changeJabatan(that)
	{
		$.post('<?= site_url('master_jabatan/get_detail'); ?>',{id:that.value},function(result){
			$('#kode_jabatan').val(result.kode_jabatan);
		},'json');
	}
	
	
	function loadForm(id)
	{
		$('.modal-body').html('');
		$.post('<?= site_url('anjab/tugas_pokok_form'); ?>',{id:id}).done(function(result){
			$('.modal-body').html(result);
			$('#myModal').modal('show');
		}).fail(function(xhr){
			alert(xhr.responseText);
		});
	}

	function deleteData(id)
	{
		$_confirm(function(){
			$.post('<?= site_url('tugas_pokok_jabatan/delete'); ?>',{id:id},function(result){
				if (result == 'success'){
					$.alert('Data Berhasil Dihapus');
					table.draw();
				} else {
					$.alert(result,'ERROR');
				}
			})
		})
	}
	
	function onSelectSelect2(e)
	{
		var data = e.params.data;
			if ( $.fn.DataTable.isDataTable('#tugas_pokok_table') ) {
				$('#tugas_pokok_table').DataTable().destroy();
			}
			table = $('#tugas_pokok_table').DataTable({
					"processing": true,
					"serverSide": true,
					"dom" : 't',
					"ajax": {
						"url": "<?= site_url('anjab/tugas_pokok_data'); ?>",
						"type":"POST",
						"data": function ( d ) {
							d.id_jabatan = data.id;
					
						}
					},
					"columns": [
					    { "data": "nomor" },
						{ "data": "tugas_pokok" },
						{ "data": "hasil_kerja" },
						{ "data": "jumlah_beban" },
						{ "data": "waktu_penyelesaian" },
					],
					
					"initComplete": function(settings, json) {
					$('[data-toggle="tooltip"]').tooltip();
						prettyTable('#myTable');
					},
					"order": [[0, 'asc']],
				});
	}
		
		
	
</script>