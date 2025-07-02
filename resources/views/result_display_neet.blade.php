@extends('exam-controller.sidebar')

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
                                <!-- <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">MaxMarks</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">TotalMarks</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">BioTotal</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">PhyTotal</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">ChemTotal</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">BioObt</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">PhyObt</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">ChemObt</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">T%</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">B%</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">P%</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">C%</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">AIR</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">TR</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">BR</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">PR</th>
                                <th style="font-size: 1rem ! important; padding: 0 ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding-right: 20px ! important;">CR</th> -->
                            </tr>
                            </thead>
                            <tbody>

                                    @foreach($data as $rows)

                                        <tr>
                                             @foreach($columns_data as $cd)
                                                <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 20px ! important;">{{$rows[$cd]}}</td>
                                            @endforeach
                                            <!-- <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 20px ! important;">{{$rows['overallmaxmarks']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['overallmarks']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['biomaxmarks']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['phymaxmarks']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['chemmaxmarks']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['biomarks']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['phymarks']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['chemmarks']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['overallpercent']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['biopercent']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['phypercent']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['chempercent']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['overallrank']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['overallcrank']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['biorank']}}</td>
                                            <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['phyrank']}}</td>
                                             <td style="font-size: 1rem ! important; letter-spacing: 0px ! important; font-weight: 300 ! important; padding: 0 !important; padding-right: 2px ! important;">{{$rows['chemrank']}}</td> -->
                                        </tr>

                                    @endforeach

                            </tbody>
                        </table>
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
    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{url('plugins/table/datatable/datatables.js')}}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{url('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{url('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{url('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        } );
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->

@endsection
