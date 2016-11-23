<?php
class Grupo_model extends CI_Model {

    /**
     * 
     * @param string $idUsuario
     * @return object
     */
    public function exibirGrupoByIdUsuario($idUsuario) {

        $this->db->select('gp_id_gp,
                            gp_grupo,
                            gp_id_pags,
                            gp_users');

        $this->db->from('grupo');

        $this->db->where('gp_situacao', 'A');

        $this->db->like('gp_users', $idUsuario.'|'); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() == 1) { 
            return $query->row();
            exit();
        }

        $this->db->like('gp_users', '|'.$idUsuario); 

        $query = $this->db->get(); 
        
        if ($this->db->count_all_results() == 1) { 
            return $query->row();
        }

        $this->db->like('gp_users', '|'.$idUsuario.'|'); 

        $query = $this->db->get(); 
        
        if ($this->db->count_all_results() == 1) {
            return $query->row();
            exit();
        }


        return false;
    }

    /**
     * 
     * @return object
     */
    public function exibirTodosAtivos() {

        $this->db->select('gp_id_gp,
                            gp_grupo,
                            gp_users');

        $this->db->from('grupo');

        $this->db->where('gp_situacao', 'A'); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) { 
            return $query->result();
            exit();
        }

        return false;
    }


    /**
     * 
     * @param int $idUsuario
     * @param int $idGrupo
     * @return object
     */
    public function adicionarUserGrupo($idUsuario, $idGrupo){
        $this->db->select('gp_users');

        $this->db->from('grupo');

        $this->db->where('gp_id_gp', $idGrupo); 

        $query = $this->db->get();
        $users = $query->row()->gp_users;

        $data = array('gp_users' => $users.$idUsuario.'|');

        $this->db->where('gp_id_gp', $idGrupo);
        $res = $this->db->update('grupo', $data);

        return $res;
    }
}

/* End of file Grupo_model.php */
/* Location: ./application/models/Grupo_model.php */