<?php
class Fluxo_model extends CI_Model {

    /**
     * 
     * @return object
     */
    public function exibirCountSemanal() {
        $this->db->select('COUNT(*) as contador,
                            fluxo_horario');
        $this->db->group_by('DAY(fluxo_horario)');
        $this->db->group_by('MONTH(fluxo_horario)');
        $this->db->group_by('YEAR(fluxo_horario)');

        $this->db->from('fluxo');

        $this->db->order_by('fluxo_horario', 'DESC');
        $this->db->limit(7);

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
    public function exibirCountQuinzenal() {
        $this->db->select('COUNT(*) as contador,
                            fluxo_horario');
        $this->db->group_by('DAY(fluxo_horario)');
        $this->db->group_by('MONTH(fluxo_horario)');
        $this->db->group_by('YEAR(fluxo_horario)');

        $this->db->from('fluxo');

        $this->db->order_by('fluxo_horario', 'DESC');
        $this->db->limit(15);

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
    public function inserirFluxo($dados) {

        $res = $this->db->insert('fluxo', $dados);

        return $res;
    }

}

/* End of file Fluxo_model.php */
/* Location: ./application/models/Fluxo_model.php */