<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
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
                        <h3 class="card-title">Lowongan</h3>

                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Posisi</th>
                                <th>Kuota</th>
                                <th>Dibuka</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($lowongan as $data) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['posisi']; ?></td>
                                    <td><?= $data['kuota']; ?></td>
                                    <td><?= nice_date($data['tgl_dibuka'], ('d-m-Y')); ?></td>
                                    <td><a class="btn btn-outline-primary" href="<?= base_url('user/ubahLowongan/' . $data['id_posisi']) ?>"><i class="mdi mdi-pencil"></i> Ubah</a></td>
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