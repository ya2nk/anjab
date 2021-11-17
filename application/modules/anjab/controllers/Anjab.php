<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;

class Anjab extends ADMIN_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load_admin('index');
	}
	
	function data()
	{
		echo json_encode($this->m_anjab->generate_datatable());
	}
	
	function form($id,$id_unit = null)
	{
		if ($id_unit == null && $id == 0){
			redirect('anjab');
		}
		
		$data['row'] = false;
		if ($id == 0 && $id_unit != null){
			$row_u = (object) $this->m_unit_kerja->unit_kerja($id_unit);
			$row_u->id_unit_kerja = $id_unit;
			$data['row'] = $row_u;
			
		}
		if ($row = $this->m_anjab->get_by_id($id)){
			$data['row'] = $row;
			$data['kondisi'] = json_decode($row->kondisi_fisik);
			$data['fungsi'] = json_decode($row->fungsi_pekerjaan);
		}
		$where_unit = [];
		/*if (session('role') == 2){
			$where_unit['id'] = session('unit_id');
		} */
		$data['jabatan'] = $this->m_master_jabatan->dropdown('id','nama_jabatan');
		$data['unit_kerja'] = $this->m_unit_kerja->where_parent(0)->where($where_unit)->dropdown('id','unit_kerja');
		$data['parent'] = $this->m_unit_kerja->order_id('asc')->result_array();
		$data['keterampilan'] = $this->m_keterampilan->dropdown('id','keterampilan');
		$data['bakat_kerja'] = $this->m_bakat->dropdown('id','kode','bakat');
		$data['temperamen_kerja'] = $this->m_temperamen->dropdown('id','kode','nama');
		$data['minat_kerja'] = $this->m_minat->dropdown('id','kode','keterangan');
		$data['upaya_fisik'] = $this->m_upaya_fisik->dropdown('id','keterangan');
		$data['fungsi_kerja'] = $this->m_fungsi_fisik->dropdown('id','kode','nama');
		$data['id'] = $id;
		$this->load_admin('form',$data);
	}
	
	function save()
	{
		$id = $this->_post('id','int');
		$data = [
			'id_jabatan'	=> $this->_post('id_jabatan','int'),
			'id_unit_kerja' => $this->_post('unit_kerja','int'),
			'prestasi_kerja' => $this->_post('prestasi_kerja'),
			'kelas_jabatan' => $this->_post('kelas_jabatan'),
			'keterampilan_kerja'=>json_encode($this->_post('keterampilan',null)),
			'bakat_kerja' => json_encode($this->_post('bakat_kerja',null)),
			'temperamen_kerja' => json_encode($this->_post('temperamen',null)),
			'minat_kerja' => json_encode($this->_post('minat_kerja',null)),
			'upaya_fisik' => json_encode($this->_post('upaya_fisik',null)),
			'kondisi_fisik' => json_encode($this->_post('kondisi_fisik',null)),
			'fungsi_pekerjaan' => json_encode($this->_post('fungsi_kerja',null)),
			'jpt_madya' => $this->_post('jpt_madya','int',0),
			'jpt_pratama' => $this->_post('jpt_pratama','int',0),
			'administrator' => $this->_post('administrator','int',0),
			'pengawas' => $this->_post('pengawas','int',0),
			'pelaksana' => $this->_post('pelaksana','int',0),
			'jumlah_saat_ini' => $this->_post('jumlah_saat_ini','int',0),
			'pengalaman_kerja' => $this->_post('pengalaman_kerja'),
			'pengetahuan_kerja' => $this->_post('pengetahuan_kerja')
		];
		
		if ($row = $this->m_master_jabatan->get_by_id($data['id_jabatan'])){
			if ($this->m_master_jabatan->where('kode_jabatan !=',$this->_post('kode_jabatan',null))->row()){
				$this->m_master_jabatan->update(['kode_jabatan'=>$this->_post('kode_jabatan',null)],$data['id_jabatan']);
			}
		}
		
		
		if(isset($_POST['bahan_kerja']) && count($_POST['bahan_kerja']) > 0){
			foreach ($_POST['bahan_kerja'] as $key=>$val){
				$bahan_kerja[] = array('bahan_kerja'=>$val,'penggunaan'=>$_POST['penggunaan'][$key]); 
			}
			$data['bahan_kerja'] = json_encode($bahan_kerja);
		}
		
		if(isset($_POST['perangkat_kerja']) && count($_POST['perangkat_kerja']) > 0){
			foreach ($_POST['perangkat_kerja'] as $key=>$val){
				$perangkat_kerja[] = array('perangkat_kerja'=>$val,'penggunaan_perangkat'=>$_POST['penggunaan_perangkat'][$key]); 
			}
			$data['perangkat_kerja'] = json_encode($perangkat_kerja);
		}
		
		if(isset($_POST['tanggung_jawab']) && count($_POST['tanggung_jawab']) > 0){
			foreach ($_POST['tanggung_jawab'] as $key=>$val){
				$tanggung_jawab[] = array('tanggung_jawab'=>$val); 
			}
			$data['tanggung_jawab'] = json_encode($tanggung_jawab);
		}
		
		if(isset($_POST['wewenang']) && count($_POST['wewenang']) > 0){
			foreach ($_POST['wewenang'] as $key=>$val){
				$wewenang[] = array('wewenang'=>$val); 
			}
			$data['wewenang'] = json_encode($wewenang);
		}
		
		if(isset($_POST['fisik_mental']) && count($_POST['fisik_mental']) > 0){
			foreach ($_POST['fisik_mental'] as $key=>$val){
				$resiko_berbahaya[] = array('fisik_mental'=>$val,'penyebab'=>$_POST['penyebab'][$key]); 
			}
			$data['resiko_berbahaya'] = json_encode($resiko_berbahaya);
		}
		
		if(isset($_POST['korelasi_jabatan']) && count($_POST['korelasi_jabatan']) > 0){
			foreach ($_POST['korelasi_jabatan'] as $key=>$val){
				$korelasi_jabatan[] = array('korelasi_jabatan'=>$val,'korelasi_unit_kerja'=>$_POST['korelasi_unit_kerja'][$key],'hal'=>$_POST['hal'][$key]); 
			}
			$data['korelasi_jabatan'] = json_encode($korelasi_jabatan);
		}
		
		$data['jumlah_kebutuhan'] = (int)$this->calculate_kebutuhan($data['id_jabatan']);
		
		
		if ($id_anjab = $this->m_anjab->upsert($data,$id)){
			if(isset($_POST['id_tugas_pokok'])){
				foreach($_POST['id_tugas_pokok'] as $key=>$row){
					$id_tugas = $row;
					$data_tugas['id_anjab'] = $id_anjab;
					$data_tugas['id_master_tugas_pokok'] = $_POST['id_master_tugas_pokok'][$key];
					$data_tugas['hasil_kerja'] = $_POST['hasil_kerja'][$key];
					$data_tugas['jumlah_beban'] = $_POST['jumlah_beban'][$key];
					$data_tugas['waktu_penyelesaian'] = $_POST['waktu_penyelesaian'][$key];
					$this->m_anjab->upsert_tugas_pokok($data_tugas,$id_tugas);
				}
			}
			exit('success');
		}
		echo 'Data Gagal Disimpan';
		
		
		
		
	}
	
	function detail($id,$cetak='')
	{
		if ($row = $this->m_anjab->get_full_jabatan($id)){
			$data['row'] = $row;
			$data['kondisi'] = json_decode($row->kondisi_fisik);
			$data['fungsi'] = json_decode($row->fungsi_pekerjaan);
			$data['syarat'] = $this->m_syarat_jabatan->where_id_jabatan($row->id_jabatan)->order_jenis('asc')->result();
			$data['abjad']  = ['a','b','c','d','e','f','g','h','i','j','k','l'];
			$data['tugas_pokok'] = $this->m_anjab->get_tugas_pokok_detail($id);
			$data['unit_kerja'] = $this->m_unit_kerja->dropdown('id','unit_kerja');
			$data['jabatan'] = $this->m_master_jabatan->dropdown('id','nama_jabatan');
			$data['lingkungan'] = $this->m_lingkungan_kerja->where_eselon($row->eselon)->result();
			$data['keterampilan_kerja'] = $this->m_keterampilan->dropdown('id','keterampilan');
			$data['bakat_kerja'] = $this->m_bakat->dropdown('id','kode','bakat');
			$data['temperamen_kerja'] = $this->m_temperamen->dropdown('id','kode','nama');
			$data['minat_kerja'] = $this->m_minat->dropdown('id','kode','keterangan');
			$data['upaya_fisik'] = $this->m_upaya_fisik->dropdown('id','keterangan');
			$data['fungsi_kerja'] = $this->m_fungsi_fisik->dropdown('id','kode','nama');
			$data['kondisi'] = json_decode($row->kondisi_fisik);
			$data['fungsi'] = json_decode($row->fungsi_pekerjaan);
			$data['fungsi_kerja'] = $this->m_fungsi_fisik->dropdown('id','kode','nama');
			if ($cetak == 'cetak'){
				$this->load->view('detail_cetak',$data);
			} else {
				$this->load_admin('detail',$data);
			}	
			
		}
	}
	
	function formulir($id)
	{
		
		
		
		if ($row = $this->m_anjab->get_full_jabatan($id)){
			$data['row'] = $row;
			
			//print_r($row); exit();
			$list = $this->m_unit_kerja->last_tree_unit_kerja($row->id_unit_kerja);
			
			$data['tree'] = buildTree($list,$list[0]['parent']);
			
			
			$data['kondisi'] = json_decode($row->kondisi_fisik);
			$data['fungsi'] = json_decode($row->fungsi_pekerjaan);
			$data['syarat'] = $this->m_syarat_jabatan->where_id_jabatan($row->id_jabatan)->order_jenis('asc')->result();
			$data['abjad']  = range('a','z');
			$data['tugas_pokok'] = $this->m_anjab->get_tugas_pokok_detail($id);
			$data['unit_kerja'] = $this->m_unit_kerja->dropdown('id','unit_kerja');
			$data['jabatan'] = $this->m_master_jabatan->dropdown('id','nama_jabatan');
			$data['lingkungan'] = $this->m_lingkungan_kerja->where_eselon($row->eselon)->result();
			$data['keterampilan_kerja'] = $this->m_keterampilan->dropdown('id','keterampilan');
			$data['bakat_kerja'] = $this->m_bakat->dropdown('id','kode','bakat');
			$data['temperamen_kerja'] = $this->m_temperamen->dropdown('id','kode','nama');
			$data['minat_kerja'] = $this->m_minat->dropdown('id','kode','keterangan');
			$data['upaya_fisik'] = $this->m_upaya_fisik->dropdown('id','keterangan');
			$data['fungsi_kerja'] = $this->m_fungsi_fisik->dropdown('id','kode','nama');
			$data['kondisi'] = json_decode($row->kondisi_fisik);
			$data['fungsi'] = json_decode($row->fungsi_pekerjaan);
			$data['fungsi_kerja'] = $this->m_fungsi_fisik->dropdown('id','kode','nama');
			$data['image'] = @$_POST['image'];
			//$this->load->view('jabatan_cetak',$data);
			//return;
			if (isset($_POST['image'])){
				//$this->load->library('pdf');
			    //$this->pdf->load_view('jabatan_cetak',$data);
				//$this->pdf->render();
				//$this->pdf->stream('Formulir_jabatan.pdf',['Attachment'=>false]); 
				//$this->load->view('jabatan_cetak',$data);
				$dompdf = new Dompdf();
                $dompdf->loadHtml($this->load->view('jabatan_cetak',$data,true));

                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'landscape');

                // Render the HTML as PDF
                $dompdf->render();

                // Output the generated PDF to Browser
                $dompdf->stream('Formulir_jabatan.pdf',['Attachment'=>false]);
				
			} else {
				$this->load->view('proses_image_chart',$data);
			}
			
			
			
		}
	}
	
	function delete()
	{
		$id = $this->_post('id','int');
		
		if ($this->m_anjab->delete($id)){
			echo 'success';
			exit();
		}
		echo 'Data Gagal dihapus';
	}
	
	
	
	function tugas_pokok_form()
	{
		$id = $this->_post('id','int');
		$data['id'] = $id;
		if ($row = $this->m_anjab->get_tugas_pokok($id)){
			$data['row'] = $row;
		}
		
		$this->load->view('tugas_pokok',$data);
	}
	
	function tugas_pokok_data()
	{
		$id_jabatan = $this->_post('id_jabatan','int');
		echo json_encode($this->m_anjab->tugas_pokok_data($id_jabatan));
	}
	
	function save_tugas_pokok()
	{
		$id   = $this->_post('id');
		$data = ['hasil_kerja' => $this->_post('hasil_kerja'),
				'jumlah_beban' => $this->_post('jumlah_beban'),
				'waktu_penyelesaian' => $this->_post('waktu_penyelesaian'),
				'id_master_tugas_pokok' => $this->_post('id_master_tugas_pokok')
				];
				
		if ($this->m_anjab->upsert_tugas_pokok($data,$id)){
			echo 'success';
		} else {
			echo 'Data Gagal disimpan';
		}
	}
	
	
}