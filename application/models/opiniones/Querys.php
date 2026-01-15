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
    function querysOpinionesView()
    {
        //---A)

        $this->db->select('*');
        $this->db->where('activo', 'true');
        $this->db->where('u_id_advance',$_GET['id']);
        $this->db->from('opiniones');

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
    function querysOpinionesOnlyView()
    {
        $this->db->trans_start();

        // SELECT
        $this->db->select('opiniones.id,opiniones.activo');
        $this->db->from('opiniones');
        $this->db->where ('d3', $this->input->get('querty', TRUE));
        $this->db->where('activo', 'true');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            $row = $query->row();

            // UPDATE contador
            $this->db->set('count', 'count + 1', FALSE);
            $this->db->where('id', $row->id);
            $this->db->update('opiniones');

            $this->db->trans_complete();
            $row->activo = 'True';
            $row->x      = $this->input->get('querty', TRUE);

            return ['data' => $row,];
                $this->db->trans_complete();
        }else{
            return [
                'data' => (object) [
                    'activo' => 'false',
                    'x' => $this->input->get('querty', TRUE)
                ]
            ];
        }
    }
    //--->

    //--->
    function querysOpinionesNew()
    {
        $data = array(
            'id_advance'  => "P-" . random_string('sha1', 20),
            'time'        => date("Y-m-d H:m:s"),
            'activo'      => "true",
            'permissions' => $this->input->post('permissions'),
            'u_id_advance'          => $this->input->post('d0'),
            'd1'          => $this->input->post('d1'),
            'd2'          => $this->input->post('d2'),
            'd3'          => $this->input->post('d3'),  
            'd4'          => $this->input->post('d4'),
            'd5'          => $this->input->post('d5'),
            'd6'          => $this->input->post('d6')
        );

        $this->db->insert('opiniones', $data);

        $status =  array(
            'code'  => "opiniones new",
            'value' => "True"
        );
        return    $status;
    }
    //--->

    //--->
    function querysOpinionesUpdate()
    {

        //$user = $this->input->post('user');

            $data = array(
                'd1'          => $this->input->post('d1'),
                'd2'          => $this->input->post('d2'),
                'd3'          => $this->input->post('d3'),  
                'd4'          => $this->input->post('d4'),
                'd5'          => $this->input->post('d5'),
                'd6'          => $this->input->post('d6')
            );

        $this->db->where('id_advance', $this->input->post('id_advance'));
        $this->db->update('opiniones', $data);

        $status =  array(
            'code'  => "User Update",
            'value' => "True"
        );

        return    $status;
    }
    //--->

    //--->
    function querysOpinionesDelete()
    {
        //$opiniones = $this->input->post('user');
        $data = array(
            'activo'        => 'false'
        );
        $this->db->where('id_advance', $this->input->post('id_advance'));
        $this->db->update('opiniones', $data);

        $status =  array(
            'code'  => "opiniones Update",
            'value' => "True"
        );

        return    $status;
    }
    //--->
}
/* End of file database.php */