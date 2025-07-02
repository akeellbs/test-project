<?php


namespace App\Utils;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Intersection;

class AdvanceDataLogics
{

    public static function complete_data_entry(Request $request){

        if ($request->hasFile('file_upload')){

            $path = base_path()."/storage/app/".$request->file('file_upload')->store('file_upload');
            $request->validate([
                'test_name' => 'required ',
                'test_date' => 'required ',
                'test_target_rank' => 'required'
            ]);

            $test_class = $request->post('test_class');
            $test_name  = $request->post('test_name');
			$paper_type  = $request->post('paper_type');

            $test_id = DB::table('tbl_test')->insertGetId([
                'id_test' => $request->post('test_id'),
                'id_exams' => 2,
                'test_class' => $test_class,
                'test_name' => strtoupper($request->post('test_name')),
                'test_date' => $request->post('test_date'),
                'test_target_rank' => $request->post('test_target_rank'),
                'test_pattern' => $request->post('test_pattern'),
                'test_excel_file_path' => $path,
                'test_stream' => 'JEE(M + A)',
            ]);


            $paper_id = DB::table('tbl_paper')->insertGetId([
                'id_test' => $test_id,
                'paper_name' => $request->post('test_name'),
                'paper_duration' => $request->post('test_duration'),
                'paper_total_questions' => $request->post('test_total_questions'),
                'paper_optional_questions' => '0',
            ]);


            self::data_entry_complete($path,$paper_id, $test_id, $test_class, $test_name);

            $request->session()->put('test_id', $test_id);
            $request->session()->put('paper_id', $paper_id);
			$request->session()->put('paper_type', $paper_type);
			$request->session()->put('test_class', $test_class);
            $request->session()->put('is_optional', "No");
            $request->session()->put('ai_rank', $request->post('test_target_rank'));
            $request->session()->put('testname', strtoupper($request->post('test_name')));
        }
        else{
            /**  In case if the value of file is null  **/
            echo 'No File Is Selected';
        }


    }

    private static function data_entry_complete($path, $paper_id, $test_id, $test_class, $test_name){


        $excel_arr = AppLogicsUtils::read_excel_file($path);

        /**  Get All RollNos in an array **/
        $roll_no_arr = (AppLogicsUtils::return_roll_numbers($excel_arr));
        $number_of_students = count($roll_no_arr);

        /**  Getting All Subjects Values in an array **/
        // private static fucntion partial_marking(corret, given, negative_marks, positive_marks){
        //     if given - correct{
        //         return negative_marks
        //     }
        //     else{
        //         if given == correct{
        //             return positive_marks
        //         }
        //         else{
        //             return len(correct).Intersection(given))
        //         }
        //     }
        // }
        /**  Getting All Subjects Values in an array **/
        $subjects    = (AppLogicsUtils::return_specific_array($excel_arr, array(strtoupper(MyAppConstants::SUB_KEY)), true));

        $QuestionsNos = (AppLogicsUtils::return_specific_array($excel_arr, array(MyAppConstants::QUE_KEY), false));
        $C_ANSWERS = (AppLogicsUtils::return_specific_array($excel_arr, array(MyAppConstants::C_ANS_KEY), false));
        $POS_MARKS = (AppLogicsUtils::return_specific_array($excel_arr, array(MyAppConstants::P_MARKS_KEY), false));
        $NEG_MARKS = (AppLogicsUtils::return_specific_array($excel_arr, array(MyAppConstants::N_MARKS_KEY), false));
        $SUBJECTS  = (AppLogicsUtils::return_specific_array($excel_arr, array(MyAppConstants::SUB_KEY), false));

        $QUESTION_TYPE = (AppLogicsUtils::return_specific_array(AppLogicsUtils::read_excel_file_for_advance($path), array(MyAppConstants::ROLL_KEY), false));


        // dd($roll_no_arr, $P_MARKS);
        $correct_dict = array();
        $incorrect_dict = array();
        $notattempt = array();
        foreach ($SUBJECTS as $key => $subject){

            $quiz_table_upload = DB::table('quiztable')->insertGetId([
                    'questionnumber' => $QuestionsNos[$key],
                    'quizid' => $test_id,
                    'subject' => $subject,
                    'qsubject' => $subject,
                    'correct' => $C_ANSWERS[$key],
                    'class' => $test_class,
                    'quiztype' => 'Advance',
                    'mark' => $POS_MARKS[$key],
                    'negmark' => $NEG_MARKS[$key],

                ]);
        }


        foreach ($roll_no_arr as $roll_nos){

            $roll_no_data = (AppLogicsUtils::return_specific_array($excel_arr, array($roll_nos), false));
            // dd($roll_no_data, $QUESTION_TYPE);
            $maximum_marks = 0;
            $total_marks   = 0;
            $wrong_answers = 0;
            $right_answers = 0;
            $users_answer = '~';
            $wrongquestionsno = '';
            $rightquestionsno = '';
            $attempted_question = 0;
            $checker = array();


            $result[$roll_nos] = array();
            $maths_op_count = 0;
            $phy_op_count = 0;
            $chem_op_count = 0;



            for ($i=0; $i<count($QuestionsNos); $i++){

                if (isset($correct_dict[$i+1])){

                }
                else{
                    $correct_dict[$i+1] = 0;
                }

                if (isset($incorrect_dict[$i+1])){

                }
                else{
                    $incorrect_dict[$i+1] = 0;
                }

                if (isset($notattempt[$i+1])){

                }
                else{
                    $notattempt[$i+1] = 0;
                }

                $question_no    = $QuestionsNos[$i];
                $correct_ans    = $C_ANSWERS[$i];
                $positive_m     = $POS_MARKS[$i];
                $negative_m     = $NEG_MARKS[$i];
                $student_ans    = $roll_no_data[$i];
                $subject        = $SUBJECTS[$i];

                if ($i === count($QuestionsNos) -1){
                    if ($student_ans === "BLANK"){
                        $users_answer  =  $users_answer.'null' ;
                    }
                    else {
                        $users_answer = $users_answer.$student_ans;
                    }
                }

                else{
                    if ($student_ans === "BLANK") {
                        $users_answer  =  $users_answer.'null'.'~' ;
                        }
                    else {
                        $users_answer  = $users_answer.$student_ans.'~';
                    }
                }

                $marks_obt      = 0;


                if (!($QUESTION_TYPE[$i] == "P")){



                if ($student_ans === "BLANK"){
                    $marks_obt  =   0;
                    array_push($checker, $marks_obt);
                    $notattempt[$i+1] =  $notattempt[$i+1] + 1;

                }
                elseif ($correct_ans === $student_ans){
                    $correct_dict[$i+1] =  $correct_dict[$i+1] + 1;
                    $marks_obt  =   $positive_m;
                    array_push($checker, $marks_obt);
                    $j = $i + 1;
                    $rightquestionsno = $rightquestionsno.'~'.$j;
                    $attempted_question = $attempted_question + 1;
                    $right_answers = $right_answers + 1;

                }
                else{
                    $incorrect_dict[$i+1] =  $incorrect_dict[$i+1] + 1;
                    $marks_obt  =   $negative_m;
                    array_push($checker, $marks_obt);
                    $j = $i + 1;
                    $wrongquestionsno = $wrongquestionsno.'~'.$j;
                    $attempted_question = $attempted_question + 1;
                    $wrong_answers = $wrong_answers + 1;
                }
            }
            else{
                if ($student_ans === "BLANK"){
                    $marks_obt  =   0;
                    array_push($checker, $marks_obt);
                    $notattempt[$i+1] =  $notattempt[$i+1] + 1;
                }
                else{
                    // Partial marking logics.
                    if (!(strlen($correct_ans) == 1)){
                         $correct_selected = substr($correct_ans,1,-1);
                    }
                    else{
                        $correct_selected = $correct_ans;
                    }
                    if (!(strlen($student_ans) == 1)){
                         $user_selected = substr($student_ans,1,-1);
                    }
                    else{
                        $user_selected = $student_ans;
                    }

                    $correct_ans_array = explode(",",$correct_selected);
                    $user_ans_array = explode(",",$user_selected);

                    $correct_set_arr = array();
                    $user_set_arr = array();

                    foreach ($correct_ans_array as $key) {
                        $correct_set_arr[$key] = true;
                    }

                    foreach ($user_ans_array as $key) {
                        $user_set_arr[$key] = true;
                    }

                    // if (($i == 26) && ($roll_nos == 204000169)){
                    //         // dd($student_ans, $correct_selected,$user_selected,$correct_set_arr, $user_ans_array  );

                    // }
                    if (sizeof($correct_set_arr+ $user_set_arr) > sizeof($correct_set_arr)){
                        // provide negative marks.
                            $marks_obt  =   $negative_m;
                            array_push($checker, $marks_obt);
                            $j = $i + 1;
                            $wrongquestionsno = $wrongquestionsno.'~'.$j;
                            $attempted_question = $attempted_question + 1;
                            $wrong_answers = $wrong_answers + 1;
                    }
                    else{
                            // marks for partial correct.
                            // if ($i == 6){
                            //        dd($correct_set_arr,$user_set_arr, $correct_set_arr+ $user_set_arr);
                            //     }
                        $correct_dict[$i+1] =  $correct_dict[$i+1] + 1;
                        if (sizeof($correct_set_arr) == sizeof($user_set_arr)){

                            $marks_obt  =   $positive_m;
                        }
                            else{
                                $marks_obt  =   sizeof($user_set_arr);
                            }
                        array_push($checker, $marks_obt);
                        $j = $i + 1;
                        $rightquestionsno = $rightquestionsno.'~'.$j;
                        $attempted_question = $attempted_question + 1;
                        $right_answers = $right_answers + 1;
                    }
                }
            }

                $maximum_marks  =   $maximum_marks+$positive_m;
                $total_marks    =   $total_marks + $marks_obt;

                array_push($result[$roll_nos], array(

                    'QNO'                   =>  $question_no,
                    'CORRECT_ANS'           =>  $correct_ans,
                    'POSITIVE_MARKS'        =>  $positive_m,
                    'NEGATIVE_MARKS'        =>  $negative_m,
                    'STUDENT_ANS'           =>  $student_ans,
                    'SUBJECT'               =>  $subject,
                    'MARKS_OBTAINED'        =>  $marks_obt,

                ));

            }
            // dd($checker);
            $maxmarks = $maximum_marks;
            $totalquestion = count($QuestionsNos);
            $attemptedquestion = $attempted_question;
            $notattemptedquestion = count($QuestionsNos) - $attemptedquestion;
            $rightquestion = $right_answers;
            $wrongquestion = $wrong_answers;
            $testname = strtoupper($test_name);
            $class = $test_class;

            $result_upload_id = DB::table('tbl_result')->insertGetId([
                'testid' => $test_id,
                'maxmarks' => $maxmarks,
                'totalquestion' => $totalquestion,
                'attemptedquestion' => $attemptedquestion,
                'wrongquestionsno' => $wrongquestionsno,
                'rightquestionsno' => $rightquestionsno,
                'notattemptedquestions' => $notattemptedquestion,
                'rightquestion' => $rightquestion,
                'wrongquestion' => $wrongquestion,
                'testname' => $testname,
                'class' => $class,
                'subject' => 'OMR',
                'obtainedmarks' => $total_marks,
                'email' => $roll_nos,
                'useranswers' => $users_answer,
				'testmode' => 'OMR'
            ]);


            $omr_upload_id = DB::table('tbl_omr_data')->insertGetId([
                'id_paper' => $paper_id,
                'id_test' => $test_id,
                'subjects_list_omr_data' => json_encode($subjects),
                'roll_no_omr_data' => $roll_nos,
                'max_marks_omr_data' => $maximum_marks,
                'total_marks_omr_data' => $total_marks,
                'response_omr_data' => json_encode($result[$roll_nos]),
            ]);


        }

        foreach ($correct_dict as $key => $ca){

             $c_per = ($ca/$number_of_students)*100;

            $inc_per = ($incorrect_dict[$key]/$number_of_students)*100;

            $not_per = ($notattempt[$key]/$number_of_students)*100;

            if(abs($c_per-$inc_per)<15) {

                $level =  "M" ;
            }else{
                if($c_per>$inc_per){
                    $level =  "E" ;
                }else{
                    $level =  "T" ;
                }
            }

            $omr_upload_id = DB::table('tbl_test_analysis')->insertGetId([
                'testid' =>  $test_id,
                'qno' => $key,
                'correct_attempt' => $c_per,
                'in_correct_attempt' => $inc_per,
                'not_attempt' => $not_per,
                'level' => $level
            ]);
        }
    }
}
