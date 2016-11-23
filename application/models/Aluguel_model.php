<?php
class Aluguel_model extends CI_Model {

    /**
     * 
     * @param string $data
     * @return object
     */
    public function exibirAluguelPorData($data) {
        $this->db->select('al_id_al,
                            al_id_usuario,
                            al_id_ac');

        $this->db->from('aluguel');

        $this->db->where('al_situacao', 'A');
        $this->db->where('al_data', $data);

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) { 
            return $query->result();
            exit();
        }

        return false;
    }

    /**
     * 
     * @return object
     */
    public function exibirTodos() {
        $this->db->select('al_id_al,
                            al_id_usuario,
                            al_id_ac, 
                            al_data,
                            ac_nome');

        $this->db->from('aluguel');

        $this->db->join('areaComum', 'areaComum.ac_id_ac = aluguel.al_id_ac');

        $this->db->where('al_situacao', 'A');

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) { 
            return $query->result();
            exit();
        }

        return false;
    }

    /**
     * 
     * @param araay $dados 
     * @return boolean
     */
    public function inserirAluguel($dados) {

        $res = $this->db->insert('aluguel', $dados);

        return $res;
    }
}

/* End of file Aluguel_model.php */
/* Location: ./application/models/Aluguel_model.php */