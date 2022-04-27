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
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user/evaluasi">Lamaran</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>user/evaluasi">Evaluasi Pelamar</a></li>
                            <li class="breadcrumb-item active">Evaluasi Posisi <?= $lowongan['posisi']; ?></li>
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
                        <h3>Testing</h3>
                        <hr>
                        <h4>Nilai Awal</h4>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Pelamar</th>
                                <?php foreach ($kriteria as $data) : ?>
                                    <th><?= $data['kriteria']; ?></th>
                                <?php endforeach; ?>
                            </tr>
                            <?php $no = 1;
                            foreach ($pelamar as $data) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['nama_pelamar']; ?></td>
                                    <td><?= $data['nilai1']; ?></td>
                                    <td><?= $data['nilai2']; ?></td>
                                    <td><?= $data['nilai3']; ?></td>
                                    <td><?= $data['nilai4']; ?></td>
                                    <td><?= $data['nilai5']; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                        <hr>
                        <h4 class="m-t-30">Nilai Max dan Min Per Kriteria</h4>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <?php
                                foreach ($kriteria as $data) :
                                    $sifat = $data['sifat'] ?>
                                    <th><?= $data['kriteria'] . '-' . $sifat; ?></th>
                                <?php
                                    if ($data['sifat'] == 'B') {
                                        $action = 'select_max';
                                    } elseif ($data['sifat'] == 'C') {
                                        $action = 'select_min';
                                    }
                                    $this->db->$action('nilai');
                                    $query1 = $this->db->get_where('penilaian_pelamar', ['id_posisi' => $lowongan['id_posisi'], 'id_kriteria' => 1])->row_array();
                                    $this->db->$action('nilai');
                                    $query2 = $this->db->get_where('penilaian_pelamar', ['id_posisi' => $lowongan['id_posisi'], 'id_kriteria' => 2])->row_array();
                                    $this->db->$action('nilai');
                                    $query3 = $this->db->get_where('penilaian_pelamar', ['id_posisi' => $lowongan['id_posisi'], 'id_kriteria' => 3])->row_array();
                                    $this->db->$action('nilai');
                                    $query4 = $this->db->get_where('penilaian_pelamar', ['id_posisi' => $lowongan['id_posisi'], 'id_kriteria' => 4])->row_array();
                                    $this->db->$action('nilai');
                                    $query5 = $this->db->get_where('penilaian_pelamar', ['id_posisi' => $lowongan['id_posisi'], 'id_kriteria' => 5])->row_array();
                                endforeach; ?>
                            </tr>
                            <?php
                            ?>
                            <tr>
                                <td><?= $query1['nilai'] . '-' . $sifat; ?></td>
                                <td><?= $query2['nilai'] . '-' . $sifat; ?></td>
                                <td><?= $query3['nilai'] . '-' . $sifat; ?></td>
                                <td><?= $query4['nilai'] . '-' . $sifat; ?></td>
                                <td><?= $query5['nilai'] . '-' . $sifat; ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?= $title; ?> Posisi <?= $lowongan['posisi']; ?></h3>
                        <div class="form-group row  m-t-30">
                            <label for="jumlahPelamar" class="col-sm-2 control-label col-form-label">Jumlah Pelamar</label>
                            <div class="col-sm-2 input-group">
                                <input type="text" class="form-control" id="jumlahPelamar" name="jumlah_pelamar" value="<?= $lowongan['jumlah_pelamar']; ?>" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-human-male"></i></span>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <label for="kuota" class="col-sm-1 control-label col-form-label">Kuota</label>
                            <div class="col-sm-2 input-group">
                                <input type="text" class="form-control" id="kuota" placeholder="First Name Here" name="kuota" value="<?= $lowongan['kuota']; ?>" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-chart-bar"></i></span>
                                </div>
                            </div>
                        </div>
                        <h4 class="text-danger m-t-30">Berikut Merupakan Hasil Penilaian Pelamar Berdasarkan Interview</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered m-t-20">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Interview</th>
                                        <th>Nama</th>
                                        <th>Nilai Total</th>
                                        <th>Penilaian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pelamar as $data) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data['tgl_interview']; ?></td>
                                            <td><?= $data['nama_pelamar']; ?></td>
                                            <td><?= $data['nilai1']; ?></td>
                                            <td><a class="btn btn-outline-primary" href="<?= base_url() ?>user/detailPelamar/<?= $data['id_pelamar']; ?>"><i class="mdi mdi-magnify"></i> Lihat</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Interview</th>
                                        <th>Nama</th>
                                        <th>Nilai Total</th>
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