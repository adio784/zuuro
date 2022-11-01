@php 
 $Notif = DB::table('notifications')->count('id');
@endphp
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Administrative :|- Welcome to Zuuro Telecommunications </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.png') }}" /> 

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min') }}" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Demo CSS (No need to include it into your project) -->
    <link rel="stylesheet" href="{{ asset('css/clock_demo.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('js/config.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ asset('DataTables/datatables.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img
                  width="25"
                  viewBox="0 0 25 42"
                  version="1.1"
                  src="{{ asset('images/favicon.png') }}"
                >
              </span>
              <span class="app-brand-text demo fw-bolder ms-2">Zuuro</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="/admin_dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Pages</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account Settings</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="#" class="menu-link">
                    <div data-i18n="Account">Manage Admin</div>
                  </a>
                </li>
                <!-- <li class="menu-item">
                  <a href="pages-account-settings-notifications.html" class="menu-link">
                    <div data-i18n="Notifications">User</div>
                  </a>
                </li> -->
                <li class="menu-item">
                  <a href="/manage_country_page" class="menu-link">
                    <div data-i18n="Connections">Country </div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/niger_datapricing" class="menu-link">
                    <div data-i18n="Connections">Pricing </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div data-i18n="Authentications">Transactions</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/all_transaction_history" class="menu-link" target="_blank">
                    <div data-i18n="Basic">All</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/data_history_page" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Data</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/airtime_history_page" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Airtime</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="/repayment_history_page" class="menu-link" target="_blank">
                    <div data-i18n="Basic">repayment</div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Fund Wallet</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="#" class="menu-link">
                    <div data-i18n="Error">Automated Bank Transfer</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#" class="menu-link">
                    <div data-i18n="Under Maintenance">Pay with Card</div>
                  </a>
                </li>
              </ul>
            </li> -->
            
            <!-- Data -->
            <li class="menu-item">
              <a href="/manage_users_page" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Users</div>
              </a>
            </li>
            <!-- Airtime
            <li class="menu-item">
              <a href="icons-boxicons.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Airtime</div>
              </a>
            </li> -->
            <!-- Loan -->
            <!-- <li class="menu-item">
              <a href="icons-boxicons.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Zuuro Loan</div>
              </a>
            </li> -->
            <!-- Utility -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Zuuro Loan</div>
              </a>
              <ul class="menu-sub">
              <li class="menu-item">
                  <a href="/manage_debtors" class="menu-link">
                    <div data-i18n="Accordion">Debtors</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/loan_payment_method_page" class="menu-link">
                    <div data-i18n="Accordion">Payment method</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/late_loan_payment" class="menu-link">
                    <div data-i18n="Accordion">Late payment</div>
                  </a>
                </li>
                <!-- <li class="menu-item">
                  <a href="loan_period_page" class="menu-link">
                    <div data-i18n="Alerts">Loan period</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="loan_interest_page" class="menu-link">
                    <div data-i18n="Alerts">Loan interest</div>
                  </a>
                </li> -->
                <li class="menu-item">
                  <a href="/sms_debtors_page" class="menu-link">
                    <div data-i18n="Alerts">SMS Debtors</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Loan Management -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div data-i18n="Extended UI">Loan Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/loan_record" class="menu-link">
                    <div data-i18n="Perfect Scrollbar">Loan Record</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/paid_loan" class="menu-link">
                    <div data-i18n="Text Divider">Paid Loan</div>
                  </a>
                </li>
              </ul>
            </li>

            {{-- Accounts --}}
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div data-i18n="Extended UI">Accounts</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/paystack_record" class="menu-link">
                    <div data-i18n="Perfect Scrollbar">Paystack >> </div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/dingconnect_record" class="menu-link">
                    <div data-i18n="Text Divider">DingConnect</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/direct_carrier_bill" class="menu-link">
                    <div data-i18n="Text Divider">Direct Carrier</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/flutterwave_record" class="menu-link">
                    <div data-i18n="Text Divider">Fluter Wave</div>
                  </a>
                </li>
              </ul>
            </li>

            

            <!-- Others -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Other &amp; Action</span></li>
            <li class="menu-item">
              <a
                href="/support_page"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="/term_conditions"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-terminal"></i>
                <div data-i18n="Support">Terms & Condition</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="{{('/manage_ads')}}"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Manage Ads</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="manage_faq"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">F.A.Q</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Administrator</a
                  >
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('img/avatars/usr-img.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset('img/avatars/usr-img.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ session('LoggedAdminFullName') }}</span>
                            <small class="text-muted">{{ session('LoggedAdminEmail') }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="admin_profile">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="admin_notification">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Notifications</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">{{ $Notif }}</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        
                            <a class="dropdown-item" href="{{ route('signout') }}">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            @yield('content')

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

    <!-- Core JS -->
    <!-- build:js vendor/js/core.js -->
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('js/ui-toasts.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
