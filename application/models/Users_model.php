<?php

class Users_model extends CI_Model {
            
            private $_limit;
            private $_pageNumber;
            private $_offset;
             
            function __construct(){
	    parent::__construct();
            $this->load->database();
		}
                
   
public function saverecords($data)
	{
	$query = $this->db->insert('employee_info',$data);
        
	return $query;
	}
    
    
    /*
     * Insert Employee data into the database
     * @param $data data to be insert based on the passed parameters
     */
public function insertdata($data = array()) {
      
        $insert = $this->db->insert("employee_info", $data);  
        // Return the status
        return $insert?$this->db->insert_id():false;
        return false;
    }
  
public function insert_csv($data) {
    
        $this->db->insert('employee_info', $data);
    }

public function setPageNumber($pageNumber) {
    
        $this->_pageNumber = $pageNumber;
    }
 
public function setOffset($offset) {
    
        $this->_offset = $offset;
    }
    
    
// Count all record of table "employee_info" in database.
public function getAllEmployeeCount() {
        $this->db->from('employee_info');
        
        return $this->db->count_all_results();
    }
    
  // Fetch data according to per_page limit.
  public function employeeList() {       
        $this->db->select(array('Name', 'Employeecode', 'Department', 'DateofBirth', 'JoiningDate'));
        $this->db->from('employee_info');          
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        return $query->result_array();
    }
	
    
  }
?>