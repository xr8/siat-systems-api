<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 *
 *
 *
 **/

class Querys extends CI_Model
{

    //--->
    function querysPacientesView()
    {
        //---A)

        $this->db->select('
            `pacientes`.id,
            `pacientes`.id_advance,
            `pacientes`.time,
            `pacientes`.activo,
            `pacientes`.permissions,
            `pacientes`.email,
            `pacientes`.firstname,
            `pacientes`.secondname,
            `pacientes`.telefono
            ');
        $this->db->where('activo', 'true');
        $this->db->from('pacientes');

        $query = $this->db->get();
        $row = $query->row_array();
        //---A)

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $row->Message = "Datasuccessful";
                $data[] = $row;
            }
            return $data;
        }
    }
    //--->
    
    //--->
    function querysPacienteOnlyView()
    {
        //---A)

        $this->db->select('
            `pacientes`.id,
            `pacientes`.id_advance,
            `pacientes`.time,
            `pacientes`.activo,
            `pacientes`.permissions,
            `pacientes`.email,
            `pacientes`.firstname,
            `pacientes`.secondname,
            `pacientes`.telefono
            ');

            $this->db->where('id_advance',$_GET['querty']);
            $this->db->where('activo', 'true');
        $this->db->from('pacientes');

        $query = $this->db->get();
        $row = $query->row_array();
        //---A)

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $token = $this->input->get_request_header('Authorization', TRUE);
                
                $row->Token   = $token;
                $row->Message = "Datasuccessful";

                $data[] = $row;
            }
            return $data;
        }
    }
    //--->

    //--->
    function querysConsultasNew()
    {

        $data = array(
            'id_advance' => "cons-" . random_string('sha1', 15),
            'time'       => date("Y-m-d H:m:s"),

            'ef_ta'      => $_POST['ef_ta'],
            'ef_fc'      => $_POST['ef_fc'],
            'ef_t'       => $_POST['ef_t'],
            'ef_p'       => $_POST['ef_p'],
            'ef_a'       => $_POST['ef_a'],
            'ef_imc'     => $_POST['ef_imc'],

            'ht_a'       => $_POST['ht_a'],
            'ht_t'       => $_POST['ht_t'],
            'ht_d'       => $_POST['ht_d'],

            'con_mc'     => $_POST['con_mc'],
            'con_ea'     => $_POST['con_ea'],
            'con_aea'    => $_POST['con_aea']
        );

        $this->db->insert('consulta', $data);

        $status =  array(
            'code'  => "consultas new",
            'value' => "True"
        );
        return    $status;
    }
    //--->

    //--->
    function querysPacientesUpdate()
    {

        $user = $this->input->post('user');

            $data = array(
                'email'       => $this->input->post('email'),
                'firstname'   => $this->input->post('first'),
                'secondname'  => $this->input->post('second'),
                'telefono'    => $this->input->post('tel')
            );

        $this->db->where('id_advance', $this->input->post('id_advance'));
        $this->db->update('pacientes', $data);

        $status =  array(
            'code'  => "User Update",
            'value' => "True"
        );

        return    $status;
    }
    //--->

    //--->
    function querysPacientesDelete()
    {
        $pacientes = $this->input->post('user');
        $data = array(
            'activo'        => 'false'
        );

        $this->db->where('id_advance', $this->input->post('id_advance'));
        $this->db->update('pacientes', $data);

        $status =  array(
            'code'  => "pacientes Update",
            'value' => "True"
        );

        return    $status;
    }
    //--->
}
/* End of file database.php */