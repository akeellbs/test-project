<?php
namespace App\Utils;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use phpDocumentor\Reflection\Types\Self_;



class SecondaryDBControls

{
    const SEC_HOST          =    "3.109.197.125";

    const SEC_USER          =    "NVXXI2LPNY======";

    const SEC_PASS          =    "%@>##>(!>!#&@m@z0n";

    const SEC_DB            =    "blueerp";



    public static function connect_to_secondary(){
        return mysqli_connect(self::SEC_HOST, self::SEC_USER, self::SEC_PASS, self::SEC_DB);
    }

	public static function delete_test_data($test_id){

        $sql = "DELETE FROM tbl_sprresult WHERE testid ='".$test_id."'";
        $result = mysqli_query(self::connect_to_secondary(), $sql);

        $sql = "DELETE FROM tbl_testresult WHERE testid ='".$test_id."'";
        $result = mysqli_query(self::connect_to_secondary(), $sql);

		$sql = "DELETE FROM tbl_test_analysis WHERE testid ='".$test_id."'";
        $result = mysqli_query(self::connect_to_secondary(), $sql);

        $sql = "DELETE FROM quiztable WHERE quizid ='".$test_id."'";
        $result = mysqli_query(self::connect_to_secondary(), $sql);

        $sql = "DELETE FROM tbl_result WHERE testid ='".$test_id."'";
        $result = mysqli_query(self::connect_to_secondary(), $sql);

        return $result;
    }



   public static function return_max_test_id(): string

    {


        $test_id = "0";



        $sql = "SELECT testid FROM tbl_sprresult ORDER BY id DESC LIMIT 1";

        $results = mysqli_query(self::connect_to_secondary(), $sql);


        while($rows = mysqli_fetch_array($results)){

            $test_id = $rows['testid'] + 1;



        }



        $id_test = DB::table('tbl_sprresult')->orderBy('testid', 'desc')->first();



        if ($id_test!=null){


            if ($test_id === $id_test->testid){
                return $id_test->testid +1;

            }

            else{
                if (($id_test->testid ) > $test_id){
                    return $id_test->testid + 1 ;

                }

                else{


                    return $test_id;

                }



            }



        }

        else{
            return $test_id;

        }







    }

	public static function insert_into_quiztable_erp($test_id): string
    {

        $sorted_array = DB::select("SELECT * FROM quiztable WHERE quizid ='".$test_id."'");
        // $sorted_array = json_decode(json_encode($data), true);
        $result_display = "Not Connected";
        $sql ="";
		$con = self::connect_to_secondary();
        $ex_sql = "SELECT * FROM quiztable where quizid = '".$test_id."'";
        $ex_res = mysqli_query($con, $ex_sql);

        if(mysqli_num_rows($ex_res)<1){


                foreach ($sorted_array as $result){
                    // $con = self::connect_to_secondary();
                        $sql .= "INSERT INTO quiztable(questionnumber, subject,correct,
                                            mark,negmark, quizid, quiztype,
                                            class, qsubject )

                            VALUES('".$result->questionnumber."',
                            '".$result->subject."',
                            '".$result->correct."',
                            '".$result->mark."',
                            '".$result->negmark."',
                            '".$result->quizid."',
                            '".$result->quiztype."',
                            '".$result->class."',
                            '".$result->qsubject."'
                        );";

                }

                if ($con){
                //$con = self::connect_to_secondary();
                if (mysqli_multi_query($con, $sql)) {
                    $result_display = "New records created successfully";
                }
                else {
                    $result_display =  "Error: " . $sql . "<br>" . mysqli_error(self::connect_to_secondary());
                    }
                } else {
                    die("ERROR: ".mysqli_error(self::connect_to_secondary()));
                }

        }



			mysqli_close($con);
            return $result_display;

            }


		public static function insert_into_tbl_test_analysis($test_id): string
		{
            $sorted_array = DB::select("SELECT * FROM tbl_test_analysis WHERE testid ='".$test_id."'");
            //$sorted_array = json_decode(json_encode($data), true);
            $result_display = "Not Connected";
            $sql ="";
    		$con = self::connect_to_secondary();

            $ex_sql = "SELECT * FROM tbl_test_analysis where testid ='".$test_id."'";

            $ex_res = mysqli_query($con, $ex_sql);
            if(mysqli_num_rows($ex_res)<1){

                    foreach ($sorted_array as $result){
                         $sql .= "INSERT INTO tbl_test_analysis(qno,testid, correct_attempt, in_correct_attempt,not_attempt,level)

                                    VALUES('".$result->qno."',

                                    '".$result->testid."',
                                    '".$result->correct_attempt."',
                                    '".$result->in_correct_attempt."',
                                    '".$result->not_attempt."',
                                    '".$result->level."'

                                );";

                    }
                    if ($con){
                        // $con = self::connect_to_secondary();
                        if (mysqli_multi_query($con, $sql)) {
                            $result_display = "New records created successfully";
                        }
                        else {
                            $result_display =  "Error: " . $sql . "<br>" . mysqli_error(self::connect_to_secondary());
                        }
                    } else{
                        die("ERROR: ".mysqli_error(self::connect_to_secondary()));
                    }
            }

			mysqli_close($con);
            return $result_display;
    }

    public static function insert_into_tbl_result($test_id): string
    {

        $sorted_array = DB::select("SELECT * FROM tbl_result WHERE testid ='".$test_id."'");
        // $sorted_array = json_decode(json_encode($data), true);
        // dd($sorted_array);
        $result_display = "Not Connected";
        $sql ="";
		$con = self::connect_to_secondary();
		
        foreach ($sorted_array as $result){
                $ex_sql = "SELECT * FROM tbl_result where email = '".$result->email."' and testid ='".$result->testid."'";
                // $con = self::connect_to_secondary();
                $ex_res = mysqli_query($con, $ex_sql);
                //mysqli_close($con);
                if(mysqli_num_rows($ex_res)<1){
                $sql .= "INSERT INTO tbl_result(totalquestion, maxmarks, attemptedquestion, notattemptedquestions,

                            rightquestion, wrongquestion, obtainedmarks,

                            email, subject,
                            wrongquestionsno, rightquestionsno, useranswers,
                            testid, class, testname, TestMode)

                            VALUES('".$result->totalquestion."',

                            '".$result->maxmarks."',

                            '".$result->attemptedquestion."',

                            '".$result->notattemptedquestions."',
                            '".$result->rightquestion."',
                            '".$result->wrongquestion."',
                            '".$result->obtainedmarks."',
                            '".$result->email."',
                            '".$result->subject."',
                            '".$result->wrongquestionsno."',
                            '".$result->rightquestionsno."',
                            '".$result->useranswers."',
                            '".$result->testid."',
                            '".$result->class."',
                            '".$result->testname."',
                            'OMR'



                        );";

                }

        }
		//$con = self::connect_to_secondary();
        if ($con){
            // $con = self::connect_to_secondary();
            if (mysqli_multi_query($con, $sql)) {
                $result_display = "New records created successfully";
            }
            else {

                $result_display =  "Error: " . $sql . "<br>" . mysqli_error(self::connect_to_secondary());
            }
        }

        else{
            die("ERROR: ".mysqli_error(self::connect_to_secondary()));
        }

		mysqli_close($con);
        return $result_display;


    }

    public static function insert_into_spr_result($test_id): string

    {

        $sorted_array = DB::select("SELECT * FROM tbl_sprresult WHERE testid ='".$test_id."'");

        $result_display = "Not Connected";
        $sql ="";

		$con = self::connect_to_secondary();
		// if($con){
			// dd($con);
		// }
		// else{
			// dd("Not Connect");
		// }
        foreach ($sorted_array as $result){
			
        $ex_sql = "SELECT * FROM tbl_sprresult where rollno = '".$result->rollno."' and testid ='".$result->testid."'";
		//dd($ex_sql);

        // $con = self::connect_to_secondary();
        $ex_res = mysqli_query($con, $ex_sql);

		//print_r(mysqli_num_rows($ex_res)); die();

            if(mysqli_num_rows($ex_res)<1){
            $sql .= " INSERT INTO tbl_sprresult(
                            rollno, 
                            testid, 
                            stream,  
                            phymarks,
                            chemmarks, 
                            mathsmarks, 
                            phymaxmarks,
                            chemmaxmarks, 
                            mathsmaxmarks, 
                            phypercent,
                            chempercent, 
                            mathspercent, 
                            overallmarks,
                            overallmaxmarks, 
                            overallpercent, 
                            uploadingdate,
                            phyhighest, 
                            chemhighest, 
                            mathshighest, 
                            overallhighest,
                            phylowest, 
                            chemlowest, 
                            mathslowest, 
                            overalllowest,
                            phyaverage, 
                            chemaverage, 
                            mathsaverage, 
                            overallaverage,
							starperformer,
                            mode, 
                            testdate, 
                            overallrank, 
                            mathsrank, 
                            phyrank, 
                            chemrank, 
                            overallcrank,
                            studentsappeared, 
                            testname, 
                            biohighest, 
                            biopercent, 
                            biomaxmarks, 
                            biomarks,
                            bioaverage, 
                            biorank, 
                            expectedrank, 
                            type, 
                            paper, 
                            class, 
                            course, 
                            bothighest, 
                            botpercent, 
                            botmaxmarks, 
                            botmarks,
                            botaverage, 
                            botrank, 
                            zoohighest, 
                            zoopercent, 
                            zoomaxmarks, 
                            zoomarks,
                            zooaverage, 
                            zoorank, 
                            botlowest, 
                            zoolowest, 
                            engmarks,
                            hindimarks,
                            sstmarks,
                            mamarks, 
                            engmaxmarks,
                            hindimaxmarks,
                            sstmaxmarks,
                            mamaxmarks, 
                            engpercent,
                            hindipercent,
                            sstpercent,
                            mapercent,
                            engrank,
                            hindirank,
                            sstrank,
                            marank,
                            enghighest,
                            hindihighest,
                            ssthighest,
                            mahighest,
                            biolowest,
                            englowest,
                            hindilowest,
                            sstlowest,
                            malowest,
                            engaverage, 
                            hindiaverage,
                            sstaverage,
                            maaverage,
                            skmarks,
                            commarks,
                            skmaxmarks, 
                            commaxmarks,
                            skpercent,
                            compercent,
                            skrank,
                            comrank,
                            skhighest,
                            comhighest, 
                            sklowest,
                            comlowest,
                            skaverage,
                            comaverage)

                   VALUES(
                    '".$result->rollno."',
                    '".$result->testid."',
                    '".$result->stream."',
                    '".$result->phymarks."',
                    '".$result->chemmarks."',
                    '".$result->mathsmarks."',
                    '".$result->phymaxmarks."',
                    '".$result->chemmaxmarks."',
                    '".$result->mathsmaxmarks."',
                    '".$result->phypercent."',
                    '".$result->chempercent."',
                    '".$result->mathspercent."',
                    '".$result->overallmarks."',
                    '".$result->overallmaxmarks."',
                    '".$result->overallpercent."',
                    '".$result->uploadingdate."',
                    '".$result->phyhighest."',
                    '".$result->chemhighest."',
                    '".$result->mathshighest."',
                    '".$result->overallhighest."',
                    '".$result->phylowest."',
                    '".$result->chemlowest."',
                    '".$result->mathslowest."',
                    '".$result->overalllowest."',
                    '".$result->phyaverage."',
                    '".$result->chemaverage."',
                    '".$result->mathsaverage."',
                    '".$result->overallaverage."',
                    '".$result->starperformer."',
                    'OMR',
                    '".$result->testdate."',
                    '".$result->overallrank."',
                    '".$result->mathsrank."',
                    '".$result->phyrank."',
                    '".$result->chemrank."',
                    '".$result->overallcrank."',
                    '".$result->studentsappeared."',
                    '".$result->testname."',
                    '".$result->biohighest."',
                    '".$result->biopercent."',
                    '".$result->biomaxmarks."',
                    '".$result->biomarks."',
                     '".$result->bioaverage."',
                     '".$result->biorank."',
                     '',
                    '".$result->type."' ,
                    '".$result->paper."',
                    '".$result->class."',
                    '".$result->course."',
                    '".$result->bothighest."',
                    '".$result->botpercent."',
                    '".$result->botmaxmarks."',
                    '".$result->botmarks."',
                     '".$result->botaverage."',
                     '".$result->botrank."',
                     '".$result->zoohighest."',
                    '".$result->zoopercent."',
                    '".$result->zoomaxmarks."',
                    '".$result->zoomarks."',
                     '".$result->zooaverage."',
                     '".$result->zoorank."',
                     '".$result->botlowest."',
                     '".$result->zoolowest."',
                     '".$result->engmarks."',
                     '".$result->hindimarks."',
                     '".$result->sstmarks."',
                     '".$result->mamarks."',
                     '".$result->engmaxmarks."',
                     '".$result->hindimaxmarks."',
                     '".$result->sstmaxmarks."',
                     '".$result->mamaxmarks."',
                     '".$result->engpercent."',
                     '".$result->hindipercent."',
                     '".$result->sstpercent."',
                     '".$result->mapercent."',
                     '".$result->engrank."',
                     '".$result->hindirank."',
                     '".$result->sstrank."',
                     '".$result->marank."',
                     '".$result->enghighest."',
                     '".$result->hindihighest."',
                     '".$result->ssthighest."',
                     '".$result->mahighest."',
                     '".$result->biolowest."',
                     '".$result->englowest."',
                     '".$result->hindilowest."',
                     '".$result->sstlowest."',
                     '".$result->malowest."',
                     '".$result->engaverage."',
                     '".$result->hindiaverage."',
                     '".$result->sstaverage."',
                     '".$result->maaverage."',
                     '".$result->skmarks."',
                     '".$result->commarks."',
                     '".$result->skmaxmarks."',
                     '".$result->commaxmarks."',
                     '".$result->skpercent."',
                     '".$result->compercent."',
                     '".$result->skrank."',
                     '".$result->comrank."',
                     '".$result->skhighest."',
                     '".$result->comhighest."',
                     '".$result->sklowest."',
                     '".$result->comlowest."',
                     '".$result->skaverage."',
                     '".$result->comaverage."'
                    );";

             }

        }

		// dd($sql);

            if ($con){

				//$con = self::connect_to_secondary();
                if (mysqli_multi_query($con, $sql)) {
                $result_display = "New Records Created Successfully";

            } else {
				// die(mysqli_error(self::connect_to_secondary()));
                // $result_display =  "Error: " . $sql . "<br>" . mysqli_error(self::connect_to_secondary());
				$result_display = $sql;

            }
			
			// $result_display = $sql;

        }

        else{
            die("ERROR: ".mysqli_error(self::connect_to_secondary()));

        }




		mysqli_close($con);
        return $result_display;



    }

    /*Rajkumar Jain*/
    public static function getStudentData(){
        $sql = "SELECT Rollno,dob, StudentName, FatherName, mothername, strGender, Course,batch ,strclass, strtarget, strmedium, strphase, strstate,
                strdistrict,center,programtype 
                FROM `student_master`
                WHERE rollno is not null  AND (rollno like '21%' or rollno like '22%' )   ORDER BY rollno DESC, center DESC limit 100 ";

        $results = mysqli_query(self::connect_to_secondary(), $sql);
        if(mysqli_num_rows($results) > 0 ){
            $r = 1;
            $resultData = '';
             while($rows = mysqli_fetch_array($results)){
                    $resultData   .=   '<tr>
                                    <td>'.$r.'</td>
                                    <td>'.$rows['Rollno'].'</td>
                                    <td>'.$rows['dob'].'</td>
                                    <td>'.$rows['StudentName'].'</td>
                                    <td>'.$rows['FatherName'].'</td>
                                    <td>'.$rows['mothername'].'</td> 
                                    <td>'.$rows['strGender'].'</td> 
                                    <td>'.$rows['Course'].'</td> 
                                    <td>'.$rows['batch'].'</td> 
                                    <td>'.$rows['strclass'].'</td>
                                    <td>'.$rows['strtarget'].'</td>
                                    <td>'.$rows['strmedium'].'</td> 
                                    <td>'.$rows['strphase'].'</td>
                                    <td>'.$rows['strstate'].'</td> 
                                    <td>'.$rows['strdistrict'].'</td>
                                    <td>'.$rows['center'].'</td>
                                    <td>'.$rows['programtype'].'</td>
                                </tr>';
                    $r++;
                }
                return json_encode($resultData);
        }
        return false;

        
    }



}

