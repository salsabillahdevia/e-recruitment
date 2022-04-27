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
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user/kriteria">Master Data</a></li>
                            <li class="breadcrumb-item active">Master Data Kriteria</li>
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
                        <h3 class="card-title"><?= $title; ?> Per Posisi</h3>
                        <table class="table m-t-20">
                            <tr>
                                <th>No</th>
                                <th>Posisi</th>
                                <th>Kuota</th>
                                <th>Dibuka</th>
                                <th>Aksi</th>
                            </tr>
                            <?php $no = 1;
                            foreach ($lowongan as $data) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['posisi']; ?></td>
                                    <td><?= $data['kuota']; ?></td>
                                    <td><?= nice_date($data['tgl_dibuka'], 'Y-m-d'); ?></td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="<?= base_url() ?>user/kriteriaPosisi/<?= $data['id_posisi']; ?>"><i class="mdi mdi-magnify"></i> Lihat</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->