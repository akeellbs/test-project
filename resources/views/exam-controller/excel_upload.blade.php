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
<form action="{{url('excel_upload/')}}" method="POST" enctype="multipart/form-data">
@csrf

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <label for="exampleFormControlInput1">Test ID</label>
            <input type="text" class="form-control" id="test_id" name="test_id" value="{{$test_id}}">
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
            <label for="exampleFormControlInput1">Test Name</label>
            <input type="text" class="form-control" id="test_name" name="test_name" value="" style="text-transform:uppercase">
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="form-group">
            <label for="exampleFormControlInput1">Class</label> 
            <select class="form-control  basic" id="test_class" name="test_class">
            <option value="00">Select Class</option>
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
            <label for="exampleFormControlInput1">Target Rank To Show</label>
            <input type="number" class="form-control" id="test_target_rank" name="test_target_rank" value="">
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <label for="exampleFormControlInput1">Test Pattern</label>
                <select class="form-control  basic" id="test_quiz_type" name="test_quiz_type" onchange="get_sms_type(this.value)">
                    <option selected="selected" value="AIEEE">AIEEE</option>
                    <option value="NEET">NEET</option>
                    <option value="COMBINED">Advance Combine</option>
                    <option value="FOUNDATION">Foundation</option>
            </select>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" id="div_sms_for">
        <div class="form-group">
            <label for="exampleFormControlInput1">SMS FOR</label>
                <select class="form-control  basic" id="test_type" name="test_type">
                    <option selected="selected" value="Unit test">SMS for Unit test result</option>
                    <option value="Assesment Subjective">SMS for Assesment test Subjective result</option>          
                    <option value="Major test">SMS for Major test result</option>
                    <option value="Half Yearly test">SMS for Half Yearly test result</option>
                    <option value="Final test">SMS for Final test result</option>
                    <option value="Assesment Objective">SMS for Assesment test Objective result</option>
                    <option value="Objective test">SMS for Objective test result</option>
            </select>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block mb-2">Submit Excel</button>
        </div>
    </div>
</form>
@endsection

@section('page_js')
    <script>
        $("#div_sms_for").hide();
        function get_sms_type(course){
            if(course == "FOUNDATION"){
                $("#div_sms_for").show();
            }
            else{
                $("#div_sms_for").hide();
            }
        }
    </script>`
@endsection