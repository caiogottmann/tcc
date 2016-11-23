<?php
class Pagina_model extends CI_Model {

    public function exibirPaginaById($id) {
        $this->db->select('pags_id_pags,
                            pags_nome,
                            pags_apelido,
                            pags_situacao');

        $this->db->from('pagina');

        $this->db->where('pags_id_pags', $id); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() == 1) { 
            return $query->row();
            exit();
        }

        return false;
    }

    public function exibirTodosAtivos() {
        $this->db->select('pags_id_pags,
                            pags_nome,
                            pags_apelido');

        $this->db->from('pagina'); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) { 
            return $query->result();
            exit();
        }

        return false;
    }

    public function alterarGrupo($id, $texto){
        $data = array('gp_users' => $texto);

        $this->db->where('gp_id_gp', $id);
        $res = $this->db->update('grupo', $data);

        return $res;
    }

    public function exibirgrupoById($id) {
        $this->db->select('gp_id_gp,
                            gp_grupo,
                            gp_id_pags,
                            gp_users');

        $this->db->from('grupo');

        $this->db->where('gp_id_gp', $id); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() == 1) { 
            return $query->row();
            exit();
        }

        return false;
    }


    public function inserirNoGrupo($id, $texto){
        $data = array('gp_users' => $texto);

        $this->db->where('gp_id_gp', $id);
        $res = $this->db->update('grupo', $data);

        return $res;
    }

    public function retiraDoLogin($id){
        $data = array('login_pags' => '');

        $this->db->where('login_id_login', $id);
        $res = $this->db->update('login', $data);

        return $res;
    }

    public function inserirnoLogin($id, $texto){
        $data = array('login_pags' => $texto);

        $this->db->where('login_id_login', $id);
        $res = $this->db->update('login', $data);

        return $res;
    }



}

/* End of file Pagina_model.php */
/* Location: ./application/models/Pagina_model.php */