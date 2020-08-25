<?php
class Peserta_model extends CI_MODEL{
    public function get_detail_peserta(){
        $id = $this->input->post("id");
        $this->db->from("peserta as a");
        $this->db->join("alamat as b", "a.id_peserta = b.id_peserta");
        $this->db->where("a.id_peserta", $id);
        return $this->db->get()->row_array();
    }
}