<?php

trait DatatableTrait {
	
	
	function _get_datatables_query($select,$join,$where)
    {
        $this->db->select($select)->from($this->table);
		
		if (count($join) > 0){
			foreach($join as $jn){
				$j_type = isset($jn[2]) ? $jn[2] : 'left';
				$this->db->join($jn[0],$jn[1],$j_type);
			}
		}
		
		 $i = 0;
		if (isset($this->column_search)){
			foreach ($this->column_search as $item) // loop column 
			{
				if(isset($_POST['search']['value'])) // if datatable send POST for search
				{
                 
					if($i===0) // first loop
					{
						$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
						$this->db->like($item, $_POST['search']['value']);
					}
					else
					{
						$this->db->or_like($item, $_POST['search']['value']);
					}
 
					if(count($this->column_search) - 1 == $i) //last loop
						$this->db->group_end(); //close bracket
				}
				$i++;
			}
		}
		
		$this->db->where($where);
		
		$this->filter();
		$this->order_by();
        
    }
	
	function order_by()
	{
		if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
	}
	
	function limit_data()
	{
		if($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
	}
	
	function get_datatables($select="*",$join=array(),$where=array())
    {
        $this->_get_datatables_query($select,$join,$where);
        $this->limit_data();
        $query = $this->db->get();
		
		$result['draw'] = intval( $_REQUEST['draw'] );
		$result['recordsFiltered'] = $this->count_filtered($select,$join,$where);
		$result['recordsTotal'] = $this->count_all();
		$result['data'] = $query->result();
		return $result;
    }
	
	function filter()
	{
		$this->db->where(array());
	}
	
	public function count_filtered($select,$join,$where)
    {
        $this->_get_datatables_query($select,$join,$where);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}