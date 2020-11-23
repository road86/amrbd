
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <link rel="icon" type="image/x-icon" href="favicon.ico">
   <title>AMR - Sensitivity Testing of Antibiotics in Bangladesh</title><!-- = VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="{{url('/')}}/public/vendor/@fortawesome/fontawesome-free/css/brands.css">
   <link rel="stylesheet" href="{{url('/')}}/public/vendor/@fortawesome/fontawesome-free/css/regular.css">
   <link rel="stylesheet" href="{{url('/')}}/public/vendor/@fortawesome/fontawesome-free/css/solid.css">
   <link rel="stylesheet" href="{{url('/')}}/public/vendor/@fortawesome/fontawesome-free/css/fontawesome.css"><!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="{{url('/')}}/public/vendor/simple-line-icons/css/simple-line-icons.css"><!-- ANIMATE.CSS-->
   <link rel="stylesheet" href="{{url('/')}}/public/vendor/animate.css/animate.css"><!-- WHIRL (spinners)-->
   <link rel="stylesheet" href="{{url('/')}}/public/vendor/whirl/dist/whirl.css"><!-- =============== PAGE VENDOR STYLES ===============-->
   <!-- WEATHER ICONS-->
   <link rel="stylesheet" href="{{url('/')}}/public/vendor/weather-icons/css/weather-icons.css"><!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="{{url('/')}}/public/css/bootstrap.css" id="bscss"><!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="{{url('/')}}/public/css/app.css" id="maincss">
   <link rel="stylesheet" href="{{url('/')}}/public/css/tableview.css">
   
   <link rel="stylesheet" href="{{url('/')}}/public/css/tablestyleview.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
   
</head>

<body>
   <div class="wrapper">
      <!-- top navbar-->
      <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header"><a class="navbar-brand" href="#/">
                  <div class="brand-logo"><img class="img-fluid" src="{{url('/')}}/public/img/logo.png" alt="App Logo"></div>
                  <div class="brand-logo-collapsed"><img class="img-fluid" src="{{url('/')}}/public/img/logo.png" alt="App Logo"></div>
               </a></div><!-- END navbar header-->
            <!-- START Left navbar-->
            <ul class="navbar-nav mr-auto flex-row">
               <li class="nav-item">
                  <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops--><a class="nav-link d-none d-md-block d-lg-block d-xl-block" href="#" data-trigger-resize="" data-toggle-state="aside-collapsed"><em class="fas fa-bars"></em></a><!-- Button to show/hide the sidebar on mobile. Visible on mobile only.--><a class="nav-link sidebar-toggle d-md-none" href="#" data-toggle-state="aside-toggled" data-no-persist="true"><em class="fas fa-bars"></em></a></li><!-- START User avatar toggle-->
               <li class="nav-item d-none d-md-block">
                  <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops--><a class="nav-link" id="user-block-toggle" href="#user-block" ><em class="icon-user"></em></a></li><!-- END User avatar toggle-->
               <!-- START lock screen-->
               <li class="nav-item d-none d-md-block"><a class="nav-link" href="lock.html" title="Lock screen"><em class="icon-lock"></em></a></li><!-- END lock screen-->

            </ul><!-- END Left navbar-->
            <!-- START Right Navbar-->
            <ul class="navbar-nav flex-row">
               <!-- Search icon-->
               <li class="nav-item"><a class="nav-link" href="#" data-search-open=""><em class="icon-magnifier"></em></a></li><!-- Fullscreen (only desktops)-->
               <li class="nav-item d-none d-md-block"><a class="nav-link" href="#" data-toggle-fullscreen=""><em class="fas fa-expand"></em></a></li><!-- START Alert menu-->
            <!--   <li class="nav-item dropdown dropdown-list"><a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-toggle="dropdown"><em class="icon-bell"></em><span class="badge badge-danger">11</span></a> --> <!-- START Dropdown menu-->
             <!--     <div class="dropdown-menu dropdown-menu-right animated flipInX">
                     <div class="dropdown-item">  -->
                        <!-- START list group-->
                    <!--    <div class="list-group">
                           -- list item
                           <div class="list-group-item list-group-item-action">
                              <div class="media">
                                 <div class="align-self-start mr-2"><em class="fab fa-twitter fa-2x text-info"></em></div>
                                 <div class="media-body">
                                    <p class="m-0">New followers</p>
                                    <p class="m-0 text-muted text-sm">1 new follower</p>
                                 </div>
                              </div>
                           </div>  -- list item--
                           <div class="list-group-item list-group-item-action">
                              <div class="media">
                                 <div class="align-self-start mr-2"><em class="fas fa-envelope fa-2x text-warning"></em></div>
                                 <div class="media-body">
                                    <p class="m-0">New e-mails</p>
                                    <p class="m-0 text-muted text-sm">You have 10 new emails</p>
                                 </div>
                              </div>
                           </div>-- list item--
                           <div class="list-group-item list-group-item-action">
                              <div class="media">
                                 <div class="align-self-start mr-2"><em class="fas fa-tasks fa-2x text-success"></em></div>
                                 <div class="media-body">
                                    <p class="m-0">Pending Tasks</p>
                                    <p class="m-0 text-muted text-sm">11 pending task</p>
                                 </div>
                              </div>
                           </div> -- last list item--
                           <div class="list-group-item list-group-item-action"><span class="d-flex align-items-center"><span class="text-sm">More notifications</span><span class="badge badge-danger ml-auto">14</span></span></div>
                        </div>  -- END list group--
                     </div>
                  </div>-- END Dropdown menu--
               </li>-- END Alert menu-->
               <!-- START Offsidebar button-->
               <li class="nav-item"><a class="nav-link" href="#" data-toggle-state="offsidebar-open" data-no-persist="true"><em class="icon-notebook"></em></a></li><!-- END Offsidebar menu-->
            </ul><!-- END Right Navbar-->
            <!-- START Search form-->
            <form class="navbar-form" role="search" action="search.html">
               <div class="form-group"><input class="form-control" type="text" placeholder="Type and hit enter ...">
                  <div class="fas fa-times navbar-form-close" data-search-dismiss=""></div>
               </div><button class="d-none" type="submit">Submit</button>
            </form><!-- END Search form-->
         </nav><!-- END Top Navbar-->
      </header><!-- sidebar-->
      <aside class="aside-container">

         <!-- START Sidebar (left)-->
         <div class="aside-inner">
            <nav class="sidebar" data-sidebar-anyclick-close="">
               <!-- START sidebar nav-->
               <ul class="sidebar-nav">
                  <!-- START user info-->
                  <li class="has-user-block">
                     <div class="collapse show" id="user-block">
                        <div class="item user-block">
                           <!-- User picture-->
                           <div class="user-block-picture">
                              <div class="user-block-status"><img class="img-thumbnail rounded-circle" src="{{url('/')}}/public/img/user.png" alt="MHC" width="60" height="60">
                                 <div class="circle bg-success circle-lg"></div>
                              </div>
                           </div><!-- Name and Job-->
                           <div class="user-block-info"><span class="user-block-name">{{auth()->user()->name}}</span><span class="user-block-role">{{auth()->user()->email}}</span></div>
                        </div>
                     </div>
                  </li><!-- END user info-->
                  <!-- Iterates over all sidebar items-->
                  <li class="nav-heading "><span data-localize="sidebar.heading.HEADER">Main Navigation</span></li>
                  <li class=" "><a href="{{url('/')}}/home" title="Dashboard" >
                        <em class="icon-speedometer"></em><span data-localize="sidebar.nav.DASHBOARD">Dashboard</span>
                     </a>
                  </li>

                    @if(auth('web')->user()->hasAnyPermission(['Insert data']))
                    <!-- Insert Data page link-->
                    <li class=" "><a href="{{url('/')}}/isolatedatatype/isolatetypeview" title="Insert Isolate Data Type Page" ><em class="fas fa-database"></em><span>Insert Data</span></a></li>
                    @endif

                     @if(auth('web')->user()->hasAnyPermission(['view data']))
                    <!-- View Data Page link-->
                    <li class=" "><a href="{{url('/')}}/isolatedatatype/dataview" title="View Isolate Data Type Page" ><em class="fas fa-eye"></em><span>View Data</span></a></li>
                    @endif

                     @if(auth('web')->user()->hasAnyPermission(['report']))
                    <!-- Report page-->
                    <li class=" "><a href="{{url('/')}}/report/view" title="Report Page" >
                        <em class="fas fa-chart-pie"></em><span>Report</span></a></li>
                      @endif


                    @if(auth('web')->user()->hasAnyPermission(['User management']))
                    <!-- User Management page-->
                    <li class=" "><a href="{{url('/')}}/usermanagement/managementview" title="User Management" ><em class="fas fa-user"></em><span>User Management</span></a></li>
                    @endif


           {{-- Commented -- View Four types of Isoalte Samaple and Test Data menu--


                    
                    <!-- View Single Isolate (S/I/R) sample Data-->
                    <li class=" "><a href="{{url('/')}}/singleisolatesample/view" title="View Single Isolate (S/I/R) Sample Data"><em class="fas fa-eye"></em><span>View SI Sample Data(SIR)</span></a></li>

                    <!-- View Single Isolate (S/I/R) Test Data-->
                    <li class=" "><a href="{{url('/')}}/singleisolatesampletest/view" title="Single Isolate (S/I/R) Test Data"><em class="icon-grid"></em><span>View SI Test Data(SIR)</span>
                    </a></li>


                    <!-- View Single Isolate (ZDIS) sample Data-->
                    <li class=" "><a href="{{url('/')}}/singleisolatezdissample/view" title="View Single Isolate (ZDIS) Sample Data"><em class="icon-grid"></em><span>View SI Sample Data(ZDIS)</span></a></li>

                    <!-- View Single Isolate (ZDIS) Test Data-->
                    <li class=" "><a href="{{url('/')}}/singleisolatezdissampletest/view" title="Single Isolate (ZDIS) Test Data"><em class="icon-grid"></em><span>View SI Test Data(ZDIS)</span>
                    </a></li>


                    <!-- View Summarize Isolate Numeric Sample Data-->
                    <li class=" "><a href="{{url('/')}}/summarizeinumsample/view" title="View Summarize Single Isolate Numeric Sample Data"><em class="icon-grid"></em><span>View Summarize Sample Data(#)</span></a></li>

                    <!-- View Summarize Isolate Numeric Test Data-->
                    <li class=" "><a href="{{url('/')}}/summarizeinumsampletest/view" title="View Summarize Single Isolate Numeric Test Data"><em class="icon-grid"></em><span>View Summarize Test Data</span>
                    </a></li>


                    <!-- View Summarize Isolate Percentage Sample Data-->
                    <li class=" "><a href="{{url('/')}}/summarizeipersample/view" title="View Summarize Isolate Percentage Sample Data"><em class="icon-grid"></em><span>View Summarize Sample Data(%)</span></a></li>

                    <!-- View Summarize Isolate Percentage Test Data-->
                    <li class=" "><a href="{{url('/')}}/summarizeipersampletest/view" title="View Summarize Isolate Percentage Test Data"><em class="icon-grid"></em><span>View Summarize Test Data(%)</span></a></li>

        --}}


        {{-- Commented -- Create Single Isolate Menu--
                    <li class=" "><a href="{{url('/')}}/singleisolatesample/create" title="Create Single Isolate Sample" ><em class="icon-grid"></em>Insert Single Isolate Data</a>
                    </li>
                   
                     <!-- View Sample Menu-->
                    <li class=" "><a href="{{url('/')}}/samples/view" title="Sample">
                        <em class="icon-grid" ></em>View Sample Information
                     </a></li>

    
                     <!-- Insert Sample Menu-->
                    <li class=" "><a href="{{url('/')}}/samples/create" title="Sample">
                        <em class="icon-grid" ></em>Insert Sample Information
                     </a></li>


                      <!-- View Sample Test Menu-->
                    <li class=" "><a href="{{url('/')}}/sampletest/view" title="Sample Test">
                        <em class="icon-grid" ></em>View Sample Test Info
                     </a></li>
        --}}

                      @if(auth('web')->user()->hasAnyPermission(['Institutions']))                 
                    <!-- Institution Menu-->
                    <li class=" "><a href="{{url('/')}}/institution/view" title="Institutions" >
                        <em class="icon-grid" ></em><span>Institutions</span>
                    </a></li>
                    @endif

                    @if(auth('web')->user()->hasAnyPermission(['Species'])) 
                    <!-- Species Menu-->
                    <li class=" "><a href="{{url('/')}}/species/view" title="Species" >
                       <em class="icon-grid"></em><span>Species</span>
                     </a></li>
                     @endif
                    <!-- Breed Menu-->
                    <li class=" "><a href="{{url('/')}}/breed/view" title="Breed" >
                       <em class="fas fa-bars"></em><span>Breed</span>
                     </a></li>

                     <!-- Specimen Menu-->
                    <li class=" "><a href="{{url('/')}}/specimen/view" title="Specimen" >
                       <em class="fas fa-list-alt"></em><span>Specimen</span>
                     </a></li>

                     <!-- Specimen Collection Location Name Menu -->
                     <li class=" "><a href="{{url('/')}}/specimencollectionlocation/view" title="Specimen Collection Location" ><em class="icon-location-pin"></em><span>Sampling Location</span>
                     </a></li>

                       <!-- Pathogen Menu-->
                    <li class=" "><a href="{{url('/')}}/pathogen/view" title="Pathogen" >
                        <em class="fas fa-flask "></em><span>Pathogen</span>
                     </a></li>

                     <!-- Antibiotic Menu-->
                    <li class=" "><a href="{{url('/')}}/antibiotic/view" title="Antibiotic" >
                       <em class="icon-chemistry"></em><span>Antibiotic</span>
                     </a></li>

                         <!-- Test Method Menu-->
                    <li class=" "><a href="{{url('/')}}/testmethod/view" title="Test Method" >
                      <em class="fas fa-file"></em><span>Test Method</span>
                     </a></li>


                     <!-- Test Sensitivies Menu-->
                    <li class=" "><a href="{{url('/')}}/testsensitivity/view" title="Test Sensitivity Type">
                      <em class="icon-grid"></em><span>Sensitivity Type</span>
                     </a></li>


                     <!-- Zone Diameter Interpretive Standards (ZDIS) Menu-->
                    <li class=" "><a href="{{url('/')}}/zdis/view" title="zdis">
                      <em class="fas fa-file-alt"></em><span>ZDIS Reference Table </span>
                     </a></li>
                     <!-- logout part -->
                     <li class=" "><a 
                     href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                      <em class="fas fa-power-off"></em><span>Logout</span>
                     </a></li>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                     </form> 
                     <!-- logout part --> 


              <!--

                  <li class=" "><a href="#layout" title="Layouts" ><em class="icon-layers"></em><span>Layouts</span></a>
                     <ul class="sidebar-nav sidebar-subnav collapse" id="layout">
                        <li class="sidebar-subnav-header">Layouts</li>
                        <li class=" "><a href="dashboard_h.html" title="Horizontal"><span>Horizontal</span></a></li>
                     </ul>
                  </li>


                  <li class="nav-heading "><span data-localize="sidebar.heading.COMPONENTS">Components</span></li>
                  <li class=" "><a href="#elements" title="Elements" ><em class="icon-chemistry"></em><span data-localize="sidebar.nav.element.ELEMENTS">Elements</span></a>
                     <ul class="sidebar-nav sidebar-subnav collapse" id="elements">
                        <li class="sidebar-subnav-header">Elements</li>
                        <li class=" "><a href="buttons.html" title="Buttons"><span data-localize="sidebar.nav.element.BUTTON">Buttons</span></a></li>
                        <li class=" "><a href="notifications.html" title="Notifications"><span data-localize="sidebar.nav.element.NOTIFICATION">Notifications</span></a></li>
                        <li class=" "><a href="sweetalert.html" title="Sweet Alert"><span>Sweet Alert</span></a></li>
                        <li class=" "><a href="carousel.html" title="Carousel"><span data-localize="sidebar.nav.element.INTERACTION">Carousel</span></a></li>
                        <li class=" "><a href="spinners.html" title="Spinners"><span data-localize="sidebar.nav.element.SPINNER">Spinners</span></a></li>
                        <li class=" "><a href="dropdown-animations.html" title="Dropdown"><span data-localize="sidebar.nav.element.DROPDOWN">Dropdown</span></a></li>
                        <li class=" "><a href="nestable.html" title="Nestable"><span>Nestable</span></a></li>
                        <li class=" "><a href="sortable.html" title="Sortable"><span>Sortable</span></a></li>
                        <li class=" "><a href="cards.html" title="Cards"><span data-localize="sidebar.nav.element.CARDS">Cards</span></a></li>
                        <li class=" "><a href="portlets.html" title="Portlets"><span data-localize="sidebar.nav.element.PORTLET">Portlets</span></a></li>
                        <li class=" "><a href="grid.html" title="Grid"><span data-localize="sidebar.nav.element.GRID">Grid</span></a></li>
                        <li class=" "><a href="grid-masonry.html" title="Grid Masonry"><span data-localize="sidebar.nav.element.GRID_MASONRY">Grid Masonry</span></a></li>
                        <li class=" "><a href="typo.html" title="Typography"><span data-localize="sidebar.nav.element.TYPO">Typography</span></a></li>
                        <li class=" "><a href="icons-font.html" title="Font Icons">
                              <div class="float-right badge badge-success">+400</div><span data-localize="sidebar.nav.element.FONT_ICON">Font Icons</span>
                           </a></li>
                        <li class=" "><a href="icons-weather.html" title="Weather Icons">
                              <div class="float-right badge badge-success">+100</div><span data-localize="sidebar.nav.element.WEATHER_ICON">Weather Icons</span>
                           </a></li>
                        <li class=" "><a href="colors.html" title="Colors"><span data-localize="sidebar.nav.element.COLOR">Colors</span></a></li>
                     </ul>
                  </li>
                  <li class=" "><a href="#forms" title="Forms" ><em class="icon-note"></em><span data-localize="sidebar.nav.form.FORM">Forms</span></a>
                     <ul class="sidebar-nav sidebar-subnav collapse" id="forms">
                        <li class="sidebar-subnav-header">Forms</li>
                        <li class=" "><a href="form-standard.html" title="Standard"><span data-localize="sidebar.nav.form.STANDARD">Standard</span></a></li>
                        <li class=" "><a href="form-extended.html" title="Extended"><span data-localize="sidebar.nav.form.EXTENDED">Extended</span></a></li>
                        <li class=" "><a href="form-validation.html" title="Validation"><span data-localize="sidebar.nav.form.VALIDATION">Validation</span></a></li>
                        <li class=" "><a href="form-wizard.html" title="Wizard"><span>Wizard</span></a></li>
                        <li class=" "><a href="form-upload.html" title="Upload"><span>Upload</span></a></li>
                        <li class=" "><a href="form-xeditable.html" title="xEditable"><span>xEditable</span></a></li>
                        <li class=" "><a href="form-imagecrop.html" title="Cropper"><span>Cropper</span></a></li>
                     </ul>
                  </li>
                  <li class=" "><a href="#charts" title="Charts" ><em class="icon-graph"></em><span data-localize="sidebar.nav.chart.CHART">Charts</span></a>
                     <ul class="sidebar-nav sidebar-subnav collapse" id="charts">
                        <li class="sidebar-subnav-header">Charts</li>
                        <li class=" "><a href="chart-flot.html" title="Flot"><span data-localize="sidebar.nav.chart.FLOT">Flot</span></a></li>
                        <li class=" "><a href="chart-radial.html" title="Radial"><span data-localize="sidebar.nav.chart.RADIAL">Radial</span></a></li>
                        <li class=" "><a href="chart-js.html" title="Chart JS"><span>Chart JS</span></a></li>
                        <li class=" "><a href="chart-rickshaw.html" title="Rickshaw"><span>Rickshaw</span></a></li>
                        <li class=" "><a href="chart-morris.html" title="MorrisJS"><span>MorrisJS</span></a></li>
                        <li class=" "><a href="chart-chartist.html" title="Chartist"><span>Chartist</span></a></li>
                     </ul>
                  </li>
                  <li class=" "><a href="#tables" title="Tables" ><em class="icon-grid"></em><span data-localize="sidebar.nav.table.TABLE">Tables</span></a>
                     <ul class="sidebar-nav sidebar-subnav collapse" id="tables">
                        <li class="sidebar-subnav-header">Tables</li>
                        <li class=" "><a href="table-standard.html" title="Standard"><span data-localize="sidebar.nav.table.STANDARD">Standard</span></a></li>
                        <li class=" "><a href="table-extended.html" title="Extended"><span data-localize="sidebar.nav.table.EXTENDED">Extended</span></a></li>
                        <li class=" "><a href="table-datatable.html" title="DataTables"><span data-localize="sidebar.nav.table.DATATABLE">DataTables</span></a></li>
                        <li class=" "><a href="table-bootgrid.html" title="BootGrid"><span>BootGrid</span></a></li>
                     </ul>
                  </li>
                  <li class=" "><a href="#maps" title="Maps" ><em class="icon-map"></em><span data-localize="sidebar.nav.map.MAP">Maps</span></a>
                     <ul class="sidebar-nav sidebar-subnav collapse" id="maps">
                        <li class="sidebar-subnav-header">Maps</li>
                        <li class=" "><a href="maps-google.html" title="Google Maps"><span data-localize="sidebar.nav.map.GOOGLE">Google Maps</span></a></li>
                        <li class=" "><a href="maps-vector.html" title="Vector Maps"><span data-localize="sidebar.nav.map.VECTOR">Vector Maps</span></a></li>
                     </ul>
                  </li>

              -->

                <!--

                  <li class="nav-heading "><span data-localize="sidebar.heading.MORE">More</span></li>
                  <li class=" "><a href="#pages" title="Pages" ><em class="icon-doc"></em><span data-localize="sidebar.nav.pages.PAGES">Pages</span></a>
                     <ul class="sidebar-nav sidebar-subnav collapse" id="pages">
                        <li class="sidebar-subnav-header">Pages</li>
                        <li class=" "><a href="login.html" title="Login"><span data-localize="sidebar.nav.pages.LOGIN">Login</span></a></li>
                        <li class=" "><a href="register.html" title="Sign up"><span data-localize="sidebar.nav.pages.REGISTER">Sign up</span></a></li>
                        <li class=" "><a href="recover.html" title="Recover Password"><span data-localize="sidebar.nav.pages.RECOVER">Recover Password</span></a></li>
                        <li class=" "><a href="lock.html" title="Lock"><span data-localize="sidebar.nav.pages.LOCK">Lock</span></a></li>
                        <li class=" "><a href="template.html" title="Starter Template"><span data-localize="sidebar.nav.pages.STARTER">Starter Template</span></a></li>
                        <li class=" "><a href="404.html" title="404"><span>404</span></a></li>
                        <li class=" "><a href="500.html" title="500"><span>500</span></a></li>
                        <li class=" "><a href="maintenance.html" title="Maintenance"><span>Maintenance</span></a></li>
                     </ul>
                  </li>
                  <li class=" "><a href="#extras" title="Extras" ><em class="icon-cup"></em><span data-localize="sidebar.nav.extra.EXTRA">Extras</span></a>
                     <ul class="sidebar-nav sidebar-subnav collapse" id="extras">
                        <li class="sidebar-subnav-header">Extras</li>
                        <li class=" "><a href="#blog" title="Blog" ><em class="fas fa-angle-right"></em><span>Blog</span></a>
                           <ul class="sidebar-nav sidebar-subnav collapse" id="blog">
                              <li class="sidebar-subnav-header">Blog</li>
                              <li class=" "><a href="blog.html" title="List"><span>List</span></a></li>
                              <li class=" "><a href="blog-post.html" title="Post"><span>Post</span></a></li>
                              <li class=" "><a href="blog-articles.html" title="Articles"><span>Articles</span></a></li>
                              <li class=" "><a href="blog-article-view.html" title="Article View"><span>Article View</span></a></li>
                           </ul>
                        </li>
                        <li class=" "><a href="#ecommerce" title="eCommerce" ><em class="fas fa-angle-right"></em><span>eCommerce</span></a>
                           <ul class="sidebar-nav sidebar-subnav collapse" id="ecommerce">
                              <li class="sidebar-subnav-header">eCommerce</li>
                              <li class=" "><a href="ecommerce-orders.html" title="Orders">
                                    <div class="float-right badge badge-success">10</div><span>Orders</span>
                                 </a></li>
                              <li class=" "><a href="ecommerce-order-view.html" title="Order View"><span>Order View</span></a></li>
                              <li class=" "><a href="ecommerce-products.html" title="Products"><span>Products</span></a></li>
                              <li class=" "><a href="ecommerce-product-view.html" title="Product View"><span>Product View</span></a></li>
                              <li class=" "><a href="ecommerce-checkout.html" title="Checkout"><span>Checkout</span></a></li>
                           </ul>
                        </li>
                        <li class=" "><a href="#forum" title="Forum" ><em class="fas fa-angle-right"></em><span>Forum</span></a>
                           <ul class="sidebar-nav sidebar-subnav collapse" id="forum">
                              <li class="sidebar-subnav-header">Forum</li>
                              <li class=" "><a href="forum-categories.html" title="Categories"><span>Categories</span></a></li>
                              <li class=" "><a href="forum-topics.html" title="Topics"><span>Topics</span></a></li>
                              <li class=" "><a href="forum-discussion.html" title="Discussion"><span>Discussion</span></a></li>
                           </ul>
                        </li>
                        <li class=" "><a href="contacts.html" title="Contacts"><span>Contacts</span></a></li>
                        <li class=" "><a href="contact-details.html" title="Contact details"><span>Contact details</span></a></li>
                        <li class=" "><a href="projects.html" title="Projects"><span>Projects</span></a></li>
                        <li class=" "><a href="project-details.html" title="Projects details"><span>Projects details</span></a></li>
                        <li class=" "><a href="team-viewer.html" title="Team viewer"><span>Team viewer</span></a></li>
                        <li class=" "><a href="social-board.html" title="Social board"><span>Social board</span></a></li>
                        <li class=" "><a href="vote-links.html" title="Vote links"><span>Vote links</span></a></li>
                        <li class=" "><a href="bug-tracker.html" title="Bug tracker"><span>Bug tracker</span></a></li>
                        <li class=" "><a href="faq.html" title="FAQ"><span>FAQ</span></a></li>
                        <li class=" "><a href="help-center.html" title="Help Center"><span>Help Center</span></a></li>
                        <li class=" "><a href="followers.html" title="Followers"><span>Followers</span></a></li>
                        <li class=" "><a href="settings.html" title="Settings"><span>Settings</span></a></li>
                        <li class=" "><a href="plans.html" title="Plans"><span>Plans</span></a></li>
                        <li class=" "><a href="file-manager.html" title="File manager"><span>File manager</span></a></li>
                        <li class=" "><a href="mailbox.html" title="Mailbox"><span data-localize="sidebar.nav.extra.MAILBOX">Mailbox</span></a></li>
                        <li class=" "><a href="timeline.html" title="Timeline"><span data-localize="sidebar.nav.extra.TIMELINE">Timeline</span></a></li>
                        <li class=" "><a href="calendar.html" title="Calendar"><span data-localize="sidebar.nav.extra.CALENDAR">Calendar</span></a></li>
                        <li class=" "><a href="invoice.html" title="Invoice"><span data-localize="sidebar.nav.extra.INVOICE">Invoice</span></a></li>
                        <li class=" "><a href="search.html" title="Search"><span data-localize="sidebar.nav.extra.SEARCH">Search</span></a></li>
                        <li class=" "><a href="todo.html" title="Todo List"><span data-localize="sidebar.nav.extra.TODO">Todo List</span></a></li>
                        <li class=" "><a href="profile.html" title="Profile"><span data-localize="sidebar.nav.extra.PROFILE">Profile</span></a></li>
                     </ul>
                  </li>
                  <li class=" "><a href="#multilevel" title="Multilevel" ><em class="far fa-folder-open"></em><span>Multilevel</span></a>
                     <ul class="sidebar-nav sidebar-subnav collapse" id="multilevel">
                        <li class="sidebar-subnav-header">Multilevel</li>
                        <li class=" "><a href="#level1" title="Level 1" ><span>Level 1</span></a>
                           <ul class="sidebar-nav sidebar-subnav collapse" id="level1">
                              <li class="sidebar-subnav-header">Level 1</li>
                              <li class=" "><a href="multilevel-1.html" title="Level1 Item"><span>Level1 Item</span></a></li>
                              <li class=" "><a href="#level2" title="Level 2" ><span>Level 2</span></a>
                                 <ul class="sidebar-nav sidebar-subnav collapse" id="level2">
                                    <li class="sidebar-subnav-header">Level 2</li>
                                    <li class=" "><a href="#level3" title="Level 3" ><span>Level 3</span></a>
                                       <ul class="sidebar-nav sidebar-subnav collapse" id="level3">
                                          <li class="sidebar-subnav-header">Level 3</li>
                                          <li class=" "><a href="multilevel-3.html" title="Level3 Item"><span>Level3 Item</span></a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </li>  -->
               </ul><!-- END sidebar nav-->
            </nav>
         </div><!-- END Sidebar (left)-->
      </aside><!-- offsidebar-->
      
      <section class="section-container">
         <!-- Page content-->
         <div class="content-wrapper">
             @yield('content')
         </div>
      </section><!-- Page footer-->
      <footer class="footer-container"><span>&copy; 2019 - FAO ECTAD, Bangladesh</span></footer>
   </div><!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="{{url('/')}}/public/vendor/modernizr/modernizr.custom.js"></script><!-- STORAGE API-->
   <script src="{{url('/')}}/public/vendor/js-storage/js.storage.js"></script><!-- SCREENFULL-->
   <script src="{{url('/')}}/public/vendor/screenfull/dist/screenfull.js"></script><!-- i18next-->
   <script src="{{url('/')}}/public/vendor/i18next/i18next.js"></script>
   <script src="{{url('/')}}/public/vendor/i18next-xhr-backend/i18nextXHRBackend.js"></script>
   <script src="{{url('/')}}/public/vendor/jquery/dist/jquery.js"></script>
   <script src="{{url('/')}}/public/vendor/popper.js/dist/umd/popper.js"></script>
   <script src="{{url('/')}}/public/vendor/bootstrap/dist/js/bootstrap.js"></script><!-- =============== PAGE VENDOR SCRIPTS ===============-->
   <!-- SLIMSCROLL-->
   <script src="{{url('/')}}/public/vendor/jquery-slimscroll/jquery.slimscroll.js"></script><!-- SPARKLINE-->
   <script src="{{url('/')}}/public/vendor/jquery-sparkline/jquery.sparkline.js"></script><!-- FLOT CHART-->
   <script src="{{url('/')}}/public/vendor/flot/jquery.flot.js"></script>
   <script src="{{url('/')}}/public/vendor/jquery.flot.tooltip/js/jquery.flot.tooltip.js"></script>
   <script src="{{url('/')}}/public/vendor/flot/jquery.flot.resize.js"></script>
   <script src="{{url('/')}}/public/vendor/flot/jquery.flot.pie.js"></script>
   <script src="{{url('/')}}/public/vendor/flot/jquery.flot.time.js"></script>
   <script src="{{url('/')}}/public/vendor/flot/jquery.flot.categories.js"></script>
   <script src="{{url('/')}}/public/vendor/jquery.flot.spline/jquery.flot.spline.js"></script><!-- EASY PIE CHART-->
   <script src="{{url('/')}}/public/vendor/easy-pie-chart/dist/jquery.easypiechart.js"></script><!-- MOMENT JS-->
   <script src="{{url('/')}}/vendor/moment/min/moment-with-locales.js"></script><!-- =============== APP SCRIPTS ===============-->
   <script src="{{url('/')}}/public/js/app.js"></script>
   <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
   <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
   @include('sweetalert::alert')
</body>

</html>