<?php

defined('BASEPATH') or exit('No direct script access allowed');

class GeneralModel extends CI_Model
{        
    //Datatable
    private function searchDataTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter)
    {
        $this->db->from($tableName);
        $i = 0;
        foreach ($searchPola as $item) 
        {
            if($this->input->post('search'))//['value'])
            {
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $this->input->post('search')['value']);
                }
                else
                {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }
                if(count($searchPola) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
        
        if(isset($_POST['order'])) 
        {
            foreach($_POST['order'] as $key => $value){'';}
            $this->db->order_by($columnOrder[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);//$columnOrder[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($orderTable))
        {
            $order = $orderTable;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        $customFilter!='' ? $this->db->where($customFilter) : '';
    }    
    
    function getTableData($tableName,$orderTable,$columnOrder,$searchPola,$customFilter)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $this->searchDataTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter);
        $maxLimit= $this->input->post('length')=='' ? 10 : ($this->input->post('length')>500  ? 500 : $this->input->post('length'));
        if($this->input->post('length') != -1)
        $this->db->limit($maxLimit, $this->input->post('start'));
        $query = $this->db->get();
        return $query;
    }
    
    function countFilterTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $this->searchDataTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function countAllTableData($tableName,$customFilter)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $customFilter!='' ? $this->db->where($customFilter) : '';
        $this->db->from($tableName);
        return $this->db->count_all_results();
    }

    //DatatableDateRange
    function getTableDataDateRange($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$dateRange)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $dateRange!='' ? $this->db->where($dateRange) : '';
        $this->searchDataTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter);        
        $maxLimit= $this->input->post('length')=='' ? 10 : ($this->input->post('length')>500  ? 500 : $this->input->post('length'));
        if($this->input->post('length') != -1)
        $this->db->limit($maxLimit, $this->input->post('start'));
        $query = $this->db->get();
        return $query;
    }

    function countFilterTableDateRange($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$dateRange)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $dateRange!='' ? $this->db->where($dateRange) : '';
        $this->searchDataTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    //Datatable Select
    function getTableDataSelect($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$select)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->select($select);
        $this->searchDataTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter);
        $maxLimit= $this->input->post('length')=='' ? 0 : ($this->input->post('length')>500  ? 500 : $this->input->post('length'));
        if($this->input->post('length') != -1)
        $this->db->limit($maxLimit, $this->input->post('start'));
        $query = $this->db->get();
        return $query;
    }
    
    function countFilterTableSelect($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$select)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->select($select);
        $this->searchDataTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function countAllTableDataSelect($tableName,$customFilter,$select)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->select($select);
        $customFilter!='' ? $this->db->where($customFilter) : '';
        $this->db->from($tableName);
        return $this->db->count_all_results();
    }
    //=============
           
    //Datatable Join
    function getTableDataSelectJoin($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$select,$joinTabel)
    {
        $jumJoint = count($joinTabel);
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->select($select);
        $this->searchDataTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter);
        if($joinTabel!='' AND $jumJoint==1){
                $this->db->join(key($joinTabel), $joinTabel[key($joinTabel)]);

        }elseif($jumJoint>1){
            foreach ($joinTabel as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
        $maxLimit= $this->input->post('length')=='' ? 1 : ($this->input->post('length')>100  ? 100 : $this->input->post('length'));
        if($this->input->post('length') != -1)
        $this->db->limit($maxLimit, $this->input->post('start'));
        $query = $this->db->get();
        return $query;
    }
    
    function countFilterTableSelectJoin($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$select,$joinTabel)
    {
        $jumJoint = count($joinTabel);
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->select($select);
        $this->searchDataTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter);
        if($joinTabel!='' AND $jumJoint==1){
                $this->db->join(key($joinTabel), $joinTabel[key($joinTabel)]);

        }elseif($jumJoint>1){
             foreach ($joinTabel as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function countAllTableDataSelectJoin($tableName,$customFilter,$select,$joinTabel)
    {
        $jumJoint = count($joinTabel);
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->select($select);
        $customFilter!='' ? $this->db->where($customFilter) : '';
        if($joinTabel!='' AND $jumJoint==1){
                $this->db->join(key($joinTabel), $joinTabel[key($joinTabel)]);

        }elseif($jumJoint>1){
             foreach ($joinTabel as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
        return $this->db->get($tableName)->num_rows();
        //return $this->db->num_rows();
    }
    //============

      
        
    //CountData
    function countAllData($tableName,$select)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        return $this->db->select($select)->group_by($select)->get($tableName)->num_rows();
    }

    function countWhereData($tableName,$query,$select)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        return $this->db->select($select)->where($query)->get($tableName)->num_rows();
    }
    //=============

    //CRUD
    function saveData($tableName,$data)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        return $this->db->insert($tableName, $data);
    }

    function saveDataIfNotExist($tableName,$data,$query)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        if($this->db->where($query)->get($tableName)->num_rows()>0){
            return false;
        }else{
            return $this->db->insert($tableName, $data);
        }
    }
	
	function saveDataIfExistUpdate($tableName,$data,$query)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        if($this->db->where($query)->get($tableName)->num_rows()>0){
            return $this->db->where($query)->update($tableName, $data);
        }else{
            return $this->db->insert($tableName, $data);
        }
    }
    
    
    function saveDataUpdate($tableName,$data,$query)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        if($this->db->where($query)->get($tableName)->num_rows()>0){
            return $this->db->where($query)->update($tableName, $data);
        }else{
            return $this->db->insert($tableName, $data);
        }
    }
    
    function saveDataDelete($tableName,$query,$data)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->where($query)->delete($tableName);
        return $this->db->insert($tableName, $data);
    }

    function updateDataById($tableName,$where,$update)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        return $this->db->where($where)->update($tableName, $update);
    }

    function updateBatch($tableName,$data,$id)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        return $this->db->update_batch($tableName, $data, $id);
    }

    function updateDataOrWhere($tableName,$where,$orWhere,$update)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $where!='' ? $this->db->where($where) : '';
        $orWhere!='' ? $this->db->or_where($orWhere) : '';
        return $this->db->update($tableName, $update);
    }
    

        
    function delDataById($tableName,$where)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        return $this->db->where($where)->delete($tableName);
    }

    function insertBatchData($tableName,$data)
    {
        $this->db->protect_identifiers($tableName, TRUE); 
        return $this->db->insert_batch($tableName,$data); 
    }  
           
    function insertBatchDeleteData($tableName,$query,$data)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $cek = $this->db->where($query)->get($tableName)->num_rows(); 
        if($cek>0){
            return false;
        }else{
           return $this->db->insert_batch($tableName,$data); 
        }
        
    }  
    
    function insertBatchDelete($tableName,$query,$data)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->where($query)->delete($tableName); 
        return $this->db->insert_batch($tableName,$data); 
    }

    function truncateTable($tableName)
    {
        return $this->db->truncate($tableName);
    }
    //======

    //Get Data Select
    function getDataSelect($tableName,$select)
    {
         $this->db->protect_identifiers($tableName, TRUE);
         return $this->db->select($select)->get($tableName); 
    }

    //Get Data Select Limit
    function getDataSelectLimitWhere($tableName,$select,$query,$order,$limit)
    {
         $this->db->protect_identifiers($tableName, TRUE);
         $select!='' ? $this->db->select($select) : '';
         $query!='' ? $this->db->where($query) : '';
         $order!='' ? $this->db->order_by(key($order), $order[key($order)]) : '';         
         $limit!='' ? $this->db->limit($limit) : '';
         return $this->db->get($tableName); 
    }

    function getDataWhereSelectJoin($tableName,$select,$where,$join)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $select!='' ? $this->db->select($select) : '';
        $where!=''? $this->db->where($where) : '';
         if($join!='' AND count($join)==1){
                $this->db->join(key($join), $join[key($join)]);
        }elseif($join!='' AND count($join)>1){
             foreach ($join as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
        return $this->db->get($tableName); 
    }
    
    function getDataSelectWhereJoinGroupOrder($tableName,$select,$where,$join,$group,$order)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $select!='' ? $this->db->select($select) : '';
         if($join!='' AND count($join)==1){
                $this->db->join(key($join), $join[key($join)]);
        }elseif($join!='' AND count($join)>1){
             foreach ($join as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
        $where!=''? $this->db->where($where) : '';
        $group!='' ? $this->db->group_by($group) : '';
        if($order!=''){ $this->db->order_by(key($order), $order[key($order)]); }
        return $this->db->get($tableName); 
    }
    
    
    
    //Get Data Join Limit
    function getLastDataWhereSelectJoin($tableName,$select,$where,$order,$join,$limit)
    {
         $this->db->protect_identifiers($tableName, TRUE);
         $this->db->select($select)->where($where);
         if($join!='' AND count($join)==1){
                $this->db->join(key($join), $join[key($join)]);

        }elseif($join!='' AND count($join)>1){
             foreach ($join as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
        if($order!=''){ $this->db->order_by(key($order), $order[key($order)]); }
         return $this->db->limit($limit)->get($tableName); 
    }
    
    //Get Data Select Where
    function getDataSelectWhere($tableName,$select,$query)
    {
         $this->db->protect_identifiers($tableName, TRUE);
         return $this->db->where($query)->select($select)->get($tableName); 
    }

    //Get Data Select Like
    function getDataSelectWhereLikeOrLike($tableName,$select,$where,$like,$orLike)
    {
         $this->db->protect_identifiers($tableName, TRUE);
         $this->db->select($select);
         $this->db->where($where);
         $this->db->like($like);
         $jumOr = $orLike!='' ? count($orLike) : 0;
         if($jumOr>0){
             for($i=1;$i<=$jumOr;$i++){
                $this->db->or_like($orLike);
             }
         }       
         return $this->db->get($tableName); 
    }    

    //Get Data Select Like
    function getDataSelectLikeOrLike($tableName,$select,$like,$orLike)
    {
         $this->db->protect_identifiers($tableName, TRUE);
         $this->db->select($select);
         $this->db->like($like);
         $jumOr = $orLike!='' ? count($orLike) : 0;
         if($jumOr>0){
             for($i=1;$i<=$jumOr;$i++){
                $this->db->or_like($orLike);
             }
         }       
         return $this->db->get($tableName); 
    }    
    
    //Get Data Select Where Order Join
    function getDataSelectWhereOrderJoin($tableName,$select,$query,$order,$join)
    {
         $this->db->protect_identifiers($tableName, TRUE);
         $this->db->where($query)->select($select);
        if($join!=''){
            if(count($join)==1){
                $this->db->join(key($join), $join[key($join)]);

            }else{
                foreach ($join as $key => $value) {
                    $this->db->join($key, $value); 
                }
            }
        }

        if($order!=''){
            if(count($order)==1){
                $this->db->order_by(key($order), $order[key($order)]);

            }else{
                foreach ($order as $keyo => $valueo) {
                    $this->db->order_by($keyo, $valueo); 
                }
            }
        }
       
         return $this->db->get($tableName); 
    }

    //Get Data Select Where Order Join Limit
    function getDataSelectWhereOrderJoinLimit($tableName,$select,$query,$order,$join,$limit)
    {
         $this->db->protect_identifiers($tableName, TRUE);
         $this->db->where($query)->select($select);
         if($join!='' AND count($join)==1){
                $this->db->join(key($join), $join[key($join)]);

        }elseif($join!='' AND count($join)>1){
             foreach ($join as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
         return $this->db->order_by(key($order), $order[key($order)])->limit($limit)->get($tableName); 
    }
    
    //Get Data Select Where OR Where Join 
    function getDataSelectWhereOrWhereJoin($tableName,$select,$where,$orWhere,$join)
    {
         $this->db->protect_identifiers($tableName, TRUE);
         $select!='' ? $this->db->select($select) : '';
         $where!='' ? $this->db->where($where) : '';
         $orWhere!='' ? $this->db->or_where($orWhere) : '';

         if($orWhere!=''){
            if(count($orWhere)==1){
                $this->db->join(key($orWhere), $orWhere[key($orWhere)]);

            }elseif(count($orWhere)>1){
                foreach ($orWhere as $key => $value) {
                    $this->db->or_where($key, $value); 
                }
            } 
        }

         if($join!=''){
            if(count($join)==1){
                $this->db->join(key($join), $join[key($join)]);

            }elseif(count($join)>1){
             foreach ($join as $key => $value) {
                $this->db->join($key, $value); 
                }
            }  
        }      
         return $this->db->get($tableName); 
    }
    
    //Get Data Select Where OR Where Order Join Limit
    function getDataSelectWhereOrWhereJoinLimit($tableName,$select,$where,$orWhere,$join,$limit)
    {
         $this->db->protect_identifiers($tableName, TRUE);
         $this->db->select($select)->where($where)->or_where($orWhere);
         if($join!='' AND count($join)==1){
                $this->db->join(key($join), $join[key($join)]);

        }elseif($join!='' AND count($join)>1){
             foreach ($join as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
         return $this->db->limit($limit)->get($tableName); 
    }
    
    //Get Data Select Where Order
    function getDataSelectWhereOrder($tableName,$select,$query,$order)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->select($select)->where($query);
        return $this->db->order_by(key($order), $order[key($order)])->get($tableName); 
    }

    //Get Data Select Where Group
    function getDataSelectWhereGroup($tableName,$select,$query,$group)
    {
        $this->db->protect_identifiers($tableName, TRUE);        
        $select!='' ? $this->db->select($select) : '';
        $query!='' ? $this->db->where($query) : '';
        $group!='' ? $this->db->group_by($group) : '';
        return $this->db->get($tableName); 
    }

    function getDataSelectGroupOrder($tableName,$select,$group,$order)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        return $this->db->select($select)->group_by($group)->order_by(key($order), $order[key($order)])->get($tableName); 
    }
    
    //Get Data Where Order
    function getDataWhereOrder($tableName,$where,$order)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        return $this->db->where($where)->order_by(key($order), $order[key($order)])->get($tableName); 
    }
    
    //Get Data Order
    function getDataOrder($tableName,$order)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        return $this->db->order_by(key($order), $order[key($order)])->get($tableName); 
    }

    //Get Data Order Join
    function getDataOrderJoin($tableName,$where,$order,$join)
    {
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->where($where);
        if($join!='' AND count($join)==1){
                $this->db->join(key($join), $join[key($join)]);

        }elseif($join!='' AND count($join)>1){
             foreach ($join as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
        return $this->db->order_by(key($order), $order[key($order)])->get($tableName); 
    }
    
    
    //datatableApi //$search = $this->input->post('search') , $order = $this->input->post('order'), $this->input->post('length'), $start = $this->input->post('start'); 
    private function searchDataTableApi($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$search,$order)
    {
        $this->db->from($tableName);
        $i = 0;
        foreach ($searchPola as $item) 
        {
            if($search!='')
            {
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $search);
                }
                else
                {
                    $this->db->or_like($item,$search);
                }
                if(count($searchPola) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
        
        if($order!='') 
        {
            $this->db->order_by($this->column_order[$order['0']['column']], $order['0']['dir']);
        } 
        else if(isset($orderTable))
        {
            $order = $orderTable;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        $customFilter!='' ? $this->db->where($customFilter) : '';
    }
    
    function getTableDataSelectJoinApi($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$select,$joinTabel,$search,$order,$length,$start)
    {
        $jumJoint = count($joinTabel);
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->select($select);
        $this->searchDataTableApi($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$search,$order);
        if($joinTabel!='' AND $jumJoint==1){
                $this->db->join(key($joinTabel), $joinTabel[key($joinTabel)]);

        }elseif($jumJoint>1){
            foreach ($joinTabel as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
        $maxLimit= $length=='' ? 10 : ($length>500  ? 500 : $length);
        $this->db->limit($maxLimit, $this->input->post('start'));
        $query = $this->db->get();
        return $query;
    }
    
    function countFilterTableSelectJoinApi($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$select,$joinTabel,$search,$order)
    {
        $jumJoint = count($joinTabel);
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->select($select);
        $this->searchDataTableApi($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$search,$order);
        if($joinTabel!='' AND $jumJoint==1){
                $this->db->join(key($joinTabel), $joinTabel[key($joinTabel)]);

        }elseif($jumJoint>1){
             foreach ($joinTabel as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function countAllTableDataSelectJoinApi($tableName,$customFilter,$select,$joinTabel)
    {
        $jumJoint = count($joinTabel);
        $this->db->protect_identifiers($tableName, TRUE);
        $this->db->select($select);
        $customFilter!='' ? $this->db->where($customFilter) : '';
        if($joinTabel!='' AND $jumJoint==1){
                $this->db->join(key($joinTabel), $joinTabel[key($joinTabel)]);

        }elseif($jumJoint>1){
             foreach ($joinTabel as $key => $value) {
                $this->db->join($key, $value); 
            }
        }
        return $this->db->get($tableName)->num_rows();
    }

}
?>