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
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>pelamar">Lamaran</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>pelamar">Daftar Pelamar</a></li>
                            <li class="breadcrumb-item active">Tambah Pelamar</li>
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
                        <h3 class="card-title"><?= $title; ?> Posisi <?= $lowongan['posisi']; ?></h3>
                        <hr>
                        <div class="row col-md-12">
                            <div class="form-group col-md-6 row">
                                <label for="tgl_interview" class="col-sm-4 control-label col-form-label">Tanggal Interview</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control" aria-describedby="basic-addon2" value="<?= $currentDate; ?>" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 row">
                                <label class="col-sm-3 control-label col-form-label">Posisi</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="<?= $lowongan['posisi']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <hr>
                            <form action="" method="post">
                                <input type="hidden" name="jumlah_pelamar" value="<?= $lowongan['jumlah_pelamar'] + 1; ?>">
                                <input type="hidden" name="id_posisi" value="<?= $lowongan['id_posisi']; ?>">
                                <div class="form-group row m-t-20">
                                    <label for="nama_pelamar" class="col-sm-2 control-label col-form-label">Nama Pelamar</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="nama_pelamar" placeholder="Nama Lengkap Pelamar" name="nama_pelamar" required>
                                    </div>
                                </div>
                                <?php
                                $nilai = 1;
                                foreach ($dataView as $item) {
                                ?>
                                    <label class="m-t-30">
                                        <h3><?= $item['nama']; ?> (
                                            <?= $item['bobot']; ?>%)</h3>
                                    </label>
                                    <div class="col-md-12 d-flex">
                                        <?php
                                        $no = 1;
                                        foreach ($item['data'] as $dataItem) { ?>
                                            <div class="custom-control custom-radio col-md-2">
                                                <input type="radio" class="custom-control-input" name="nilai[<?= $dataItem->id_kriteria ?>]" required value="<?= $no; ?>" id="<?= $dataItem->sub_kriteria . $dataItem->id_kriteria; ?>">
                                                <label for="<?= $dataItem->sub_kriteria . $dataItem->id_kriteria; ?>" class="custom-control-label"><?= $dataItem->sub_kriteria; ?></label>
                                                <?php $no++; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group modal-footer row m-t-20">
                                    <div class="col-sm-12 ">
                                        <button onclick="return confirm('Apakah Anda Yakin Ingin Menyimpan Data Penilaian Ini?');" type="submit" class="btn btn-lg btn-success float-right"> Simpan <i class="mdi mdi-account-check"></i></button>
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