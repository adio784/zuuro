<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Welcome | QoinCo - User Dashboard for all operations </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>

    <script src="/assets/js/config.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

  </head>

  <body>


        <div class="flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Loan /</span> Data</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Data</h5>
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    
                    <div class="card-body">
                      <div class="table">
                      <table id="example" class="display" style="width:100%">
                        <thead>
                          <td>id</td>
                          <th width="60%">Provider Code</th>
                          <th width="20%">SkuCode</th>
                          <th width="20%">DefaultDisplayText</th>
                          
                          <th width="20%"> LocalizationKey</th>
                          <th width="20%">CommissionRate</th>
                          <th width="20%">ProcessingMode</th>
                          <th width="20%">RedemptionMechanism</th>
                          <!-- <th width="20%">ValidityPeriodIso</th> -->
                          <th width="20%">UatNumber</th>
                          <th width="20%">RegionCode</th>
                          
                          <th width="20%">ValidityPeriodIso</th>
                          <th width="20%">Status</th>
                          <th width="20%">Created_At</th>
                          <th width="20%">Updated_At</th>
                          
                        </thead>
                        <tbody>
                        @foreach($Products as $key=>$Product)
                        <?php $count++; ?>
                        <tr>
                              <td> {{ $count }}</td>
                              <td> {{ $Product['ProviderCode'] }} </td>
                              <td> {{ $Product['SkuCode'] }} </td>
                              <td> {{ $Product['DefaultDisplayText'] }} </td>  
                              <td> {{ $Product['LocalizationKey'] }} </td>                        
                              <td> {{ $Product['CommissionRate'] }} </td>
                              <td> {{ $Product['ProcessingMode'] }} </td>
                              <td> {{ $Product['RedemptionMechanism'] }} </td>
                               
                              <td> {{ $Product['UatNumber'] }} </td>                              
                              <td> {{ $Product['RegionCode'] }} </td> 

                              <td> <?php 
                                      error_reporting(0);
                                      if($Product['ValidityPeriodIso'] == 'P1D'){ echo $Product['ValidityPeriodIso']; }
                                      elseif($Product['ValidityPeriodIso'] == ''){ echo $Product['ValidityPeriodIso']; }
                                      else{ echo $Product['ValidityPeriodIso'].'ays'; } ?> 
                                </td>                              
                              <td> {{ '1' }} </td>                                                       
                              <td>{{ date('Y-m-d H-m-s') }}</td>
                              <td>{{ date('Y-m-d H-m-s') }}</td>
                              
                            </tr>
                        @endforeach
                        </tbody>
                      </table>
                      </div>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
              </div>
        </div>



                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                              <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                  document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Excel GlobalTech.</a>
                              </div>
                              <div>
                                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">Main Website</a>
                                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">Pricing</a>
              
                                <a
                                  href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                  target="_blank"
                                  class="footer-link me-4"
                                  >Term & Conditions</a
                                >
              
                                <a
                                  href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                  target="_blank"
                                  class="footer-link me-4"
                                  >Support</a
                                >
                              </div>
                            </div>
                          </footer>
                          <!-- / Footer -->
              
                          <div class="content-backdrop fade"></div>
                        </div>
                        <!-- Content wrapper -->
                      </div>
                      <!-- / Layout page -->
                    </div>
              
                    <!-- Overlay -->
                    <div class="layout-overlay layout-menu-toggle"></div>
                  </div>
                  <!-- / Layout wrapper -->
              
                  <div class="buy-now">
                    <a
                      href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
                      target="_blank"
                      class="btn btn-success btn-buy-now"
                      >Live chat</a
                    >
                  </div>
              
                  <!-- Core JS -->
                  <!-- build:js assets/vendor/js/core.js -->
                  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
                  <script src="../assets/vendor/libs/popper/popper.js"></script>
                  <script src="../assets/vendor/js/bootstrap.js"></script>
                  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
              
                  <!-- Data Tables -->
                  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
              
              
                  <script src="../assets/vendor/js/menu.js"></script>
                  <!-- endbuild -->
              
                  <!-- Vendors JS -->
                  <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>
              
                  <!-- Main JS -->
                  <script src="../assets/js/main.js"></script>
              
                  <!-- Page JS -->
                  <script src="../assets/js/dashboards-analytics.js"></script>
              
                  <!-- Place this tag in your head or just before your close body tag. -->
                  <script async defer src="https://buttons.github.io/buttons.js"></script>
              
                  <script>
                      $(document).ready(function() {
                        $('#example').DataTable( {
                            dom: 'Bfrtip',
                            buttons: [
                                'copyHtml5',
                                'excelHtml5',
                                'csvHtml5',
                                'pdfHtml5'
                            ]
                        } );
                      });
                  </script>
              
                </body>
              </html>