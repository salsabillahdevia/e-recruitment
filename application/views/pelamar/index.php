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
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>pelamar">Lamaran</a></li>
                            <li class="breadcrumb-item active">Daftar Pelamar</li>
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
                        <hr>
                        <div class="col-md-4 m-b-20">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-plus"></i> Tambah Pelamar</button>
                                <div class="dropdown-menu">
                                    <?php foreach ($lowongan as $data) : ?>
                                        <a class="dropdown-item" href="<?= base_url('pelamar/tambahPelamar/' . $data['id_posisi']) ?>"><?= $data['posisi']; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div><!-- /btn-group -->
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered m-t-20">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Interview</th>
                                        <th>Nama</th>
                                        <th>Posisi</th>
                                        <th>Penilaian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pelamar as $data) :
                                        $query = $this->db->get_where('lowongan', ['id_posisi' => $data['id_posisi']])->row_array();
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data['tgl_interview']; ?></td>
                                            <td><?= $data['nama_pelamar']; ?></td>
                                            <td><?= $query['posisi']; ?></td>
                                            <td><a class="btn btn-outline-primary" href="<?= base_url() ?>pelamar/detailPelamar/<?= $data['id_pelamar']; ?>"><i class="mdi mdi-magnify"></i> Lihat</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Interview</th>
                                        <th>Nama</th>
                                        <th>Posisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->