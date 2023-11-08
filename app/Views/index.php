<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Smart Plug</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="https://cdn.vectorstock.com/i/preview-1x/11/36/flat-leave-icon-vector-18811136.jpg" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include "nav/top.php" ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include "nav/side.php" ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span> 
            </h3>
          </div>

          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <?php foreach ($lastRelay as $lr) : ?>
                <?php
                $rStatus = $lr['status'];
                if ($rStatus == 'on') {
                  $warna = 'bg-gradient-success';
                  $Bwarna = 'bg-gradient-success';
                  $cek = 'checked';
                } else if ($rStatus == 'off') {
                  $warna = 'bg-gradient-danger';
                  $Bwarna = 'bg-gradient-secondary';
                  $cek = "";
                }
                ?>
                <div class="card <?= $warna ?>  card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?= base_url() ?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Status Plug <i class="mdi mdi-air-conditioner mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-2 text-center text-uppercase"> <?= $lr['status'] ?></h2>
                  </div>
                </div>
            </div>
          <?php endforeach; ?>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-warning card-img-holder text-white">
              <div class="card-body">
                <img src="<?= base_url() ?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Daya Digunakan <i class="mdi mdi-air-conditioner mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-2 text-center"> <?= $kwh ?> Kwh</h2>
              </div>
            </div>
          </div>
          <div class="col-md-4  stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
              <div class="card-body">
                <img src="<?= base_url() ?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Estimasi Biaya <i class="mdi mdi-air-conditioner mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-2 text-center"> Rp.<?= $biaya ?> / Jam</h2>
              </div>
            </div>
          </div>

          </div>

          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card <?= $Bwarna ?> ">
                <div class="card-body">
                  <h4 class="card-title">Control</h4>
                  <style>
                    .checkbox-container {
                      display: flex;
                      align-items: center;
                      justify-content: center;
                    }

                    input[type="checkbox"] {
                      height: 200px;
                      width: 200px;
                      -webkit-appearance: none;
                      box-shadow:
                        -10px -10px 15px rgba(255, 255, 255, 0.5),
                        10px 10px 15px rgba(70, 70, 70, 0.12);
                      position: relative;
                      transform: translate(-50%, 0%);
                      top: 50%;
                      left: 50%;
                      border-radius: 50%;
                      border: 20px solid #ececec;
                      outline: none;
                      display: flex;
                      align-items: center;
                      justify-content: center;
                      cursor: pointer;
                    }

                    input[type="checkbox"]::after {
                      font-family: FontAwesome;
                      content: "\f011";
                      color: #7a7a7a;
                      font-size: 70px;
                    }

                    input[type="checkbox"]:checked {
                      box-shadow:
                        -10px -10px 15px rgba(255, 255, 255, 0.5),
                        10px 10px 15px rgba(70, 70, 70, 0.12),
                        inset -10px -10px 15px rgba(255, 255, 255, 0.5),
                        inset 10px 10px 15px rgba(70, 70, 70, 0.12);
                    }

                    input[type="checkbox"]:checked::after {
                      color: #15e38a;
                    }
                  </style>
                  <div class="checkbox-container">
                    <input type="checkbox" id="relayCheckbox" <?= $cek ?> />

                    <script>
                      document.addEventListener('DOMContentLoaded', function() {
                        const relayCheckbox = document.getElementById('relayCheckbox');

                        relayCheckbox.addEventListener('change', function() {
                          const status = relayCheckbox.checked ? 'on' : 'off';
                          const apiUrl = `https://appapi.my.id/index.php/relay/insertrelay?status=${status}`;

                          // Kirim permintaan ke API
                          fetch(apiUrl, {
                              method: 'POST', // Atur metode yang sesuai (POST/GET) sesuai dengan kebutuhan Anda
                              // Tambahkan header jika diperlukan
                            })
                            .then(response => {
                              if (response.ok) {
                                console.log('Berhasil: Data berhasil dikirim ke API.');
                                setTimeout(function() {
                                  location.reload();
                                }, 500);
                              } else {
                                console.log('Gagal: Terjadi kesalahan saat mengirim data ke API.');
                              }
                            })
                            .catch(error => {
                              console.error('Gagal: Terjadi kesalahan jaringan', error);
                            });
                        });
                      });
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Status Relay</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Status </th>
                          <th> Date </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;
                        foreach ($relay as $r) : ?>
                          <tr>
                            <td><?= $i++ ?> </td>
                            <td>
                              <?php
                              $status = $r['status'];
                              if ($status == 'on') {
                                echo '<label class="badge badge-gradient-success">ON</label>';
                              } else if ($status == 'off') {
                                echo '<label class="badge badge-gradient-danger">OFF</label>';
                              }
                              ?>
                            </td>
                            <td>
                              <?php
                              $date = $r['date'];
                              echo date("H:i , M j Y", strtotime($date));
                              ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?= base_url() ?>assets/vendors/chart.js/Chart.min.js"></script>
  <script src="<?= base_url() ?>assets/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
  <script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
  <script src="<?= base_url() ?>assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
</body>

</html>