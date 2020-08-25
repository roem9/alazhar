<?php
class Kelas extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Peserta_model');
        $this->load->model('Main_model');
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
            redirect(base_url("login"));
        }
    }

    public function index(){
        $data['title'] = 'List Kelas';
        $kelas = $this->Main_model->get_all("kelas", "", "tgl_mulai", "ASC");
        $data['kelas'] = [];
        foreach ($kelas as $i => $kelas) {
            $data['kelas'][$i] = $kelas;
            $data['kelas'][$i]['peserta'] = COUNT($this->Main_model->get_all("kelas_user", ["id_kelas" => $kelas['id_kelas']]));
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kelas/kelas', $data);
        $this->load->view('templates/footer');
    }

    // get
        public function get_detail_kelas(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("kelas", ["id_kelas" => $id]);
            $data['pertemuan'] = $this->Main_model->get_all("materi_kelas", ["id_kelas" => $id]);
            $peserta = $this->Main_model->get_all("kelas_user", ["id_kelas" => $id]);
            $data['peserta'] = [];
            foreach ($peserta as $i => $peserta) {
                $data['peserta'][$i] = $this->Main_model->get_one("user", ["id_user" => $peserta['id_user']]);
            }

            echo json_encode($data);
        }
    // get

    // edit
        public function edit_kelas(){
            $id = $this->input->post("id_kelas");
            $data = [
                "nama_kelas" => $this->input->post("nama_kelas"),
                "program" => $this->input->post("program"),
                "tgl_mulai" => $this->input->post("tgl_mulai")
            ];
            $this->Main_model->edit_data("kelas", ["id_kelas" => $id], $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil mengubah data kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function list_pertemuan(){
            $id = $this->input->post("id_kelas");
            $pert = $this->input->post("pertemuan");
            
            // delete list
                $this->Main_model->delete_data("materi_kelas", ["id_kelas" => $id]);
            // delete list

            foreach ($pert as $pert) {
                $data = [
                    "materi" => $pert,
                    "id_kelas" => $id
                ];

                $this->Main_model->add_data("materi_kelas", $data);
            }

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menyimpan data pertemuan kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit
    
    // add
        public function add_kelas(){
            $data = [
                "nama_kelas" => $this->input->post("nama_kelas"),
                "program" => $this->input->post("program"),
                "tgl_mulai" => $this->input->post("tgl_mulai")
            ];
            
            $this->Main_model->add_data("kelas", $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('kelas');
        }
    // add

    // delete
        public function delete_peserta(){
            $peserta = $this->input->post("peserta");
            foreach ($peserta as $peserta) {
                $where = [
                    "id_kelas" => $this->input->post("id_kelas"),
                    "id_user" => $peserta,
                ];

                $this->Main_model->delete_data("kelas_user", $where);
            };
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus peserta dari kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
}