<!-- modal peserta -->
    <div class="modal fade" id="modalPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPesertaTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="#" class='nav-link active' id="btn-form-1"><i class="fas fa-user"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class='nav-link' id="btn-form-2"><i class="fas fa-book"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class='nav-link' id="btn-form-3">Tambah Kelas</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body cus-font">
                        <div class="card" id="form-1">
                            <div class="card-header text-primary">
                                <strong>Data Diri</strong>
                            </div>
                            <div class="card-body">
                                <form action="peserta/edit_peserta" method="post">
                                    <input type="hidden" name="id_user">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">No Handphone</label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control form-control-sm">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" value="Ubah Data" class="btn btn-sm btn-success" id="btnEdit">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card" id="form-2">
                            <div class="card-header text-primary">
                                <strong>Data Akademik</strong>
                            </div>
                            <div class="card-body">
                                <form action="peserta/delete_kelas" method="post">
                                    <input type="hidden" name="id_user">
                                    <div class="form-group">
                                        <label for="link">Link Login</label>
                                        <input type="text" name="link" id="link" class="form-control form-control-sm" readonly>
                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>List Kelas</strong></li>
                                        <div id="list-kelas"></div>
                                    </ul>
                                    <div class="d-flex justify-content-end" id="btnHapusKelas">
                                        <input type='submit' value='Hapus Kelas' class='btn btn-sm btn-danger mt-3' id='btnHapus'>
                                    </div>
                                </form>
                            </div>
                        </div>

                        
                        <form action="peserta/tambah_kelas" method="post" id="form-3">
                            <input type="hidden" name="id_user">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="id_kelas" class="form-control form-control-sm" required>
                                    <option value="">Pilih Kelas</option>
                                    <?php foreach ($kelas as $data) :?>
                                        <option value="<?= $data['id_kelas']?>"><?= $data['nama_kelas']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type='submit' value='Tambah Kelas' class='btn btn-sm btn-primary mt-3' id='btnTambahKelas'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- modal peserta -->

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
                                <th>Nama Peserta</th>
                                <th style="width: 18%"><center>No Hp</center></th>
                                <th style="width: 10%">Kelas</th>
                                <th style="width: 10%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            foreach ($peserta as $peserta) :?>
                                <tr>
                                    <td><center><?= ++$i?></center></td>
                                    <td><?= $peserta['nama']?></td>
                                    <td><?= $peserta['no_hp']?></td>
                                    <td><center><a href="#modalPeserta" data-toggle="modal" data-id="<?= $peserta['id_user']?>" class="modalPeserta btn btn-sm btn-outline-success" id="kelas"><?= $peserta['kelas']?></a></center></td>
                                    <td><a href="#modalPeserta" data-toggle="modal" data-id="<?= $peserta['id_user']?>" class="modalPeserta btn btn-sm btn-info" id="peserta">detail</a></td>
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
    $("#sidebarPeserta").addClass("active");
    
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
    
    $(".modalPeserta").click(function(){
        if(this.id == "kelas"){
            $("#btn-form-1").removeClass("active");
            $("#btn-form-2").addClass("active");
            $("#btn-form-3").removeClass("active");

            $("#form-1").hide();
            $("#form-2").show();
            $("#form-3").hide();
        } else {
            $("#btn-form-1").addClass("active");
            $("#btn-form-2").removeClass("active");
            $("#btn-form-3").removeClass("active");

            $("#form-1").show();
            $("#form-2").hide();
            $("#form-3").hide();
        }

        const id = $(this).data('id');
        $("#btnHapus").show();
        
        $.ajax({
            url : "<?=base_url()?>peserta/get_detail_peserta",
            method : "POST",
            data : {id : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#modalPesertaTitle").html(data.nama)
                $("#nama").val(data.nama)
                $("#no_hp").val(data.no_hp)
                $("#tgl_masuk").val(data.tgl_masuk)
                $("input[name='id_user']").val(data.id_user)
                $("#link").val(data.link)
                html = "";
                if(data.user){
                    array = data.user;
                    array.forEach((user, i) => {
                        html += `<li class="list-group-item"><div class="form-check">
                                    <input class="form-check-input" name="id[`+i+`]" type="checkbox" value="`+user.id+`" id="j`+i+`">
                                    <label class="form-check-label" for="j`+i+`">
                                        `+user.kelas.nama_kelas+`
                                    </label>
                                </div></li>`;
                    });
                    $("#list-kelas").html(html);
                } else {
                    $("#list-kelas").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> List kelas kosong</div>`);
                    $("#btnHapus").hide();
                }
                
            }
        })
    })

    $("#btnEdit").click(function(){
        var c = confirm("Yakin akan mengubah data?");
        return c;
    })

    $("#btnHapus").click(function(){
        var c = confirm("Yakin akan menghapus kelas?");
        return c;
    })

    $("#btnTambahKelas").click(function(){
        var c = confirm("Yakin akan menambahkan kelas?");
        return c;
    })
    
</script>
