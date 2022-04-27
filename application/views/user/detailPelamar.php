<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user/pelamar">Lamaran</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user/pelamar">Daftar Pelamar</a></li>
                            <li class="breadcrumb-item active">Detail Pelamar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <form action="" method="post">
                            <div class="form-group row m-t-20">
                                <label for="tgl_interview" class="col-sm-2 control-label col-form-label">Tanggal Interview</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" aria-describedby="basic-addon2" value="24-05-2021" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-t-20">
                                <label for="posisi" class="col-sm-2 control-label col-form-label">Posisi</label>
                                <div class="col-sm-6">
                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                        <option>--Pilih Posisi--</option>
                                        <option value="Monev" selected>Monev</option>
                                        <option value="Koordinator Lapangan">Koordinator Lapangan</option>
                                        <option value="Petugas Lapangan">Petugas Lapangan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-t-20">
                                <label for="nama_pelamar" class="col-sm-2 control-label col-form-label">Nama Pelamar</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="nama_pelamar" placeholder="Nama Lengkap Pelamar" name="nama_pelamar" required value="Akasuna Hera">
                                </div>
                            </div>
                            <div class="form-group row m-t-20">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-6">
                                    <button class="btn btn-success">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title m-b-20 text-danger">Penilaian Interview Pelamar</h3>
                            <form action="" method="post">
                                <label>Pengalaman Kerja (10%)</label>
                                <div class="col-md-12 d-flex">
                                    <div class="custom-control custom-radio col-md-2">
                                        <input type="radio" class="custom-control-input" id="tidakada" name="radio-stacked" required>
                                        <label class="custom-control-label" for="tidakada">Tidak Ada</label>
                                    </div>
                                    <div class="custom-control custom-radio col-md-2">
                                        <input type="radio" class="custom-control-input" id="1thn" name="radio-stacked" required>
                                        <label class="custom-control-label" for="1thn">1 Tahun</label>
                                    </div>
                                    <div class="custom-control custom-radio col-md-2">
                                        <input type="radio" class="custom-control-input" id="2-3thn" name="radio-stacked" required>
                                        <label class="custom-control-label" for="2-3thn">2-3 Tahun</label>
                                    </div>
                                    <div class="custom-control custom-radio col-md-2">
                                        <input type="radio" class="custom-control-input" id="4-5thn" name="radio-stacked" required>
                                        <label class="custom-control-label" for="4-5thn">4-5 Tahun</label>
                                    </div>
                                    <div class="custom-control custom-radio col-md-2">
                                        <input type="radio" class="custom-control-input" id=">5thn" name="radio-stacked" required checked>
                                        <label class="custom-control-label" for=">5thn">>5 Tahun</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->