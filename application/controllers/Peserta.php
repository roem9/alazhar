<?php
    class Peserta extends CI_CONTROLLER{
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
            $data['title'] = 'List Peserta';
            $data['peserta'] = [];
            $peserta = $this->Main_model->get_all("user", "", "nama", "ASC");
            foreach ($peserta as $i => $peserta) {
                $data['peserta'][$i] = $peserta;
                $data['peserta'][$i]['kelas'] = COUNT($this->Main_model->get_all("kelas_user", ["id_user" => $peserta['id_user']]));
            }
            $data['kelas'] = $this->Main_model->get_all("kelas", "", "tgl_mulai", "ASC");

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('peserta/peserta', $data);
            $this->load->view('templates/footer');
        }

        // get
            public function get_detail_peserta(){
                $id = $this->input->post("id");
                $data = $this->Main_model->get_one("user", ["id_user" => $id]);
                $data['link'] = "localhost/ci/mrscholaev3/login?user=" . MD5("alazhar") . MD5($data['id_user']);
                $kelas = $this->Main_model->get_all("kelas_user", ["id_user" => $id], "id");
                foreach ($kelas as $i => $kelas) {
                    $data['user'][$i] = $kelas;
                    $data['user'][$i]['kelas'] = $this->Main_model->get_one("kelas", ["id_kelas" => $kelas['id_kelas']]);
                }
                echo json_encode($data);
            }

            public function get_kelas_peserta(){
                $id = $this->input->post("id");
                $kelas = $this->Main_model->get_all("kelas_user", ["id_user" => $id]);
                foreach ($kelas as $i => $kelas) {
                    $data['user'][$i] = $kelas;
                    $data['user'][$i]['kelas'] = $this->Main_model->get_one("kelas", ["id_kelas" => $kelas['id_kelas']]);
                }
                echo json_encode($data);
            }
        // get

        // edit
            public function edit_peserta(){
                $id = $this->input->post("id_user", TRUE);
                $data = [
                    "nama" => $this->input->post("nama", TRUE),
                    "no_hp" => $this->input->post("no_hp", TRUE)
                ];

                $this->Main_model->edit_data("user", ["id_user" => $id], $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merubah data peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        // edit

        // delete
            public function delete_kelas(){
                $kelas = $this->input->post("id");
                foreach ($kelas as $kelas) {
                    $this->Main_model->delete_data("kelas_user", ["id" => $kelas]);
                }
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus kelas peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        // delete

        // add
            public function tambah_kelas(){
                $data = [
                    "id_kelas" => $this->input->post("id_kelas", TRUE),
                    "id_user" => $this->input->post("id_user", TRUE)
                ];
                $this->Main_model->add_data("kelas_user", $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan kelas peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect($_SERVER['HTTP_REFERER']);
            }

            public function add_peserta(){
                $data = [
                    "nama" => $this->input->post("nama", TRUE),
                    "no_hp" => $this->input->post("no_hp")
                ];
                $this->Main_model->add_data("user", $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect("peserta");
            }
    }