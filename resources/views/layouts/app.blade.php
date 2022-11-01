@php 
 $Notif = DB::table('notifications')->where('user_id', Auth::user()->id)->count('id');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Welcome | Zuuro Telecommunications Limited </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/demo_country.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/libs/apex-charts/apex-charts.css') }}" />


    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('js/config.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js" ></script>
    
    
    

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    

    <style>
      #loan_receipt {
        padding: 10px;
        background-color: rgba(46, 46, 46, 0.016);
      }

      @media print
        {
            .print-hidden {
                display: none;
            }
            
            a {
                display: none;
            }
        }
      
    </style>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ route('user-welcome') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img
                  width="25"
                  viewBox="0 0 25 42"
                  version="1.1"
                  src="{{ asset('images/favicon.png') }}"
                >
                  <defs>
                    <path
                      d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                      id="path-1"
                    ></path>
                    <path
                      d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                      id="path-3"
                    ></path>
                    <path
                      d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                      id="path-4"
                    ></path>
                    <path
                      d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                      id="path-5"
                    ></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g
                          id="Triangle"
                          transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                        >
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
              </img>
              </span>
              <span class="app-brand-text demo fw-bolder ms-2">ZUURO</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="{{('home')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Pages</span>
            </li>
            
            <li class="menu-item">
              <a href="{{ ('/transactions') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Transactions</div>
              </a>
            </li>
            
            <!-- Data -->
            <li class="menu-item">
              <a href="{{('/loan_data')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Basic">Data</div>
              </a>
            </li>
            <!-- Airtime -->
            <li class="menu-item">
              <a href="{{('/loan_airtime')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Airtime</div>
              </a>
            </li>
            <!-- Loan -->
            <li class="menu-item">
              <a href="{{('/loan_summary')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Boxicons">ZUURO Loan</div>
              </a>
            </li>

             <!-- Pricing -->
             <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div data-i18n="Extended UI">Fund Wallet</div>
              </a>
              <ul class="menu-sub"> 
                @php
                  $PayMethodABT = DB::table('payment_method')->where('id',1)->first();
                  $PayMethodStack = DB::table('payment_method')->where('id',2)->first();
                @endphp
                  
                
                @if($PayMethodABT->status ==1)
                <li class="menu-item">
                  <a href="{{('/automated_bank_transfer')}}" class="menu-link">
                    <div data-i18n="Perfect Scrollbar">ABT- Automated Bank Transfer</div>
                  </a>
                </li>
                @endif
                @if($PayMethodStack->status ==1)
                <li class="menu-item">
                  <a href="{{('/user_account_cardfund')}}" class="menu-link">
                    <div data-i18n="Text Divider">Card Funding</div>
                  </a>
                </li>
                @endif
                <li class="menu-item">
                  <a href="{{('/user_fund_history')}}" class="menu-link">
                    <div data-i18n="Text Divider">Fund History</div>
                  </a>
                </li>
              </ul>
            </li> 
            

            <!-- Others -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Other &amp; Action</span></li>
            <li class="menu-item">
              <a
                href="{{('/transaction_pin')}}"
                target="_blank"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-lock"></i>
                <div data-i18n="Support">Change PIN</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="{{('/customer_support')}}"
                target="_blank"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="/user_term_conditions"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-terminal"></i>
                <div data-i18n="Support">Terms & Condition</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a
                href="{{('/user_faq')}}"
                target="_blank"
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
            class="layout-navbar print-hidden container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
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
                    href="#"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >{{ Auth::user()->country }}</a
                  >
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="@if(Auth::user()->gender =='Male'){{ asset('img/avatars/boy.png') }} @else {{ asset('img/avatars/girl-1.png') }} @endif" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="@if(Auth::user()->gender =='Male'){{ asset('img/avatars/boy.png') }} @else {{ asset('img/avatars/girl-1.png') }} @endif" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{('user_profile')}}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <!-- <li>
                      <a class="dropdown-item" href="{{('account_setting')}}">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li> -->
                    <li>
                      <a class="dropdown-item" href="/user_notifications">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Notification</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">{{ $Notif  }}</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                         <i class="bx bx-power-off me-2"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    {{-- <li>
                      <a class="dropdown-item" href="/logout_user">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li> --}}
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

            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  Copyright ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                   | All right reserved.
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

    <div class="buy-now print-hidden">
      <a
        href="https://www.wa.me/09098146934"
        target="_blank"
        class="btn btn-success btn-buy-now"
        ><i class='bx bxl-whatsapp'></i></a
      >
    </div>

    <!-- Core JS -->
    <!-- build:js vendor/js/core.js -->
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <!-- Data Tables -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.5.25/dist/jspdf.plugin.autotable.js"></script>

    {{-- paystack cdn --}}
    <script src="https://js.paystack.co/v1/inline.js"></script> 
    <script src="https://checkout.flutterwave.com/v3.js"></script>


    <script src="{{ asset('vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('js/intlTelInput.js') }}"></script>

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
      } );
    </script>
     <script>
      $(document).ready(function() {
        $('#loan_receipt').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'pdfHtml5'
            ]
        } );
    } );
  </script>

      <!-- Phone Number Validation =================================== -->
  <script>
    if($('#phone_Number').length){
      var userName = document.querySelector('#phone_Number');

        userName.addEventListener('input', restrictNumber);
        function restrictNumber (e) {  
        var newValue = this.value.replace(new RegExp(/[^\d]/,'ig'), "");
        this.value = newValue;
        }
      }

  </script>

 <script>
  $(document).ready(function(){
    $('#country').change(function(){
      let ctr = $('#country').val();
      let phone = $('.phoneNumber').val();
      let vp = $('.phoneNumber').val()

      // $("#network").addClass("disabled"); 
      $('#network').css('pointer-events','none');
      $("#network_airtime").css('pointer-events','none');
      $("#select_network").html($('<div class="spinner-border spinner-border-sm text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>'));
      $("#select_networkAirt").html($('<div class="spinner-border spinner-border-sm text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>'));
      
      $.ajax({
        method: 'GET',
        url: '/getOperatorByPhone/'+ctr,
        success:function(response)
        {
          if(response != ""){
              if($('#network_airtime').length) {
                
                $("#select_networkAirt").html("");
                $("#select_networkAirt").html('Network') ;
                $('#network').css('pointer-events','visible'); 
                $("#network_airtime").css('pointer-events','visible');

                $('#network_airtime').html("<option> Select Network </option>");
                $.each(response.Operators, function(key, item) {
                  $('#network_airtime').append(
                    '<option value='+ item.ProviderCode +'>'+ item.Name + '</option>'
                  )
                });
              }else{
                
                $("#select_network").html("");
                $("#select_network").html('Network') ;
                $('#network').css('pointer-events','visible'); 
                $("#network_airtime").css('pointer-events','visible');

                  $('#network').html("<option> Select Network </option>");
                  console.log(response);
                  $.each(response.Operators, function(key, item) {
                    $('#network').append(
                      '<option value='+item.ProviderCode+'>'+ item.Name +'</option>'
                    )
                  }); 
                }
          }else{
            $('#network').html("<option> Select Network </option>");
          }
          // $('#countryInfoContainer').toggleClass('d-none');
          // for(i in response.Operators){
          //   $('#network').append('<option>'+ response.Operators[i].operator +'</option>');
          //   // console.log(response.Operators[i].operator);
          // }
        }
      });
      $.ajax({
        method: 'GET',
        url: '/getPhoneCodeIso/'+ctr,
        success:function(data)
        {
          if(data != ""){
            // $('#network').html("<option> Select Network </option>");
            $.each(data.PhoneCode, function(key, phn) {
              let vall = phn.phonecode;
              // console.log(vall);
              $('.phoneNumber').val(vall);
            })
          }
          
        }
        });
    });



    // Checking data product for each network
  if ($('#network').length) {
    $('#network').on('change', function(){
      let ph_no = $('#phone_Number').val();
     
      $("#data_plan").css('pointer-events','none'); 
      $("#select_dataplan").html($('<div class="spinner-border spinner-border-sm text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>'));

      // alert(ph_no);
      $.ajax({
        method: 'GET',
        url: '/getProductByPhone/'+ph_no,
        success:function(response)
        {
          if(response != ""){
            $("#select_dataplan").html("");
            $("#select_dataplan").html('Select Data Plan') ;
            $("#data_plan").css('pointer-events','visible'); 
            $('#data_plan').html("<option> Select Plan </option>");
            // console.log(response.DefaultDisplayText);
            $.each(response, function(key, item) {
              let validperiod = "";
              if(item.ValidityPeriodIso == " "){ validperiod = '-';}else{validperiod= '(' +item.ValidityPeriodIso +'Days )';}
              let inpu_amt_val = item.price;
              if(item.DefaultDisplayText == ''){
                $('#data_plan').append(
                  "<option value=''> -- Input phone number with country code -- </option>"
                );
              }else{
                $('#data_plan').append(
                  "<option value="+ inpu_amt_val +">" + item.DefaultDisplayText + " -- " + validperiod + " -- " + " - at ( " + new Intl.NumberFormat().format(item.Minimum.ReceiveValue) + ' ' + item.Minimum.ReceiveCurrencyIso + ' ) '+ "</option>"
                );
              }
              
               // Passing values
              let distributorReference = Math.floor(100000 + Math.random() * 900000);
              let SendCurrencyIso = item.Minimum.SendCurrencyIso;
              let BillRef = item.LookupBillsRequired;
              let ReceiveCurrencyIso = item.Minimum.ReceiveCurrencyIso;
              let DefaultDisplayText = item.DefaultDisplayText;

              $('#SendCurrencyIso').val(SendCurrencyIso); 
              $('#DefaultDisplayText').val(DefaultDisplayText); 
              $('#DistributorRef').val(distributorReference); 
              $('#SName').val('Data'); 
              $('#BillRef').val(BillRef); 
              $('#ReceiveCurrencyIso').val(ReceiveCurrencyIso); 
            });
            
          }else{
            $('#data_plan').html("<option value=''> Select Plan </option>");
          }
        }
      })
    });
  }else{
    $('#network_airtime').on('change', function(){
      let ph_no = $('#phone_Number').val();
      let network_provider = $(this).val();

      $("#input_amount").css('pointer-events','none'); 
      $("#select_inputAmt").html($('<div class="spinner-border spinner-border-sm text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>'));
      
          // Ajax  request to get provider details
          $.ajax({
            method: 'GET',
            url: '/getLogoByProviderCode/'+network_provider,
            success:function(data)
            {
              if(data != ""){

                $('#modileNetworkDetaile').toggleClass('d-none');
                $.each(data.OperatorLogos, function(key, item) {
                  let opUrl = item.LogoUrl;
                  let Name = item.Name;
                  console.log(opUrl);
                  $('#network_logo').attr('src', opUrl);
                  $('#operator_CName').html(Name);
                });
              }
              
            }
          });
      $.ajax({
        method: 'GET',
        url: '/getAirtimeProductByPhone/'+ph_no,
        success:function(response)
        {
          if(response != ""){
            $("#select_inputAmt").html("");
            $("#select_inputAmt").html('Input Amount') ;
            $("#input_amount").css('pointer-events','visible'); 

            $('#input_amount').html("<option> Select Amount </option>");
            console.log(response);
            $.each(response, function(key, item) {
              if(item.ValidityPeriodIso=='undefined'){ validperiod = '';}else{validperiod= item.ValidityPeriodIso +'ays';}
                let inpu_amt_val = item.SkuCode+','+item.Minimum.SendValue ;
              $('#input_amount').append(
                "<option value="+ inpu_amt_val + ">" +  
                  
                  new Intl.NumberFormat().format(item.Minimum.ReceiveValue) + ' ' + item.Minimum.ReceiveCurrencyIso + "</option>"
              );
               // Passing values
              let distributorReference = Math.floor(100000 + Math.random() * 900000);
              let SendCurrencyIso = item.Minimum.SendCurrencyIso;
              let BillRef = item.LookupBillsRequired;
              let ReceiveCurrencyIso = item.Minimum.ReceiveCurrencyIso;
              
              $('#SendCurrencyIso').val(SendCurrencyIso);  $('#DistributorRef').val(distributorReference); 
              $('#SName').val('Airtime'); $('#BillRef').val(BillRef); 
              $('#ReceiveCurrencyIso').val(ReceiveCurrencyIso); 
            });
            
          }else{
            $('#input_amount').html("<option value=''> Select Amount </option>");
          }
        }
      })
    });
  }
// =======================================   Getting Product With Network ID ================== >
// This vaidate between Top-up and Loan ---------------------------------------------
    $('#top_up').change(function(){
      let top_up = $(this).val();
      // alert(top_up);
        if(top_up ==2){
          $('#country').val('NG').trigger('change');
          // $('.country_select').attr('disabled', true);
          $('#country').css('pointer-events','none');
          $('#loan_term_box').removeClass('d-none');
          $('#topup_message').toggleClass('d-none');
          $('#topup_message').html('The loan is only available in Nigeria ');
          var theValue = $('#country').val('NG').split(" ",1);
          $('option[value=' + theValue + ']').attr('selected', true);  
          $('#phone_Number').val('234');          
        }else{
          $('#loan_term_box').addClass('d-none');
          $('.country_select').attr('disabled', false);
          $('#country').css('pointer-events','visible'); 
          $('#topup_message').html('');
        }

    });


    // Getting Product Details By Themselves
    if($('#data_plan').length){
      $('#data_plan').change(function(){
        let data_plan_value = $(this).val();
          var names = data_plan_value;
          var nameArr = names.split(',');
          console.log(nameArr[0]);
          console.log(nameArr[1]);
        $('#sendValue').val(nameArr[1]);
        $('#SkuCode').val(nameArr[0]);
      });
      
    }else{
      $('#input_amount').change(function(){
        var airtime_plan_value = $(this).val();
          var names = airtime_plan_value;
          var nameArr = names.split(',');
          console.log(nameArr[0]);
          console.log(nameArr[1]);
        $('#sendValue').val(nameArr[1]);
        $('#SkuCode').val(nameArr[0]);
      });
      
    }

  })
  
</script>
<script>
  $(function() {
    $("#print_btn").click(function (){
        $("body > table").addClass("print-hidden");
        $(this).parents("table").last().removeClass("print-hidden");
        if (window.print) {
            window.print();
        }
    });
});
</script>

<script>
  async function generatePDF() {
      document.getElementById("downloadReceipt_btn").innerHTML = "downloading ...";

      //Downloading
      var downloading = document.getElementById("loan_receipt");
      var doc = new jsPDF('l', 'pt');

      await html2canvas(downloading, {
          //allowTaint: true,
          //useCORS: true,
          width: 530
      }).then((canvas) => {
          //Canvas (convert to PNG)
          doc.addImage(canvas.toDataURL("image/png"), 'PNG', 5, 5, 500, 200);
      })

      doc.save("Receipt.pdf");

      //End of downloading

      document.getElementById("downloadReceipt_btn").innerHTML = "Download";
  }
</script>

<script>
    function getRate(from, to) {
    var script = document.createElement('script');
    script.setAttribute('src', "http://query.yahooapis.com/v1/public/yql?q=select%20rate%2Cname%20from%20csv%20where%20url%3D'http%3A%2F%2Fdownload.finance.yahoo.com%2Fd%2Fquotes%3Fs%3D"+from+to+"%253DX%26f%3Dl1n'%20and%20columns%3D'rate%2Cname'&format=json&callback=parseExchangeRate");
    document.body.appendChild(script);
  }

  function parseExchangeRate(data) {
    var name = data.query.results.row.name;
    var rate = parseFloat(data.query.results.row.rate, 10);
    console.log("Exchange rate " + name + " is " + rate);
  }
  
getRate("SEK", "USD");
  getRate("USD", "SEK");
</script>

<script>
if($('#paymentForm').length){
var paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener('submit', payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();
      document.getElementById("hideWindowButton").innerHTML = "Loading ";
      $("#hideWindowButton").addClass("disabled");
      $("#hideWindowButton").append($('<div class="spinner-border spinner-border-sm text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>'));
  let handler = PaystackPop.setup({
    key: 'pk_test_394f238d02a87de9c5611878d71cf84df06bb015', // Replace with your public key
    email: document.getElementById('email_address').value,
    amount: document.getElementById('pay_amount').value * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
    currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
    ref: ''+Math.floor((Math.random() * 100000000) + 1), // Replace with a reference you generated
    callback: function(response) {
      //this happens after the payment is completed successfully
      let reference = response.reference;
      // alert('Payment complete! Reference: ' + reference);
      // Make an AJAX call to your server with the reference to verify the transaction
      $.ajax({
        url: "{{ URL::to('verifyPayment')}}/"+ response.reference,
        method: 'get',
        success: function (response) {
          // the transaction status is in response.data.status
          document.getElementById("hideWindowButton").innerHTML = "Success ";
          $("#hideWindowButton").removeClass("disabled");
          $('#pay_amount_error').html("You have added a new balance");
          $('#pay_amount').val(' ');
        }
      });
    },
    onClose: function() {
      alert('Transaction was not completed, window closed.');
    },
  });
  handler.openIframe();
}}
</script>




<script>
  $(function (){
    $('#automateBankTransfer').submit(function(e){
      e.preventDefault();

      document.getElementById("hideWindowButton").innerHTML = "Loading ";
      $("#hideWindowButton").addClass("disabled");
      $("#hideWindowButton").append($('<div class="spinner-border spinner-border-sm text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>'));
      // document.getElementById("hideWindowButton").innerHTML = "downloading ...";
      
      let name = $('#username').val();
      let email = $('#email_address').val();
      let phone = $('#phone_number').val();
      let amount = $('#pay_amount').val();
      makePayment(amount,email,phone,name);
    })
  });


  function makePayment(amount,email,phone_number,name) {
    FlutterwaveCheckout({
      public_key: "FLWPUBK_TEST-4656ea3f37bef493c54d971a4b89ecec-X",
      tx_ref: "SNK-{{ substr(rand(0,time()), 0,11) }}",
      amount,
      currency: "NGN",
      payment_options: "card, mobilemoneyghana, ussd",
      callback: function(payment) {
        // Send AJAX verification request 
        let transaction_id = payment.transaction_id;
        let _token = $("input[name=_token]").val();
        $.ajax({
          method: 'POST',
          url: "{{ URL::to('verifyPaymentFlutterWave') }}",
          data: { 
            transaction_id,
            _token
            },
          success: function (response) {
            console.log(response);
            $('#payment_failed').html(response +" You have added a new balance");
            $('#pay_amount').val(' ');
          }
      });
        verifyTransactionOnBackend(payment.id);
      },
      onclose: function(incomplete) {
        if (incomplete || window.verified === false) {
          document.querySelector("#payment-failed").style.display = 'block';
        } else {
          document.querySelector("form").style.display = 'none';
          if (window.verified == true) {
            document.querySelector("#payment-success").style.display = 'block';
          } else {
            document.querySelector("#payment-pending").style.display = 'block';
          }
        }
      },

      customer: {
        email,
        phone_number,
        name,
      },
      customizations: {
        title: "Zuuroo Telecommuncations",
        description: "Payment receieved",
        logo: "https://www.logolynx.com/images/logolynx/22/2239ca38f5505fbfce7e55bbc0604386.jpeg",
      },
    });
  }

  function verifyTransactionOnBackend(transactionId) {
    // Let's just pretend the request was successful
    setTimeout(function() {
      window.verified = true;
    }, 200);
  }
</script>


</body>
</html>