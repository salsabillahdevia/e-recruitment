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
                            <li class=" breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user/kriteria">Master Data</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user/kriteria">Master Data Kriteria</a></li>
                            <li class="breadcrumb-item active">Kriteria <?= $lowongan['posisi']; ?></li>
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
                        <h3 class="card-title">Kriteria Posisi <?= $lowongan['posisi']; ?></h3>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahKriteria"><i class="mdi mdi-plus"></i> Tambah Kriteria</button>
                        </div>
                        <table class="table m-t-20">
                            <tr>
                                <th>No</th>
                                <th>Kriteria</th>
                                <th>Bobot</th>
                                <th>Sifat</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($kriteria as $data) :
                            ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['kriteria'] ?></td>
                                    <td><?= $data['bobot']; ?></td>
                                    <td><?= $data['sifat']; ?></td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="<?= base_url('user/ubahKriteria/' . $data['id_posisi'] . '/' . $data['id_kriteria']); ?>"><i class="mdi mdi-pencil"></i> Ubah</a>
                                    </td>
                                </tr>
                            <?php
                            endforeach
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    <!-- Modal Tambah Kriteria-->
    <div class="modal fade" id="tambahKriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/tambahKriteria/' . $lowongan['id_posisi']) ?>" method="post">
                    <input type="hidden" name="aksi" value="insert">
                    <div class="modal-body">
                        <div class="form-group row m-t-20">
                            <label for="kriteria" class="col-sm-3 control-label col-form-label">Kriteria</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kriteria" name="kriteria" placeholder="Nama Kriteria" required>
                            </div>
                        </div>
                        <div class="form-group row m-t-20">
                            <label for="sub kriteria" class="col-sm-3 control-label col-form-label">Sub Kriteria</label>
                            <div class="col-sm-9">
                                <!-- ini ascending. dari terkecil ke terbesar. nilai (value) subkriteria 1 itu 1 dan seterusnya. -->
                                <input type="text" class="form-control" id="kriteria" name="nama_sub1" placeholder="Sub Kriteria 1" required>
                                <input type="text" class="form-control" id="kriteria" name="nama_sub2" placeholder="Sub Kriteria 2" required>
                                <input type="text" class="form-control" id="kriteria" name="nama_sub3" placeholder="Sub Kriteria 3" required>
                                <input type="text" class="form-control" id="kriteria" name="nama_sub4" placeholder="Sub Kriteria 4" required>
                                <input type="text" class="form-control" id="kriteria" name="nama_sub5" placeholder="Sub Kriteria 5" required>
                            </div>
                        </div>
                        <div class="form-group row m-t-20">
                            <label for="bobot" class="col-sm-3 control-label col-form-label">Bobot</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="bobot" required name="bobot">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row m-t-20">
                            <label for="sifat" class="col-sm-3 control-label col-form-label">Sifat</label>
                            <div class="col-sm-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="C" name="sifat" required value="C">
                                    <label class="custom-control-label" for="C">Cost</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="B" name="sifat" required value="B">
                                    <label class="custom-control-label" for="B">Benefit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal Tambah Kriteria -->