<?php
class Notificacao_model extends CI_Model {

	
    public function exibirNotificacaoCorreio($id) {
        $this->db->select(' COUNT(correio_id_correio) as total,
                            correio_data');

        $this->db->from('correio');

        $this->db->where('correio_situacao', 'P'); 
        $this->db->where('correio_id_usuario', $id); 


        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) {
            return $query->result();
            exit();
        }
        
        return false;
    }

    public function exibirNotificacaoAluguel($id) {
        $this->db->select(' al_id_al,
                            COUNT(al_id_al) as total,
                            al_id_usuario,
                            usuario.usuario_nome,
                            areaComum.ac_nome,
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

    public function exibirNotificacaoAluguelAI($id) {


        $this->db->select(" al_id_al,
                            al_id_usuario,
                            areaComum.ac_nome,
                            al_id_ac,
                            DATE_FORMAT(al_data, '%d/%m/%Y') as al_data,
                            al_situacao");

        $this->db->from('aluguel');

         $this->db->join('areaComum', 'areaComum.ac_id_ac = aluguel.al_id_ac');

        $where =  "al_data >= now() and al_id_usuario = ".$id;

        $this->db->where($where); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) {
            return $query->result();
            exit();
        }
        
        return false;
    }


}

/* End of file Cookie_model.php */
/* Location: ./application/models/Cookie_model.php */