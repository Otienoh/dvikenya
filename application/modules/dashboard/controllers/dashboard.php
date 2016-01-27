<?php
class Dashboard extends MY_Controller 
{

function __construct() {
parent::__construct();
Modules::run('secure_tings/is_logged_in');
// $this->output->enable_profiler(true);

}



function home() {
  Modules::run('secure_tings/is_logged_in');
  $this->output->enable_profiler(true);
  $data['chart'] = $this->get_chart();
  $data['wastage'] = $this->get_wastage();
  $data['mavaccine'] = $this->vaccines();
  $data['coverage'] = $this->get_coverage();
  $data['section'] = "DVI Kenya";
  $data['subtitle'] = "Dashboard";
  $user_level=$this->session->userdata['logged_in']['user_level'];
  $data['page_title'] = "";

   if($user_level!=='1'){
       $data['view_file'] = "dashboard_view";
    } else if($user_level=='1'){
       $data['view_file'] = "national_dashboard_view";
    }else if($user_level=='5'){
       $data['view_file'] = "facility_dashboard_view";
    }

  $data['module'] = "dashboard";
  $data['id'] = ($this->session->userdata['logged_in']['user_id']);
  $data['user_level'] = ($this->session->userdata['logged_in']['user_level']);
  $data['user_object'] = $this->get_user_object();
  $data['main_title'] = $this->get_title();
  echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);

}


function get_chart() {
    $user_id = ($this->session->userdata['logged_in']['user_id']);
    $this->load->model('mdl_dashboard');
    $query = $this->mdl_dashboard->getChart($user_id);
    $json_array=array(); 
    foreach ($query->result() as $row) {
       $data['value'] = (int)$row->Stock_balance;
       $data['label'] = $row->Vaccine;

       array_push($json_array,$data);

    }
        
    return $json_array;
  }


  function get_coverage() {
    $this->load->model('mdl_dashboard');
    $user_id = $this->session->userdata['logged_in']['user_id'];
    $user_level=$this->session->userdata['logged_in']['user_level'];
     if($user_level=='3'){
    $query = $this->mdl_dashboard->get_county_coverage($user_id);
     } else if($user_level=='4'){
    $query = $this->mdl_dashboard->get_subcounty_coverage($user_id);
     }else if($user_level=='5'){
    $query = $this->mdl_dashboard->get_subcounty_coverage($user_id);
     }else if($user_level=='1'){
   $query = $this->mdl_dashboard->get_county_coverage($user_id);
     }
    foreach ($query as $row) {
      $json_array[]= array(
       "label"=>$row->Months,
       "BCG"=>(float)$row->totalbcg,
       "DPT2"=>(float)$row->totaldpt2,
       "DPT3"=>(float)$row->totaldpt3,
       "Measles"=>(float)$row->totalmeasles,
       "OPV"=>(float)$row->totalopv,
       "OPV1"=>(float)$row->totalopv1,
       "OPV2"=>(float)$row->totalopv2,
       "OPV3"=>(float)$row->totalopv3,
       "PCV1"=>(float)$row->totalpcv1,
       "PCV2"=>(float)$row->totalpcv2,
       "PCV3"=>(float)$row->totalpcv3,
       "ROTA1"=>(float)$row->totalrota1,
       "ROTA2"=>(float)$row->totalrota2
       );    
    }
    //echo json_encode($json_array);
    return $json_array;

  }

function get_wastage() {
    $this->load->model('mdl_dashboard');
    $user_id = $this->session->userdata['logged_in']['user_id'];
    $user_level=$this->session->userdata['logged_in']['user_level'];
    
    if($user_level=='3'){
    $query = $this->mdl_dashboard->get_county_wastage($user_id);
    } else if($user_level=='4'){
    $query = $this->mdl_dashboard->get_subcounty_wastage($user_id);
    }else if($user_level=='5'){
    $query = $this->mdl_dashboard->get_facility_wastage($user_id);
    }else if($user_level=='1'){
    $query = $this->mdl_dashboard->get_subcounty_wastage($user_id);
    }
   
    foreach ($query as $row) {
      $json_array= array(
      array( 'value'=>(int)$row->totalbcg, 'label'=>'BCG'),
      array( 'value'=>(int)$row->totalopv,'label'=>'OPV'),
      array( 'value'=>(int)$row->totalpcv, 'label'=>'PCV'),
      array( 'value'=>(int)$row->totaltt, 'label'=>'TT'),
      array( 'value'=>(int)$row->totalvita1, 'label'=>'VITA1'),
      array( 'value'=>(int)$row->totalvita2,'label'=>'VITA2'),
      array( 'value'=>(int)$row->totalvita5, 'label'=>'VITA5'),
      array( 'value'=>(int)$row->totalyellowfev, 'label'=>'YELLOWFEV')
       );

      }
   //echo json_encode($json_array);
   return $json_array;
  }


  function get_linechart() {
    $vaccine = $this->input->post("vaccine");
    $user_id = $this->input->post("id");


    if (!empty($vaccine)){
     if(!empty($user_id))
       echo json_encode ($this->getLineChart($vaccine, $user_id));
    } else{
      echo json_encode ($this->get_chart());
    }
    
  }

function getLineChart($vaccine, $user_id){
    $this->load->model('mdl_dashboard');
    $query = $this->mdl_dashboard->getLineChart($vaccine, $user_id);
    $json_array=array(); 
    foreach ($query as $row) {
       $data['value'] = (int)$row->Stock_balance;
       $data['label'] = $row->Vaccine;

       $json_array[] = $data;

    }
    return $json_array;
    //echo json_encode($json_array);
}


function get_data() {
    $query = $this->getData();
    //var_dump($query);
    $datatable = array();
    $no = $_POST['start'];
    foreach ($query as $data) {
      $no++;
      $row = array();
      $row[] = $data->Months;
      $row[] = (int)$data->Above2yrs;
      $row[] = $data->Above1yr;
     
      $datatable[] = $row;
    }
    
    $output = array(
              "draw" => $_POST['draw'],
              "recordsTotal" => $this->count_all(),
              "recordsFiltered" => $this->count_filtered(),
              "data" => $datatable,
            );
    //output to json format
    echo json_encode($output);
  }


function vaccines(){
    $query = $this->mdl_dashboard->get_vaccine_details();
    $vaccines=array(); 
    foreach ($query->result() as $row) {
       $data['ID'] = (int)$row->ID;
       $data['Vaccine_name'] = $row->Vaccine_name;

       array_push($vaccines,$data);

    }
        
    return $vaccines;
        }


function getData() {
    $this->load->model('mdl_dashboard');
    $query = $this->mdl_dashboard->getDatatable();
    return $query;
    //var_dump($query);
  }

function get($order_by){
$this->load->model('mdl_dashboard');
$query = $this->mdl_dashboard->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_dashboard');
$query = $this->mdl_dashboard->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_dashboard');
$query = $this->mdl_dashboard->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_dashboard');
$query = $this->mdl_dashboard->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_dashboard');
$this->mdl_dashboard->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_dashboard');
$this->mdl_dashboard->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_dashboard');
$this->mdl_dashboard->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_dashboard');
$count = $this->mdl_dashboard->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_dashboard');
$max_id = $this->mdl_dashboard->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_dashboard');
$query = $this->mdl_dashboard->_custom_query($mysql_query);
return $query;
}

function count_all() {
            $this->load->model('mdl_dashboard');
            $query = $this->mdl_dashboard->count_all();
            return $query;
      }

function count_filtered() {
            $this->load->model('mdl_dashboard');
            $query = $this->mdl_dashboard->count_filtered();
            return $query;
      }



}



