
   <!DOCTYPE html>
   <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
      <script src="{{ url('/css/fonts/kit.fontawesome-42d5adcbca.js') }}" crossorigin="anonymous"></script>

      <script src="{{ URL::asset('editor/sandbox/js/jquery.dataTables.js') }}"></script>
      <link href="{{ URL::asset('editor/sandbox/css/editor.dataTables.css') }}" rel="stylesheet" type="text/css" />

      <!-- Style -->
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('editor/jquery/jquery.dataTables.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('editor/css/select.dataTables.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('editor/buttons/buttons.dataTables.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('editor/css/dataTables.dateTime.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('editor/css/editor.dataTables.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/vendors/select2/css/select2.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/vendors/bundle.css') }}" />

      <!-- Css -->
      <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ url('/css/plantilla.css') }}" />

      <!-- Icon -->
      <link rel="icon" class="rounded-circle" href="{{URL::asset('/image/logos/ssm_logo_32.png')}}">
      
      <body>
         <!-- begin::preloader-->
         <div class="preloader">
            <div class="preloader-icon"></div>
         </div>
         <!-- end::preloader --><!-- begin::header -->
         <div class="header">
            <div>
               <ul class="navbar-nav">
                  <!-- begin::navigation-toggler -->
                  <li class="nav-item navigation-toggler"><a href="#" class="nav-link" title="Hide navigation"><i data-feather="arrow-left"></i></a></li>
                  <li class="nav-item navigation-toggler mobile-toggler"><a href="#" class="nav-link" title="Show navigation"><i data-feather="menu"></i></a></li>
                  <!-- end::navigation-toggler -->
                  <li class="nav-item">
                     <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dirección</a>
                     <div class="dropdown-menu"><a href="#" class="dropdown-item">User</a><a href="#" class="dropdown-item">Category</a><a href="#" class="dropdown-item">Product</a><a href="#" class="dropdown-item">Report</a></div>
                  </li>
                  <li class="nav-item dropdown">
                     <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Aplicativos</a>
                     <div class="dropdown-menu dropdown-menu-big">
                        <div class="p-3">
                           <div class="row row-xs">
                              <div class="col-6">
                                 <a href="chat.html">
                                    <div class="p-3 border-radius-1 border text-center mb-3">
                                       <i class="width-23 height-23" data-feather="clipboard"></i>
                                       <div class="mt-2">SOS</div>
                                    </div>
                                 </a>
                              </div>
                              <div class="col-6">
                                 <a href="inbox.html">
                                    <div class="p-3 border-radius-1 border text-center mb-3">
                                       <i class="width-23 height-23" data-feather="video"></i>
                                       <div class="mt-2">Conferencias</div>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
               </ul>
            </div>
            <div>
               <ul class="navbar-nav">
                  <!-- begin::header search -->
                  <li class="nav-item">
                     <a href="#" class="nav-link" title="Search" data-toggle="dropdown"><i data-feather="search"></i></a>
                     <div class="dropdown-menu p-2 dropdown-menu-right">
                        <form>
                           <div class="input-group">
                              <input type="text" class="form-control" placeholder="Search">
                              <div class="input-group-prepend"><button class="btn" type="button"><i data-feather="search"></i></button></div>
                           </div>
                        </form>
                     </div>
                  </li>
                  <!-- end::header search --><!-- begin::header minimize/maximize -->
                  <li class="nav-item dropdown"><a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen"><i class="maximize" data-feather="maximize"></i><i class="minimize" data-feather="minimize"></i></a></li>
                  <!-- end::header minimize/maximize --><!-- begin::header messages dropdown -->
                  <li class="nav-item dropdown">
                     <a href="#" onclick="taskmenubtn();" class="nav-link nav-link-notify" title="Notas" data-toggle="dropdown"><i data-feather="book"></i></a>
                     <div id="taskmenu" class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                        <div class="p-4 text-center d-flex justify-content-between"                         data-backround-image="{{URL::asset('/image/avatar/image1.jpg')}}">
                           <h6 class="mb-0">Notas</h6>
                           <small class="font-size-11 opacity-7"></small>
                        </div>
                        <div>
                           <div class="input-group mb-2 p-2">
                              <input id="new-task" type="text" class="form-control bg-gray" placeholder="Crear nueva nota">
                              <div class="input-group-append"><button class="btn btn-info" type="button" id="add-task">Crear</button></div>
                           </div>
                           <ul class="list-group list-group-flush">
                              <div class="task">
                              <span class="text-divider small pb-2 pl-3 pt-3"><span>Notas pendientes</span></span>
                              <ul id="incomplete-tasks">
                               <li><input type="checkbox"><label>Task with customers</label><input type="text" class="form-control bg-gray" value=""><button class="check-edit btn btn-link text-info btn-sm m-1"><i class="fa fa-pencil"></i></button><button class="check-delete btn btn-link text-danger btn-sm m-1"><i class="fa fa-times"></i></button></li>
                               <li><input type="checkbox"><label>Go Shopping</label><input type="text" class="form-control bg-gray" value=""><button class="check-edit btn btn-link text-info btn-sm m-1"><i class="fa fa-pencil"></i></button><button class="check-delete btn btn-link text-danger btn-sm m-1"><i class="fa fa-times"></i></button></li>
                            </ul>
                            <span class="text-divider small pb-2 pl-3 pt-3"><span>Notas finalizadas</span></span>
                            <ul id="completed-tasks">
                              <li><input type="checkbox" checked><label>Go Shopping</label><input type="text" class="form-control bg-gray" value="Go Shopping"><button class="check-edit btn btn-link text-info btn-sm m-1 disabled" disabled><i class="fa fa-pencil"></i></button><button class="check-delete btn btn-link text-danger btn-sm m-1"><i class="fa fa-times"></i></button></li>
                           </ul>
                        </div>
                        </ul>
                     </div>
                     <div class="p-2 text-right">
                        <ul class="list-inline small">
                           <li class="list-inline-item"><a href="#">Finalizar todas</a></li>
                           <li class="list-inline-item"><a href="#">Eliminar todas</a></li>
                        </ul>
                     </div>
                  </div>
               </li>
               <!-- end::header messages dropdown --><!-- begin::header notification dropdown -->
               <li class="nav-item dropdown">
                  <a href="#" class="nav-link nav-link-notify" title="Notifications" data-toggle="dropdown"><i data-feather="bell"></i></a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                     <div class="p-4 text-center d-flex justify-content-between"                         data-backround-image="{{URL::asset('/image/avatar/image1.jpg')}}">
                        <h6 class="mb-0">Notifications</h6>
                        <small class="font-size-11 opacity-7">1 unread notifications</small>
                     </div>
                     <div>
                        <ul class="list-group list-group-flush">
                           <li>
                              <a href="#" class="list-group-item d-flex hide-show-toggler">
                                 <div>
                                    <figure class="avatar avatar-sm m-r-15"><span class="avatar-title bg-success-bright text-success rounded-circle"><i class="ti-user"></i></span></figure>
                                 </div>
                                 <div class="flex-grow-1">
                                    <p class="mb-0 line-height-20 d-flex justify-content-between">New customer registered                                            <i title="Mark as read" data-toggle="tooltip"                                               class="hide-show-toggler-item fa fa-circle-o font-size-11"></i></p>
                                    <span class="text-muted small">20 min ago</span>
                                 </div>
                              </a>
                           </li>
                           <li class="text-divider small pb-2 pl-3 pt-3"><span>Old notifications</span></li>
                           <li>
                              <a href="#" class="list-group-item d-flex hide-show-toggler">
                                 <div>
                                    <figure class="avatar avatar-sm m-r-15"><span class="avatar-title bg-warning-bright text-warning rounded-circle"><i class="ti-package"></i></span></figure>
                                 </div>
                                 <div class="flex-grow-1">
                                    <p class="mb-0 line-height-20 d-flex justify-content-between">New Order Recieved                                            <i title="Mark as unread" data-toggle="tooltip"                                               class="hide-show-toggler-item fa fa-check font-size-11"></i></p>
                                    <span class="text-muted small">45 sec ago</span>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <a href="#"                                   class="list-group-item d-flex align-items-center hide-show-toggler">
                                 <div>
                                    <figure class="avatar avatar-sm m-r-15"><span class="avatar-title bg-danger-bright text-danger rounded-circle"><i class="ti-server"></i></span></figure>
                                 </div>
                                 <div class="flex-grow-1">
                                    <p class="mb-0 line-height-20 d-flex justify-content-between">Server Limit Reached!                                            <i title="Mark as unread" data-toggle="tooltip"                                               class="hide-show-toggler-item fa fa-check font-size-11"></i></p>
                                    <span class="text-muted small">55 sec ago</span>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <a href="#"                                   class="list-group-item d-flex align-items-center hide-show-toggler">
                                 <div>
                                    <figure class="avatar avatar-sm m-r-15"><span class="avatar-title bg-info-bright text-info rounded-circle"><i class="ti-layers"></i></span></figure>
                                 </div>
                                 <div class="flex-grow-1">
                                    <p class="mb-0 line-height-20 d-flex justify-content-between">Apps are ready for update                                            <i title="Mark as unread" data-toggle="tooltip"                                               class="hide-show-toggler-item fa fa-check font-size-11"></i></p>
                                    <span class="text-muted small">Yesterday</span>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class="p-2 text-right">
                        <ul class="list-inline small">
                           <li class="list-inline-item"><a href="#">Mark All Read</a></li>
                        </ul>
                     </div>
                  </div>
               </li>
               <!-- end::header notification dropdown --><!-- begin::user menu -->
               <li class="nav-item dropdown">
                  <a href="#" class="nav-link" title="User menu" data-toggle="dropdown"><i data-feather="settings"></i></a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                     <div class="p-4 text-center d-flex justify-content-between"                         data-backround-image="{{URL::asset('/image/avatar/image1.jpg')}}">
                        <h6 class="mb-0">Settings</h6>
                     </div>
                     <div>
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item">
                              <div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="customSwitch1" checked><label class="custom-control-label" for="customSwitch1">Allow notifications.</label></div>
                           </li>
                           <li class="list-group-item">
                              <div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="customSwitch2"><label class="custom-control-label" for="customSwitch2">Hide user requests</label></div>
                           </li>
                           <li class="list-group-item">
                              <div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="customSwitch3" checked><label class="custom-control-label" for="customSwitch3">Speed up demands</label></div>
                           </li>
                           <li class="list-group-item">
                              <div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="customSwitch4" checked><label class="custom-control-label" for="customSwitch4">Hide menus</label></div>
                           </li>
                           <li class="list-group-item">
                              <div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="customSwitch5"><label class="custom-control-label" for="customSwitch5">Remember next visits</label></div>
                           </li>
                           <li class="list-group-item">
                              <div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="customSwitch6"><label class="custom-control-label" for="customSwitch6">Enable report generation.</label></div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </li>
               <!-- end::user menu -->
            </ul>
            <!-- begin::mobile header toggler -->
            <ul class="navbar-nav d-flex align-items-center">
               <li class="nav-item header-toggler"><a href="#" class="nav-link"><i data-feather="arrow-down"></i></a></li>
            </ul>
            <!-- end::mobile header toggler -->
         </div>
      </div>
      <!-- end::header -->
      <div id="main">
         <!-- begin::navigation -->
         <div class="navigation">
            <div class="navigation-menu-tab">
               <div>
                  <div class="navigation-menu-tab-header" data-toggle="tooltip" title="SSM" data-placement="right">
                     <figure class="avatar avatar-sm"><img src="{{URL::asset('/image/logos/ssm_logo_60.png')}}" class="rounded-circle" alt="avatar"></figure>
                  </div>
               </div>
               <div class="flex-grow-1">
                  <ul>
                     <li><a class="active" href="#" data-toggle="tooltip" data-placement="right" title="Proyectos"                           data-nav-target="#dashboards"><i data-feather="home"></i></a></li>
                     <li><a href="#" data-toggle="tooltip" data-placement="right" title="Apps" data-nav-target="#apps"><i data-feather="command"></i></a></li>
                     <li><a href="#" data-toggle="tooltip" data-placement="right" title="UI Elements"                           data-nav-target="#elements"><i data-feather="layers"></i></a></li>
                     <li><a href="#" data-toggle="tooltip" data-placement="right" title="Aplicativos" data-nav-target="#páginas"><i data-feather="copy"></i></a></li>
                  </ul>
               </div>
               <div>
                  <ul>
                     <li><a href="{{ url('usuarios/perfil') }}" data-toggle="tooltip" data-placement="right" title="Mi perfil"><i data-feather="user"></i></a></li>
                     <li><a href="{{ route('logout') }}" data-toggle="tooltip" data-placement="right" title="Cerrar sesión" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                       </form></li>
                    </ul>
                 </div>
              </div>
              <!-- begin::navigation menu -->
              <div class="navigation-menu-body">
               <!-- begin::navigation-logo -->
               <div>
                  <div id="navigation-logo"><a href="https://www.ssm.gob.mx" target="_blank"><img class="logo" src="{{URL::asset('/image/logos/ssm_logo.png')}}" alt="light logo" width="170"><img class="logo-light" src="" alt="light logo" width="170"></a></div>
               </div>
               <!-- end::navigation-logo -->
               <div class="navigation-menu-group">
                  <div class="open" id="dashboards">
                     <ul>
                        <li class="navigation-divider mt-2 "><h4>SGPI</h4></li>
                        <!-- <li><a href="dashboard-two.html">Ecommerce <span class="badge badge-danger">2</span></a></li> -->
                        <li><a class="{{ (request()->is('home')) ? 'active' : '' }}" href="{{route('home')}}">Mis proyectos</a></li>
                        <li><a class="{{ (request()->is('tareas')) ? 'active' : '' }}" href="{{route('tareas.index')}}">Tareas</a></li>
                        <li><a class="{{ (request()->is('subtareas')) ? 'active' : '' }}" href="{{route('subtareas.index')}}">Subtareas</a></li>
                        <li><a href="dashboard-five.html">Archivos</a></li>
                        <div id="pages">
                           <ul class="mt-3">
                              <li class="navigation-divider mb-0">Desarrollo</li>
                              <li>
                                 <a class="{{ (request()->is('usuarios')) ? 'active' : '' }} {{ (request()->is('admins')) ? 'active' : '' }} {{ (request()->is('accesos')) ? 'active' : '' }}" href="#">Usuarios</a>
                                 <ul>
                                    <li><a class="{{ (request()->is('usuarios')) ? 'text-bold' : '' }}" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                                    <li><a class="{{ (request()->is('admins')) ? 'text-bold' : '' }}" href="{{ route('admins.index') }}">Administradores</a></li>
                                    <li><a class="{{ (request()->is('accesos')) ? 'text-bold' : '' }}" href="{{ route('accesos.index') }}">Accesos</a></li>
                                 </ul>
                              </li>
                              <li>
                                 <a class="{{ (request()->is('direcciones')) ? 'active' : '' }} {{ (request()->is('subdirecciones')) ? 'active' : '' }} {{ (request()->is('departamentos')) ? 'active' : '' }}" href="#">Sectores</a>
                                 <ul>
                                    <li><a class="{{ (request()->is('direcciones')) ? 'text-bold' : '' }}" href="{{ route('direcciones.index') }}">Direcciones</a></li>
                                    <li><a class="{{ (request()->is('subdirecciones')) ? 'text-bold' : '' }}" href="{{ route('subdirecciones.index') }}">Subdirecciones</a></li>
                                    <li><a class="{{ (request()->is('departamentos')) ? 'text-bold' : '' }}" href="{{ route('departamentos.index') }}">Departamentos</a></li>
                                 </ul>
                              </li>
                              <li>
                                 <a href="#">Menu Level</a>
                                 <ul>
                                    <li>
                                       <a href="#">Menu Level</a>
                                       <ul>
                                          <li><a href="#">Menu Level</a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                     </ul>
                  </div>
                  <div id="apps">
                     <ul>
                        <li class="navigation-divider">Web Apps</li>
                        <li><a href="chat.html"><span>Chat</span><span class="badge badge-danger">5</span></a></li>
                        <li><a href="inbox.html"><span>Mail</span></a></li>
                        <li><a href="app-todo.html"><span>Todo</span><span class="badge badge-warning">2</span></a></li>
                        <li><a href="file-manager.html"><span>File Manager</span></a></li>
                        <li><a href="calendar.html"><span>Calendar</span></a></li>
                     </ul>
                  </div>
                  <div id="elements">
                     <ul>
                        <li class="navigation-divider">UI Elements</li>
                        <li>
                           <a href="#">Basic</a>
                           <ul>
                              <li><a href="alerts.html">Alert</a></li>
                              <li><a href="accordion.html">Accordion</a></li>
                              <li><a href="buttons.html">Buttons</a></li>
                              <li><a href="dropdown.html">Dropdown</a></li>
                              <li><a href="list-group.html">List Group</a></li>
                              <li><a href="pagination.html">Pagination</a></li>
                              <li><a href="typography.html">Typography</a></li>
                              <li><a href="media-object.html">Media Object</a></li>
                              <li><a href="progress.html">Progress</a></li>
                              <li><a href="modal.html">Modal</a></li>
                              <li><a href="spinners.html">Spinners</a></li>
                              <li><a href="navs.html">Navs</a></li>
                              <li><a href="tab.html">Tab</a></li>
                              <li><a href="tooltip.html">Tooltip</a></li>
                              <li><a href="popovers.html">Popovers</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#">Cards</a>
                           <ul>
                              <li><a href="basic-cards.html">Basic Cards </a></li>
                              <li><a href="image-cards.html">Image Cards </a></li>
                              <li><a href="card-scroll.html">Card Scroll </a></li>
                              <li><a href="other-cards.html">Others </a></li>
                           </ul>
                        </li>
                        <li><a href="avatar.html">Avatar</a></li>
                        <li><a href="icons.html">Icons</a></li>
                        <li><a href="colors.html">Colors</a></li>
                        <li>
                           <a href="#">Plugins</a>
                           <ul>
                              <li><a href="sweet-alert.html">Sweet Alert</a></li>
                              <li><a href="lightbox.html">Lightbox</a></li>
                              <li><a href="toast.html">Toast</a></li>
                              <li><a href="tour.html">Tour</a></li>
                              <li><a href="slick-slide.html">Slick Slide</a></li>
                              <li><a href="nestable.html">Nestable</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#">Forms</a>
                           <ul>
                              <li><a href="basic-form.html">Form Layouts</a></li>
                              <li><a href="custom-form.html">Custom Forms</a></li>
                              <li><a href="advanced-form.html">Advanced Form</a></li>
                              <li><a href="form-validation.html">Validation</a></li>
                              <li><a href="form-wizard.html">Wizard</a></li>
                              <li><a href="file-upload.html">File Upload</a></li>
                              <li><a href="datepicker.html">Datepicker</a></li>
                              <li><a href="timepicker.html">Timepicker</a></li>
                              <li><a href="colorpicker.html">Colorpicker</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#">Tables</a>
                           <ul>
                              <li><a href="tables.html">Basic Tables</a></li>
                              <li><a href="data-table.html">Datatable</a></li>
                              <li><a href="responsive-table.html">Responsive Tables</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#">Charts</a>
                           <ul>
                              <li><a href="apexchart.html">Apex</a></li>
                              <li><a href="chartjs.html">Chartjs</a></li>
                              <li><a href="justgage.html">Justgage</a></li>
                              <li><a href="morsis.html">Morsis</a></li>
                              <li><a href="peity.html">Peity</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#">Maps</a>
                           <ul>
                              <li><a href="google-map.html">Google</a></li>
                              <li><a href="vector-map.html">Vector</a></li>
                           </ul>
                        </li>
                     </ul>
                  </div>
                  <div id="pages">
                     <ul>
                        <li class="navigation-divider">Pages</li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="register.html">Register</a></li>
                        <li><a href="recover-password.html">Recovery Password</a></li>
                        <li><a href="lock-screen.html">Lock Screen</a></li>
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="timeline.html">Timeline</a></li>
                        <li><a href="invoice.html">Invoice</a></li>
                        <li><a href="pricing-table.html">Pricing Table</a></li>
                        <li><a href="search-result.html">Search Result</a></li>
                        <li>
                           <a href="#">Error Pages</a>
                           <ul>
                              <li><a href="404.html">404</a></li>
                              <li><a href="404-2.html">404 V2</a></li>
                              <li><a href="503.html">503</a></li>
                              <li><a href="mean-at-work.html">Mean at Work</a></li>
                           </ul>
                        </li>
                        <li><a href="blank-page.html">Starter Page</a></li>
                        <li>
                           <a href="#">Email Templates</a>
                           <ul>
                              <li><a href="email-template-basic.html">Basic</a></li>
                              <li><a href="email-template-alert.html">Alert</a></li>
                              <li><a href="email-template-billing.html">Billing</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#">Menu Level</a>
                           <ul>
                              <li>
                                 <a href="#">Menu Level</a>
                                 <ul>
                                    <li><a href="#">Menu Level</a></li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <!-- end::navigation menu -->
         </div>
         <!-- end::navigation --><!-- begin::main content -->
         <main class="main-content pb-1">
            <div class="page-header">
               <div class="container-fluid d-sm-flex justify-content-between">
                  <h4>Sistema de gestión de proyectos internos</h4>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">SGPI</li>
                        <li class="breadcrumb-item active" aria-current="page">Mis proyectos</li>
                     </ol>
                  </nav>
               </div>
            </div>
            <div class="container-fluid">
               @yield('content')
            </div>
            <!-- begin::footer -->
            <footer>
               <div class="container-fluid">
                  <div><a href="https://www.ssm.gob.mx">© Servicios de Salud de Morelos 2022</a></div>
                     <!-- <div>
                        <nav class="nav"><a href="" class="nav-link">Licenses</a><a href="#" class="nav-link">Change Log</a><a href="#" class="nav-link">Get Help</a></nav>
                     </div> -->
                  </div>
               </footer>
               <!-- end::footer -->
            </main>

            <!-- end::main content -->
         </div>

         <div class="modal fade modalframe" id="modaliframe"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" style="overflow-y: scroll;">
           <div class="modal-dialog modal-lg" id="dialog">
            <div class="modal-content">
             <div class="modal-header bg-{{$bg->customcolor}}">
              <h5 class="modal-title text-md text-white" id="modaltitulo"></h5>
              <span id="close" onclick="$('#modaliframe').modal('hide')" class="close text-{{$bg->customcolor}}" data-dismiss="modal" aria-label="Close"> 
               <span aria-hidden="true" >&times;</span>
            </span>
         </div>
         <div class="embed-responsive embed-responsive-16by9 z-depth-1-half rounded-bottom">
            <iframe class="embed-responsive-item" id="iframemarca" src=""  frameborder="0" allowfullscreen></iframe>
         </div>
           <!-- <div class="modal-footer">
           </div> -->
        </div>
     </div>
   </div>

   <div class="modal fade modalframe" id="modaliframe2" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" style="overflow-y: scroll;">
     <div class="modal-dialog" id="dialog">
      <div class="modal-content">
       <div class="modal-header bg-{{$bg->customcolor}}">
        <h5 class="modal-title text-md text-white w-100 text-center" id="modaltitulo2"></h5>
     </div>
     <div class="rounded-bottom bg-lavender">
      <iframe class="" style="height: 420px; width: 100%;" id="iframemarca2" src=""  frameborder="0" allowfullscreen></iframe>
   </div>
   </div>
   </div>
   </div>

   <!-- Plugins -->
   <script src="{{ URL::asset('js/vendors/bundle.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/charts/apex/apexcharts.min.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/charts/chartjs/chart.min.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/circle-progress/circle-progress.min.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/prism/prism.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/datepicker/daterangepicker.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/charts/peity/jquery.peity.min.js') }}"></script>
   <script src="{{ URL::asset('js/examples/dashboard.js') }}"></script>
   <script src="{{ URL::asset('js/plugins/bootstrap.min.js') }}"></script>
   <script src="{{ URL::asset('js/examples/datatable.js') }}"></script>

   <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->

   <!-- Javascript -->
   <script src="{{ URL::asset('editor/jquery/jquery.dataTables.min.js') }}"></script>
   <script src="{{ URL::asset('editor/js/dataTables.select.min.js') }}"></script>
   <script src="{{ URL::asset('editor/js/dataTables.datetime.min.js') }}"></script>
   <script src="{{ URL::asset('editor/js/dataTables.editor.min.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/dataTable/dataTables.responsive.min.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/dataTable/dataTables.bootstrap.min.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/dataTable/dataTables.buttons.min.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/dataTable/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ URL::asset('js/vendors/select2/js/select2.min.js') }}"></script>

   <div class="colors">
      <div class="bg-primary"></div>
      <div class="bg-primary-bright"></div>
      <div class="bg-secondary"></div>
      <div class="bg-secondary-bright"></div>
      <div class="bg-info"></div>
      <div class="bg-info-bright"></div>
      <div class="bg-success"></div>
      <div class="bg-success-bright"></div>
      <div class="bg-danger"></div>
      <div class="bg-danger-bright"></div>
      <div class="bg-warning"></div>
      <div class="bg-warning-bright"></div>
   </div>
   <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
   <script type="text/javascript" src="{{ URL::asset('js/app2.js') }}"></script>
   <script type="text/javascript" src="{{ URL::asset('js/plantilla.js') }}"></script>
   <script type="text/javascript">
      function taskmenubtn() {
         $("#taskmenu").click();
      }
      document.getElementById("taskmenu").addEventListener('click', function (event) {
      event.stopPropagation();
      var taskInput=document.getElementById("new-task")
      var addButton=document.getElementById("add-task");
      var incompleteTaskHolder=document.getElementById("incomplete-tasks");
      var completedTasksHolder=document.getElementById("completed-tasks");

      var createNewTaskElement=function(taskString){
         var listItem=document.createElement("li");
         var checkBox=document.createElement("input");
         var label=document.createElement("label");
         var editInput=document.createElement("input");
         var editButton=document.createElement("button");
         var deleteButton=document.createElement("button");

         label.innerText=taskString;
         checkBox.type="checkbox";
         editInput.type="text";
         editInput.className="form-control bg-gray";

         editButton.innerHTML='<i class="fa fa-pencil"></i>';
         editButton.className="check-edit btn btn-link text-info btn-sm m-1";
         deleteButton.innerHTML='<i class="fa fa-times"></i>';
         deleteButton.className="check-delete btn btn-link text-danger btn-sm m-1";

         listItem.appendChild(checkBox);
         listItem.appendChild(label);
         listItem.appendChild(editInput);
         listItem.appendChild(editButton);
         listItem.appendChild(deleteButton);
         return listItem;
      }


      var addTask=function(){
         var listItem=createNewTaskElement(taskInput.value);
         incompleteTaskHolder.appendChild(listItem);
         bindTaskEvents(listItem, taskCompleted);
         taskInput.value="";
      }

      var editTask = function() {
         var listItem=this.parentNode;
         var editInput=listItem.querySelector('input[type=text]');
         var label=listItem.querySelector("label");
         var btn=listItem.querySelector("button");
         var containsClass=listItem.classList.contains("editMode");

         if(containsClass){
            label.innerText=editInput.value;
            btn.innerHTML='<i class="fa fa-pencil"></i>';
         }else{
            editInput.value=label.innerText;
            btn.innerHTML='<i class="fa fa-check"></i>';
         }
         listItem.classList.toggle("editMode");
      }

      var deleteTask = function() {
         var listItem=this.parentNode;
         var ul=listItem.parentNode;
         ul.removeChild(listItem);
      }

      var taskCompleted=function(){
         var listItem=this.parentNode;
         completedTasksHolder.appendChild(listItem);
         var btn=listItem.querySelector("button");
         var containsClass=listItem.classList.contains("editMode");
         btn.disabled = true;
         btn.classList.add("disabled");
         if(containsClass){
            btn.innerHTML='<i class="fa fa-pencil"></i>';
            listItem.classList.toggle("editMode");
         }
         
         bindTaskEvents(listItem, taskIncomplete);
      }

      var taskIncomplete=function(){
         var listItem=this.parentNode;
         var containsClass=listItem.querySelector("button");
         containsClass.disabled = false;
         containsClass.classList.remove("disabled");
         incompleteTaskHolder.appendChild(listItem);
         bindTaskEvents(listItem,taskCompleted);
      }

      var ajaxRequest=function(){
         console.log("AJAX Request");
      }

      addButton.onclick=addTask;
      addButton.addEventListener("click",ajaxRequest);

      var bindTaskEvents=function(taskListItem,checkBoxEventHandler){
         var checkBox=taskListItem.querySelector("input[type=checkbox]");
         var editButton=taskListItem.querySelector("button.check-edit");
         var deleteButton=taskListItem.querySelector("button.check-delete");
         editButton.onclick = editTask;
         deleteButton.onclick = deleteTask;
         checkBox.onchange=checkBoxEventHandler;
      }

      for (var i=0; i<incompleteTaskHolder.children.length;i++){
         bindTaskEvents(incompleteTaskHolder.children[i],taskCompleted);
      }

      for (var i=0; i<completedTasksHolder.children.length;i++){
         bindTaskEvents(completedTasksHolder.children[i],taskIncomplete);
      }

   });
   </script>
   </body>

   <script type="text/javascript">

      $(document).ready(function(){
         @if(Auth::user()->area==null)
         var url = '{{ route("usuarios.area") }}';
         openiframe2('Mi area de trabajo',url);
         @endif
         $(".preloader").fadeOut(400,function(){setTimeout(function(){},500)});
         if ($(window).width() < 700) {
          $('.tabla-responsiva').addClass('table-responsive');
       }

    });

      localStorage.setItem('res','');

      $('.modalframe').on('hidden.bs.modal', function () {
       var val = localStorage.getItem('res');

       if(val != ''){
          if (val == 'ok'){
           $(".preloader").fadeOut(400,function(){setTimeout(function(){toastr.options={timeOut:2000,progressBar:true,showMethod:"slideDown",hideMethod:"slideUp",showDuration:200,hideDuration:300,positionClass:"toast-bottom-center",};toastr.success("Operación exitosa");a(".theme-switcher").removeClass("open")},500)});
           localStorage.getItem('res', '');
           setTimeout(function(){
             history.go(0);
          }, 2500);
        }else if(val == 'nook'){
           var mensaje = '';
           @if(Auth::user()->tipo_usuario==2)
           mensaje = "Operación no exitosa:" + val;
           @else
           mensaje = "Operación no exitosa";
           @endif
           $(".preloader").fadeOut(400,function(){setTimeout(function(){toastr.options={timeOut:5000,progressBar:true,showMethod:"slideDown",hideMethod:"slideUp",showDuration:200,hideDuration:300,positionClass:"toast-bottom-center",};toastr.error(mensaje);a(".theme-switcher").removeClass("open")},500)});
           localStorage.getItem('res', '');
        }else if(val == 'tareas'){
           window.location.href="{{route('tareas.index')}}";
           localStorage.getItem('res', '');
        }else if(val == 'subtareas'){
           window.location.href="{{route('subtareas.index')}}";
           localStorage.getItem('res', '');
        }
     }

   });
      
   </script>



   </html>
