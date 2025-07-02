@extends('exam-controller.sidebar')

@section('page_css')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{url('assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{url('plugins/select2/select2.min.css')}}">
    <link href="{{url('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

@endsection

@section('page_content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-one">
                    <div class="widget-heading text-center">
                        <h6 class="">NEET Result File Upload | OMR Data Upload Panel</h6>
                    </div>
                    <form action="{{url('result-uploader/1')}}" method="post" enctype="multipart/form-data">
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
                                    <option selected="selected" value="">Select Class</option>
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
                                <input type="number" class="form-control" id="test_duration" name="test_duration" value="">
                            </div>

                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Quiz Type</label>
                                <input type="text" class="form-control" id="test_quiz_type" name="test_quiz_type" value="NEET" readonly style="text-transform:uppercase">
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
                                <small id="sh-text1" class="form-text text-muted">Please enter text in multiple of 3</small>
                            </div>

                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Total Questions (Physics)</label>
                                <input type="text" class="form-control" id="test_total_questions_phy" name="test_total_questions_phy" value="0" readonly>
                            </div>

                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Total Questions (Chemistry)</label>
                                <input type="text" class="form-control" id="test_total_questions_chem" name="test_total_questions_chem" value="0" readonly>
                            </div>

                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Total Questions (Biology)</label>
                                <input type="text" class="form-control" id="test_total_questions_biology" name="test_total_questions_biology" value="0" readonly>
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

            function set_question_settings(){

                let total_questions = $("#total_questions").val();

                console.log(total_questions)

                if (parseInt(total_questions) % 2===0 && parseInt(total_questions) % 3===0){

                    $("#sh-text1").html("Please check questions in physics, chemistry and biology")

                    let phy = 0.25 * parseInt(total_questions);
                    let chem = 0.25 * parseInt(total_questions);
                    let bio  = 0.5 * parseInt(total_questions);

                    $("#test_total_questions_phy").val(phy)
                    $("#test_total_questions_chem").val(chem)
                    $("#test_total_questions_biology").val(bio)

                }
                else{

                    $("#test_total_questions_phy").val("0")
                    $("#test_total_questions_chem").val("0")
                    $("#test_total_questions_biology").val("0")
                    $("#sh-text1").html("Please enter a digit of multiple 3 and divisible by 2")

                }

            }
    </script>

@endsection
