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
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user/evaluasi">Lamaran</a></li>
                            <li class="breadcrumb-item active">Evaluasi Pelamar</li>
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
                <?php if ($this->session->flashdata('gagal')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('gagal'); ?>
                    </div>
                <?php elseif ($this->session->flashdata('message')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                <?php endif ?>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <form action="" method="post">
                            <div class="form-group row m-t-20">
                                <label for="posisi" class="col-sm-2 control-label col-form-label">Posisi</label>
                                <div class="col-sm-6">
                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="posisi" required>
                                        <option value="<?= NULL; ?>">--Pilih Posisi--</option>
                                        <?php foreach ($lowongan as $data) : ?>
                                            <option value="<?= $data['id_posisi']; ?>"><?= $data['posisi']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-t-20">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-6">
                                    <button class="btn btn-outline-success"><i class="mdi mdi-magnify"></i> Evaluasi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->