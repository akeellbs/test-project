<?php

namespace App\Cases;

use Closure;

class CaseAuthentication
{
    public function handle($request, Closure $next){

        if (request()->route()->uri ==='login'){

            if ($request->session()->get('username')!=null && !empty($request->session()->get('username'))){

                if (request()->route()->uri ==='login' || request()->route()->uri ==='/'){

                    return redirect('/dashboard');

                }

                return $next($request);


            }

            else{

                return $next($request);

            }

        }

        else{

            if ($request->session()->get('username')!=null && !empty($request->session()->get('username'))){

                if (request()->route()->uri ==='login' || request()->route()->uri ==='/'){

                    return redirect('/dashboard');

                }

                return $next($request);


            }

            else{

                return redirect('login');

            }

        }






    }

}
