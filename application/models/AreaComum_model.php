<?php
class AreaComum_model extends CI_Model {

    /**
     * 
     * @return object
     */
    public function exibirTodasAreasLivresNoDia() {
        $this->db->select('ac_id_ac,
                            ac_nome');

        $this->db->from('areaComum');

        $this->db->where('ac_situacao', 'A');

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) { 
            return $query->result();
            exit();
        }

        return false;
    }

    /**
     * 
     * @param array $datas
     * @return object
     */
    public function exibirAreasLivresNoDia($datas) {
        $this->db->select('ac_id_ac,
                            ac_nome');

        $this->db->from('areaComum');

        $this->db->where('ac_situacao', 'A');
        $this->db->where_not_in('ac_id_ac', $datas);

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) { 
            return $query->result();
            exit();
        }

        return false;
    }

    public function verificarPendentes($id) {
        $this->db->select(' al_id_al,
                            COUNT(al_id_al) as total,
                            usuario.usuario_nome,
                            areaComum.ac_nome,
                            al_id_usuario,
                            al_id_ac,
                            al_data,
                            al_situacao');

        $this->db->from('aluguel');

         $this->db->join('areaComum', 'areaComum.ac_id_ac = aluguel.al_id_ac');
          $this->db->join('usuario', 'usuario.usuario_id_usuario = aluguel.al_id_usuario');

        $this->db->where('al_situacao', 'P'); 


        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) {
            return $query->result();
            exit();
        }
        
        return false;
    }

    public function cancelarAluguel($id){
        $data = array('al_situacao' => 'I');

        $this->db->where('al_id_al', $id);
        $res = $this->db->update('aluguel', $data);

        return $res;
    }

    public function confirmarAluguel($id){
        $data = array('al_situacao' => 'A');

        $this->db->where('al_id_al', $id);
        $res = $this->db->update('aluguel', $data);

        return $res;
    }
}

/* End of file AreaComum_model.php */
/* Location: ./application/models/AreaComum_model.php */