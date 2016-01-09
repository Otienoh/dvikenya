<?php
    class Uploads extends MY_Controller 
  {

        function __construct() {
            parent::__construct();
        }


        function index () {
          Modules::run('secure_tings/is_logged_in');
          
          
           $this->load->model('mdl_uploads');

           $data['section'] = "DVI Kenya";
           $data['subtitle'] = "File Manager";
           $data['page_title'] = "Files";
           $data['module'] = "uploads";
           $data['view_file'] = "file_view";
           $data['user_object'] = $this->get_user_object();
           $data['main_title'] = $this->get_title();
           echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
       }




        function do_upload() {
          Modules::run('secure_tings/is_logged_in');
            $config['upload_path']='./docs/';
            $config['allowed_types']='pdf|doc|jpg|png|docx';
            $config['max_size']='2048';
            $config['remove_spaces']= TRUE;

            $this->load->library('upload', $config);
                //$this->upload->initialize($config);
                    if ( ! $this->upload->do_upload()) {
                      
                        $this->session->set_flashdata('msg', $this->upload->display_errors());
                        redirect('uploads/index');
                    }
                    else
                    {


                        function get_data_from_post(){
                            $data['region_name']=$this->input->post('region_name', TRUE);
                            $data['region_headquater']=$this->input->post('region_headquater', TRUE);

                            return $data;
                        }

                            $data = $this->upload->data();
                            $mydata = array(
                               'file_name' => $this->input->post('file_name'),
                               'raw_name' => $data["file_name"],
                               'file_type' => $data["file_type"],
                               'full_path' => $data["full_path"], 
                               'published' => $this->input->post('published'),
                               'purpose' => $this->input->post('purpose'),
                               'owner' => ($this->session->userdata['logged_in']['user_fname']),
                               'upload_date' => date('Y-m-d')   
                               );
                            $this->load->model('mdl_uploads');
                            $this->mdl_uploads->add_uploads($mydata);
                            $data = array('upload_data' => $this->upload->data());
                            $this->session->set_flashdata('msg','<div id="alert-message" class="alert alert-success text-center">File uploaded successfully!</div> ');
                            redirect('uploads/list_files', 'refresh');
                }
        }


        function list_files() {
            Modules::run('secure_tings/is_logged_in');
            $this->load->model('mdl_uploads');
            $this->load->library('pagination');
            $this->load->library('table');
            $config['base_url'] = base_url().'/uploads/index';
            //$config['total_rows'] = $this->mdl_uploads->get_files();
            $config['total_rows'] = $this->mdl_uploads->get('id')->num_rows;
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
                  // $data['query'] = $this->mdl_county->get('id', $config['per_page'], $this->uri->segment(3));
            $data['files'] = $this->db->get('m_uploads', $config['per_page'], $this->uri->segment(3));
                   //$this->load->view('display', $data);
            $data['section'] = "DVI Kenya";
            $data['subtitle'] = "File Manager";
            $data['page_title'] = "Files";
            $data['module'] = "uploads";
            $data['view_file'] = "list_view";
            $data['user_object'] = $this->get_user_object();
            $data['main_title'] = $this->get_title();
            echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
        }


        function download_file($file_name){
          Modules::run('secure_tings/is_logged_in');
           $this->load->helper('download');
            $data = file_get_contents('./docs/'.$file_name); // Read the file's contents
            $name = $file_name;

            force_download($name, $data);
        }

        function delete($id){
          Modules::run('secure_tings/is_logged_in');
           $this->load->model('mdl_uploads');
           $this->mdl_uploads->_delete($id);
           redirect('uploads/list_files', 'refresh');
        }

  }