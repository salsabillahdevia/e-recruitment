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
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>evaluasi">Lamaran</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>evaluasi">Evaluasi Pelamar</a></li>
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
                        <h3 class="text-danger m-t-30">Berikut Merupakan Hasil Penilaian Pelamar Berdasarkan Interview</h3>
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
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered m-t-20">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <?php
                                        $no = 1;
                                        $table = $this->page->getData('tableFinal');
                                        foreach ($table as $item => $value) {
                                            foreach ($value as $heading => $itemValue) {
                                                if ($heading == 'id_posisi') {
                                                    continue;
                                                } elseif ($heading == 'nama_pelamar') {
                                                    $heading = str_replace('nama_pelamar', 'Nama Pelamar', $heading);
                                                }
                                                $heading = str_replace('_', ' ', $heading);
                                        ?>
                                                <th class="text-center"><?php echo $heading ?></th>
                                        <?php
                                            }
                                            break;
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($table as $item => $value) {
                                        if ($value->Rangking <= $lowongan['kuota']) {
                                            $bg = 'alert-success';
                                        } else {
                                            $bg = 'alert-danger';
                                        }
                                    ?>
                                        <tr>
                                            <td class="<?= $bg; ?>"><?= $no++; ?></td>
                                            <?php
                                            foreach ($value as $item => $itemValue) {
                                                if ($item == 'id_posisi') {
                                                    continue;
                                                }
                                            ?>
                                                <td class="<?= $bg; ?>"><?php echo $itemValue ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <?php
                                        $no = 1;
                                        $table = $this->page->getData('tableFinal');
                                        foreach ($table as $item => $value) {
                                            foreach ($value as $heading => $itemValue) {
                                                if ($heading == 'id_posisi') {
                                                    continue;
                                                } elseif ($heading == 'nama_pelamar') {
                                                    $heading = str_replace('nama_pelamar', 'Nama Pelamar', $heading);
                                                }
                                                $heading = str_replace('_', ' ', $heading);
                                        ?>
                                                <th class="text-center"><?php echo $heading ?></th>
                                        <?php
                                            }
                                            break;
                                        }
                                        ?>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php
                        $table = $this->page->getData('tableFinal');
                        foreach ($table as $item => $value) {
                            if ($value->Rangking == 1) {
                        ?>
                                <div class="alert alert-success" role="alert">
                                    <h4><b>Kesimpulan : </b> Dari hasil perhitungan yang dilakukan menggunakan metode SAW
                                        Pelamar terbaik untuk di pilih adalah
                                        <?php echo $value->nama_pelamar ?> dengan nilai <?php echo $value->Total ?>
                                    </h4>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->