<?php
class Funcionario_model extends CI_Model {

	/**
	 * 
	 * @param araay $data 
	 * @return boolean
	 */
	public function inserirFuncionario($data) {

        $res = $this->db->insert('funcionario', $data);

        return $res;
    }

    public function excluirFuncionarioById($id) {
        $data = array('func_situacao' => 'I');

        $this->db->where('func_id_func', $id);
        $res = $this->db->update('funcionario', $data);

        return $res;
    }

}

/* End of file Funcionario_model.php */
/* Location: ./application/models/Funcionario_model.php */