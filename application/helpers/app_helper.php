<?php

function asset($file) {
	return base_url('assets/'.$file);
}

function css($asset,$tag='') {
	if (is_array($asset)){
		$link = '';
		foreach($asset as $file) {
			$link .= "<link href='".asset($file)."' rel='stylesheet' $tag>";
		}
		return $link;
	}
	return "<link href='".asset($asset)."' rel='stylesheet' $tag>";
}

function js($asset,$tag='') {
	if (is_array($asset)){
		$link = '';
		foreach($asset as $file) {
			$link .= '<script src="'.asset($file).'"></script>';
		}
		return $link;
	}
	return '<script src="'.asset($asset).'"></script>';
} 

function session($key) {
	$ci =& get_instance();
	return $ci->session->userdata($key);
}

function session_set($key,$value=''){
	$ci =& get_instance();
	if (is_array($key)) {
		$ci->session->set_userdata($key);
		return;
	}
	$ci->session->set_userdata($key,$value);
}

function generate_select_input($data,$default="",$attrs,$id=""){
	$option = "<select";
	foreach ($attrs as $key=>$val){
		$option .=" {$key}='{$val}'";
	}
	$option .= '>';
	if ($default != null){
		$option .= "<option value=''>$default</option>";
	}
	
	if (count($data) > 0){
		foreach($data as $k=>$row){
			$selected = "";
			if (is_array($id)){
				if (in_array($k,$id)){
					$selected = 'selected';
				}
			} else {
				if($id == $k){$selected = 'selected';}
			}
			
			$option .= "<option value='".$k."' $selected>".$row."</option>";
		}
	}
	$option .= "</select>";
	return $option;
}

function input_text($name,$attrs,$value="")
{
	return _input($name,$attrs,$value,'text');
}

function _input($name,$attrs,$value,$type='text')
{
	$input = "<input type='$type' name='$name' id='$name' value='$value' placeholder='".__($name)."'";
	if (is_array($attrs)){
		if (count($attrs) >0){
			foreach ($attrs as $key=>$val ){
				$input .= " {$key}='{$val}'";
			}
		}
	}
	$input .= ">";
	return $input;
}

function textarea($name,$attrs,$value="")
{
	$input = "<textarea name='$name' id='$name' placeholder='".__($name)."'";
	if (is_array($attrs)){
		foreach ($attrs as $key=>$val ){
			$input .= " {$key}='{$val}'";
		}
	}
	$input .= ">$value</textarea>";
	return $input;
}

function clean_template($template, array $variables){

 return preg_replace_callback('#{(.*?)}#',
       function($match) use ($variables){
            $match[1]=trim($match[1],'$');
            return $variables[$match[1]];
       },
       ' '.$template.' ');

}

function load_datatable()
{
	$assets = base_url('assets');
	return '<link href="'.$assets.'/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		    <link href="'.$assets.'/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
            <link href="'.$assets.'/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
            <link href="'.$assets.'/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
            <link href="'.$assets.'/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
			<script src="'.$assets.'/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
			<script src="'.$assets.'/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
			<script src="'.$assets.'/vendors/jszip/dist/jszip.min.js"></script>
			<script src="'.$assets.'/vendors/pdfmake/build/pdfmake.min.js"></script>
			<script src="'.$assets.'/vendors/pdfmake/build/vfs_fonts.js"></script>';
}

function buildTree(Array $data, $parent = 0) {
    $tree = array();
    foreach ($data as $d) {
        if ($d['parent'] == $parent) {
            $children = buildTree($data, $d['id']);
            // set a trivial key
            if (!empty($children)) {
                $d['_children'] = $children;
            }
            $tree[] = $d;
        }
    }
    return $tree;
}

function printTree($tree, $r = 0, $p = null,$id=0,$field=array()) {
    foreach ($tree as $i => $t) {
		$selected = '';
		if ($id == $t['id']){
			$selected = 'selected';
		}
        $dash = ($t['parent'] == 0) ? '' : str_repeat('*', $r) .' ';
        printf("\t<option value='%d' %s>%s%s(%s)</option>\n", $t[$field[0]],$selected, $dash, $t[$field[1]],@$t[$field[2]]);
        if ($t['parent'] == 0) {
            // reset $r
            //$r = 0;
        }
		
		
        if (isset($t['_children'])) {
            printTree($t['_children'], $r+1, $t['parent'],$id,$field);
        }
    }
}

function chartTree($TreeArray,$main=true)
{
	$class = $main ? 'organizational-chart' : '';
    echo "<ol class='$class'>";
    foreach($TreeArray as $arr)
    {
		$nama_jabatan = $arr['nama_jabatan'] == null ? $arr['unit_kerja'] : $arr['nama_jabatan'];
		$eselon = "Eselon : ".$arr['eselon'];
		$text = "<table width='100%' border='2' style='border-collapse:collapse;border-color:#fff'><tr><th><h3>".$nama_jabatan."</h3></th></tr><tr><th>$eselon</th></tr></table>";
		if ($main == false){
			$text = "<table width='100%' border='2' style='border-collapse:collapse;border-color:#fff'><tr><th>$nama_jabatan</th><th>B</th><th>K</th><th>+/-</th></tr><tr><td align='center'>$eselon</td><td align='center'>".$arr['jumlah_kebutuhan']."</td><td align='center'>".$arr['jumlah_saat_ini']."</td><td align='center'>".($arr['jumlah_saat_ini']-$arr['jumlah_kebutuhan'])."</td></tr></table>";
		}
		
        echo '<li>';
		echo "<div>". $text ."</div>";
        if(isset($arr['_children'])) 
        {
                chartTree($arr['_children'],false);
        }
		echo '</li>';
    }
    echo '</ol>';
}

function chartTree2($TreeArray,$main=true)
{
	
    echo "<ul>";
    foreach($TreeArray as $arr)
    {
		$nama_jabatan = $arr['nama_jabatan'] == null ? $arr['unit_kerja'] : $arr['nama_jabatan'];
		$eselon = "Eselon : ".$arr['nama_eselon'];
		$text = "<span class='tf-nc'>$nama_jabatan<br>($eselon)</span>";
		
        echo '<li>';
		echo $text;
        if(isset($arr['_children'])) 
        {
                chartTree2($arr['_children'],false);
        }
		echo '</li>';
    }
    echo '</ul>';
}


function listTree($TreeArray,$main=true,$id=0)
{
	
	$class = $main ? 'tree' : '';
	if ($main){
		  echo "<div class='$class'>";
	}
  
	echo "<ul>";
    foreach($TreeArray as $arr)
    {
		$background = $id == $arr['id_anjab'] ? "style='background-color:#ccc'" : "";
		$nama_jabatan = $arr['nama_jabatan'] == null ? $arr['unit_kerja'] : $arr['nama_jabatan'];
		$text = $nama_jabatan;
		
        echo '<li>';
		echo "<a href='#' $background >". $text ."</a>";
        if(isset($arr['_children'])) 
        {
                listTree($arr['_children'],false,$id);
        }
		echo '</li>';
    }
    echo '</ul>';
	if ($main){
		echo '</div>';
	}
}



function tableTree($tree,$parent = 0,$second=false) {
	foreach ($tree as $i => $t) {
		$class= "";
		if ($t['parent'] != $parent){
			$class = "treegrid-parent-".$t['parent'];
		}
		$button = "";
		if (session('role') == 1){
			$button .= '<button class="btn btn-info btn-sm" onclick="loadForm('.$t['id'].')"><i class="fa fa-pencil"></i></button> 
				  <button class="btn btn-danger btn-sm" onclick="deleteData('.$t['id'].')"><i class="fa fa-trash"></i></button>';
		}
		
				  
		if ($t['status_madya'] == 1 && $t['parent'] == 0){
			$button .= '<a href="'.site_url('anjab/form/0/'.$t['id']).'" title="Tambah Jabatan" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>';
		}
		
		if ($t['status_madya'] == 0 && $t['parent'] != 0){
			$button .= '<a href="'.site_url('anjab/form/0/'.$t['id']).'" title="Tambah Jabatan" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>';
		}
		
		
		
		
		printf("\t<tr class='treegrid-%s %s'><td>%s (%s)</td><td>%s</td></tr>\n",$t['id'],$class,$t['unit_kerja'],@$t['eselon'],$button);
		if (isset($t['_children'])) {
            tableTree($t['_children'],$parent,$second);
        }
	}
}



function alert($msg,$type='success')
{
	$result = "new PNotify({
			title: '".ucfirst($type)."',
            text: '$msg',
            type: '$type',
            styling: 'bootstrap3',
			hide:true
        });";
    return $result;
}  

function __($string)
{
	$text = ucfirst(trim(str_replace("_"," ",$string)));
	return str_replace(array('[',']'),'',$text);
}

function master_eselon()
{
	$eselon = array(
		'IIA'=>'IIA',
		'IIB'=>'IIB',
		'IIIA'=>'IIIA',
		'IIIB'=>'IIIB',
		'IVA'=>'IVA',
		'IVB'=>'IVB',
		'VA'=>'VA',
		'Pelaksana'=>'Pelaksana',
		'Fungsional Tertentu' => 'Fungsional Tertentu'
	);
	return $eselon;
}

if (!function_exists('is_countable')) {
   function is_countable($c) {
      return is_array($c) || $c instanceof Countable;
   }
}

