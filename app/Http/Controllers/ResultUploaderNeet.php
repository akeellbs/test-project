<?php


namespace App\Http\Controllers;


use App\Utils\AppLogicsUtils;
use App\Utils\MainsDataLogics;
use App\Utils\NeetDataLogics;
use App\Utils\MyAppConstants;
use App\Utils\SecondaryDBControls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResultUploaderNeet extends Controller
{

    public function upload_result_excel(Request $request){
        ini_set('memory_limit', '-1');
        dd($request->id);
        switch ($request->id){

            case 1:

                // echo "Case 1";
                
                NeetDataLogics::complete_data_entry($request);
                return redirect(url('/result-display'));



            

            case 2:

                if ($request->post('is_checked')==="yes"){


                    MainsDataLogics::optional_data_entry($request);
                    return redirect(url('/result-display'));

                }
                else{

                    MainsDataLogics::complete_data_entry($request);
                    return redirect(url('/result-display'));
                }


            case 3:

                echo "Case 3";

                break;

        }


    }


    public function upload_result_excel_view(Request $request){

        $results = DB::select("SELECT MAX(tbl_test.id_test) AS 'ID' FROM tbl_test");

        $test_id = 1;

        if ($results!=null && count($results)>0){

            foreach ($results as $rows){

                $test_id = $rows->ID+1;

            }

        }

        switch ($request->id){

            case 1:

                $data = array(
                    'title' => "NEET Result File Uploader",
                    'test_id' => SecondaryDBControls::return_max_test_id(),

                );

                return view('exam-controller/neet_result_file_uploader')->with($data);

            case 2:

                $data = array(
                    'title' => "Mains Result File Uploader",
                    'test_id' => SecondaryDBControls::return_max_test_id(),
                );

                return view('exam-controller/mains_result_file_uploader')->with($data);

            case 3:

                $data = array(
                    'title' => "Advance Result File Uploader",
                    'test_id' => SecondaryDBControls::return_max_test_id(),
                );

                return view('exam-controller/adv_result_file_uploader')->with($data);

        }

    }

    public function display_result_view_from_menu(Request $request){

        $request->session()->put('test_id', $request->post('test_id'));
        $request->session()->put('is_optional', $request->post('is_optional'));
        $request->session()->put('ai_rank', $request->post('ai_rank'));
        $request->session()->put('testname', strtoupper($request->post('test_name')));


    }



    public function display_result_view(Request $request){

        $users = DB::table('tbl_omr_data')->where('id_test', $request->session()->get('test_id'))->get();

        $total_gained_marks = 0;
        $total_gained_marks_phy = 0;
        $total_gained_marks_maths = 0;
        $total_gained_marks_chem = 0;
        $total_gained_marks_bio = 0;

        $is_optional = $request->session()->get('is_optional');

        $i = 0;

        $data = array();

        $total_students = count($users);

        foreach ($users as $user){

            $roll_no  = $user->roll_no_omr_data;
            $mm_total = $user->max_marks_omr_data;
            $tm_total  = $user->total_marks_omr_data;
            $percent_total = number_format((float)(($tm_total/$mm_total)*100), 2, '.', '');
			$starperformer = number_format((float)(($tm_total/$mm_total)*100), 2, '.', '');
            $sortedArray = json_decode($user->response_omr_data, true);



            // $maths_total =$this->getTotalMarksForSubject($sortedArray, 'MATHS', true, $is_optional);
            $phy_total =$this->getTotalMarksForSubject($sortedArray, 'PHYSICS', true, $is_optional);
            $chem_total =$this->getTotalMarksForSubject($sortedArray, 'CHEMISTRY', true, $is_optional);
            $bio_total = $this->getTotalMarksForSubject($sortedArray, 'BIO', true, $is_optional);

            // $maths_obt =$this->getTotalMarksForSubject($sortedArray, 'MATHS');
            $phy_obt =$this->getTotalMarksForSubject($sortedArray, 'PHYSICS');
            $chem_obt =$this->getTotalMarksForSubject($sortedArray, 'CHEMISTRY');
            $bio_obt =$this->getTotalMarksForSubject($sortedArray, 'BIO');

            $total_gained_marks = $total_gained_marks+$tm_total;
            $total_gained_marks_phy = $total_gained_marks_phy+$phy_obt;
            $total_gained_marks_bio = $total_gained_marks_bio+$bio_obt;
            $total_gained_marks_chem = $total_gained_marks_chem+$chem_obt;
            $i++;

                array_push($data, array(
                    'Roll' => $roll_no,
                    'MaxMarks' => $mm_total,
                    'TotalMarks' => $tm_total,
                    'BioTotal' => $bio_total,
                    'PhysicsTotal' => $phy_total,
                    'ChemistryTotal' => $chem_total,
                    'BioObt' => $bio_obt,
                    'PhysicsObt' => $phy_obt,
                    'ChemistryObt' => $chem_obt,
                ));

            $test_date_query = DB::table('tbl_test')->where('id_test', $request->session()->get('test_id'))->first();


            $paper_id = DB::table('tbl_sprresult')->insertGetId([
                'rollno' => $roll_no,
                'testid' => $request->session()->get('test_id'),
                'overallmarks' => $tm_total,
                'overallmaxmarks' => $mm_total,
                'overallpercent' => $percent_total,
				'starperformer' => $starperformer,
                'biomaxmarks' => $bio_total,
                'phymaxmarks' => $phy_total,
                'chemmaxmarks' => $chem_total,
                'biomarks' => $bio_obt,
                'phymarks' => $phy_obt,
                'chemmarks' => $chem_obt,
                'studentsappeared' => $total_students,
                'testname'=>$request->session()->get('testname'),
                'biopercent' => number_format((float)(($bio_obt/$bio_total)*100), 2, '.', ''),
                'phypercent' => number_format((float)(($phy_obt/$phy_total)*100), 2, '.', ''),
                'chempercent' => number_format((float)(($chem_obt/$chem_total)*100), 2, '.', ''),
                'uploadingdate'=>Now(),
                'testdate' =>$test_date_query->test_date
            ]);

        }

        $avg_total_marks = number_format((float)($total_gained_marks/$i), 2, '.', '');
        $avg_total_marks_phy = number_format((float)($total_gained_marks_phy/$i), 2, '.', '');
        $avg_total_marks_chem = number_format((float)($total_gained_marks_chem/$i), 2, '.', '');
        $avg_total_marks_bio = number_format((float)($total_gained_marks_bio/$i), 2, '.', '');


        $affected = DB::table('tbl_sprresult')
            ->where('testid', $request->session()->get("test_id"))
            ->update(
                    ['phyaverage' => $avg_total_marks_phy ,
                    'chemaverage' => $avg_total_marks_chem,
                    'bioaverage' => $avg_total_marks_bio,
                    'overallaverage' => $avg_total_marks]
            );

        $max_total       = 0;
        $max_total_phy   = 0;
        $max_total_chem  = 0;
        $max_total_maths = 0;
        $max_total_bio = 0;


        $min_total       = 0;
        $min_total_phy   = 0;
        $min_total_chem  = 0;
        $min_total_maths = 0;
        $min_total_bio = 0;
        

        $max_total_query = DB::select("SELECT MAX(overallmarks) AS 'MAXMARKS', MAX(phymarks) AS 'MAXMARKSPHY', MAX(chemmarks) AS 'MAXMARKSCHEM', MAX(biomarks) AS 'BIOMARKSMATHS', MIN(overallmarks) AS 'MINMARKS', MIN(phymarks) AS 'MINMARKSPHY', MIN(chemmarks) AS 'MINMARKSCHEM', MIN(biomarks) AS 'MINMARKSBIO' FROM tbl_sprresult where testid ='".$request->session()->get('test_id')."'");

        foreach ($max_total_query as $total){

            $max_total       = $total->MAXMARKS;
            $max_total_phy   = $total->MAXMARKSPHY;
            $max_total_chem  = $total->MAXMARKSCHEM;
            // $max_total_maths   = $total->MAXMARKSMATHS;
            $max_total_bio   = $total->BIOMARKSMATHS;

            $min_total       = $total->MINMARKS;
            $min_total_phy   = $total->MINMARKSPHY;
            $min_total_chem  = $total->MINMARKSCHEM;
            // $min_total_maths  = $total->MINMARKSMATHS;
            $min_total_bio  = $total->MINMARKSBIO;


        }
        $affected = DB::table('tbl_sprresult')
            ->where('testid', $request->session()->get("test_id"))
            ->update(
                   ['phyhighest' => $max_total_phy ,
                    'chemhighest' => $max_total_chem,
                    'mathshighest' => $max_total_maths,
                    'overallhighest' => $max_total,
                       'phylowest' => $min_total_phy ,
                       'chemlowest' => $min_total_chem,
                       'mathslowest' => $min_total_maths,
                       'biolowest' => $min_total_bio,
                       'overalllowest' => $min_total]
            );


        $rank_query_total = DB::select("select * from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."' order by overallmarks DESC");

        $rank = 0;

        $students_no = count($rank_query_total);

        foreach ($rank_query_total as $rank_total){

            $rank ++;
            //$ai_rank = $request->session()->get('ai_rank') + $rank;
            $ai_rank = 1+(($rank-1)*(($request->session()->get('ai_rank') + ($students_no-1))/($students_no-1)));
            //print_r($ai_rank);
            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->session()->get("test_id")],
                    ['rollno', $rank_total->rollno]
                ])
                ->update(
                    [
                        'overallrank' => $ai_rank,
                        'overallcrank' => $rank
                    ]
                );


        }

        $rank_query_m = DB::select("select * from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."' order by mathsmarks DESC");

        $rank_m = 0;
        foreach ($rank_query_m as $rank_total){

            $rank_m ++;
            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->session()->get("test_id")],
                    ['rollno', $rank_total->rollno]
                ])
                ->update(
                    ['mathsrank' => $rank_m]
                );


        }

        $rank_query_p = DB::select("select * from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."' order by phymarks DESC");

        $rank_p = 0;
        foreach ($rank_query_p as $rank_total){

            $rank_p ++;
            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->session()->get("test_id")],
                    ['rollno', $rank_total->rollno]
                ])
                ->update(
                    ['phyrank' => $rank_p]
                );


        }

        $rank_query_c = DB::select("select * from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."' order by chemmarks DESC");

        $rank_c = 0;
        foreach ($rank_query_c as $rank_total){

            $rank_c ++;
            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->session()->get("test_id")],
                    ['rollno', $rank_total->rollno]
                ])
                ->update(
                    ['chemrank' => $rank_c]
                );


        }

        $rank_query_b = DB::select("select * from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."' order by biomarks DESC");

        $rank_b = 0;
        foreach ($rank_query_b as $rank_total){

            $rank_c ++;
            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->session()->get("test_id")],
                    ['rollno', $rank_total->rollno]
                ])
                ->update(
                    ['biorank' => $rank_b]
                );


        }


        $res_total = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))->get();

        $final = json_encode($res_total);

        $rest_r = array(
            'title' => "Result Display",
            'data' => json_decode($final, true)
            'subject' => 'Hey'
        );

        return view('result_display_neet')->with($rest_r);

    }

    function getTotalMarksForSubject($arr=array(), $subject, $is_total=false, $is_optional="No"): int
    {

        $return_marks = 0;
    
        foreach ($arr as $cal_arr){
            
            if (strtoupper($cal_arr['SUBJECT']) == $subject){
                
                if ($is_total){

                    if ($is_optional === "Yes"){

                        $return_marks = 100;

                    }
                    else{
                        $return_marks = $return_marks + $cal_arr['POSITIVE_MARKS'];
                        
                    }

                }
                else{
                    $return_marks = $return_marks + $cal_arr['MARKS_OBTAINED'];
                    
                }

            }

        }

        return $return_marks;

    }


}
