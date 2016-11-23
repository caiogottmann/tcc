<?php
class Visitante_model extends CI_Model {

	/**
	 * 
	 * @param araay $data 
	 * @return boolean
	 */
	public function inserirVisitante($data) {

        $res = $this->db->insert('visitante', $data);

        return $res;
    }

    public function exibirVisitante() {

         $this->db->select('vis_id_vis, 
         					usuario_nome,
         					vis_nome, 
         					vis_cpf, 
         					vis_rg, 
         					vis_data');

        $this->db->from('visitante');

        $this->db->join('usuario', 'usuario.usuario_id_usuario = visitante.vis_id_usuario'); 

        $this->db->order_by("vis_data", "ASC"); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) {
            return $query->result();
            exit();
        }
        
        return false;
    }

}

/* End of file Funcionario_model.php */
/* Location: ./application/models/Funcionario_model.php */