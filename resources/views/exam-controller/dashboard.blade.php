@extends('exam-controller.sidebar')

@section('page_css')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{url('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

@endsection

@section('page_content')
<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one">
                <div class="widget-heading">
                    <h6 class="">Statistics</h6>
                </div>
                <div class="w-chart">
                    <div class="w-chart-section">
                        <div class="w-detail">
                            <p class="w-title">Total Tests</p>
                            <p class="w-stats">423,964</p>
                        </div>
                        <div class="w-chart-render-one">
                            <div id="total-users"></div>
                        </div>
                    </div>

                    <div class="w-chart-section">
                        <div class="w-detail">
                            <p class="w-title">My Uploads</p>
                            <p class="w-stats">7,929</p>
                        </div>
                        <div class="w-chart-render-one">
                            <div id="paid-visits"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">45,141</h6>
                            <p class="">Online Updated</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            </div>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>
@endsection

@section('page_js')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{url('plugins/apex/apexcharts.min.js')}}"></script>
    <script src="{{url('assets/js/dashboard/dash_2.js')}}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

@endsection
