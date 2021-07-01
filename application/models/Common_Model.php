<?php

class Common_Model extends CI_Model
{


      
    
    public function countRow($table,$column1,$column1_data)
    {
        if($column1 == null && $column1_data == null)
        {
            return $this->db->count_all_results($table);
        }
        else{
        return $this->db->where($column1,$column1_data)->count_all_results($table);
        }
    }
    public function updateData($table,$data,$column1,$column1_data,$column2,$column2_data)
    {
        
        
        if($column2 == null && $column2_data == null)
        {
            return  $this->db->where($column1, $column1_data)->update($table,$data);  
        }
        else{
              return $this->db->where($column1, $column1_data)->where($column2,$column2_data)->update($table,$data);
              //print_r($this->db->last_query());
        }
    }
        
    public function deleteData($table,$column1,$column1_data,$column2,$column2_data)
    {
        if($column2 == null && $column2_data == null)
        {
            return  $this->db->where($column1, $column1_data)->delete($table);  
            
            
        }
        else{
            return  $this->db->where($column1, $column1_data)->where($column2,$column2_data)->delete($table);
        }
    }
    
    public function SelectSingleData($column,$email,$table,$status,$scode)
    {

        if($column == null && $email == null && $status == null && $scode == null)
        {
            return  $this->db->get($table)->result();  
        }

        if($status == null && $scode == null)
        {
            return  $this->db->where($column, $email)->get($table)->result();  
        }
        else{
            return  $this->db->where($column, $email)->where($status,$scode)->get($table)->result();
        }
      
    
    }

    public function insertData($table,$data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function updateTable($table,$where,$id,$data)
	{
	  return $this->db->where($where,$id)->update($table,$data);
	}



    //select data with limit
    public function SelectLimitedData($table,$limit,$colForOrder,$order)
    {

         return  $this->db->order_by($colForOrder, $order)->limit($limit)->get($table)->result();
      
    
    }
}
?>