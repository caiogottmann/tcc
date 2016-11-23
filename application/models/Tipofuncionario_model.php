<?php
class TipoFuncionario_model extends CI_Model {

    /**
     * 
     * @param id $id 
     * @param string $coluna 
     * @param string $texto 
     * @return boolean
     */
    public function alterarTipo($id, $coluna, $texto){
        $data = array($coluna => $texto);

        $this->db->where('tipoFunc_id_tipoFunc', $id);
        $res = $this->db->update('tipoFuncionario', $data);

        return $res;
    }

    /**
     * 
     * @return object
     */
    public function exibirTiposFuncionariosAtivos() {
        $this->db->select('tipoFunc_id_tipoFunc,
                            tipoFunc_tipo,
                            tipoFunc_obs');

        $this->db->from('tipoFuncionario');
        $this->db->where('tipoFunc_situacao', 'A');

        $query = $this->db->get(); 

        if ($this->db->count_all_results() >= 1) { 
            return $query->result();
            exit();
        }

        return false;
    }
    
    /**
     * 
     * @param int $id 
     * @return boolean
     */
    public function excluirTipoById($id) {
        $data = array('tipoFunc_situacao' => 'I');

        $this->db->where('tipoFunc_id_tipoFunc', $id);
        $res = $this->db->update('tipoFuncionario', $data);

        return $res;
    }

    /**
     * 
     * @param araay $data 
     * @return boolean
     */
    public function inserirTipoFunc($data) {

        $res = $this->db->insert('tipoFuncionario', $data);

        return $res;
    }
}

/* End of file TipoFuncionario_model.php */
/* Location: ./application/models/TipoFuncionario_model.php */