@extends('exam-controller.sidebar')

@section('page_css')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{url('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{url('plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('plugins/table/datatable/custom_dt_html5.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('plugins/table/datatable/dt-global_style.css')}}">
    <link href="{{url('assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
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
                                <th>S. No.</th>
                                <th>Roll Number</th>
                                <th>DOB</th>
                                <th>Student Name</th>
                                <th>Father Rank</th>
                                <th>Mother Name</th>
                                <th>Gender</th>
                                <th>Course</th>
                                <th>Batch</th>
                                <th>Class</th>
                                <th>Target</th>
                                <th>Medium</th>
                                <th>Phase</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Center</th>
                                <th>Program Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($test_data as $rows)
                                <tr>
                                    <td>#</td>
                                    <td>{{$rows['Rollno']}}</td>
                                    <td>{{$rows['dob']}}</td>
                                    <td>{{$rows['StudentName']}}</td>
                                    <td>{{$rows['FatherName']}}</td>
                                    <td>{{$rows['mothername']}}</td> 
                                    <td>{{$rows['strGender']}}</td> 
                                    <td>{{$rows['Course']}}</td> 
                                    <td>{{$rows['batch']}}</td> 
                                    <td>{{$rows['strclass']}}</td>
                                    <td>{{$rows['strtarget']}}</td>
                                    <td>{{$rows['strmedium']}}</td> 
                                    <td>{{$rows['strphase']}}</td>
                                    <td>{{$rows['strstate']}}</td> 
                                    <td>{{$rows['strdistrict']}}</td>
                                    <td>{{$rows['center']}}</td>
                                    <td>{{$rows['programtype']}}</td>
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
            "lengthMenu": [200, 10, 20, 50],
            "pageLength": 200
        } );
    </script>
    <script>

        $('[data-toggle="tooltip"]').tooltip()

        function view_test_page(test_id, test_name, ai_rank, is_optional){

            $.ajax({
                url: '{{url('/result-display')}}',
                type: 'POST',
                data: {"test_id":test_id, "test_name":test_name, "ai_rank":ai_rank, "is_optional":is_optional},
                success: function(data) {
                    window.open('{{url('/view-csv')}}');
                },
                error: function() {
                }
            });

        }

        function confirm_delete(test_id, test_name){

                $('#confirm_modal').modal('show');
                $('#confirm_modal_label').html("Delete?");
                $('#confirm_modal_body_para').html("Are you sure you want to delete "+test_id+" | "+test_name+"");
                $('#confim_modal_btn_yes').on('click', function(){
                    // window.location.href = "{{url('log-out')}}"
                    delete_testid_data(test_id);
                });



        }

        function upload_online(test_id, test_stream, is_upload_excel){

            $('#info_modal').modal('show');
            $('#info_modal_label').html("Information");
            $('#info_modal_body_para').html("Please wait while the uploading process is up!!");

            $.ajax({
                url: '{{url('/upload-online')}}',
                type: 'POST',
                data: {"test_id":test_id, "test_stream":test_stream, "is_upload_excel":is_upload_excel},
                success: function(data) {
                    console.log(data);
                    $('#info_modal').modal('show');
                    $('#info_modal_label').html("Information");
                    $('#info_modal_body_para').html(data);
                },
                error: function(data) {
                    $('#info_modal').modal('show');
                    $('#info_modal_label').html("Error "+data.status);
                    $('#info_modal_body_para').html(data.statusText);
                    console.log(data.statusText)
                }
            });

        }

        function delete_testid_data(test_id){
            console.log(test_id)

            $.ajax({
                url: '{{url('/delete-testid-data')}}',
                type: 'POST',
                data: {"test_id":test_id,  _token: '{{csrf_token()}}'},
                success: function(data) {
                    console.log("ss");
                    location.reload();
                },
                error: function(data) {
                    $('#info_modal').modal('show');
                    $('#info_modal_label').html("Error "+data.status);
                    $('#info_modal_body_para').html(data.statusText);
                    console.log(data.statusText)
                }
            });

        }

    </script>

@endsection
