<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{

    public function set_login_action(Request $request){

        $request->validate([
            'username' => 'required | email',
            'password' => 'required '
        ]);

        $results = DB::connection('mysql')->select('Select * from tbl_user where username = ? AND userpass =?', [$request->post('username'), $request->post('password')]);

        if ($results!=null && count($results)>0){

            foreach($results as $rows):

                $request->session()->put('id_user', $rows->id_user);
                $request->session()->put('username', $rows->username);
                $request->session()->put('user_fname', $rows->user_fname);
                $request->session()->put('user_lname', $rows->user_lname);

            endforeach;

            $request->session()->flash('success', 'Login Successful');

            return redirect('dashboard');

        }
        else{

            $request->session()->flash('error', 'Either username or password is not correct');

            return redirect('login');

        }



    }

    public function set_Login_View(Request $request){

        return view('auth/login');

    }

    public function log_out(Request $request){

        $request->session()->flush();
        return redirect(url('/login'));

    }

    public function local_Render(){
        echo request()->route()->uri;
    }


}
