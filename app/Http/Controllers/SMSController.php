<?php


namespace App\Http\Controllers;


use App\Utils\SecondaryDBControls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SMSController extends Controller
{

    public function sms_view(Request $request){

        $data = array(
            'title' => ' SMS Sending Script'
        );

        return view('exam-controller/sms')->with($data);

    }

    public function send_sms_action(Request $request){

        ini_set('max_execution_time', -1);

        $data['Status'] ="0";
        $data['Msg'] ="You are not allowed !";
        $data['Values'] = array();

        $conn = SecondaryDBControls::connect_to_secondary();

        if ($conn){

            if ($request->post('prjTitle')){

                $query ="select tbl_sprresult.* , student_master.studentname,cast(unhex(des_decrypt(student_master.stmob,'1')) as char(250)) as `stmob`, cast(unhex(des_decrypt(student_master.fmob,'1')) as char(250)) as `fmob`,student_master.strclass  from tbl_sprresult left join student_master on student_master.rollno=tbl_sprresult.rollno where tbl_sprresult.testid ='".$request->post('prjTitle')."' group by tbl_sprresult.rollno";
                $mr = "select max(overallrank) as max_rank from tbl_sprresult where testid = '".$request->post('prjTitle')."'";
                $max_rank = mysqli_query($conn,$mr);
                $max_rank = mysqli_fetch_array($max_rank);
                $max_rank = $max_rank["max_rank"];

				$result=mysqli_query($conn,$query);

                if(mysqli_num_rows($result) > 0){
                    //if data found
                    $data['Status'] ="1";

                    while($row=mysqli_fetch_array($result)){

                        $data['Stream'] = $row['stream'];

                        array_push($data['Values'], array(
                            'studentname' => $row['studentname'],
                            'testname' => $row['testname'],
                            'rollno' => $row['rollno'],
                            'testid' => $row['testid'],
                            'phymarks'=> $row['phymarks'],
                            'chemmarks'=> $row['chemmarks'],
                            'mathsmarks' => $row['mathsmarks'],
                            'biomarks' => $row['biomarks'],
                            'phymaxmarks'=> $row['phymaxmarks'],
                            'chemmaxmarks'=> $row['chemmaxmarks'],
                            'mathsmaxmarks' => $row['mathsmaxmarks'],
                            'biomaxmarks' => $row['biomaxmarks'],
                            'overallmarks' => $row['overallmarks'],
                            'overallmaxmarks' => $row['overallmaxmarks'],
                            'overallrank' => $row['overallrank'],
                            'overallcrank' => $row['overallcrank'],
                            'stream' => $row['stream'],
                            'stmob' => $row['stmob'],
                            'fmob' => $row['fmob']

                        ));

                        if($row['phymarks'] === "-1000"){

                                echo "ABSENT";

                        }
                        else{

                       // $total = $row['overallmarks']."/".$row['overallmaxmarks'];    old sms
                        $total = $row['overallmarks'];
                     //   $crank = $row['overallcrank']."/".$row['studentsappeared'];   old sms
                        $crank = $row['overallcrank'];
                        $air   = $row['overallrank']."/".$max_rank;
						
					//	$dlttemplateid = "1507166693202791337";
						$dlttemplateid = "1107171266378453315";
                        

					//	$msg = "Dear ".strtoupper($row['studentname'])." Result in ".$row['testname']." test is P:".$row['phymarks'].",C:".$row['chemmarks'].", M:".$row['mathsmarks'].", Total:".$total.", CR: ".$crank.", AIR:".$air." Motion";
					$stringvar = "P" . $row['phymarks'] . ",C" . $row['chemmarks'] . ",M" . $row['mathsmarks'] . ",T" . $total . ",R" . $crank;
						$msg = "Dear Student/Parent test result dated, ".$row['testdate']." is ".$stringvar.". Motion";

							if($row['stream']==="NEET"){

								//$msg = "Dear ".strtoupper($row['studentname'])." test result dated, ".$row['testname']." is P:".$row['phymarks'].",C:".$row['chemmarks'].", B:".$row['biomarks'].", Total:".$total.", CR: ".$crank.", AIR:".$air." Motion";
								$stringvar = "P" . $row['phymarks'] . ",C" . $row['chemmarks'] . ",B" . $row['biomarks'] . ",T" . $total . ",R" . $crank;
								$msg = "Dear Student/Parent test result dated, ".$row['testdate']." is ".$stringvar.". Motion";
								
								//$dlttemplateid = "1507162122666768790";
								$dlttemplateid = "1107171266378453315";

							}

							if($row['stream']==="NEET_NEW"){

							//	$msg = "Dear ".strtoupper($row['studentname'])." Result in ".$row['testname']." test is P:".$row['phymarks'].",C:".$row['chemmarks'].", BT:".$row['botmarks'].", ZL:".$row['zoomarks'].", Total:".$total.", CR: ".$crank.", AIR:".$air." Motion";

								$stringvar = "P" . $row['phymarks'] . ",C" . $row['chemmarks'] . ",B" . $row['botmarks'] . ",Z" . $row['zoomarks'] . ",T" . $total . ",R" . $crank;
								
								$msg = "Dear Student/Parent test result dated, ".$row['testdate']." is ".$stringvar.". Motion";
								
								$dlttemplateid = "1107171266378453315";
							//	$dlttemplateid = "1507166097602334466";

							}
                            if($row['stream']==="FOUNDATION"){
                                $st_class = $row['class'];
                                
                                $test_type_result = DB::select("select test_type from tbl_test where id_test = '".$request->post('prjTitle')."'");
                               
                                 $test_type = strtolower($test_type_result[0]->test_type);   
                                //die();                            
                                
                                //$msg = "Dear ".strtoupper($row['studentname'])." Result in ".$row['testname']." test is P:".$row['phymarks'].",C:".$row['chemmarks'].", B:".$row['biomarks'].", M:".$row['mathsmarks'].", Total:".$total." Motion Foundation";

                                $stringvar_first = "P" . $row['phymarks'] . ",C" . $row['chemmarks']. ",M" . $row['mathsmarks'] . ",B" . $row['biomarks'] . ",E" . $row['engmarks'] . ",H" . $row['hindimarks'] . ",SST" . $row['sstmarks'];

                                if($st_class < 11){
                                    $stringvar_sec = "MAT" . $row['mamarks'] . ",COM" . $row['commarks']. ",SAN" . $row['skmarks']. ",TM" . $total . ",CR" . $crank;
                                }
                                else{
                                    $stringvar_sec = "MAT" . $row['mamarks'] . ",COM" . $row['commarks']. ",TM" . $total . ",CR" . $crank;
                                }

                                if($test_type == 'assesment subjective'){   
                                    //Assesment Subjective test
                                    $msg = "Dear Student/Parent Assesment test Subjective result is,".$stringvar_first.", AND ".$stringvar_sec.". Motion";
                                    $dlttemplateid = "1107172403485348331";
                                }
                                else if($test_type == 'major test'){

                                    $msg = "Dear Student/Parent Major test result is,".$stringvar_first.", AND ".$stringvar_sec.". Motion";
                                    $dlttemplateid = "1107172403464680494";
                                }
                                else if($test_type == 'half yearly test'){

                                    $msg = "Dear Student/Parent Half yearly test result is,".$stringvar_first.", AND ".$stringvar_sec.". Motion";
                                    $dlttemplateid = "1107172403474070963";
                                }
                                else if($test_type == 'final test'){

                                    $msg = "Dear Student/Parent Final test result is,".$stringvar_first.", AND ".$stringvar_sec.". Motion";
                                    $dlttemplateid = "1107172403479325369";
                                }
                                else if($test_type == 'assesment objective'){
                                    //Assesment Objective test
                                    $stringvar_first = "P" . $row['phymarks'] . ",C" . $row['chemmarks']. ",M" . $row['mathsmarks'] . ",TM" . $total . ",CR" . $crank;

                                    $msg = "Dear Student/Parent Assesment test Objective result is, ".$stringvar_first.". Motion";
                                    $dlttemplateid = "1107172403490536827";
                                }
                                else if($test_type == 'objective test'){
                                    
                                    $stringvar_first = "P" . $row['phymarks'] . ",C" . $row['chemmarks']. ",M" . $row['mathsmarks'] . ",B" . $row['biomarks'] . ",TM" . $total . ",CR" . $crank;

                                    $msg = "Dear Student/Parent Objective test result is, ".$stringvar_first.". Motion";
                                    $dlttemplateid = "1107172403503265520";
                                }
                                //($test_type == 'unit test')
                                else{

                                    $msg = "Dear Student/Parent Unit test result is,".$stringvar_first.", AND ".$stringvar_sec.". Motion";
                                    $dlttemplateid = "1107172403455210317";
                                }
                                
                                // $stringvar_first = "P" . $row['phymarks'] . ",C" . $row['chemmarks']. ",M" . $row['mathsmarks'] . ",B" . $row['biomarks'] . ",E" . $row['engmarks'] . ",H" . $row['hindimarks'] . ",SST" . $row['sstmarks']. ",SK" . $row['skmarks'];

                                // $stringvar_sec = "MAT" . $row['mamarks'] . ",COM" . $row['commarks']. ",TM" . $total . ",CR" . $crank;

                                // $msg = "Dear Student/Parent Unit test result is,".$stringvar_first.", AND ".$stringvar_sec.". Motion";

                                //Dear Student/Parent Unit test result is,{#var#}, AND {#var#}. Motion
								
								//$dlttemplateid = "1507165157149342605"; //old id
								//$dlttemplateid = "1107172403455210317"; //new id
                            }
							
							
							
					    // dd($msg);

                         $output_st = self::send_curl_request_pinnacle($row['stmob'], $msg, $dlttemplateid);
						 $output_f  = self::send_curl_request_pinnacle($row['fmob'], $msg, $dlttemplateid);
					//	echo $msg;
						//$output_st = self::send_curl_request_pinnacle('7737288502', $msg, $dlttemplateid);
					//	dd($output_st);
						// $output_f  = self::send_curl_request_pinnacle('9694985655', $msg, $dlttemplateid);

                        // dd($msg);
						$sql_sms = "INSERT INTO tbl_sms (rollno, mobile, smsdetails, title, insdate, status, processed, processeddatetime, taskby) VALUES ('".$row['rollno']."','".$row['stmob']."', '".$msg."', 'SPR SMS From New Panel', NOW(), '".$output_st."', '1', NOW(), 'Akbar'), ('".$row['rollno']."','".$row['fmob']."', '".$msg."', 'SPR SMS From New Panel', NOW(), '".$output_f."', '1', NOW(), 'Akbar')";

						mysqli_query($conn, $sql_sms);

                        }

                    }
                    //self::send_curl_request('9610305941', 'Hey Ankit Whats Up');



                    $data['Msg'] = "Message Sent Successfully";
                    echo json_encode($data);

                } else{
                    $data['Status'] ="0";
                    $data['Msg']="Data not found";
                    echo json_encode($data);
                }


            }

            else{

                $data['Status'] ="0";
                $data['Msg']="Not a valid variable";
                echo json_encode($data);

            }


        }

        else{

            $data['Status'] ="0";
            $data['Msg']="Not Connected";
            echo json_encode($data);

        }

        //echo 'SMS';


    }

    public function return_records_for_sms(Request $request){

        ini_set('max_execution_time', -1);

        $data['Status'] ="0";
        $data['Msg'] ="You are not allowed !";
        $data['Values'] = array();

        $conn = SecondaryDBControls::connect_to_secondary();

            if ($conn){

                if ($request->post('prjTitle')){

                    $query ="select tbl_sprresult.* , student_master.studentname,cast(unhex(des_decrypt(student_master.stmob,'1')) as char(250)) as `stmob`, cast(unhex(des_decrypt(student_master.fmob,'1')) as char(250)) as `fmob`,student_master.strclass  from tbl_sprresult left join student_master on student_master.rollno=tbl_sprresult.rollno where tbl_sprresult.testid ='".$request->post('prjTitle')."' group by tbl_sprresult.rollno";
                    $mr = "select max(overallrank) as max_rank from tbl_sprresult where testid = '".$request->post('prjTitle')."'";
					$max_rank = mysqli_query($conn,$mr);
					$max_rank = mysqli_fetch_array($max_rank);
					$max_rank = $max_rank["max_rank"];
					$result=mysqli_query($conn,$query);

                    if(mysqli_num_rows($result) > 0){
                        //if data found
                        $data['Status'] ="1";
                        $data['Msg']="Found Data";
                        $data['Values'] =array();
                        while($row=mysqli_fetch_array($result)){

                            $data['Stream'] = $row['stream'];

                            array_push($data['Values'], array(
                                'studentname' => $row['studentname'],
                                'testname' => $row['testname'],
                                'rollno' => $row['rollno'],
                                'testid' => $row['testid'],
                                'phymarks'=> $row['phymarks'],
                                'chemmarks'=> $row['chemmarks'],
                                'mathsmarks' => $row['mathsmarks'],
                                'biomarks' => $row['biomarks'],
                                'phymaxmarks'=> $row['phymaxmarks'],
                                'chemmaxmarks'=> $row['chemmaxmarks'],
                                'mathsmaxmarks' => $row['mathsmaxmarks'],
                                'biomaxmarks' => $row['biomaxmarks'],
                                'overallmarks' => $row['overallmarks'],
                                'overallmaxmarks' => $row['overallmaxmarks'],
                                'overallrank' => $row['overallrank'],
                                'overallcrank' => $row['overallcrank'],
                                'stream' => $row['stream'],
                                'stmob' => $row['stmob'],
                                'fmob' => $row['fmob']

                            ));

                        }

                        echo json_encode($data);

                    } else{
                        $data['Status'] ="0";
                        $data['Msg']="Data not found";
                        echo json_encode($data);
                    }


                }

                else{

                    $data['Status'] ="0";
                    $data['Msg']="Not a valid variable";
                    echo json_encode($data);

                }


            }

            else{

                $data['Status'] ="0";
                $data['Msg']="Not Connected";
                echo json_encode($data);

            }



    }

    public function return_sms_title_details(Request $request){

        ini_set('max_execution_time', -1);

        $conn = SecondaryDBControls::connect_to_secondary();

        if ($conn){

           // $query = "select cast(Concat(TestName,'-' , TestDate ,'-', TestID,'-',STREAM) as char(250)) as `Test` , testdate , testid from tbl_testtable group by testid order by testdate desc limit 800";
		   $query = "select cast(Concat(TestName,'-' , TestDate ,'-', TestID,'-',STREAM) as char(250)) as `Test` , testdate , testid from tbl_sprresult group by testid order by testdate DESC limit 100";

            $result=mysqli_query($conn,$query);

            $data['Status'] ="1";
            $data['Values'] = array();
            if(mysqli_num_rows($result) > 0){
                //if data found
              //  print_r($result);
                while($row=mysqli_fetch_array($result)){


                    if($row['Test']!=null || !empty($row['Test'])){
                        array_push($data['Values'], array(
                            'id' => $row['testid'],
                            'name'=>$row['Test']
                        ));
                    }

                }
                echo json_encode($data);
                //print_r($data);

            } else{
                //data not found
                $data['Status'] ="0";
                $data['Msg']="Data not found";
                echo json_encode($data);
            }
        }

        else{
            $data['Status'] ="0";
            $data['Msg']="Not Connected";
            echo json_encode($data);
        }


    }
	
	private static function send_curl_request_pinnacle($mobile="", $msg="", $dlttemplateid):string
	
	{
		// echo $msg;
		$url = "https://api.pinnacle.in/index.php/sms/urlsms?sender=Motion&numbers=".urlencode($mobile)."&messagetype=TXT&message=".urlencode($msg)."&response=Y&apikey=c032f1-7c489c-aa1ade-0c0582-cd5644&dlttempid=".$dlttemplateid;
		
		// echo $url;
		//exit;
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 0);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		
		curl_close ($ch);

        return $server_output;
	}

    private static function send_curl_request($mobile="", $msg=""): string
    {

        //$url = "http://api.pinnacle.in/index.php/sms/send";
		//$url = "http://enterprise.smsgupshup.com/GatewayAPI/rest?method=SendMessage&send_to=".urlencode($mobile)."&msg=".urlencode($msg)."&msg_type=TEXT&userid=2000160161&auth_scheme=plain&password=Mangoshake@123&v=1.1&format=text";
		
        $url = "http://enterprise.smsgupshup.com/GatewayAPI/rest?method=SendMessage&send_to=".urlencode($mobile)."&msg=".urlencode($msg)."&msg_type=TEXT&userid=2000160161&auth_scheme=plain&password=Mangoshake@123&v=1.1&format=text&mask=MTNRSL";


        // $vars = array(
            // 'sender' => 'MOTION',
            // 'numbers' => $mobile,
            // 'message' => $msg,
            // 'messagetype'=>'TXT'
        // );
        // $headers = array(
            // 'apikey: 70e5cf-a2dc39-35927a-90f2c4-11ef20',
            // 'Content-Type: application/json',
        // );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($vars));  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_HEADER, true);
        // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $server_output = curl_exec ($ch);
        //$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $outHeaders = curl_getinfo($ch);
        //$outHeaders = array_filter($outHeaders, function($value) { return $value !== '' && $value !== ' ' && strlen($value) != 1; });

        curl_close ($ch);

        return $server_output;



    }

}
