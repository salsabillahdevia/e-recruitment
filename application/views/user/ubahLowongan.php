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
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user/lowongan">Master Data</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user/lowongan">Data Lowongan</a></li>
                            <li class="breadcrumb-item active">Ubah Lowongan</li>
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
                                <label for="posisi" class="col-sm-2 control-label col-form-label">Posisi</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control <?= form_error('posisi') == true ? 'is-invalid' : ''; ?>" id="posisi" name="posisi" value="<?= $lowongan['posisi']; ?>" required>
                                    <?= form_error('posisi', '<small class="font-bold text-danger">', '</small>');  ?>
                                </div>
                            </div>
                            <div class="form-group row m-t-20">
                                <label for="kuota" class="col-sm-2 control-label col-form-label">Kuota</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control <?= form_error('kuota') == true ? 'is-invalid' : ''; ?>" id="kuota" value="<?= $lowongan['kuota']; ?>" name="kuota" required>
                                    <?= form_error('kuota', '<small class="font-bold text-danger">', '</small>');  ?>
                                </div>
                            </div>
                            <div class="form-group row m-t-20">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-success">Ubah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->