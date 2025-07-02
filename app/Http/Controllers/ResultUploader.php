<?php


namespace App\Http\Controllers;


use App\Utils\AppLogicsUtils;
use App\Utils\MainsDataLogics;
use App\Utils\NeetDataLogics;
use App\Utils\AdvanceDataLogics;
use App\Utils\MyAppConstants;
use App\Utils\NeetNewDataLogics;
use App\Utils\SecondaryDBControls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResultUploader extends Controller
{

    public function upload_result_excel(Request $request){
        ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
		
		// dd();

        switch ($request->id){

            case 1:

                // echo "Case 1";

                NeetDataLogics::complete_data_entry($request);
                // return redirect(url('/view-csv'));
                return redirect(url('/result-display/1'));





            case 2:

                if ($request->post('is_checked')==="yes"){


                    MainsDataLogics::optional_data_entry($request);
                    return redirect(url('/result-display/2'));

                }
                else{

                    MainsDataLogics::complete_data_entry($request);
                    return redirect(url('/result-display/2'));
                }


            case 3:

                AdvanceDataLogics::complete_data_entry($request);
                return redirect(url('/result-display/3'));

                break;

            case 4:

                NeetNewDataLogics::complete_data_entry($request);
                //echo "uload";
                return redirect(url('/result-display/4'));

                break;

        }


    }


    public function upload_result_excel_view(Request $request){
		 ini_set('memory_limit', '-1');
		 ini_set('max_execution_time', 0);

        $results = DB::select("SELECT MAX(tbl_test.id_test) AS 'ID' FROM tbl_test");
        // dd($results);
        $test_id = 1;

        if ($results!=null && count($results)>0){

            foreach ($results as $rows){

                $test_id = $rows->ID+1;

            }

        }

        switch ($request->id){

            case 1:

                $data = array(
                    'title' => "Neet Old Result File Uploader",
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

            case 4:

                $data = array(
                    'title' => "Neet new Result File Uploader",
                    'test_id' => SecondaryDBControls::return_max_test_id(),
                );

                return view('exam-controller/neet_new')->with($data);

        }

    }

    public function display_result_view_from_menu(Request $request){
	     ini_set('memory_limit', '-1');
		 ini_set('max_execution_time', 0);
	

        $request->session()->put('test_id', $request->post('test_id'));
        $request->session()->put('is_optional', $request->post('is_optional'));
        $request->session()->put('ai_rank', $request->post('ai_rank'));
        $request->session()->put('testname', strtoupper($request->post('test_name')));
		$request->session()->put('test_class', $request->post('test_class'));
		$request->session()->put('paper_type', $request->post('paper_type'));


    }



    public function display_result_view(Request $request){
		
		//dd($request->id);

        switch ($request->id){
            case 2:
                // dd($request->session()->get('test_id'));
                $var = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))->get();
				
				//define variables 
                // $obt_marks = 0;
                // $total_marks = 0;
                $n = 0.35;

                if ($var->count() === 0){

                    $users = DB::table('tbl_omr_data')->where('id_test', $request->session()->get('test_id'))->get();
                    $total_gained_marks = 0;
                    $total_gained_marks_phy = 0;
                    $total_gained_marks_maths = 0;
                    $total_gained_marks_chem = 0;

                    $is_optional = $request->session()->get('is_optional');

                    $i = 0;

                    $data = array();
                    $subject = array();

                    $total_students = count($users);

                    foreach ($users as $user){

                        $roll_no  = $user->roll_no_omr_data;
                        $mm_total = $user->max_marks_omr_data;
                        $tm_total  = $user->total_marks_omr_data;
                        $percent_total = number_format((float)(($tm_total/$mm_total)*100), 2, '.', '');
                        $starperformer = number_format((float)(($tm_total/$mm_total)*100), 2, '.', '');
                        $sortedArray = json_decode($user->response_omr_data, true);

						$obt_marks = $tm_total;
						$total_marks = $mm_total;
						
						
						
						//echo $obt_marks;
						//echo $total_marks;
						
						//dd(round($ai_rank));


                        $maths_total =$this->getTotalMarksForSubject($sortedArray, 'MATHS', true, $is_optional);
                        $phy_total =$this->getTotalMarksForSubject($sortedArray, 'PHYSICS', true, $is_optional);
                        $chem_total =$this->getTotalMarksForSubject($sortedArray, 'CHEMISTRY', true, $is_optional);

                        $maths_obt =$this->getTotalMarksForSubject($sortedArray, 'MATHS');
                        $phy_obt =$this->getTotalMarksForSubject($sortedArray, 'PHYSICS');
                        $chem_obt =$this->getTotalMarksForSubject($sortedArray, 'CHEMISTRY');

                        $total_gained_marks = $total_gained_marks+$tm_total;
                        $total_gained_marks_phy = $total_gained_marks_phy+$phy_obt;
                        $total_gained_marks_maths = $total_gained_marks_maths+$maths_obt;
                        $total_gained_marks_chem = $total_gained_marks_chem+$chem_obt;
                        $i++;

                            array_push($data, array(
                                'Roll' => $roll_no,
                                'MaxMarks' => $mm_total,
                                'TotalMarks' => $tm_total,
                                'MathsTotal' => $maths_total,
                                'PhysicsTotal' => $phy_total,
                                'ChemistryTotal' => $chem_total,
                                'MathsObt' => $maths_obt,
                                'PhysicsObt' => $phy_obt,
                                'ChemistryObt' => $chem_obt,
                            ));

                        $test_date_query = DB::table('tbl_test')->where('id_test', $request->session()->get('test_id'))->first();

                            //  dd($phy_total, $maths_total);
                        $paper_id = DB::table('tbl_sprresult')->insertGetId([
                            'rollno' => $roll_no,
                            'testid' => $request->session()->get('test_id'),
                            'overallmarks' => $tm_total,
                            'stream' => "AIEEE",
            				'type' => "AIEEE",
                            'mode' => "OMR",
                            'course' => $request->session()->get('test_class'),
                            'testtype' => 'Combined',
                            'overallmaxmarks' => $mm_total,
                            'overallpercent' => $percent_total,
                            'mathsmaxmarks' => $maths_total,
                            'phymaxmarks' => $phy_total,
                            'chemmaxmarks' => $chem_total,
                            'mathsmarks' => $maths_obt,
                            'phymarks' => $phy_obt,
                            'chemmarks' => $chem_obt,
                            'studentsappeared' => $total_students,
                            'testname'=>$request->session()->get('testname'),
                            'class' => $request->session()->get('test_class'),
                            'starperformer' => $starperformer,
                            'mathspercent' => number_format((float)(($maths_obt/$maths_total)*100), 2, '.', ''),
                            'phypercent' => number_format((float)(($phy_obt/$phy_total)*100), 2, '.', ''),
                            'chempercent' => number_format((float)(($chem_obt/$chem_total)*100), 2, '.', ''),
                            'uploadingdate'=>Now(),
                            'testdate' =>$test_date_query->test_date
                        ]);

                    }

                    $avg_total_marks = number_format((float)($total_gained_marks/$i), 2, '.', '');
                    $avg_total_marks_phy = number_format((float)($total_gained_marks_phy/$i), 2, '.', '');
                    $avg_total_marks_chem = number_format((float)($total_gained_marks_chem/$i), 2, '.', '');
                    $avg_total_marks_maths = number_format((float)($total_gained_marks_maths/$i), 2, '.', '');


                    $affected = DB::table('tbl_sprresult')->where('testid', $request->session()->get("test_id"))->update(
                                ['phyaverage' => $avg_total_marks_phy ,
                                'chemaverage' => $avg_total_marks_chem,
                                'mathsaverage' => $avg_total_marks_maths,
                                'overallaverage' => $avg_total_marks]
                        );

                    $max_total       = 0;
                    $max_total_phy   = 0;
                    $max_total_chem  = 0;
                    $max_total_maths = 0;

                    $min_total       = 0;
                    $min_total_phy   = 0;
                    $min_total_chem  = 0;
                    $min_total_maths = 0;


                    $max_total_query = DB::select("SELECT MAX(overallmarks) AS 'MAXMARKS', MAX(phymarks) AS 'MAXMARKSPHY', MAX(chemmarks) AS 'MAXMARKSCHEM', MAX(mathsmarks) AS 'MAXMARKSMATHS', MIN(overallmarks) AS 'MINMARKS', MIN(phymarks) AS 'MINMARKSPHY', MIN(chemmarks) AS 'MINMARKSCHEM', MIN(mathsmarks) AS 'MINMARKSMATHS' FROM tbl_sprresult where testid ='".$request->session()->get('test_id')."'");

                    foreach ($max_total_query as $total){

                        $max_total       = $total->MAXMARKS;
                        $max_total_phy   = $total->MAXMARKSPHY;
                        $max_total_chem  = $total->MAXMARKSCHEM;
                        $max_total_maths   = $total->MAXMARKSMATHS;

                        $min_total       = $total->MINMARKS;
                        $min_total_phy   = $total->MINMARKSPHY;
                        $min_total_chem  = $total->MINMARKSCHEM;
                        $min_total_maths  = $total->MINMARKSMATHS;


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
                                   'overalllowest' => $min_total]
                        );


                    $rank_query_total = DB::select("select *,RANK() OVER(ORDER BY overallmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");// order by overallmarks DESC

                    $rank = 0;

                    $students_no = count($rank_query_total);

                    foreach ($rank_query_total as $rank_total){

                        $rank ++;
						$obt_marks = $rank_total->overallmarks;
						$total_marks = $rank_total->overallmaxmarks;
                       //  $ai_rank = $request->session()->get('ai_rank') + $rank;
                        ///$ai_rank = 1+((($rank_total->Rank)-1)*(($request->session()->get('ai_rank') + ($students_no-1))/($students_no-1)));
						$ai_rank = 1 + ((0.5/(1-$n)) * (1 - ($obt_marks/$total_marks)) * 5000);
                        // $ai_rank_1 = (($request->session()->get('ai_rank') + ($students_no-1))/($students_no-1));
                        // $ai_rank_2 = (($rank-1) * $ai_rank_1) + 1;
						// echo $obt_marks."/".$total_marks;
                        // echo "{".$rank_total->rollno."-".$ai_rank."}";
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                [
                                    'overallrank' => $ai_rank,
                                    'overallcrank' => $rank_total->Rank
                                ]
                            );


                    }
					
					// die;


                    $rank_query_m = DB::select("select rollno,RANK() OVER(ORDER BY mathsmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_m = 0;
                    foreach ($rank_query_m as $rank_total){

                        $rank_m ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['mathsrank' => $rank_total->Rank]
                            );


                    }

                    $rank_query_p = DB::select("select rollno,RANK() OVER(ORDER BY phymarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_p = 0;
                    foreach ($rank_query_p as $rank_total){

                        $rank_p ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['phyrank' => $rank_total->Rank]
                            );


                    }

                    $rank_query_c = DB::select("select rollno,RANK() OVER(ORDER BY chemmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_c = 0;
                    foreach ($rank_query_c as $rank_total){

                        $rank_c ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['chemrank' => $rank_total->Rank]
                            );


                    }
                }

                $res_total = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))->get();

                $final = json_encode($res_total);

                $rest_r = array(
                    'title' => $res_total[0]->testid,
                    'data' => json_decode($final, true),
                    'columns' => array("Roll No", "MaxMarks", "TotalMarks", "MathsTotal", "PhyTotal", "ChemTotal",
                                    "MathsObt", "PhyObt", "ChemObt", "T%", "M%", "P%", "C%",
                                    "AIR", "ClassRank", "MathsRank", "PhyRank", "ChemRank"
                                    ),

                    'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "mathsmaxmarks", "phymaxmarks", "chemmaxmarks",
                                    "mathsmarks", "phymarks", "chemmarks", "overallpercent", "mathspercent", "phypercent", "chempercent",
                                    "overallrank", "overallcrank", "mathsrank", "phyrank", "chemrank"
                    )
                );

                return view('result_display')->with($rest_r);
                break;
            case 1:

				$n = 0.2;
                $var = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))->get();

                if ($var->count() === 0){

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
                            'stream' => "NEET",
            				'type' => "NEET",
                            'mode' => "OMR",
                            'course' => $request->session()->get('test_class'),

                            'testtype' => 'Combined',

                            'overallmarks' => $tm_total,
                            'overallmaxmarks' => $mm_total,
                            'overallpercent' => $percent_total,
                            'biomaxmarks' => $bio_total,
                            'phymaxmarks' => $phy_total,
                            'chemmaxmarks' => $chem_total,
                            'biomarks' => $bio_obt,
                            'phymarks' => $phy_obt,
                            'chemmarks' => $chem_obt,
                            'studentsappeared' => $total_students,
                            'testname'=>$request->session()->get('testname'),
                            'class'=>$request->session()->get('test_class'),
							'starperformer' => $starperformer,
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
                        $max_total_bio   = 0;


                        $min_total       = 0;
                        $min_total_phy   = 0;
                        $min_total_chem  = 0;
                        $min_total_maths = 0;
                        $min_total_bio   = 0;


                        $max_total_query = DB::select("SELECT MAX(overallmarks) AS 'MAXMARKS', MAX(phymarks) AS 'MAXMARKSPHY', MAX(chemmarks) AS 'MAXMARKSCHEM', MAX(biomarks) AS 'MAXMARKSKBIO', MIN(overallmarks) AS 'MINMARKS', MIN(phymarks) AS 'MINMARKSPHY', MIN(chemmarks) AS 'MINMARKSCHEM', MIN(biomarks) AS 'MINMARKSBIO' FROM tbl_sprresult where testid ='".$request->session()->get('test_id')."'");

                    foreach ($max_total_query as $total){

                        $max_total       = $total->MAXMARKS;
                        $max_total_phy   = $total->MAXMARKSPHY;
                        $max_total_chem  = $total->MAXMARKSCHEM;
                        // $max_total_maths   = $total->MAXMARKSMATHS;
                       $max_total_bio   = $total->MAXMARKSKBIO;
                        //$max_total_bio   = 1000;

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
                                'biohighest' => $max_total_bio,
                                'overallhighest' => $max_total,
                                   'phylowest' => $min_total_phy ,
                                   'chemlowest' => $min_total_chem,
                                   'biolowest' => $min_total_bio,
                                   'overalllowest' => $min_total]
                        );


                    $rank_query_total = DB::select("select *,RANK() OVER(ORDER BY overallmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'"); // order by overallmarks DESC

                    $rank = 0;

                    $students_no = count($rank_query_total);

                    foreach ($rank_query_total as $rank_total){

                        $rank ++;
                       //  $ai_rank = $request->session()->get('ai_rank') + $rank;
                        $obt_marks = $rank_total->overallmarks;
						$total_marks = $rank_total->overallmaxmarks;
                       //  $ai_rank = $request->session()->get('ai_rank') + $rank;
                        ///$ai_rank = 1+((($rank_total->Rank)-1)*(($request->session()->get('ai_rank') + ($students_no-1))/($students_no-1)));
						$ai_rank = 1 + ((0.5/(1-$n)) * (1 - ($obt_marks/$total_marks)) * 5000);

                        // $ai_rank_1 = (($request->session()->get('ai_rank') + ($students_no-1))/($students_no-1));
                        // $ai_rank_2 = (($rank-1) * $ai_rank_1) + 1;

                        // print_r($ai_rank_2);
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                [
                                    'overallrank' => $ai_rank,
                                    'overallcrank' => $rank_total->Rank
                                ]
                            );


                    }

                    // $rank_query_m = DB::select("select * from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."' order by mathsmarks DESC");

                    // $rank_m = 0;
                    // foreach ($rank_query_m as $rank_total){

                    //     $rank_m ++;
                    //     $affected = DB::table('tbl_sprresult')
                    //         ->where([
                    //             ['testid', $request->session()->get("test_id")],
                    //             ['rollno', $rank_total->rollno]
                    //         ])
                    //         ->update(
                    //             ['mathsrank' => $rank_m]
                    //         );


                    // }

                    $rank_query_p = DB::select("select rollno,RANK() OVER(ORDER BY phymarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");
                    // dd($rank_query_p);
                    $rank_p = 0;
                    foreach ($rank_query_p as $rank_total){

                        $rank_p ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['phyrank' => $rank_total->Rank]
                            );
                    }

                    $rank_query_c = DB::select("select rollno,RANK() OVER(ORDER BY chemmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_c = 0;
                    foreach ($rank_query_c as $rank_total){

                        $rank_c ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['chemrank' => $rank_total->Rank]
                            );
                    }

                    $rank_query_b = DB::select("select rollno,RANK() OVER(ORDER BY biomarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_b = 0;
                    foreach ($rank_query_b as $rank_total){

                        $rank_b ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['biorank' => $rank_total->Rank]
                            );
                    }
                } // if stataemanet for var count

                $res_total = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))->get();
                // dd($res_total);
                $final = json_encode($res_total);

                $rest_r = array(
                    'title' => $res_total[0]->testid,
                    'data' => json_decode($final, true),
                    'columns' => array("Roll No", "MaxMarks", "TotalMarks", "BioTotal", "PhyTotal", "ChemTotal",
                                    "BioObt", "PhyObt", "ChemObt", "T%", "B%", "P%", "C%",
                                    "AIR", "ClassRank", "BioRank", "PhyRank", "ChemRank"
                                    ),

                    'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "biomaxmarks", "phymaxmarks", "chemmaxmarks", "biomarks",
                                    "phymarks", "chemmarks", "overallpercent", "biopercent", "phypercent", "chempercent",
                                    "overallrank", "overallcrank", "biorank", "phyrank", "chemrank"
                    )
                );

                return view('result_display')->with($rest_r);
                break;
    		case 3:
                // dd($request->session()->get('test_id'));
                // JEE ADVANCE:
				$n = 0.35;
                $var = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))->get();

                if ($var->count() === 0){
            		// dd($request->session()->all());
                    $users = DB::table('tbl_omr_data')->where('id_test', $request->session()->get('test_id'))->get();
                    $total_gained_marks = 0;
                    $total_gained_marks_phy = 0;
                    $total_gained_marks_maths = 0;
                    $total_gained_marks_chem = 0;

                    $is_optional = $request->session()->get('is_optional');

                    $i = 0;

                    $data = array();
                    $subject = array();

                    $total_students = count($users);
                    foreach ($users as $user){

                        $roll_no  = $user->roll_no_omr_data;
                        $mm_total = $user->max_marks_omr_data;
                        $tm_total  = $user->total_marks_omr_data;
                        $percent_total = number_format((float)(($tm_total/$mm_total)*100), 2, '.', '');
						$starperformer = number_format((float)(($tm_total/$mm_total)*100), 2, '.', '');
                        $sortedArray = json_decode($user->response_omr_data, true);



                        $maths_total =$this->getTotalMarksForSubject($sortedArray, 'MATHS', true, $is_optional);
                        $phy_total =$this->getTotalMarksForSubject($sortedArray, 'PHYSICS', true, $is_optional);
                        $chem_total =$this->getTotalMarksForSubject($sortedArray, 'CHEMISTRY', true, $is_optional);

                        $maths_obt =$this->getTotalMarksForSubject($sortedArray, 'MATHS');
                        $phy_obt =$this->getTotalMarksForSubject($sortedArray, 'PHYSICS');
                        $chem_obt =$this->getTotalMarksForSubject($sortedArray, 'CHEMISTRY');

                        $total_gained_marks = $total_gained_marks+$tm_total;
                        $total_gained_marks_phy = $total_gained_marks_phy+$phy_obt;
                        $total_gained_marks_maths = $total_gained_marks_maths+$maths_obt;
                        $total_gained_marks_chem = $total_gained_marks_chem+$chem_obt;
                        $i++;

                            array_push($data, array(
                                'Roll' => $roll_no,
                                'MaxMarks' => $mm_total,
                                'TotalMarks' => $tm_total,
                                'MathsTotal' => $maths_total,
                                'PhysicsTotal' => $phy_total,
                                'ChemistryTotal' => $chem_total,
                                'MathsObt' => $maths_obt,
                                'PhysicsObt' => $phy_obt,
                                'ChemistryObt' => $chem_obt,
                            ));

                        $test_date_query = DB::table('tbl_test')->where('id_test', $request->session()->get('test_id'))->first();

                        // dd($request->session()->get('paper_type'), $request->session()->get('test_class'));
                        $paper_id = DB::table('tbl_sprresult')->insertGetId([
                            'rollno' => $roll_no,
                            'testid' => $request->session()->get('test_id'),
                            'overallmarks' => $tm_total,
                            'stream' => "IIT",
                            'type' => "IIT",
                            'course' => 'JEE(M + A)',
                            'mode' => "OMR",
                            'paper' => $request->session()->get('paper_type'),
                            'overallmaxmarks' => $mm_total,
                            'overallpercent' => $percent_total,
                            'mathsmaxmarks' => $maths_total,
                            'phymaxmarks' => $phy_total,
                            'chemmaxmarks' => $chem_total,
                            'mathsmarks' => $maths_obt,
                            'phymarks' => $phy_obt,
                            'chemmarks' => $chem_obt,
                            'testtype' => 'Combined',

                            'class' => $request->session()->get('test_class'),
							'starperformer' => $starperformer,
                            'studentsappeared' => $total_students,
                            'testname'=>$request->session()->get('testname'),
                            'mathspercent' => (($maths_obt>0 && $maths_obt != "" && $maths_total>0 && $maths_total != "") ? number_format((float)(($maths_obt/$maths_total)*100), 2, '.', '') : 0),
                            'phypercent' => (($phy_obt>0 && $phy_obt != "" && $phy_total>0 && $phy_total != "") ? number_format((float)(($phy_obt/$phy_total)*100), 2, '.', '') : 0),
                            'chempercent' => (($chem_obt>0 && $chem_obt != "" && $chem_total>0 && $chem_total != "") ? number_format((float)(($chem_obt/$chem_total)*100), 2, '.', '') : 0),
                            'uploadingdate'=>Now(),
                            'testdate' =>$test_date_query->test_date
                        ]);



                    }

                    $avg_total_marks = number_format((float)($total_gained_marks/$i), 2, '.', '');
                    $avg_total_marks_phy = number_format((float)($total_gained_marks_phy/$i), 2, '.', '');
                    $avg_total_marks_chem = number_format((float)($total_gained_marks_chem/$i), 2, '.', '');
                    $avg_total_marks_maths = number_format((float)($total_gained_marks_maths/$i), 2, '.', '');


                    $affected = DB::table('tbl_sprresult')
                        ->where('testid', $request->session()->get("test_id"))
                        ->update(
                                ['phyaverage' => $avg_total_marks_phy ,
                                'chemaverage' => $avg_total_marks_chem,
                                'mathsaverage' => $avg_total_marks_maths,
                                'overallaverage' => $avg_total_marks]
                        );

                    $max_total       = 0;
                    $max_total_phy   = 0;
                    $max_total_chem  = 0;
                    $max_total_maths = 0;

                    $min_total       = 0;
                    $min_total_phy   = 0;
                    $min_total_chem  = 0;
                    $min_total_maths = 0;


                    $max_total_query = DB::select("SELECT MAX(overallmarks) AS 'MAXMARKS', MAX(phymarks) AS 'MAXMARKSPHY', MAX(chemmarks) AS 'MAXMARKSCHEM', MAX(mathsmarks) AS 'MAXMARKSMATHS', MIN(overallmarks) AS 'MINMARKS', MIN(phymarks) AS 'MINMARKSPHY', MIN(chemmarks) AS 'MINMARKSCHEM', MIN(mathsmarks) AS 'MINMARKSMATHS' FROM tbl_sprresult where testid ='".$request->session()->get('test_id')."'");

                    foreach ($max_total_query as $total){

                        $max_total       = $total->MAXMARKS;
                        $max_total_phy   = $total->MAXMARKSPHY;
                        $max_total_chem  = $total->MAXMARKSCHEM;
                        $max_total_maths   = $total->MAXMARKSMATHS;

                        $min_total       = $total->MINMARKS;
                        $min_total_phy   = $total->MINMARKSPHY;
                        $min_total_chem  = $total->MINMARKSCHEM;
                        $min_total_maths  = $total->MINMARKSMATHS;


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
                                   'overalllowest' => $min_total]
                        );


                    $rank_query_total = DB::select("select *,RANK() OVER(ORDER BY overallmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");// order by overallmarks DESC

                    $rank = 0;

                    $students_no = count($rank_query_total);

                    foreach ($rank_query_total as $rank_total){

                        $rank ++;
                       //  $ai_rank = $request->session()->get('ai_rank') + $rank;
                       $obt_marks = $rank_total->overallmarks;
						$total_marks = $rank_total->overallmaxmarks;
                       //  $ai_rank = $request->session()->get('ai_rank') + $rank;
                        ///$ai_rank = 1+((($rank_total->Rank)-1)*(($request->session()->get('ai_rank') + ($students_no-1))/($students_no-1)));
						$ai_rank = 1 + ((0.5/(1-$n)) * (1 - ($obt_marks/$total_marks)) * 5000);

                        // $ai_rank_1 = (($request->session()->get('ai_rank') + ($students_no-1))/($students_no-1));
                        // $ai_rank_2 = (($rank-1) * $ai_rank_1) + 1;

                        // print_r($ai_rank_2);
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                [
                                    'overallrank' => $ai_rank,
                                    'overallcrank' => $rank_total->Rank
                                ]
                            );


                    }


                    $rank_query_m = DB::select("select rollno,RANK() OVER(ORDER BY mathsmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_m = 0;
                    foreach ($rank_query_m as $rank_total){

                        $rank_m ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['mathsrank' => $rank_total->Rank]
                            );


                    }

                    $rank_query_p = DB::select("select rollno,RANK() OVER(ORDER BY phymarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_p = 0;
                    foreach ($rank_query_p as $rank_total){

                        $rank_p ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['phyrank' => $rank_total->Rank]
                            );


                    }

                    $rank_query_c = DB::select("select rollno,RANK() OVER(ORDER BY chemmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_c = 0;
                    foreach ($rank_query_c as $rank_total){

                        $rank_c ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['chemrank' => $rank_total->Rank]
                            );


                    }
                }

                $res_total = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))->get();

                $final = json_encode($res_total);

                $rest_r = array(
                    'title' => $res_total[0]->testid,
                    'data' => json_decode($final, true),
                    'columns' => array("Roll No", "MaxMarks", "TotalMarks", "MathsTotal", "PhyTotal", "ChemTotal",
                                    "MathsObt", "PhyObt", "ChemObt", "T%", "M%", "P%", "C%",
                                    "AIR", "ClassRank", "MathsRank", "PhyRank", "ChemRank"
                                    ),

                    'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "mathsmaxmarks", "phymaxmarks", "chemmaxmarks",
                                    "mathsmarks", "phymarks", "chemmarks", "overallpercent", "mathspercent", "phypercent", "chempercent",
                                    "overallrank", "overallcrank", "mathsrank", "phyrank", "chemrank"
                    )
                );

                return view('result_display')->with($rest_r);
                break;
            case 4 :
			
				$n = 0.2;
                $var = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))->get();

                if ($var->count() === 0){

                    $users = DB::table('tbl_omr_data')->where('id_test', $request->session()->get('test_id'))->get();

                    $total_gained_marks = 0;
                    $total_gained_marks_phy = 0;
                    $total_gained_marks_zoology = 0;
                    $total_gained_marks_chem = 0;
                    $total_gained_marks_botany = 0;

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

                        $zoology_total =180;
                        $phy_total =180;
                        $chem_total =180;
                        $botany_total = 180;



                        //  $zoology_total =$this->getTotalMarksForSubject($sortedArray, 'ZOOLOGY', true, $is_optional);
                        //  $phy_total =$this->getTotalMarksForSubject($sortedArray, 'PHYSICS', true, $is_optional);
                        //  $chem_total =$this->getTotalMarksForSubject($sortedArray, 'CHEMISTRY', true, $is_optional);
                        //  $botany_total = $this->getTotalMarksForSubject($sortedArray, 'BOTANY', true, $is_optional);

                        $zoology_obt =$this->getTotalMarksForSubject($sortedArray, 'ZOOLOGY');
                        $phy_obt =$this->getTotalMarksForSubject($sortedArray, 'PHYSICS');
                        $chem_obt =$this->getTotalMarksForSubject($sortedArray, 'CHEMISTRY');
                        $botany_obt =$this->getTotalMarksForSubject($sortedArray, 'BOTANY');

                        $total_gained_marks = $total_gained_marks+$tm_total;
                        $total_gained_marks_phy = $total_gained_marks_phy+$phy_obt;
                        $total_gained_marks_botany = $total_gained_marks_botany+$botany_obt;
                        $total_gained_marks_zoology = $total_gained_marks_chem+$zoology_obt;
                        $total_gained_marks_chem = $total_gained_marks_chem+$chem_obt;
                        $i++;

                        array_push($data, array(
                            'Roll' => $roll_no,
                            'MaxMarks' => $mm_total,
                            'TotalMarks' => $tm_total,
                            'BotanyTotal' => $botany_total,
                            'ZoologyTotal' => $zoology_total,
                            'PhysicsTotal' => $phy_total,
                            'ChemistryTotal' => $chem_total,
                            'BotanyObt' => $botany_obt,
                            'ZoologyObt' => $zoology_obt,
                            'PhysicsObt' => $phy_obt,
                            'ChemistryObt' => $chem_obt,
                        ));

                        $test_date_query = DB::table('tbl_test')->where('id_test', $request->session()->get('test_id'))->first();


                        $paper_id = DB::table('tbl_sprresult')->insertGetId([
                            'rollno' => $roll_no,
                            'testid' => $request->session()->get('test_id'),
                            'stream' => "NEET_NEW",
                            'type' => "NEET",
                            'mode' => "OMR",
                            'course' => $request->session()->get('test_class'),
                            'testtype' => 'Combined',
                            'overallmarks' => $tm_total,
                            'overallmaxmarks' => $mm_total,
                            'overallpercent' => $percent_total,
                            'botmaxmarks' => $botany_total,
                            'zoomaxmarks' => $zoology_total,
                            'phymaxmarks' => $phy_total,
                            'chemmaxmarks' => $chem_total,
                            'botmarks' => $botany_obt,
                            'zoomarks' => $zoology_obt,
                            'phymarks' => $phy_obt,
                            'chemmarks' => $chem_obt,
                            'studentsappeared' => $total_students,
                            'testname'=>$request->session()->get('testname'),
                            'class'=>$request->session()->get('test_class'),
							 'starperformer' => $starperformer,
                            'botpercent' => number_format((float)(($botany_obt/$botany_total)*100), 2, '.', ''),
                            'zoopercent' => number_format((float)(($zoology_obt/$zoology_total)*100), 2, '.', ''),
                            'phypercent' => number_format((float)(($phy_obt/$phy_total)*100), 2, '.', ''),
                            'chempercent' => number_format((float)(($chem_obt/$chem_total)*100), 2, '.', ''),
                            'uploadingdate'=>Now(),
                            'testdate' =>$test_date_query->test_date
                        ]);

                    }

                    $avg_total_marks = number_format((float)($total_gained_marks/$i), 2, '.', '');
                    $avg_total_marks_phy = number_format((float)($total_gained_marks_phy/$i), 2, '.', '');
                    $avg_total_marks_chem = number_format((float)($total_gained_marks_chem/$i), 2, '.', '');
                    $avg_total_marks_botany = number_format((float)($total_gained_marks_botany/$i), 2, '.', '');
                    $avg_total_marks_zoology = number_format((float)($total_gained_marks_zoology/$i), 2, '.', '');


                    $affected = DB::table('tbl_sprresult')
                        ->where('testid', $request->session()->get("test_id"))
                        ->update(
                            ['phyaverage' => $avg_total_marks_phy ,
                                'chemaverage' => $avg_total_marks_chem,
                                'botaverage' => $avg_total_marks_botany,
                                'zooaverage' => $avg_total_marks_zoology,
                                'overallaverage' => $avg_total_marks]
                        );

                    $max_total       = 0;
                    $max_total_phy   = 0;
                    $max_total_chem  = 0;
                    $max_total_zoology = 0;
                    $max_total_botany   = 0;

                    $min_total       = 0;
                    $min_total_phy   = 0;
                    $min_total_chem  = 0;
                    $min_total_zoology = 0;
                    $min_total_botany   = 0;


                    $max_total_query = DB::select("SELECT MAX(overallmarks) AS 'MAXMARKS', MAX(phymarks) AS 'MAXMARKSPHY', MAX(chemmarks) AS 'MAXMARKSCHEM', MAX(botmarks) AS 'MAXMARKSKBOT', MAX(zoomarks) AS 'MAXMARKSZOO', MIN(overallmarks) AS 'MINMARKS', MIN(phymarks) AS 'MINMARKSPHY', MIN(chemmarks) AS 'MINMARKSCHEM', MIN(botmarks) AS 'MINMARKSBOT' , MIN(zoomarks) AS 'MINMARKSZOO' FROM tbl_sprresult where testid ='".$request->session()->get('test_id')."'");

                    foreach ($max_total_query as $total){

                        $max_total       = $total->MAXMARKS;
                        $max_total_phy   = $total->MAXMARKSPHY;
                        $max_total_chem  = $total->MAXMARKSCHEM;
                        $max_total_zoology   = $total->MAXMARKSZOO;
                        $max_total_botany   = $total->MAXMARKSKBOT;
                        //$max_total_bio   = 1000;

                        $min_total       = $total->MINMARKS;
                        $min_total_phy   = $total->MINMARKSPHY;
                        $min_total_chem  = $total->MINMARKSCHEM;
                        $min_total_zoology  = $total->MINMARKSZOO;
                        $min_total_botany  = $total->MINMARKSBOT;


                    }
                    $affected = DB::table('tbl_sprresult')
                        ->where('testid', $request->session()->get("test_id"))
                        ->update(
                            ['phyhighest' => $max_total_phy ,
                                'chemhighest' => $max_total_chem,
                                'bothighest' => $max_total_botany,
                                'zoohighest' => $max_total_zoology,
                                'overallhighest' => $max_total,
                                'phylowest' => $min_total_phy ,
                                'chemlowest' => $min_total_chem,
                                'botlowest' => $min_total_botany,
                                'zoolowest' => $min_total_zoology,
                                'overalllowest' => $min_total]
                        );


                    $rank_query_total = DB::select("select *,RANK() OVER(ORDER BY overallmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'"); // order by overallmarks DESC

                    $rank = 0;

                    $students_no = count($rank_query_total);

                    foreach ($rank_query_total as $rank_total){

                        $rank ++;
                        //  $ai_rank = $request->session()->get('ai_rank') + $rank;
						$obt_marks = $rank_total->overallmarks;
						$total_marks = $rank_total->overallmaxmarks;
                       //  $ai_rank = $request->session()->get('ai_rank') + $rank;
                        ///$ai_rank = 1+((($rank_total->Rank)-1)*(($request->session()->get('ai_rank') + ($students_no-1))/($students_no-1)));
						$ai_rank = 1 + ((0.5/(1-$n)) * (1 - ($obt_marks/$total_marks)) * 5000);

                        // $ai_rank_1 = (($request->session()->get('ai_rank') + ($students_no-1))/($students_no-1));
                        // $ai_rank_2 = (($rank-1) * $ai_rank_1) + 1;

                        // print_r($ai_rank_2);
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                [
                                    'overallrank' => $ai_rank,
                                    'overallcrank' => $rank_total->Rank
                                ]
                            );


                    }

                    // $rank_query_m = DB::select("select * from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."' order by mathsmarks DESC");

                    // $rank_m = 0;
                    // foreach ($rank_query_m as $rank_total){

                    //     $rank_m ++;
                    //     $affected = DB::table('tbl_sprresult')
                    //         ->where([
                    //             ['testid', $request->session()->get("test_id")],
                    //             ['rollno', $rank_total->rollno]
                    //         ])
                    //         ->update(
                    //             ['mathsrank' => $rank_m]
                    //         );


                    // }

                    $rank_query_p = DB::select("select rollno,RANK() OVER(ORDER BY phymarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");
                    // dd($rank_query_p);
                    $rank_p = 0;
                    foreach ($rank_query_p as $rank_total){

                        $rank_p ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['phyrank' => $rank_total->Rank]
                            );
                    }

                    $rank_query_c = DB::select("select rollno,RANK() OVER(ORDER BY chemmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_c = 0;
                    foreach ($rank_query_c as $rank_total){

                        $rank_c ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['chemrank' => $rank_total->Rank]
                            );
                    }

                    $rank_query_b = DB::select("select rollno,RANK() OVER(ORDER BY botmarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_b = 0;
                    foreach ($rank_query_b as $rank_total){

                        $rank_b ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['botrank' => $rank_total->Rank]
                            );
                    }

                    $rank_query_z = DB::select("select rollno,RANK() OVER(ORDER BY zoomarks DESC) Rank from tbl_sprresult WHERE testid = '".$request->session()->get('test_id')."'");

                    $rank_z = 0;
                    foreach ($rank_query_z as $rank_total){

                        $rank_z ++;
                        $affected = DB::table('tbl_sprresult')
                            ->where([
                                ['testid', $request->session()->get("test_id")],
                                ['rollno', $rank_total->rollno]
                            ])
                            ->update(
                                ['zoorank' => $rank_total->Rank]
                            );
                    }

                } // if stataemanet for var count

                $res_total = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))->get();
                // dd($res_total);
                $final = json_encode($res_total);

                $rest_r = array(
                    'title' => $res_total[0]->testid,
                    'data' => json_decode($final, true),
                    'columns' => array("Roll No", "MaxMarks", "TotalMarks", "BotTotal", "ZooTotal", "PhyTotal", "ChemTotal",
                        "BotObt", "ZooObt", "PhyObt", "ChemObt", "T%", "BT%", "ZT%", "P%", "C%",
                        "AIR", "ClassRank", "BotRank", "ZooRank", "PhyRank", "ChemRank"
                    ),

                    'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "botmaxmarks", "zoomaxmarks", "phymaxmarks", "chemmaxmarks",  "botmarks", "zoomarks",
                        "phymarks", "chemmarks", "overallpercent", "botpercent" ,"zoopercent", "phypercent", "chempercent",
                        "overallrank", "overallcrank", "botrank", "zoorank", "phyrank", "chemrank"
                    )
                );

                return view('result_display')->with($rest_r);
                break;
        }

    }

    function getTotalMarksForSubject($arr=array(), $subject, $is_total=false, $is_optional="No"): int
    {

        $return_marks = 0;
        // dd($arr);
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
