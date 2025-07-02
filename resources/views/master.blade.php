<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{$title}} | Motion SPR Management Portal | Motion Education Private Limited</title>
    <link rel="icon" type="image/x-icon" href="{{url('assets/img/favicon.ico')}}"/>
    <link href="{{url('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('assets/js/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{url('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{url('plugins/font-icons/fontawesome/css/regular.css')}}">
    <link rel="stylesheet" href="{{url('plugins/font-icons/fontawesome/css/fontawesome.css')}}">
    <!-- END GLOBAL MANDATORY STYLES -->

    @yield('page_css')

</head>
<body>
<!-- BEGIN LOADER -->
<div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>
<!--  END LOADER -->

<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{url('/dashboard')}}">
                    <img src="https://motion.ac.in/wp-content/uploads/2017/11/cropped-Logo-32x32.png" class="navbar-logo" alt="logo">
                </a>
            </li>

            <li class="nav-item theme-text">
                <a href="{{url('/dashboard')}}" class="nav-link"> Motion Education Private Limited </a>
            </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-0 ml-auto">
            <li class="nav-item align-self-center search-animated">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <form class="form-inline search-full form-inline search" role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                    </div>
                </form>
            </li>
        </ul>


    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN NAVBAR  -->
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">

                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Motion SPR Management Portal</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>{{$title}}</span></li>
                        </ol>
                    </nav>

                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    @yield('main_content')

</div>

<div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="confirm_modal_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm_modal_label"></h5>
            </div>
            <div class="modal-body">
                <p class="modal-text" id="confirm_modal_body_para">Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros. Phasellus egestas sit amet velit sed luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut sit amet ullamcorper mi. </p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12" id="confim_modal_btn_no"></i> Discard</button>
                <button type="button" class="btn btn-primary" id="confim_modal_btn_yes">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="info_modal" tabindex="-1" role="dialog" aria-labelledby="info_modal_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="info_modal_label">Information</h5>
            </div>
            <div class="modal-body">
                <p class="modal-text" id="info_modal_body_para">Please wait while the process is on.  </p>
            </div>

        </div>
    </div>
</div>

<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{url('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{url('bootstrap/js/popper.min.js')}}"></script>
<script src="{{url('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{url('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{url('assets/js/app.js')}}"></script>
<script src="{{url('plugins/font-icons/feather/feather.min.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{url('assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
@yield('page_js')

<script>
    function logout(){

        $('#confirm_modal').modal('show');
        $('#confirm_modal_label').html("Logout?");
        $('#confirm_modal_body_para').html("Are you sure of logging out? Click confirm to log out.");
        $('#confim_modal_btn_yes').on('click', function(){
            window.location.href = "{{url('log-out')}}"
        });



    }
</script>

</body>
</html>
