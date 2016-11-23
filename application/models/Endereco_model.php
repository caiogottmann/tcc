<?php
class Endereco_model extends CI_Model {

    /**
     * @param array $data 
     * @return object
     */
    public function inserirEndereco($data) {

        $res = $this->db->insert('endereco', $data);

        return $res;
    }

    /**
     * 
     * @param int $id 
     * @return object
     */
    public function exibirEnderecoByIdUsuario($id) {
    	$this->db->select('end_id_end,
							end_rua,
							end_bairro,
							end_numero,
                            end_complemento,
							end_id_estado');

        $this->db->from('endereco');
        $this->db->join('usuario', 'endereco.end_id_end = usuario.usuario_id_end');
        
        $this->db->where("usuario.usuario_id_usuario = $id");

        $query = $this->db->get();

        if ($this->db->count_all_results() == 1) { 
            return $query->row();
            exit();
        }

        return false;
    }

    /**
     * 
     * @return araay
     */
    public function exibirUltimoId() {

        $this->db->select_max('end_id_end');

        $res = $this->db->get('endereco');

        return $res->row()->end_id_end;
    }

    /**
     * 
     * @param string $endereco 
     * @param int $id_end 
     * @return boolean
     */
    public function updateEndereco($endereco, $id_end) {
        $this->db->where('end_id_end', $id_end);
        $res = $this->db->update('endereco', $endereco);

        return $res;
    }

}

/* End of file Endereco_model.php */
/* Location: ./application/models/Endereco_model.php */