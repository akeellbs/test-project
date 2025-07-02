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
                        <h6 class="">Advance Result File Upload | OMR Data Upload Panel</h6>
                    </div>

                    <form action="{{url('result-uploader/3')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Test ID</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="test_id" value="{{$test_id}}">
                                </div>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Test Name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="test_name" value="">
                                </div>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Class</label>
                                    <select class="form-control basic" id = "test_class" name="test_class" required>
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
                                    <input type="text" class="form-control flatpickr flatpickr-input active" id="basicFlatpickr" name = "test_date" value="">
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Paper Time Out</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name = "test_duration" value="">
                                </div>

                            </div>
							
							
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Quiz Type</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="IIT">
                                </div>
						
							
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Target Rank To Show</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name = "test_target_rank" value="">
                                </div>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Test Pattern</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name = "test_pattern" value="OMR">
                                </div>

                            </div>
							
							
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Total Questions (per subject)</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name = "test_total_questions" value="75">
                                </div>
							
                            </div>
							
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Optional Questions (Per Subject)</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="5">
                                </div>
						
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Paper Number</label>
                                    <select class="form-control  basic" id = "paper_type" name = "paper_type">
                                        <!-- <option selected="selected" value="00">Select Paper</option> -->
                                        @for($i=0; $i<2; $i++)
                                            <option value="P{{$i+1}}">Paper {{$i+1}}</option>
                                        @endfor
                                    </select>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Is Last?</label>
                                    <select class="form-control  basic">
                                        <option selected="selected" value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Excel File Upload</label>
                                    <input type="file" class="form-control" id="file_upload" name="file_upload">
                                </div>

                            </div>


                            

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-warning btn-block mb-2">Reset Fields</button>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-2">Get Result</button>
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
        let f1 = flatpickr(document.getElementById('date_picker'));
    </script>

@endsection
