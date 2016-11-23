<?php
class Estado_model extends CI_Model {

    /**
     * 
     * @return object
     */
    public function exibirEstados() {
        $this->db->select('estado_id_estado,
                            estado_nome,
                            estado_sigla');

        $this->db->from('estado');

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) { 
            return $query->result();
            exit();
        }

        return false;
    }
}

/* End of file Estado_model.php */
/* Location: ./application/models/Estado_model.php */