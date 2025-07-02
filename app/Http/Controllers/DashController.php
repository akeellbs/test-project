<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class DashController extends Controller
{
    public function show_dashboard(Request $request){

        $data = array(
            'title' => "Dashboard",

        );


        return view('exam-controller/dashboard')->with($data);

    }

}
