<?php

class DB 
{    
    
    //Migration===
    public static function createDatabase($dbName)
    {   
        $CI = getInstance();
        $CI->load->dbforge();        
        return $CI->dbforge->create_database($dbName,TRUE);
    }

    /*
    ALL PRIVILEGES : The user account has full access to the database
    INSERT : The user can insert rows into tables
    DELETE : The user can remove rows from tables
    CREATE : The user can create entirely new tables and databases
    DROP : The user can drop (remove) entire tables and databases
    SELECT : The user gets access to the select command, to read the information in the databases
    UPDATE : The user can update table rows
    GRANT OPTION : The user can modify other user account privileges
    */

    public static function createUserDb($dbName,$userName,$Privilages)
    {
        
        $createUser =  $CI->db->query("CREATE USER '$userName'@'localhost' IDENTIFIED BY 'password'");
        $CI->db->query("GRANT $Privilages ON $dbName.* TO '$userName'@'localhost'");
        return  $CI->db->query("FLUSH PRIVILEGES");
    }
    
    public static function grantUserDbPrivilages($dbName,$userName,$Privilages)
    {
        $CI = getInstance();
        $CI->db->query("GRANT $Privilages ON $dbName.* TO '$userName'@'localhost'");
        return  $CI->db->query("FLUSH PRIVILEGES");
    }

    public static function revokeUserDbPrivilages($dbName,$userName,$Privilages)
    {
        $CI = getInstance();
        $CI->db->query("REVOKE $Privilages ON $dbName.* FROM '$userName'@'localhost'");
        return  $CI->db->query("FLUSH PRIVILEGES");
    }  

    public static function dropUserDb($userName)
    {
        $CI = getInstance();
        return  $CI->db->query("DROP USER '$userName'@'localhost'");
    }

    
    public static function dropDatabase($dbName)
    {   
        $CI = getInstance();
        $CI->load->dbforge();
        return $CI->dbforge->drop_database($dbName);
    }

    

    public static function backupDatabase($pathBackUp,$fileName)
    {        
        $CI = getInstance();
        $namaFile = $fileName.'-'.time();
        $prefs = array(
            'tables'        => array(), 
            'ignore'        => array(), 
            'format'        => 'zip',  
            'filename'      => $namaFile.'.sql', 
            'add_drop'      => TRUE, 
            'add_insert'    => TRUE, 
            'newline'       => "\n"
        );
        $CI->load->dbutil();
        $backup = $CI->dbutil->backup($prefs);
        $CI->load->helper('file');
        write_file($pathBackUp.'/'.$namaFile.'.zip', $backup);
    }

    public static function optimizeDatabase()
    {
        $CI = getInstance();
        $CI->load->dbutil();
        return $CI->dbutil->optimize_database();
    }

    public static function exportTableToCsv($query)
    {        
        $CI = getInstance();
        $CI->load->dbutil();
        $data = $CI->db->query($query);
        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';
        return $CI->dbutil->csv_from_result($data, $delimiter, $newline, $enclosure);
    }

    public static function optimizeTable($tableName)
    {
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName; 
        $CI->load->dbutil();         
        return $CI->dbutil->optimize_table($table);
    }

    public static function createTable($tableName,$arrayField,$keyId)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName; 
        $CI->load->dbforge();
        return $CI->dbforge->add_field($arrayField)->add_key($keyId, true)->create_table($table,TRUE);
    }

    public static function isExistTable($tableName)
    {
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;        
        return $CI->generalModel->isExistTable($table);
    }

    public static function addSingleIndexTable($tableName,$indexName,$ColumnName)
    {
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName; 
        $CI->load->dbforge();
        $sql = "CREATE INDEX $indexName ON $table($ColumnName)";
        return $CI->db->query($sql);
    }

    public static function addMultipleIndexTable($tableName,$multipleColumnName)
    {
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;
        $CI->load->dbforge();
        return $CI->db->query("ALTER TABLE $table ADD INDEX($multipleColumnName)");
    }

    public static function addColumn($tableName,$Column,$After)
    {        
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;
        $CI->load->dbforge();
        return $CI->dbforge->add_column($table, $Column,$After);
    }

    public static function renameTable($oTable,$nTable)
    {   
        $CI = getInstance();
        $oldTable = $CI->config->item('db_prefix').$oTable;
        $newTable = $CI->config->item('db_prefix').$nTable;
        $CI->load->dbforge();
        return $CI->dbforge->rename_table($oldTable,$newTable);
    }

    public static function dropTable($tableName)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;
        $CI->load->dbforge();
        return $CI->dbforge->drop_table($table,TRUE);
    }
    //==========

    
    //QuerySql
    public static function querySql($query)
    {   
        $CI = getInstance();
        return $CI->db->query($query);
    }
    //======

    //Datatable 
    public static function getTableData($tableName,$orderTable,$columnOrder,$searchPola,$customFilter)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;        
        return $CI->generalModel->getTableData($table,$orderTable,$columnOrder,$searchPola,$customFilter);
    }
    
    public static function countFilterTable($tableName,$orderTable,$columnOrder,$searchPola,$customFilter)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;        
        return $CI->generalModel->countFilterTable($table,$orderTable,$columnOrder,$searchPola,$customFilter);
    }
 
    public static function countAllTableData($tableName,$customFilter)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;        
        return $CI->generalModel->countAllTableData($table,$customFilter);
    }
    
    //Datatable DateRange
    public static function getTableDataDateRange($tableName,$orderTable,$columnOrder,$searchColoumn,$customFilter,$dateRange)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;        
        return $CI->generalModel->getTableDataDateRange($table,$orderTable,$columnOrder,$searchColoumn,$customFilter,$dateRange);
    }
    
    public static function countFilterTableDateRange($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$dateRange)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;        
        return $CI->generalModel->countFilterTableDateRange($table,$orderTable,$columnOrder,$searchPola,$customFilter,$dateRange);
    }
    
    //Datatable Select
    public static function getTableDataSelect($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$select)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;        
        return $CI->generalModel->getTableDataSelect($table,$orderTable,$columnOrder,$searchPola,$customFilter,$select);
    }
    
    public static function countFilterTableSelect($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$select)
    {   
        $CI = getInstance(); 
        $table = $CI->config->item('db_prefix').$tableName;       
        return $CI->generalModel->countFilterTableSelect($table,$orderTable,$columnOrder,$searchPola,$customFilter,$select);
    }
 
    public static function countAllTableDataSelect($tableName,$customFilter,$select)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->countAllTableDataSelect($table,$customFilter,$select);
    }
    //=============
           
    //Datatable Join
    public static function getTableDataSelectJoin($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$select,$joinTabel)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getTableDataSelectJoin($table,$orderTable,$columnOrder,$searchPola,$customFilter,$select,$joinTabel);
    }
    
    public static function countFilterTableSelectJoin($tableName,$orderTable,$columnOrder,$searchPola,$customFilter,$select,$joinTabel)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->countFilterTableSelectJoin($table,$orderTable,$columnOrder,$searchPola,$customFilter,$select,$joinTabel);
    }
 
    public static function countAllTableDataSelectJoin($tableName,$customFilter,$select,$joinTabel)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->countAllTableDataSelectJoin($table,$customFilter,$select,$joinTabel);
    }
    //============

      
        
    //CountData
    public static function countAllData($tableName,$select)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->countAllData($table,$select);
    }

    public static function countWhereData($tableName,$query,$select)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->countWhereData($table,$query,$select);
    }
    //=============

    //CRUD
    public static function saveData($tableName,$data)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->saveData($table,$data);
    }
	
	public static function saveDataIfExistUpdate($tableName,$data,$query)
    {
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->saveDataIfExistUpdate($table,$data,$query);
    }
	
    public static function saveDataUpdate($tableName,$data,$query)
    {
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->saveDataUpdate($table,$data,$query);
    }

    public static function saveDataIfNotExist($tableName,$data,$query)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->saveDataIfNotExist($table,$data,$query);
    }
    
    public static function saveDataDelete($tableName,$query,$data)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->saveDataDelete($table,$query,$data);
    }

    public static function updateDataById($tableName,$where,$update)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->updateDataById($table,$where,$update);
    }

    public static function updateDataOrWhere($tableName,$where,$orWhere,$update)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->updateDataOrWhere($table,$where,$orWhere,$update);
    }

    public static function updateBatch($tableName,$data,$id)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->updateBatch($table,$data,$id);
    }
    
    public static function delDataById($tableName,$where)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->delDataById($table,$where);
    }

    public static function insertBatchData($tableName,$data)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->insertBatchData($table,$data); 
    } 
    
    public static function insertBatchDuplicateIgnore($tableName,$data,$field)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->insertBatchDuplicateIgnore($table,$data,$field); 
    } 
    
           
    public static function insertBatchDeleteData($tableName,$query,$data)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->insertBatchDeleteData($table,$query,$data);        
    }  

    public static function insertBatchDelete($tableName,$query,$data)
    {
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->insertBatchDelete($table,$query,$data); 
    }

    public static function truncateTable($tableName)
    {   $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;
        return $CI->db->truncate($table);
    }
    //======

    //Get Data Select
    public static function getDataSelect($tableName,$select)
    {   $CI = getInstance();   
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelect($table,$select); 
    }

    //Get Data Select Where
    public static function getDataSelectWhere($tableName,$select,$query)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectWhere($table,$select,$query); 
    }

    //Get Data Select Limit
    public static function getDataSelectLimitWhere($tableName,$select,$query,$order,$limit)
    {   $CI = getInstance();   
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectLimitWhere($table,$select,$query,$order,$limit); 
    }
    
    //Get Data Join Limit
    public static function getDataWhereSelectJoin($tableName,$select,$where,$join)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataWhereSelectJoin($table,$select,$where,$join); 
    }

    public static function getLastDataWhereSelectJoin($tableName,$select,$where,$order,$join,$limit)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getLastDataWhereSelectJoin($table,$select,$where,$order,$join,$limit);
    }
    
    public static function getDataSelectWhereJoinGroupOrder($tableName,$select,$where,$join,$group,$order)
    {
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectWhereJoinGroupOrder($table,$select,$where,$join,$group,$order);
    }

    //Get Data Select Like Or LIke
    public static function getDataSelectLikeOrLike($tableName,$select,$like,$orLike)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectLikeOrLike($table,$select,$like,$orLike); 
    }

    public static function getDataSelectWhereLikeOrLike($tableName,$select,$where,$like,$orLike)
    {
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;
        return $CI->generalModel->getDataSelectWhereLikeOrLike($table,$select,$where,$like,$orLike); 
    }
    
    //Get Data Select Where Order Join
    public static function getDataSelectWhereOrderJoin($tableName,$select,$query,$order,$join)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectWhereOrderJoin($table,$select,$query,$order,$join); 
    }

    //Get Data Select Where Order Join Limit
    public static function getDataSelectWhereOrderJoinLimit($tableName,$select,$query,$order,$join,$limit)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectWhereOrderJoinLimit($table,$select,$query,$order,$join,$limit); 
    }
    
    
    //Get Data Select Where OR Where Order Join Limit
    public static function getDataSelectWhereOrWhereJoinLimit($tableName,$select,$where,$orWhere,$join,$limit)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectWhereOrWhereJoinLimit($table,$select,$where,$orWhere,$join,$limit); 
    }
    
    public static function getDataSelectWhereOrWhereJoin($tableName,$select,$where,$orWhere,$join)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectWhereOrWhereJoin($table,$select,$where,$orWhere,$join); 
    }
    
    //Get Data Select Where Order
    public static function getDataSelectWhereOrder($tableName,$select,$query,$order)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectWhereOrder($table,$select,$query,$order); 
    }

    //Get Data Select Where Group
    public static function getDataSelectWhereGroup($tableName,$select,$query,$group)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectWhereGroup($table,$select,$query,$group); 
    }

    public static function getDataSelectGroupOrder($tableName,$select,$group,$order)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataSelectGroupOrder($table,$select,$group,$order); 
    }
    
    //Get Data Where Order
    public static function getDataWhereOrder($tableName,$where,$order)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataWhereOrder($table,$where,$order); 
    }
    
    //Get Data Order
    public static function getDataOrder($tableName,$order)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataOrder($table,$order); 
    }

    //Get Data Order Join
    public static function getDataOrderJoin($tableName,$where,$order,$join)
    {   
        $CI = getInstance();
        $table = $CI->config->item('db_prefix').$tableName;     
        return $CI->generalModel->getDataOrderJoin($table,$where,$order,$join); 
    }
}
?>