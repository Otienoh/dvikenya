<?php
class Jobcard extends MY_Controller 
{

function __construct() {
parent::__construct();
Modules::run('secure_tings/ni_met');
}


public function index()
	{
            
            $this->load->model('mdl_jobcard');
            $this->load->library('pagination');
            $this->load->library('table');
            $config['base_url'] = base_url().'/jobcard/index';
            $config['total_rows'] = $this->mdl_jobcard->get('id')->num_rows;
            $config['per_page'] = 10;
            $config['num_links'] = 4;
            $config['full_tag_open'] = '<div><ul class="pagination pagination-small pagination-centered">';
            $config['full_tag_close'] = '</ul></div>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $this->pagination->initialize($config);
            $data['records'] = $this->db->get('m_jobcards', $config['per_page'], $this->uri->segment(3));
            $data['section'] = "Maintenance";
            $data['subtitle'] = "Job Card";
            $data['page_title'] = "Job Card Details";
            $data['module']="jobcard";
            $data['view_file']="list_jobcard_view";
             $data['user_object'] = $this->get_user_object();
           $data['main_title'] = $this->get_title();
           echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data); 
	}
   


function create(){
	         // Modules::run('secure_tings/ni_met');
            $update_id= $this->uri->segment(3);
            $data = array();
            $this->load->model('mdl_jobcard');
            $this->load->model('spareparts/mdl_spareparts');
            
            if (!isset($update_id )){
                $update_id = $this->input->post('update_id', $id);
                 $data['maequipment']  = $this->mdl_spareparts->getequip();
				
            }
            
            if (is_numeric($update_id)){
                $data = $this->get_data_from_db($update_id);
                $data['update_id'] = $update_id;
                 $data['maequipment']  = $this->mdl_spareparts->getequip();
                 $this->session->set_flashdata('Umsg', '<div id="alert-message" class="alert alert-warning text-center">Please Check the Reason for Failure and Tests Administered Sections before Updating !</div>');
								
                
            } else {
				        $data= $this->get_data_from_post();
                 $data['maequipment']  = $this->mdl_spareparts->getequip();
						
            }
            
              $data['section'] = "Maintenance";
              $data['subtitle'] = "Job Card";
              $data['page_title'] = "Cold Chain Maintenance Job Card";
              $data['module'] = "jobcard";
              $data['view_file'] = "create_jobcard_form";
              $data['user_object'] = $this->get_user_object();
              $data['main_title'] = $this->get_title();
              echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
}


function get_data_from_post(){

           $data['user_statiton']=$this->input->post('user_statiton', TRUE);
			     $data['facility']=$this->input->post('facility', TRUE);
           $data['equipment']=$this->input->post('equipment', TRUE);
            $data['serial_id']=$this->input->post('serial_id', TRUE);
           $data['deffect']=$this->input->post('deffect', TRUE);
           $data['actions']=$this->input->post('actions', TRUE);
           
           $data['specific_defect']=$this->input->post('specific_defect', TRUE);

            $data['comments']=$this->input->post('comments', TRUE);
           $data['tech_name']=$this->input->post('tech_name', TRUE);
           $data['tech_initials']=$this->input->post('tech_initials', TRUE);

           
    
          
			        
            return $data;
        }

        function get_data_from_db($update_id){
               $query = $this->get_where($update_id);
               foreach ($query->result() as $row){
                   $data['user_statiton'] = $row->user_statiton;
                   $data['facility'] = $row->facility;
                   $data['equipment'] = $row->equipment;
                   $data['serial_id'] = $row->serial_id;
                   $data['deffect'] = $row->deffect;
                   $data['actions'] = $row->actions;
                   // $data['reason_defects'] = $row->reason_defects;
                   $data['specific_defect'] = $row->specific_defect;
                   // $data['test_administered'] = $row->test_administered;
                   $data['comments'] = $row->comments;
                   $data['tech_name'] = $row->tech_name;
                   $data['tech_initials'] = $row->tech_initials;
                  
               }
            return $data;
        }

          function submit (){
         // Modules::run('secure_tings/ni_met');    
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_statiton', 'User Base Station', 'required|xss_clean');
        $this->form_validation->set_rules('facility', 'Facility Name', 'required|xss_clean');
        $this->form_validation->set_rules('equipment', 'Equipment', 'required|xss_clean');
        $this->form_validation->set_rules('serial_id', 'Serial', 'required|xss_clean');
        $this->form_validation->set_rules('deffect', 'Deffect Description', 'required|xss_clean');
        $this->form_validation->set_rules('actions', 'Action Description', 'required|xss_clean');
        $this->form_validation->set_rules('reason_defects', 'Reasons', 'xss_clean');
        $this->form_validation->set_rules('specific_defect', 'Specific Description', 'xss_clean');
        $this->form_validation->set_rules('test_administered', 'Tests', 'xss_clean');
        $this->form_validation->set_rules('comments', 'Comments', 'xss_clean');
        $this->form_validation->set_rules('tech_name', 'Technician Name', 'required|xss_clean');
        $this->form_validation->set_rules('tech_initials', 'Technician Initial', 'required|xss_clean');
        
       
       
        $update_id = $this->input->post('update_id', TRUE);
        if ($this->form_validation->run() == FALSE)
        {   
                    $this->create();         
        }
        else
        {       
                   $data =  $this->get_data_from_post();
                   $data['created_by'] = $this->session->userdata['logged_in']['user_id'];
                   $matest=$this->input->post('test_administered', TRUE);
                    $mareason = $this->input->post('reason_defects', TRUE);

            $data['reason_defects'] = implode(',',$mareason);
            $data['test_administered'] = implode(',',$matest);
                   // echo "<pre>";
                   // var_dump($data);
                   // die();
                   
                   if(is_numeric($update_id)){
                       $this->_update($update_id, $data);
                       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Jobcard details updated successfully!</div>');
            
                   } else {
                       $this->_insert($data);
                       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">New Jobcard successfully created!</div>');
                   }
                   
                   //$this->session->set_flashdata('success', 'depot added successfully.');
                   redirect('jobcard');
        }
        }

        function delete($id){
           // Modules::run('secure_tings/ni_met');
$this->_delete($id);
$this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">depot details deleted successfully!</div>');
redirect('jobcard');
}


function get($order_by){
$this->load->model('mdl_jobcard');
$query = $this->mdl_jobcard->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_jobcard');
$query = $this->mdl_jobcard->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_jobcard');
$query = $this->mdl_jobcard->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_jobcard');
$query = $this->mdl_jobcard->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_jobcard');
$this->mdl_jobcard->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_jobcard');
$this->mdl_jobcard->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_jobcard');
$this->mdl_jobcard->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_jobcard');
$count = $this->mdl_jobcard->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_jobcard');
$max_id = $this->mdl_jobcard->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_jobcard');
$query = $this->mdl_jobcard->_custom_query($mysql_query);
return $query;
}

}