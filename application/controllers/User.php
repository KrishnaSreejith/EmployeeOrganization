<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
                $this->load->helper('form');
                $this->load->library('session');
		$this->load->helper('url');
                $this->load->library('form_validation');
                $this->load->helper('file');
                $this->load->database();
                $this->load->library('user_agent');
		$this->load->model('users_model');
                $this->load->library("pagination");
                $this->perPage = 5; 
                $this->load->library('CSVReader');
	}
 /*pagination - STARTS*/       
public function index(){
        $config['total_rows'] = $this->users_model->getAllEmployeeCount();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';
        if ($config['total_rows'] > 0) {
            $page_number = $this->uri->segment(3);
            if ($page_number > 0) {
                $config['base_url'] = base_url() . 'user/index/';
            } else {
                $config['base_url'] = base_url() . 'user/index/';
            }
            if (empty($page_number))
                $page_number = 1;
            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->users_model->setPageNumber($this->pagination->per_page);
            $this->users_model->setOffset($offset);
            $this->pagination->cur_page = $offset;
            $config['attributes'] = array('class' => 'page-link');
            $this->pagination->initialize($config);
            $data['page_links'] = $this->pagination->create_links();
            $data['employeeInfo'] = $this->users_model->employeeList();
        }
        $this->load->view('employeedetails', $data);
    }
    
    
/*pagination- ENDS*/ 
    
              /*FORM DATA UPLOAD-STARTS*/   
    
 public function savedata()
	{
		if($this->input->post('type')==1)
		{
			$epcode=$this->input->post('epcode');
			$epname=$this->input->post('epname');
			$dept=$this->input->post('dept');
			$dob=$this->input->post('dob');
                        $joining=$this->input->post('joining');
                        $data = array(
			'Employeecode'	=> $epcode,
			'Name' => $epname,
			'Department'	=> $dept,
                        'DateofBirth'	=> $dob,
                        'JoiningDate'	=> $joining,
		);
			$this->users_model->saverecords($data);	
			echo json_encode(array(
				"statusCode"=>200
			));
		} 
	}
        
        /*FORM DATA UPLOAD-ENDS*/
         
 /*CSV FILE IMPORT - STARTS*/ 
    
    
public function import(){
        $data = array();
        $memData = array();
        
        // If import request is submitted//
        if($this->input->post('importSubmit')){
            
            // Form field validation rules//
            
        $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            
            // Validate submitted form data
        if($this->form_validation->run() == true){
        $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                // If file uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
        $this->load->library('CSVReader');
                    
                    // Parse data from CSV file
        $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    // Insert CSV data into database
        if(!empty($csvData)){
        foreach($csvData as $row){ 
        $rowCount++;
                            
                // Prepare data for DB insertion
        $memData =  array(
                           'Name' => $row['Name'],
                           'Employeecode' => $row['Employee code'],
                           'Department' => $row['Department'],
                           'DateofBirth' => $row['Date of Birth'],
                           'JoiningDate' => $row['Joining Date']
                            );
                      
                      
                        
                                // Insert EMPLOYEE data
                                $insert = $this->users_model->insertdata($memData);
                                
                                
                            
                        }
                        
                        // Status message with imported data 
                       
                        $this->session->set_tempdata('success', 'CSV file successfully uploaded!!!!!',2);
                    }
                }else{
                    $this->session->set_tempdata('error_msg', 'Error on file upload, please try again.',2);
                }
            }else{
                $this->session->set_tempdata('error_msg', 'Invalid file, please select only CSV file.',2);
            }
        }
        redirect('user');
    }             
                
                
                
public function file_check($str){
        
    $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }   
    
    
             /*CSV FILE IMPORT - ENDS*/ 
    
    
   
        
    }  
     
     
                  


     
	
                

        
        
