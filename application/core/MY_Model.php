<?php
class MY_Model extends CI_Model{
    protected $tableName= "";
    public $primaryKey = "";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    /*
     * parameter example $where = array('id'=>1,'name'=>'some name')
     *
     */

    public function getAllData($where = array(),$limit=100,$offset=0){
        if (!empty($where)){
            $this->db->where($where);
        }
        if($limit==-1){
            $query = $this->db->get($this->tableName);
        }else{
            $query = $this->db->get($this->tableName,$limit,$offset);
        }
        return $query;
    }

    public function getById($id=null){
        if(empty($id)){
            return FALSE;
        }
        $this->db->where($this->primaryKey,$id);
        $this->db->limit(1);
        return $this->db->get($this->tableName);
    }
	
    public function insert($data){
        $this->db->insert($this->tableName, $data);
		return $this->db->insert_id();
    }
	
    public function update($updates=array(),$where=null){
        if(empty($updates) || empty($where)){
           return FALSE;
        }
        $this->db->update($this->tableName,$updates,$where);
        return ($this->db->affected_rows() > 0);
    }
	
    public function deleteById($id=null){
        if(empty($id)){
            return FALSE;
        }
        $this->db->where($this->primaryKey,$id);
        $this->db->delete($this->tableName);
        return ($this->db->affected_rows() > 0);

    }
}
