<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_anjab extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'anjab';
		$this->column_order = ['id_jabatan','nama_jabatan','unit_kerja'];
		$this->order = ['id_jabatan'=>'asc'];
	}
	
	function filter()
	{
		if (session('role') == 2){
			$this->db->where('jpt_madya',session('unit_id'));
		}
	}
	
	function generate_datatable()
	{
		$select = $this->table.'.*,master_jabatan.nama_jabatan,master_unit_kerja.unit_kerja';
		$join   = [['master_jabatan','master_jabatan.id = '.$this->table.".id_jabatan"],
					['master_unit_kerja','master_unit_kerja.id = '.$this->table.".id_unit_kerja"]];
		$result = $this->get_datatables($select,$join);
		$rows = $result['data'];
		if ($rows){
			$no = $_POST['start'] + 1;
			foreach ($rows as $key=>$row){
				$rows[$key]->action = " <a href='".site_url('anjab/detail/'.$row->id)."' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Data'><i class='fa fa-eye'></i></a>
										<a href='".site_url('anjab/formulir/'.$row->id)."' class='btn btn-info btn-sm' data-toggle='tooltip' data-placement='top' title='Formulir Jabatan' target='_blank'><i class='fa fa-file-o'></i></a>
										<a href='".site_url('anjab/form/'.$row->id)."' class='btn btn-info btn-sm' data-toggle='tooltip' data-placement='top' title='Ubah Data'><i class='fa fa-pencil'></i></a>
									   <button class='btn btn-danger btn-sm' data-container='table' data-toggle='tooltip' data-placement='top' title='Hapus Data' onclick='deleteData(".$row->id.")'><i class='fa fa-trash'></i></button>";
				$rows[$key]->no     = $no;
				$no++;
			}
		}
		$result['data'] = $rows;
		return $result;
	}
	
	function get_full_jabatan($id)
	{
		$row = $this->db->select('A.*,H.unit_kerja,B.nama_jabatan,B.kode_jabatan,B.deskripsi_jabatan,B.eselon,C.unit_kerja as nama_jpt_madya,D.unit_kerja as nama_jpt_pratama,E.unit_kerja as nama_administrator,F.unit_kerja as nama_pengawas,
								 G.unit_kerja as nama_pelaksana')->from($this->table." A")
						->join('master_jabatan B','A.id_jabatan=B.id','left')
						->join('master_unit_kerja C','A.jpt_madya=C.id','left')
						->join('master_unit_kerja D','A.jpt_pratama=D.id','left')
						->join('master_unit_kerja E','A.administrator=E.id','left')
						->join('master_unit_kerja F','A.pengawas=F.id','left')
						->join('master_unit_kerja G','A.pelaksana=G.id','left')
						->join('master_unit_kerja H','A.id_unit_kerja=H.id','left')
						->where('A.id',$id)
						->get()
						->row();
		return $row;
	}
	
	function get_parent_child($id,$parent=0,$result = array())
	{
		
		if ($parent == 0){
			$rows = $this->db->select('A.*,C.nama_jabatan,C.eselon,B.jumlah_kebutuhan,B.jumlah_saat_ini')->from('master_unit_kerja A')
							 ->join('anjab B','A.id=B.id_unit_kerja','left')
							 ->join('master_jabatan C','B.id_jabatan=C.id','left')
							 ->where('A.id',$id)->get()->result_array();
		} else {
			$rows = $this->db->select('A.*,C.nama_jabatan,C.eselon,B.jumlah_kebutuhan,B.jumlah_saat_ini')->from('master_unit_kerja A')
							 ->join('anjab B','A.id=B.id_unit_kerja','left')
							 ->join('master_jabatan C','B.id_jabatan=C.id','left')
							 ->where('A.parent',$parent)->get()->result_array();
		}
		
		if ($rows){
			foreach($rows as $row){
				$result[] = $row;
				$result = $this->get_parent_child($id,$row['id'],$result);
			}
		}
		return $result;
	}
	
	function tugas_pokok_data($id)
	{
		$rows  = $this->db->select('A.id_jabatan,A.tugas_pokok,B.hasil_kerja,B.jumlah_beban,B.waktu_penyelesaian,B.id,A.id AS id_master_tugas_pokok')->from('master_tugas_pokok_jabatan A')
					      ->join('tugas_pokok_jabatan B','A.id=B.id_master_tugas_pokok','left')
						  ->where('A.id_jabatan',$id)
						  ->get()
						  ->result();
						  
		if ($rows){
			$no = 1;
			foreach ($rows as $key=>$row){
				$rows[$key]->hasil_kerja = generate_select_input(['Data'=>'Data',
									   'Kegiatan'=>'Kegiatan',
									   'Laporan'=>'Laporan',
									   'Dokumen'=>'Dokumen',
									   'Berkas'=>'Berkas']
									 ,'--Pilih Hasil Kerja--',
									 ["name"=>"hasil_kerja[]","class"=>"form-control"],
									 $row->hasil_kerja);
				
				$rows[$key]->jumlah_beban = _input('jumlah_beban[]',['class'=>'form-control'],$row->jumlah_beban,'number');
				$rows[$key]->waktu_penyelesaian = _input('waktu_penyelesaian[]',['size'=>'6','class'=>'form-control'],$row->waktu_penyelesaian,'number');
				$rows[$key]->nomor = $no."<input type='hidden' name='id_tugas_pokok[]' value='".$row->id."'><input type='hidden' name='id_master_tugas_pokok[]' value='".$row->id_master_tugas_pokok."'>";
				$no++;
			}
		}
						  
		$result['draw'] = $_REQUEST['draw'];
		$result['recordsFiltered'] = count($rows);
		$result['recordsTotal'] = count($rows);
		$result['data'] = $rows;
		return $result;
	}
	
	function get_tugas_pokok($id)
	{
		$row  = $this->db->select('A.id_jabatan,A.tugas_pokok,B.hasil_kerja,B.jumlah_beban,B.waktu_penyelesaian,B.id,A.id AS id_master_tugas_pokok')->from('master_tugas_pokok_jabatan A')
					      ->join('tugas_pokok_jabatan B','A.id=B.id_master_tugas_pokok','left')
						  ->where('A.id',$id)
						  ->get()
						  ->row();
		return $row;
	}
	
	function upsert_tugas_pokok($data,$id)
	{
		if ($this->db->where('id',$id)->get('tugas_pokok_jabatan')->row()){
			return $this->db->where('id',$id)->update('tugas_pokok_jabatan',$data);
		} else {
			return $this->db->insert('tugas_pokok_jabatan',$data);
		}
	}
	
	function get_tugas_pokok_detail($id)
	{
		$rows  = $this->db->select('A.id_jabatan,A.tugas_pokok,A.hasil_kerja_asli,B.hasil_kerja,B.jumlah_beban,B.waktu_penyelesaian,B.id,A.id AS id_master_tugas_pokok,A.tahapan_kerja')->from('master_tugas_pokok_jabatan A')
					      ->join('tugas_pokok_jabatan B','A.id=B.id_master_tugas_pokok','left')
						  ->where('B.id_anjab',$id)
						  ->get()
						  ->result();
						  
		
		return $rows;
	}
	
	
	
	
}