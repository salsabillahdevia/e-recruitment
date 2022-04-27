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
                        <div class="panel-heading">Table Perhitungan</div>
                        <div class="panel-body">
                            <h2>Table 1 - Nilai Awal</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr class="active">
                                        <th class="col-md-1 text-center">No</th>
                                        <?php
                                        $no = 1;
                                        $table = $this->page->getData('table1');
                                        foreach ($table as $item => $value) {
                                            foreach ($value as $heading => $itemValue) {
                                        ?>
                                                <th class="text-center"><?php echo $heading ?></th>
                                        <?php
                                            }
                                            break;
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                    foreach ($table as $item => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <?php
                                            foreach ($value as $itemValue) {
                                            ?>
                                                <td><?php echo $itemValue ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>

                                </table>
                            </div>

                            <h2>Table 2 - Dihitung sesuai sifat cost atau benefit</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr class="active">
                                        <th class="col-md-1 text-center">No</th>
                                        <?php
                                        $no = 1;
                                        $table = $this->page->getData('table2');
                                        foreach ($table as $item => $value) {
                                            foreach ($value as $heading => $itemValue) {
                                        ?>
                                                <th class="text-center"><?php echo $heading ?></th>
                                        <?php
                                            }
                                            break;
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                    foreach ($table as $item => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <?php
                                            foreach ($value as $itemValue) {
                                            ?>
                                                <td><?php echo $itemValue ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </table>
                            </div>

                            <div class="table-responsive ">
                                <table class="table table-bordered">
                                    <tr class="active">
                                        <th class="col-md-1 text-center">No</th>
                                        <th class="text-center">Kriteria</th>
                                        <th class="text-center">Sifat</th>
                                        <th class="text-center">Nilai min /max</th>
                                    </tr>
                                    <?php
                                    $dataSifat = $this->page->getData('dataSifat');
                                    $no = 1;
                                    foreach ($dataSifat as $item => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <td><?php echo $item ?></td>
                                            <td><?php echo $value->sifat ?></td>
                                            <td>
                                                <?php
                                                $valueMinMax = $dataSifat = $this->page->getData('valueMinMax');
                                                if (isset($valueMinMax['min' . $item])) {
                                                    echo $valueMinMax['min' . $item] . ' - Minimal';
                                                }
                                                if (isset($valueMinMax['max' . $item])) {
                                                    echo $valueMinMax['max' . $item] . ' - Maksimal';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </table>
                            </div>

                            <h2>Table 3 - Dikali dengan bobot</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr class="active">
                                        <th class="col-md-1 text-center">No</th>
                                        <?php
                                        $no = 1;
                                        $table = $this->page->getData('table3');
                                        foreach ($table as $item => $value) {
                                            foreach ($value as $heading => $itemValue) {
                                        ?>
                                                <th class="text-center"><?php echo $heading ?></th>
                                        <?php
                                            }
                                            break;
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                    foreach ($table as $item => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <?php
                                            foreach ($value as $itemValue) {
                                            ?>
                                                <td><?php echo $itemValue ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </table>
                            </div>

                            <div class="table-responsive ">
                                <table class="table table-bordered">
                                    <tr class="active">
                                        <th class="col-md-1 text-center">No</th>
                                        <th class="text-center">Kriteria</th>
                                        <th class="text-center">Bobot</th>
                                    </tr>
                                    <?php
                                    $bobot = $this->page->getData('bobot');
                                    $no = 1;
                                    foreach ($bobot as $item => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <td><?php echo $value->kriteria ?></td>
                                            <td class="text-center"><?php echo $value->bobot ?></td>

                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </table>
                            </div>
                            <h2>Table 4 - Dijumlah sesuai dengan pelamar dan di dapat hasil rangking</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr class="active">
                                        <th class="col-md-1 text-center">No</th>
                                        <?php
                                        $no = 1;
                                        $table = $this->page->getData('tableFinal');
                                        foreach ($table as $item => $value) {
                                            foreach ($value as $heading => $itemValue) {
                                        ?>
                                                <th class="text-center"><?php echo $heading ?></th>
                                        <?php
                                            }
                                            break;
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                    foreach ($table as $item => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <?php
                                            foreach ($value as $itemValue) {
                                            ?>
                                                <td><?php echo $itemValue ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
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
                        <hr>
                        <hr>
                        <h4 class="text-danger m-t-30">Berikut Merupakan Hasil Penilaian Pelamar Berdasarkan Interview</h4>
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
                                        ?>
                                                <th class="text-center"><?php echo $heading ?></th>
                                        <?php
                                            }
                                            break;
                                        }
                                        ?>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($table as $item => $value) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <?php
                                            foreach ($value as $itemValue) {
                                            ?>
                                                <td><?php echo $itemValue ?></td>
                                            <?php
                                            }
                                            ?>
                                            <!-- <td><a class="btn btn-outline-primary" href="<?//= base_url() ?>user/detailPelamar/<?//= $data['id_pelamar']; ?>"><i class="mdi mdi-magnify"></i> Lihat</a></td> -->
                                        </tr>
                                    <?php } ?>
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