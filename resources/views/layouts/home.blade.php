<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/style-calendar.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/perfil.css')}}" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="{{URL::asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">
    <link href="{{URL::asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <link href="{{URL::asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css')}}"/>
    <link href="{{URL::asset('https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard.min.css')}}" rel="stylesheet" type="text/css" />
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('home')}}">
                <img width="100%" src="{{URL::asset('img/logo.png')}}" alt="">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            @if ($user=Auth::user()->role_id=='3')
                @include('menu.administrador')
            @elseif($user=Auth::user()->role_id=='4')
                @include('menu.contador')
            @elseif($user=Auth::user()->role_id=='5')
                @include('menu.cliente')
            @endif
            <!-- Nav Item - Dashboard -->
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                       
                        <!-- Nav Item - Alerts -->
                       @if (Auth::user()->role_id=='3' or Auth::user()->role_id=='4' )
                           @include('colaboradores.alertas')
                        @elseif(Auth::user()->role_id=='5')
                            @include('empresas.alerta')
                        @endif
                        <!-- Nav Item - Messages -->
                        
                        <div class="topbar-divider d-none d-sm-block"></div>
                    
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>

                                @if (Storage::disk('fotoperfil')->has(Auth::user()->url_imagen))
                                    <img class="img-profile rounded-circle"
                                     src="{{url('/fotoperfil/'.Auth::user()->url_imagen)}}">
                                @else
                                    <img class="img-profile rounded-circle" 
                                    src="{{URL::asset('img/undraw_profile.svg')}}">
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @if($user=Auth::user()->role_id!='5')
                                <a class="dropdown-item" href="{{route('perfil-usuario')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="{{route('hoja-de-vida')}}">
                                    <i class="fas fa-user-graduate fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Hoja de Vida
                                </a>
                                @endif
                                
                                <div class="dropdown-divider">
                                </div>
                                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    Cerrar Sesion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    @yield('content')
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{ url('/logout') }}">Salir</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{URL::asset('js/sb-admin-2.min.js')}}"></script>
    <!-- Page level plugins -->
    <script src="{{URL::asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('js/demo/datatables-demo.js')}}"></script>
    <script src="{{URL::asset('https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.smartWizard.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery-bootstrap-modal-steps.js')}}"></script>
    
    <script>
        $(document).ready(function(){

        $('div#smartwizard').smartWizard({
               selected: 0,  // Initial selected step, 0 = first step
      keyNavigation:true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
      autoAdjustHeight:true, // Automatically adjust content height
      cycleSteps: false, // Allows to cycle the navigation of steps
      backButtonSupport: true, // Enable the back button support
      useURLhash: true, // Enable selection of the step based on url hash
      lang: {  // Language variables
          next: 'Siguiente',
          previous: 'Anterior'
      },
      toolbarSettings: {
          toolbarPosition: 'bottom', // none, top, bottom, both
          toolbarButtonPosition: 'right', // left, right
          showNextButton: true, // show/hide a Next button
          showPreviousButton: true, // show/hide a Previous button
          toolbarExtraButtons: [
$('<button type="submit" ></button>').text('Guardar')
		      .addClass('btn btn-acontis')
		      .on('click', function(){
			
		      }),
$('<button  data-dismiss="modal"></button>').text('Cancelar')
		      .addClass('btn btn-danger')
		      .on('click', function(){
			
		      })
                ]
      },
      anchorSettings: {
          anchorClickable: true, // Enable/Disable anchor navigation
          enableAllAnchors: false, // Activates all anchors clickable all times
          markDoneStep: true, // add done css
          enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
      },
      contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
      disabledSteps: [],    // Array Steps disabled
      errorSteps: [],    // Highlight step with errors
      theme: 'dots',
      transitionEffect: 'fade', // Effect on navigation, none/slide/fade
      transitionSpeed: '400'
        });

        });
    </script>
      <script>
        $('#myModal').modalSteps();
        </script>
        
    </body>
</html>