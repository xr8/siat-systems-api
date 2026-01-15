<?php
class Opiniones extends CI_Controller
{
    //----->

    //--->
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->default = $this->load->database('default', TRUE);
        $this->load->model('opiniones/Querys');
    }
    //--->

    //--->
    public function index()
    {
    }
    //--->

    //---> C
    public function opinionesNew()
    {
        if (
            empty($this->input->post('permissions'))/* ||
            empty($this->input->post('email')) ||
            empty($this->input->post('first')) ||
            empty($this->input->post('second')) ||
            empty($this->input->post('tel'))*/
        ) {
            $xr8_data =  array('code' => 'user new', 'value' => False);
        } else {
            $xr8_data = $this->Querys->querysOpinionesNew();
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($xr8_data));
    }
    //--->

    //---> R
    /*
    run first
    */
    public function opinionesView()
    {
        if (empty($_GET['querty'])) {
            $xr8_data   = $this->Querys->querysOpinionesView();
        } else {
            //$token = $this->input->get_request_header('Authorization', TRUE);
            $xr8_data   = $this->Querys->querysOpinionesOnlyView();
            // $xr8_data =array_merge($xr8_data, array('token' => $token));
            $xr8_data = array_merge($xr8_data);
        }

        if ($xr8_data === null) {
            $xr8_data = "No se encontraron datos.";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($xr8_data));
    }
    //--->

    //---> U
    public function opinionesUpdate()
    {

        if (
            empty($this->input->post('id_advance'))
        ) {
            $xr8_data =
                array(
                    'code' => 'Opiniones Update',
                    'value' => False
                );
        } else {
            $xr8_data = $this->Querys->querysOpinionesUpdate();
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($xr8_data));
    }
    //--->

    //---> D
    public function opinionesDelete()
    {
        if (
            empty($this->input->post('id_advance'))
        ) {
            $xr8_data =
                array(
                    'code' => 'Opiniones Delete',
                    'value' => False
                );
        } else {
            $xr8_data = $this->Querys->querysOpinionesDelete();
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($xr8_data));
    }
    //--->

    //----->
}