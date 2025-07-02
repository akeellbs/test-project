{{-- @extends('exam-controller.sidebar') --}}
@extends('master')

@section('main_content')


<div class="overlay"></div>
<div class="search-overlay"></div>
@section('page_css')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{url('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{url('plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('plugins/table/datatable/custom_dt_html5.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('plugins/table/datatable/dt-global_style.css')}}">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

@endsection

@section('page_content')

<div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-one">
                    <div class="table-responsive mb-4 mt-4">
                        <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                            <thead>
                            <tr>
                            
                             @foreach($columns as $col)
                                <th style="font-size: 1rem ! important; letter-spacing: px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 30px ! important;" >{{$col}}</th>
                             @endforeach   
                                
                            </tr>
                            </thead>
                            <tbody>

                                    @foreach($data as $rows)

                                        <tr>
                                            @foreach($columns_data as $cd)
                                                <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 20px ! important;">{{$rows[$cd]}}</td>
                                            @endforeach
                                          
                                        </tr>

                                    @endforeach
									
									
									
									
										
                            </tbody>
                        </table>
						
						
						
						
						{{-- <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                            <thead>
                            <tr>
                            
                             @foreach($columns1 as $col)
                                <th style="font-size: 1rem ! important; letter-spacing: px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 30px ! important;" >{{$col}}</th>
                             @endforeach   
                                
                            </tr>
                            </thead>
                            <tbody>

                                    @foreach($data0 as $rows)

                                        <tr>
                                             @foreach($columns1_data as $cd)
                                                <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 20px ! important;">{{$rows[$cd]}}</td>
                                            @endforeach
                                          
                                        </tr>

                                    @endforeach
									
									
									
									
										
                            </tbody>
                        </table> --}}
						
						
						<div class="form-group">
										<a class="btn btn-primary" href="{{ URL::to('/pdf') }}">Export to PDF</a>

										</div>
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection