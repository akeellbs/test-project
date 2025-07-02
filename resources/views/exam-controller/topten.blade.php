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
<form action="{{url('top10/')}}" method="POST" enctype="multipart/form-data">
@csrf

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <label for="exampleFormControlInput1">Test ID</label>
            <input type="text" class="form-control" id="test_id" name="test_id" value="">
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <label for="exampleFormControlInput1">Test Pattern</label>
                <select class="form-control  basic" id="test_quiz_type" name="test_quiz_type">
                    <option selected="selected" value="AIEEE">AIEEE</option>
                    <option value="NEET">NEET</option>
                    <option value="COMBINED">Advance Combine</option>
            </select>
        </div>
    </div>
	
	    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block mb-2">Click Here</button>
        </div>
    </div>
</form>
@endsection 