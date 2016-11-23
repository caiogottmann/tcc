<?php
class Login_model extends CI_Model {

    /**
     * 
     * @param araay $data 
     * @return boolean
     */
    public function inserirLogin($data) {

        $res = $this->db->insert('login', $data);

        return $res;
    }

    /**
     * 
     * @return string
     */
    public function exibirUltimoId() {

        $this->db->select_max('login_id_login');

        $res = $this->db->get('login');

        return $res->row()->login_id_login;
    }

    /**
     * 
     * @param int $id 
     * @return string
     */
    public function exibirUsuarioById($id) {
        $this->db->select('login_usuario');

        $this->db->from('login');

        $this->db->where('login_id_login', $id); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() == 1) { 
            return $query->row()->login_usuario;
            exit();
        }

        return false;
    }

    /**
     * 
     * @param string $usuario 
     * @param string $senha 
     * @return string
     */
    public function exibirLoginByInput($usuario, $senha) {
        $this->db->select('login_id_login,
                            login_pags,
                            login_id_pags,
                            login_situacao,
                            usuario.usuario_situacao,');

        $this->db->from('login');

        $this->db->join('usuario', 'usuario.usuario_id_login = login.login_id_login');

        $this->db->where('login_usuario', $usuario); 
        $this->db->where('login_senha', $senha);
        $this->db->where('usuario_situacao', 'A');


        $query = $this->db->get(); 

        if (($this->db->count_all_results() == 1) and ($query->row()->login_situacao == 'A')) { 
            return $query->row();
            exit();
        }

        return false;
    }

    /**
     * 
     * @param int $id 
     * @return object
     */
    public function exibirLoginById($id) {
        $this->db->select('login_id_login,
                            login_pags,
                            login_usuario,
                            login_senha,
                            login_situacao');

        $this->db->from('login');

        $this->db->where('login_id_login', $id); 

        $query = $this->db->get(); 

        if (($this->db->count_all_results() == 1) and ($query->row()->login_situacao == 'A')) { 
            return $query->row();
            exit();
        }

        return false;
    }

    /**
     * 
     * @param int $idLogin 
     * @return string
     */
    public function exibirPaginasByIdLogin($idLogin) {
        $this->db->select('login_id_login,
                            login_pags');

        $this->db->from('login');

        $this->db->where('login_id_login', $idLogin); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() == 1) { 
            return $query->row()->login_pags;
            exit();
        }

        return false;
    }

    /**
     * 
     * @param araay $usuarioEmail 
     * @return object
     */
    public function recuperarSenhaByUsuarioEmail($usuarioEmail) {

        $this->db->select('usuario.usuario_id_usuario, 
                            usuario.usuario_email,
                            usuario.usuario_nome');

        $this->db->from('usuario');

        $this->db->join('login', 'login.login_id_login = usuario.usuario_id_login');
        
        $where = "login.login_usuario = '$usuarioEmail' or usuario.usuario_email = '$usuarioEmail' and usuario.usuario_situacao = 'A' and login.login_situacao = 'A'";

        $this->db->where($where);


        $query = $this->db->get();

        
        if ($this->db->count_all_results() == 1) { 

            return $query->row();
            exit();
        }

        return false;

    }

    /**
     * 
     * @param int $id 
     * @param string $senha 
     * @return boolean
     */
    public function updateSenhaById($id, $senha) {
        $data = array('login_senha' => $senha);

        $this->db->where('login_id_login', $id);
        $res = $this->db->update('login', $data);

        return $res;
    }

    public function exibirGrupoIndefinido() {
        $this->db->select('gp_id_gp,
                           gp_grupo,
                           gp_users,
                           gp_situacao');

        $this->db->from('grupo');

        $this->db->where('gp_id_gp', 4); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() == 1) { 
            return $query->row()->login_pags;
            exit();
        }

        return false;
    }
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */