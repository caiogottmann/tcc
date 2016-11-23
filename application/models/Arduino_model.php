<?php
class Arduino_model extends CI_Model {

	/**
	 * 
	 * @param array $data 
	 * @return boolean
	 */
    public function inserirRfid($data) {

        $res = $this->db->insert('arduino', $data);

        return $res;
    }

    /**
     * 
     * @return string
     */
    public function exibirUltimoId() {

        $this->db->select_max('arduino_id_arduino');

        $res = $this->db->get('arduino');

       return $res->row()->arduino_id_arduino;
    }

    /**
     * 
     * @param string $arduinoSenha 
     * @return string
     */
    public function exibirIdBySenha($arduinoSenha) {

        $this->db->select('arduino_id_arduino');

        $this->db->from('arduino');

        $this->db->where('arduino_senha', $arduinoSenha);
        $this->db->where('arduino_situacao', 'A');

        $query = $this->db->get(); 

        if ( ($this->db->count_all_results() == 1) and ($query->row() ) ) { 
            return $query->row()->arduino_id_arduino;
            exit();
        }

        return false;
    }

    /**
     * 
     * @param string $arduinoRfid 
     * @return string
     */
    public function exibirIdByRfid($arduinoRfid) {

        $this->db->select('arduino_id_arduino');

        $this->db->from('arduino');

        $this->db->where('arduino_rfid', $arduinoRfid);
        $this->db->where('arduino_situacao', 'A');

        $query = $this->db->get(); 

        if ( ($this->db->count_all_results() == 1) and ($query->row()) ) { 
            return $query->row()->arduino_id_arduino;
            exit();
        }

        return false;
    }

}

/* End of file Rfid_model.php */
/* Location: ./application/models/Rfid_model.php */