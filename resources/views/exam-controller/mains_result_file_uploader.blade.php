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
    <!--  END CUSTOM STYLE FILE  -->
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

@endsection

@section('page_content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-one">
                    <div class="widget-heading text-center">
                        <h6 class="">Mains Result File Upload | OMR Data Upload Panel</h6>
                    </div>
                    <form action="{{url('result-uploader/2')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Test ID</label>
                                    <input type="text" class="form-control" id="test_id" name="test_id" value="{{$test_id}}">
                                </div>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Test Name</label>
                                    <input type="text" class="form-control" id="test_name" name="test_name" value="" style="text-transform:uppercase">
                                </div>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Class</label>
                                    <select class="form-control  basic" id="test_class" name="test_class" required>
                                        <option value="">Select Class</option>
                                        @for($i=0; $i<13; $i++)
                                            <option value="{{$i+1}}">{{$i+1}}</option>
                                        @endfor
                                    </select>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Test Date</label>
                                    <input type="text" class="form-control flatpickr flatpickr-input active" id="basicFlatpickr" name="test_date" value="">
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Paper Time Out (Duration in minutes)</label>
                                    <input type="text" class="form-control" id="test_duration" name="test_duration" value="" maxlength="3" pattern="\d*">
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Quiz Type</label>
                                    <input type="text" class="form-control" id="test_quiz_type" name="test_quiz_type" value="MAINS" readonly style="text-transform:uppercase">
                                </div>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Target Rank To Show</label>
                                    <input type="number" class="form-control" id="test_target_rank" name="test_target_rank" value="">
                                </div>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Test Pattern</label>
                                    <select class="form-control  basic" id="test_pattern" name="test_pattern">
                                        <option selected="selected" value="OMR">OMR</option>
                                        <option value="TABLET">TABLET</option>
                                        <option value="SUBJECTIVE">SUBJECTIVE</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Total Questions(3 Digits max)</label>
                                    <input type="text" class="form-control" id="total_questions" name="test_total_questions" value="" oninput="set_question_settings()" maxlength="3" pattern="\d*">
                                    <div class=" mt-1">
                                        <span class="badge badge-primary">
                                            <small id="sh-text1" class="form-text mt-0">Please enter the multiple of 3</small>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Total Questions (Physics without optionals)</label>
                                    <input type="text" class="form-control" id="test_total_questions_phy" name="test_total_questions_phy" value="0" readonly>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Total Questions (Chemistry without optionals)</label>
                                    <input type="text" class="form-control" id="test_total_questions_chem" name="test_total_questions_chem" value="0" readonly>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Total Questions (Maths without optionals)</label>
                                    <input type="text" class="form-control" id="test_total_questions_maths" name="test_total_questions_maths" value="0" readonly>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary" style="margin-top: 5%;">
                                        <input type="checkbox" class="new-control-input" id="checkbox">
                                        <span class="new-control-indicator"></span>Please check if optional pattern is opted
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" id="optional_view">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Optional Questions(2 Digits max)</label>
                                        <input type="text" class="form-control" id="test_optional_questions" name="test_optional_questions" value="" oninput="set_optional_question_settings()" maxlength="2" pattern="\d*">
                                        <div class=" mt-1">
                                            <span class="badge badge-primary">
                                                <small id="sh-text2" class="form-text mt-0">Please enter the multiple of 3</small>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" id="optional_view_final_check">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Questions To Attempt</label>
                                    <select class="form-control  basic" id="test_question_attempt" name="test_question_attempt">
                                        <option selected="selected" value="1/2">Half Of Optional Questions</option>
                                        <option value="1/3">One-Third Of Optional Questions</option>
                                    </select>
                                </div>

                            </div>



                            <div id="hidden-view" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Optional Questions (Physics)</label>
                                            <input type="text" class="form-control" id="test_optional_questions_phy" name="test_total_questions_phy" value="0" readonly>
                                        </div>

                                    </div>

                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Optional Questions (Chemistry)</label>
                                            <input type="text" class="form-control" id="test_optional_questions_chem" name="test_total_questions_chem" value="0" readonly>
                                        </div>

                                    </div>

                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Optional Questions (Maths)</label>
                                            <input type="text" class="form-control" id="test_optional_questions_maths" name="test_total_questions_maths" value="0" readonly>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Excel File Upload</label>
                                    <input type="file" class="form-control" id="file_upload" name="file_upload" value="Excel">
                                </div>

                            </div>


                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">

                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-warning btn-block mb-2">Reset Fields</button>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block mb-2">Get Result</button>
                                </div>

                            </div>

                        </div>
                        <input type="hidden" value="no" name="is_checked" id="is_checked"/>
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
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script>

        $(document).ready(function() {

            $("#hidden-view").hide();
            $("#optional_view").hide();
            $("#optional_view_final_check").hide();

                $('#checkbox').change(function() {

                        if(this.checked) {
                            $("#hidden-view").show();
                            $("#optional_view").show();
                            $("#optional_view_final_check").show();
                            $("#is_checked").val("yes");
                        }
                        else{
                            $("#hidden-view").hide();
                            $("#optional_view").hide();
                            $("#optional_view_final_check").hide();
                            $("#is_checked").val("no");
                        }

                });

        });

        function set_optional_question_settings(){

            let total_questions = $("#test_optional_questions").val();

            if (parseInt(total_questions) % 3===0){

                $("#sh-text2").html("Please check questions in physics, chemistry and maths")

                let phy = (1/3) * parseInt(total_questions);
                let chem = (1/3) * parseInt(total_questions);
                let bio  = (1/3) * parseInt(total_questions);


                $("#test_optional_questions_phy").val(phy)
                $("#test_optional_questions_chem").val(chem)
                $("#test_optional_questions_maths").val(bio)

            }
            else{

                $("#test_optional_questions_phy").val("0")
                $("#test_optional_questions_chem").val("0")
                $("#test_optional_questions_maths").val("0")
                $("#sh-text2").html("Please enter a digit of multiple 3")

            }

        }

        function set_question_settings(){

                let total_questions = $("#total_questions").val();

                if (parseInt(total_questions) % 3===0){

                    $("#sh-text1").html("Please check questions in physics, chemistry and maths")

                    let phy = (1/3) * parseInt(total_questions);
                    let chem = (1/3) * parseInt(total_questions);
                    let bio  = (1/3) * parseInt(total_questions);


                    $("#test_total_questions_phy").val(phy)
                    $("#test_total_questions_chem").val(chem)
                    $("#test_total_questions_maths").val(bio)

                }
                else{

                    $("#test_total_questions_phy").val("0")
                    $("#test_total_questions_chem").val("0")
                    $("#test_total_questions_maths").val("0")
                    $("#sh-text1").html("Please enter a digit of multiple 3")

                }

        }
    </script>

@endsection
