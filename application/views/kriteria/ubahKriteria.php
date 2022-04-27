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
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>kriteria/lowongan">Master Data</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>kriteria/kriteria">Master Data Kriteria</a></li>
                            <li class="breadcrumb-item active"><a href="<?= base_url() ?>kriteria/kriteriaPosisi/<?= $kriteria['id_posisi']; ?>">Kriteria <?= $lowongan['posisi']; ?></a></li>
                            <li class="breadcrumb-item active">Ubah Kriteria</li>
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
                        <form action="" method="post" class="form-horizontal">
                            <input type="hidden" name="aksi" value="update">

                            <div class="form-group row m-t-20">
                                <label for="kriteria" class="col-sm-2 control-label col-form-label">Kriteria</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control <?= form_error('kriteria') == true ? 'is-invalid' : ''; ?>" id=" kriteria" name="kriteria" value="<?= $kriteria['kriteria']; ?>" required>
                                    <?= form_error('kriteria', '<small class="font-bold text-danger">', '</small>');  ?>
                                </div>
                            </div>
                            <div class="form-group row m-t-20">
                                <label for="sub kriteria" class="col-sm-2 control-label col-form-label">Sub Kriteria</label>
                                <div class="col-sm-4">
                                    <!-- ini ascending. dari terkecil ke terbesar. nilai (value) subkriteria 1 itu 1 dan seterusnya. -->
                                    <?php
                                    $no = 1;

                                    foreach ($subKriteria as $data) {
                                        // ini kalo sub kriterianya cuma 1 nanti cuma ada satu doang input formnya
                                    ?>
                                        <div class="input-group">
                                            <input type="hidden" class="form-control col-md" name="id_sub_kriteria<?= $no ?>" value="<?= $data['id_sub_kriteria']; ?>" required>
                                            <input type="text" class="form-control col-md" name="sub_kriteria<?= $no ?>" value="<?= $data['sub_kriteria']; ?>" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Nilai = <?= $no++; ?></span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row m-t-20">
                                <label for="bobot" class="col-sm-2 control-label col-form-label">Bobot</label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="number" class="form-control <?= form_error('bobot') == true ? 'is-invalid' : ''; ?>" id="bobot" required value="<?= $kriteria['bobot']; ?>" name="bobot">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <?= form_error('bobot', '<small class="font-bold text-danger">', '</small>');  ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-t-20">
                                <label for="sifat" class="col-sm-2 control-label col-form-label">Sifat</label>
                                <div class="col-sm-4">
                                    <div class="custom-control custom-radio m-r-20">
                                        <input type="radio" class="custom-control-input" id="C" name="sifat" required name="sifat" value="C" <?= ($kriteria['sifat'] == "C" ? 'checked' : ''); ?>>
                                        <label class="custom-control-label" for="C">Cost</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="B" name="sifat" required name="sifat" <?= ($kriteria['sifat'] == "B" ? 'checked' : ''); ?> value="B">
                                        <label class="custom-control-label" for="B">Benefit</label>
                                    </div>
                                    <div class="col">
                                        <?= form_error('sifat', '<small class="font-bold text-danger">', '</small>');  ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->