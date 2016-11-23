<?php
class Correio_model extends CI_Model {

    public function exibirTodosAtivos() {
        $this->db->select(' correio_id_correio,
                            usuario_nome,
                            correio_nome_correio,
                            correio_rg_correio,
                            correio_empre_correio,
                            correio_data,
                            correio_situacao');

        $this->db->from('correio');

        $this->db->join('usuario', 'usuario.usuario_id_usuario = correio.correio_id_usuario');

        $this->db->where('correio_situacao', 'A'); 

        $this->db->order_by("correio_data", "ASC"); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) {
            return $query->result();
            exit();
        }
        
        return false;
    }

    public function exibirTodosPendentes() {
        $this->db->select(' correio_id_correio,
                            usuario_nome,
                            correio_nome_correio,
                            correio_rg_correio,
                            correio_empre_correio,
                            correio_data,
                            correio_situacao');

        $this->db->from('correio');

        $this->db->join('usuario', 'usuario.usuario_id_usuario = correio.correio_id_usuario');

        $this->db->where('correio_situacao', 'P'); 

        $this->db->order_by("correio_data", "ASC"); 

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) {
            return $query->result();
            exit();
        }
        
        return false;
    }

    public function excluirCorreioById($id) {
        $data = array('correio_situacao' => 'I');

        $this->db->where('correio_id_correio', $id);
        $res = $this->db->update('correio', $data);

        return $res;
    }


    public function confirmarCorreioById($id) {
        $data = array('correio_situacao' => 'A');

        $this->db->where('correio_id_correio', $id);
        $res = $this->db->update('correio', $data);

        return $res;
    }

    public function alterarCorreio($id, $coluna, $texto){
        $data = array($coluna => $texto);

        $this->db->where('correio_id_correio', $id);
        $res = $this->db->update('correio', $data);

        return $res;
    }

    /**
     * 
     * @param array $entrega 
     * @return boolean
     */
    public function inserirEntrega($entrega) {

        $res = $this->db->insert('correio', $entrega);

        return $res;
    }

}

/* End of file Cookie_model.php */
/* Location: ./application/models/Cookie_model.php */