<?php
trait QueryBuilder{
    public $tableName='';
    public $where='';
    public $operator='';
    public $selectField='*';
    public $limit='';
    public $orderBy='';
    public $innerJoin='';
    public $count=false;

    public function table($tableName){
        $this->tableName=$tableName;
        return $this;
    }

    
    public function where($field,$compare,$value){
        if(empty($this->where)){
            $this->operator='WHERE';
        }else{
            $this->operator=' AND';
        }
        $this->where.= "$this->operator $field $compare '$value'";
        return $this;
    }

    public function select($field='*'){
        $this->selectField = $field;
        return $this;

    }
    public function orWhere($field,$compare,$value){
        if(empty($this->where)){
            $this->operator='WHERE';
        }else{
            $this->operator=' OR';
        }
        $this->where.= "$this->operator $field $compare '$value'";
        return $this;
    }


    public function whereLike($field, $value) {
        if (empty($this->where)) {
            $this->operator = 'WHERE';
        } else {
            $this->operator = ' AND';
        }

        $this->where = trim($this->where);
    
        // Kiểm tra xem điều kiện WHERE đã tồn tại hay chưa
        if (empty($this->where)) {
            $this->where .= "$this->operator $field LIKE '$value'";
        } else {
            $this->where .= " $this->operator $field LIKE '$value'";
        }
        return $this;
    }
    
    // 50 
    // 0, 10 ;
    // 10, 10 ;
    public function limit($number,$offset=0){
        $this->limit='LIMIT '.$offset.', '.$number.' ';
        return $this;
    }

    //OrderBy 
    public function orderBy($field,$type ='ASC'){
        $arrField=array_filter(explode(',',$field));
        if(!empty($arrField) && count($arrField)>=2){
            //sql orderby
            $this->orderBy='ORDER BY'.implode(', ',$arrField);
        }else{
            $this->orderBy='ORDER BY '.$field.' '.$type;
        }
        return $this;
    }
    //inner join
    public function join($tableName,$relationShip){
        $this->innerJoin.=' INNER JOIN '.$tableName.' ON '.$relationShip.' ';
        return $this;
    }

    public function insert($data){
        $tableName=$this->tableName;
        $insertStatus=$this->insert_db($tableName,$data);
        return $insertStatus;
    }
    public function lastId(){
        return $this->lastInsertId();
    }
    public function update($data){
        $whereUpdate=str_replace('WHERE',' ',$this->where);
        $whereUpdate=trim($whereUpdate);
        $tableName=$this->tableName;
        $statusUpdate=$this->update_db($tableName,$data,$whereUpdate);
        return $statusUpdate;
    }
    public function delete(){
        $whereDelete=str_replace('WHERE',' ',$this->where);
        $whereDelete=trim($whereDelete);
        $tableName=$this->tableName;
        $statusDelete=$this->delete_db($tableName,$whereDelete);
        return $statusDelete;
    }

    public function count(){
        $count=true;
        if($count){
            $this->selectField = 'COUNT(*) as count';
        }
        return $this;
    }
    public function getValue(){
        $sqlQuey="SELECT $this->selectField FROM $this->tableName $this->innerJoin  $this->where $this->limit $this->orderBy";
        $sqlQuey=trim($sqlQuey);
        $query=$this->query($sqlQuey);
        //reset
        $this->resetQuery();
        if(!empty($query)){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    // select * or '' form  'table' where id = 1....;
    public function first(){
        $sqlQuey="SELECT $this->selectField FROM $this->tableName $this->where $this->limit";
        $query=$this->query($sqlQuey);
        //reset
        $this->resetQuery();
        if(!empty($query)){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    public function showError($mess){
        App::$app->loadError('database', ['mess'=>$mess]);
    }
    public function resetQuery(){
        $this->tableName='';
        $this->where='';
        $this->operator='';
        $this->selectField='*';
        $this->limit='';
        $this->orderBy='';
        $this->count=false;
    }
    
}