<?php
class Usuario_model extends CI_Model {

    /**
     * 
     * @return string
     */
    public function exibirUltimoId() {

        $this->db->select_max('usuario_id_usuario');

        $res = $this->db->get('usuario');

       return $res->row()->usuario_id_usuario;
    }

    /**
     * 
     * @param int $id 
     * @param string $coluna 
     * @param string $texto 
     * @return boolean
     */
    public function alterarUsuario($id, $coluna, $texto){
        $data = array($coluna => $texto);

        $this->db->where('usuario_id_usuario', $id);
        $res = $this->db->update('usuario', $data);

        return $res;
    }

    /**
     * 
     * @param int $id 
     * @return boolean
     */
    public function excluirUsuarioById($id) {
        $data = array('usuario_situacao' => 'I');

        $this->db->where('usuario_id_usuario', $id);
        $res = $this->db->update('usuario', $data);

        return $res;
    }

    /**
     * 
     * @param int $id_login 
     * @return object
     */
    public function exibirUsuarioByLogin($id_login) {
        $this->db->select('usuario_id_usuario,
                            usuario_nome,
                            usuario_cpf,
                            usuario_rg,
                            usuario_email,
                            usuario_tel,
                            usuario_cel,
                            usuario_id_end,
                            usuario_id_arduino,
                            usuario_id_login');

        $this->db->from('usuario');

        $this->db->where('usuario_id_login', $id_login);
        $this->db->where('usuario_situacao', 'A'); 

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
    public function exibirTodosAtivos() {
        $this->db->select('usuario_id_usuario,
                            usuario_nome,
                            usuario_cpf,
                            usuario_rg,
                            usuario_email,
                            usuario_tel,
                            usuario_cel,
                            usuario_id_end,
                            usuario_id_arduino,
                            usuario_id_login');

        $this->db->from('usuario');

        $this->db->where('usuario_situacao', 'A'); 

        $this->db->order_by("usuario_nome", "ASC"); 

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
    public function exibirCompletoTodosAtivos() {
        $this->db->select('usuario_id_usuario,
                            usuario_nome,
                            usuario_cpf,
                            usuario_rg,
                            usuario_email,
                            usuario_tel,
                            usuario_cel,
                            usuario_id_end,
                            usuario_id_arduino,
                            usuario_id_login,
                            end_rua,
                            end_bairro,
                            end_numero,
                            end_complemento');

        $this->db->from('usuario');

        $this->db->join('endereco', 'endereco.end_id_end = usuario.usuario_id_end');

        $this->db->where('usuario_situacao', 'A'); 

        $this->db->order_by("usuario_nome", "ASC"); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) {
            return $query->result();
            exit();
        }
        
        return false;
    }

    public function exibirNomeLikeNome($nome) {
        $this->db->select('usuario_id_usuario,
                            usuario_nome,
                            usuario_cpf');

        $this->db->from('usuario');

        $this->db->where('usuario_situacao', 'A'); 
        $this->db->like('usuario_nome', $nome, 'after'); 

        $this->db->order_by("usuario_nome", "ASC"); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) {
            return $query->result();
            exit();
        }
        
        return false;
    }

    /**
     * 
     * @param string $idArduino 
     * @return string
     */
    public function exibirIdNomeByIdArduino($idArduino) {
        $this->db->select('usuario_id_usuario,
                            usuario_nome');

        $this->db->from('usuario');

        $this->db->where('usuario_id_arduino', $idArduino); 

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
    public function exibirFuncionariosAstivos() {
        $this->db->select('usuario_id_usuario,
                            usuario_nome,
                            usuario_cpf,
                            usuario_rg,
                            usuario_email,
                            usuario_tel,
                            usuario_cel,
                            usuario_id_end,
                            usuario_id_arduino,
                            usuario_id_login,
                            func_id_func,
                            func_id_tipoFunc,
                            tipofunc_id_tipofunc, 
                            tipofunc_tipo');

        $this->db->from('usuario');

        $this->db->join('funcionario', 'funcionario.func_id_usuario = usuario.usuario_id_usuario');
        $this->db->join('tipofuncionario', 'tipofuncionario.tipofunc_id_tipofunc = funcionario.func_id_tipoFunc');

        $this->db->where('usuario_situacao', 'A'); 
        $this->db->where('func_situacao', 'A'); 

        $this->db->order_by("usuario_nome", "ASC"); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) {
            return $query->result();
            exit();
        }
        
        return false;
    }

    /**
     * 
     * @param array $data 
     * @return boolean
     */
    public function inserirUsuario($data) {

        $res = $this->db->insert('usuario', $data);

        return $res;
    }

    /**
     * 
     * @param string $usuario 
     * @param string $id_login 
     * @return boolean
     */
    public function updateUsuario($usuario, $id_login) {
        $this->db->where('usuario_id_login', $id_login);
        $res = $this->db->update('usuario', $usuario);

        return $res;
    }

    /**
     * 
     * @param string $nome 
     * @param string $cpf 
     * @return object
     */
    public function exibirIdByNomeCpf($nome, $cpf) {
        $this->db->select('usuario_id_usuario');

        $this->db->from('usuario');

        $this->db->where('usuario_nome', $nome);
        $this->db->where('usuario_cpf', $cpf);

        $query = $this->db->get(); 

        if ($this->db->count_all_results() == 1) {
            return $query->result();
            exit();
        }
        
        return false;
    }

    /**
     * 
     * @param string $nome 
     * @param string $cpf 
     * @return string
     */
    public function exibirIdLoginByNomeCpf($nome, $cpf) {
        $this->db->select('usuario_id_login');

        $this->db->from('usuario');

        $this->db->where('usuario_nome', $nome);
        $this->db->where('usuario_cpf', $cpf);

        $query = $this->db->get(); 

        if ($this->db->count_all_results() == 1) {
            return $query->row()->usuario_id_login;
            exit();
        }
        
        return false;
    }


    public function exibirGrupo() {
        $this->db->select('gp_id_gp, gp_grupo, gp_users');

        $this->db->from('grupo');

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) {

            return $query->result();
            exit();
        }
        
        return false;
    }

    public function exibirIdByIdLogin($id_login) {
        $this->db->select('usuario_id_usuario');

        $this->db->from('usuario');

        $this->db->where('usuario_id_login', $id_login);

        $query = $this->db->get(); 

        if ($this->db->count_all_results() == 1) {

            return $query->result();
            exit();
        }
        
        return false;
    }

    public function localizaGrupoById($user, $id) {


        $ids = explode('|', $user);

        return $existe = in_array($id, $ids);



    }

    
}
/* End of file Usuario_model.php */
/* Location: ./application/models/Usuario_model.php */