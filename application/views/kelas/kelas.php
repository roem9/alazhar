<!-- modal kelas -->
    <div class="modal fade" id="modalKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKelasTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="#" class='nav-link active' id="btn-form-1"><i class="fas fa-database"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class='nav-link' id="btn-form-2"><i class="fas fa-book"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class='nav-link' id="btn-form-3"><i class="fas fa-users"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body cus-font">
                        <div class="card" id="form-1">
                            <div class="card-header text-primary">
                                <strong>Data Kelas</strong>
                            </div>
                            <div class="card-body">
                                <form action="kelas/edit_kelas" method="post">
                                    <input type="hidden" name="id_kelas">
                                    <div class="form-group">
                                        <label for="nama_kelas">Nama Kelas</label>
                                        <input type="text" name="nama_kelas" id="nama_kelas" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="program">Program</label>
                                        <select name="program" id="program" class="form-control form-control-sm">
                                            <option value="">Pilih Program</option>
                                            <option value="Hifdzi 1">Hifdzi 1</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_mulai">Tgl. Mulai</label>
                                        <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control form-control-sm">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" value="Ubah Data" class="btn btn-sm btn-success" id="btnEdit">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card" id="form-2">
                            <div class="card-header text-primary">
                                <strong>List Pertemuan</strong>
                            </div>
                            <div class="card-body">
                                <form action="kelas/list_pertemuan" method="post">
                                    <input type="hidden" name="id_kelas">
                                    <ul class="list-group">
                                        <div id="list-pertemuan"></div>
                                    </ul>
                                    <div class="d-flex justify-content-end">
                                        <input type='submit' value='Simpan Data' class='btn btn-sm btn-primary mt-3' id='btnList'>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="card" id="form-3">
                            <div class="card-header text-primary">
                                <strong>List Peserta</strong>
                            </div>
                            <div class="card-body">
                                <form action="kelas/delete_peserta" method="post">
                                    <input type="hidden" name="id_kelas">
                                    <ul class="list-group">
                                        <div id="list-peserta"></div>
                                    </ul>
                                    <div class="d-flex justify-content-end">
                                        <input type='submit' value='Hapus Peserta' class='btn btn-sm btn-danger mt-3' id='btnPeserta'>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- modal kelas -->

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
        </div>

        <?php if( $this->session->flashdata('pesan') ) : ?>
            <div class="row">
                <div class="col-6">
                    <?= $this->session->flashdata('pesan');?>    
                </div>
            </div>
        <?php endif; ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="max-width: 750px">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-sm cus-font">
                        <thead>
                            <tr>
                                <th style="width: 8%">No</th>
                                <th>Nama Kelas</th>
                                <th style="width: 22%"><center>Program</center></th>
                                <th style="width: 10%">Peserta</th>
                                <th style="width: 15%">Tgl. Mulai</th>
                                <th style="width: 10%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            foreach ($kelas as $kelas) :?>
                                <tr>
                                    <td><center><?= ++$i?></center></td>
                                    <td><?= $kelas['nama_kelas']?></td>
                                    <td><?= $kelas['program']?></td>
                                    <td><center><a href="#modalKelas" data-toggle="modal" data-id="<?= $kelas['id_kelas']?>" class="modalListPeserta btn btn-sm btn-outline-dark" id="peserta"><?= $kelas['peserta']?></a></center></td>
                                    <td><?= date("d-M-Y", strtotime($kelas['tgl_mulai']));?></td>
                                    <td><a href="#modalKelas" data-toggle="modal" data-id="<?= $kelas['id_kelas']?>" class="modalKelas btn btn-sm btn-info">detail</a></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>

<script>
    $("#sidebarKelas").addClass("active");
    
    // btn modal
        $("#btn-form-1").addClass("active");
        $("#form-1").show();
        $("#form-2").hide();
        $("#form-3").hide();
        
        $("#btn-form-1").click(function(){
            $("#btn-form-1").addClass("active");
            $("#btn-form-2").removeClass("active");
            $("#btn-form-3").removeClass("active");

            $("#form-1").show();
            $("#form-2").hide();
            $("#form-3").hide();
        })
        
        $("#btn-form-2").click(function(){
            $("#btn-form-1").removeClass("active");
            $("#btn-form-2").addClass("active");
            $("#btn-form-3").removeClass("active");

            $("#form-1").hide();
            $("#form-2").show();
            $("#form-3").hide();
        })

        $("#btn-form-3").click(function(){
            $("#btn-form-1").removeClass("active");
            $("#btn-form-2").removeClass("active");
            $("#btn-form-3").addClass("active");

            $("#form-1").hide();
            $("#form-2").hide();
            $("#form-3").show();
        })
    // btn modal

    $(".modalKelas, .modalListPeserta").click(function(){
        if(this.id == "peserta"){
            $("#btn-form-1").removeClass("active");
            $("#btn-form-2").removeClass("active");
            $("#btn-form-3").addClass("active");

            $("#form-1").hide();
            $("#form-2").hide();
            $("#form-3").show();
        }

        const id = $(this).data('id');
        
        $.ajax({
            url : "<?=base_url()?>kelas/get_detail_kelas",
            method : "POST",
            data : {id : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#modalKelasTitle").html(data.nama_kelas);
                $("input[name='id_kelas']").val(data.id_kelas);
                $("#nama_kelas").val(data.nama_kelas);
                $("#program").val(data.program);
                $("#tgl_mulai").val(data.tgl_mulai)
                
                pert = [];
                data.pertemuan.forEach((materi, i) => {
                    pert[i] = materi.materi;
                });
                
                let html = "";
                let check = "";

                for (let i = 1; i < 26; i++) {
                    if(pert.includes("Pertemuan "+i)){
                        check = "checked";
                    } else {
                        check = "";
                    }

                    html += `<li class="list-group-item"><input type="checkbox" name="pertemuan[]" value="Pertemuan `+i+`" id="per`+i+`" class="mr-3" `+check+`><label for="per`+i+`">Pertemuan `+i+`</label></li>`;
                }

                $("#list-pertemuan").html(html);

                html = "";

                let peserta = data.peserta;
                peserta.forEach((element, i) => {
                    html += `<li class="list-group-item"><input type="checkbox" name="peserta[]" value="`+element.id_user+`" id="peserta`+element.id_user+`" class="mr-3"><label for="peserta`+element.id_user+`">`+element.nama+`</label></li>`;
                });
                $("#list-peserta").html(html);

            }
        })
    })

    $("#btnEdit").click(function(){
        var c = confirm("Yakin akan mengubah data kelas?");
        return c;
    })
    
    $("#btnList").click(function(){
        var c = confirm("Yakin akan menyimpan data pertemuan?");
        return c;
    })

    $("#btnPeserta").click(function(){
        var c = confirm("Yakin akan menghapus peserta?");
        return c;
    })
    
</script>
