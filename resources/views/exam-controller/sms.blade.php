
@extends('exam-controller.sidebar')

@section('page_css')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{url('assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{url('plugins/select2/select2.min.css')}}">
    <link href="{{url('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/forms/theme-checkbox-radio.css')}}">
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{url('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

@endsection

@section('page_content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-one">
                    <div class="widget-heading text-center">
                        <h6 class="">SMS Sending Panel | OMR Data Upload Panel</h6>
                    </div>
                    <form action="#" method="post" id="">
                        @csrf
                        <div class="row">
							
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block mb-2" id="send_sms">Send SMS</button>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Details</label>
                                    <select class="form-control  basic" id="test_details" name="test_details">
                                        <option value="00">Select Details</option>

                                    </select>
                                </div>

                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <div class="table-responsive" id="view-grid">



                                    </div>
                                </div>

                            </div>
							<!--
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block mb-2" id="send_sms">Send SMS</button>
                                </div>
                            </div>
							-->
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
@endsection

@section('page_js')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{url('assets/js/dashboard/dash_2.js')}}"></script>
    <script src="{{url('plugins/select2/select2.min.js')}}"></script>
    <script src="{{url('plugins/select2/custom-select2.js')}}"></script>

    <script src="{{url('plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{url('plugins/flatpickr/custom-flatpickr.js')}}"></script>
    <script src="{{url('assets/js/custom.js')}}"></script>
    <script src="{{url('plugins/highlight/highlight.pack.js')}}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script>
        $(document).ready(function(){
            $('#send_sms').attr('disabled', 'disabled');
            $("#send_sms").html("Please Wait....");
            $.ajax({
                url: "{{url('get_sms_test_details')}}",
                success: function(data, textStatus, jqXHR){
                    //console.log(data);
                    //$('#send_sms').removeAttr('disabled');
                    $("#send_sms").html("Choose specific from above");
                    let dropdown=$('#test_details');
                    dropdown.empty();
                    dropdown.append('<option selected="true" disabled>Choose Project Title</option>');
                    dropdown.prop('selectedIndex',0);

                    let obj = JSON.parse(data)

                    for(let i=0; i<obj.Values.length; i++){

                        let values = obj.Values[i];
                        dropdown.append('<option value="'+ values.id +'" >' + values.name + '</option>')

                    }

                },
                error(jqXHR, textStatus, errorThrown) {
                    console.log("fail......");
                }
            });

            $('#test_details').on('change',function(){

                let e = document.getElementById("test_details");
                let prjTitle = e.options[e.selectedIndex].value;

                $('#test_details').attr('disabled', 'disabled');
                $('#send_sms').attr('disabled', 'disabled');
                $("#send_sms").html("Please Wait...");
                $("#view-grid").html("");
                $.ajax({
                    url: "{{url('get_sms_records')}}",
                    type: "POST",
                    data :{"prjTitle": prjTitle},
                    success: function(data, textStatus, jqXHR){

                        $('#test_details').removeAttr('disabled');
                        $('#send_sms').removeAttr('disabled');
                        $("#send_sms").html("Send SMS");

                        let obj = JSON.parse(data);

                        if (obj.Status==="1"){

                            if (obj.Stream==="NEET"){

                                display_bio_grid(obj)
                            }
                            else{
                                display_maths_grid(obj)
                            }


                        }
                        else{
                            alert(obj.Msg);
                        }
                        console.log(obj)
                    },
                    error(jqXHR, textStatus, errorThrown) {
                        $('#test_details').removeAttr('disabled');
                        $("#send_sms").html("Try Again");
                    }
                });

            });

            $('#send_sms').on('click',function(){

                let e = document.getElementById("test_details");
                let prjTitle = e.options[e.selectedIndex].value;

                $('#test_details').attr('disabled', 'disabled');
                $('#send_sms').attr('disabled', 'disabled');
                $("#send_sms").html("Please Wait...");
                $.ajax({
                    url: "{{url('send-sms')}}",
                    type: "POST",
                    data :{"prjTitle": prjTitle},
                    success: function(data, textStatus, jqXHR){

                        $('#test_details').removeAttr('disabled');
                        $('#send_sms').removeAttr('disabled');
                        $("#send_sms").html("Send SMS");
						
						let obj = JSON.parse(data);
						
						let msg_count = obj.Values.length;
						
						alert(msg_count + obj.Msg);

                        console.log(data)
                    },
                    error(jqXHR, textStatus, errorThrown) {
                        $('#test_details').removeAttr('disabled');
                        $('#send_sms').removeAttr('disabled');
                        $("#send_sms").html("Try Again");
                    }
                });

            });



        });

        function display_bio_grid(obj){

            $("#view-grid").append('<table class="table table-bordered mb-4">');
            $("#view-grid").append('<thead>');

            $("#view-grid").append('<th style="padding-right: 10px;"> Roll No </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Test ID </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Test Name </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> St Name </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> St Mob </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> F Mob </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Phy Obt </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Chem Obt</th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Bio Obt </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Phy Max </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Chem Max</th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Bio Max </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Total Obt </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Max Marks</th>');

            $("#view-grid").append('<th style="padding-right: 10px;"> C Rank </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> AIR Rank</th>');

            $("#view-grid").append('</thead>');
            $("#view-grid").append('<tbody>');
            for (let i=0; i<obj.Values.length; i++){

                let values = obj.Values[i];
                $("#view-grid").append('<tr>');

                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.rollno+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.testid+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.testname+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.studentname+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.stmob+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.fmob+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.phymarks+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.chemmarks+'</td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.biomarks+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.phymaxmarks+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.chemmaxmarks+'</td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.biomaxmarks+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.overallmarks+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.overallmaxmarks+'</td>');

                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.overallcrank+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.overallrank+'</td>');

                $("#view-grid").append('</tr>');

            }
            $("#view-grid").append('</tbody>');
            $("#view-grid").append('</table>');

        }

        function display_maths_grid(obj){

            $("#view-grid").append('<table class="table table-bordered mb-4">');
            $("#view-grid").append('<thead>');

            $("#view-grid").append('<th style="padding-right: 10px;"> Roll No </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Test ID </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Test Name </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> St Name </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> St Mob </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> F Mob </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Phy Obt </th>');
            $("#view-grid").append('<th style="padding-right: 6px;"> Chem Obt</th>');
            $("#view-grid").append('<th style="padding-right: 6px;"> Maths Obt </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Phy Max </th>');
            $("#view-grid").append('<th style="padding-right: 6px;"> Chem Max</th>');
            $("#view-grid").append('<th style="padding-right: 6px;"> Maths Max </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Total Obt </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> Max Marks</th>');

            $("#view-grid").append('<th style="padding-right: 10px;"> C Rank </th>');
            $("#view-grid").append('<th style="padding-right: 10px;"> AIR Rank</th>');

            $("#view-grid").append('</thead>');
            $("#view-grid").append('<tbody>');
            for (let i=0; i<obj.Values.length; i++){

                let values = obj.Values[i];
                $("#view-grid").append('<tr>');

                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.rollno+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.testid+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.testname+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.studentname+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.stmob+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.fmob+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.phymarks+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.chemmarks+'</td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.mathsmarks+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.phymaxmarks+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.chemmaxmarks+'</td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.mathsmaxmarks+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.overallmarks+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.overallmaxmarks+'</td>');

                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.overallcrank+' </td>');
                $("#view-grid").append('<td style="padding-right: 10px;"> '+values.overallrank+'</td>');

                $("#view-grid").append('</tr>');



            }
            $("#view-grid").append('</tbody>');
            $("#view-grid").append('</table>');

        }


    </script>


@endsection
