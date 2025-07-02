<?php

namespace App\Http\Controllers;

use Artisan;
use App\Utils\SecondaryDBControls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ThrowOnline extends Controller
{

    public function put_online_view(Request $request){

        $test_data = json_encode(DB::table('tbl_test')->orderBy('id_test', 'desc')->get());


        $data = array(
            'title' => 'Put Online',
            'test_data' => json_decode($test_data, true),
        );

        return view('exam-controller/put_online')->with($data);

    }

    public function view_test_data(Request $request){
        $res_total = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))->get();
        $final = json_encode($res_total);
        $stream = $res_total[0]->stream;
        //dd($stream);
        switch ($stream){

        case "AIEEE":
            $rest_r = array(
            'title' => $res_total[0]->testid,
            'data' => json_decode($final, true),
            'columns' => array("Roll No", "MaxMarks", "TotalMarks", "MathsTotal", "PhyTotal", "ChemTotal",
                            "MathsObt", "PhyObt", "ChemObt", "T%", "M%", "P%", "C%",
                            "AIR", "TR", "MathsRank", "PhysicsRank", "ChemRank"
                            ),

            'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "mathsmaxmarks", "phymaxmarks", "chemmaxmarks",
                            "mathsmarks", "phymarks", "chemmarks", "overallpercent", "mathspercent", "phypercent", "chempercent",
                            "overallrank", "overallcrank", "mathsrank", "phyrank", "chemrank"
            )
        );
            return view('result_display')->with($rest_r);
            break;
        case "NEET":
            // dd($final);
            $rest_r = array(
            'title' => $res_total[0]->testid,
            'data' => json_decode($final, true),
            'columns' => array("Roll No", "MaxMarks", "TotalMarks", "BioTotal", "PhyTotal", "ChemTotal",
                            "BioObt", "PhyObt", "ChemObt", "T%", "B%", "P%", "C%",
                            "AIR", "TR", "BioRank", "PhyRank", "ChemRank"
                            ),

            'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "biomaxmarks", "phymaxmarks", "chemmaxmarks", "biomarks",
                            "phymarks", "chemmarks", "overallpercent", "biopercent", "phypercent", "chempercent",
                            "overallrank", "overallcrank", "biorank", "phyrank", "chemrank"
            )
        );
             return view('result_display')->with($rest_r);
             break;

            case "NEET_NEW":
                // dd($final);
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

		case "FOUNDATION":
            $rest_r = array(
            'title' => $res_total[0]->testid,
            'data' => json_decode($final, true),
            'columns' => array("Roll No", "MaxMarks", "TotalMarks", "MathsTotal", "PhyTotal", "ChemTotal","BioTotal","SSTTotal","EngTotal","HindiTotal","MathsObt", "PhyObt", "ChemObt", "BioObt","SSTObt","EngObt","HindiObt", "T%", "M%", "P%", "C%","B%", "S%", "E%","H%","AIR", "TR", "MathsRank", "PhysicsRank", "ChemRank","BioRank", "SSTRank", "EngRank", "HindiRank"
                            ),

            'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "mathsmaxmarks", "phymaxmarks", "chemmaxmarks","biomaxmarks", "sstmaxmarks", "engmaxmarks", "hindimaxmarks","mathsmarks", "phymarks", "chemmarks","biomarks", "sstmarks", "engmarks","hindimarks", "overallpercent", "mathspercent", "phypercent", "chempercent","biopercent", "sstpercent", "engpercent", "hindipercent","overallrank", "overallcrank", "mathsrank", "phyrank", "chemrank", "biorank", "sstrank", "engrank", "hindirank"
            )
        );
            return view('result_display')->with($rest_r);
            break;
			
			
		case "COMBINED":
            $rest_r = array(
            'title' => $res_total[0]->testid,
            'data' => json_decode($final, true),
            'columns' => array("Roll No", "MaxMarks", "TotalMarks", "MathsTotal", "PhyTotal", "ChemTotal",
                            "MathsObt", "PhyObt", "ChemObt", "T%", "M%", "P%", "C%",
                            "AIR", "TR", "MathsRank", "PhysicsRank", "ChemRank"
                            ),

            'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "mathsmaxmarks", "phymaxmarks", "chemmaxmarks",
                            "mathsmarks", "phymarks", "chemmarks", "overallpercent", "mathspercent", "phypercent", "chempercent",
                            "overallrank", "overallcrank", "mathsrank", "phyrank", "chemrank"
            )
        );
            return view('result_display')->with($rest_r);
            break;
			
		case "IIT":
            $rest_r = array(
            'title' => $res_total[0]->testid,
            'data' => json_decode($final, true),
            'columns' => array("Roll No", "MaxMarks", "TotalMarks", "MathsTotal", "PhyTotal", "ChemTotal",
                            "MathsObt", "PhyObt", "ChemObt", "T%", "M%", "P%", "C%",
                            "AIR", "TR", "MathsRank", "PhysicsRank", "ChemRank"
                            ),

            'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "mathsmaxmarks", "phymaxmarks", "chemmaxmarks",
                            "mathsmarks", "phymarks", "chemmarks", "overallpercent", "mathspercent", "phypercent", "chempercent",
                            "overallrank", "overallcrank", "mathsrank", "phyrank", "chemrank"
            )
        );
            return view('result_display')->with($rest_r);
            break;	
			
			
			default: 
			
			dd("Not Defined");
        }

    }

    public function delete_testid_data(Request $request){
        // dd($request->session()->get('test_id'));

        $res = DB::table('tbl_test')->where('id_test', $request->test_id)->delete();
        $res1 = DB::table('tbl_sprresult')->where('testid', $request->test_id)->delete();
        $res2 = DB::table('tbl_omr_data')->where('id_test', $request->test_id)->delete();
		$res3 = DB::table('quiztable')->where('quizid', $request->test_id)->delete();
		$res4 = DB::table('tbl_test_analysis')->where('testid', $request->test_id)->delete();
		$res5 = DB::table('tbl_result')->where('testid', $request->test_id)->delete();
		$res6 = SecondaryDBControls::delete_test_data($request->test_id);

        $test_data = json_encode(DB::table('tbl_test')->orderBy('id_test', 'desc')->get());

        $data = array(
            'title' => 'Put Online',
            'test_data' => json_decode($test_data, true),
        );
        // return(put_online_view($request));
        // return back();
        return view('exam-controller/put_online')->with($data);

    }

    public function data_download(Request $request){
        $year   =   explode('-', $request->id);
        // Artisan::call('cache:clear');
        // Artisan::call('config:cache');
        ini_set('memory_limit', '-1');
		//dd(DB::connection('manish'));
        $test_data = DB::connection('manish')
                    //->leftJoin('product_images', 'products.p_id', '=', 'product_images.p_id')
                    ->select("SELECT Rollno,dob, StudentName, FatherName,mothername,strGender, Course,batch ,strclass,strtarget,strmedium,strphase,strstate,strdistrict,center,programtype FROM `student_master`
where rollno is not null  and (rollno like '".$year[0]."%' or rollno like '".$year[1]."%' )   order by rollno desc, center desc limit 5000");                              

            $test_data   = json_decode(json_encode($test_data), true);
            
        
        $data = array(
            'title' => 'Student Data',
            'test_data' => $test_data
        );

        return view('exam-controller/data_download')->with($data);

    }


    public function put_online(Request $request): string
    {
        ini_set('memory_limit', '-1');

        $test_id = $request->post('test_id');
        $stream = $request->post('test_stream');
		$is_upload_excel = $request->post('is_upload_excel');
        if (!$is_upload_excel == 1){
            $res1= SecondaryDBControls::insert_into_spr_result($test_id);
            $res2 = SecondaryDBControls::insert_into_quiztable_erp($test_id);
            $res3 = SecondaryDBControls::insert_into_tbl_result($test_id);
            return SecondaryDBControls::insert_into_tbl_test_analysis($test_id);
            //return $res1;
        }
    else{

        return SecondaryDBControls::insert_into_spr_result($test_id);
            }
    }
}


