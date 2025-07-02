<?php

// namespace App\Utils;
namespace App\Http\Controllers;
use App\Utils\ExcelReadLogics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ExcelUploadController extends Controller
{
    public function upload_result_from_excel_view(Request $request)
    {
		 ini_set('memory_limit', '-1');
		 ini_set('max_execution_time', 0);
        $results = DB::select("SELECT MAX(tbl_test.id_test) AS 'ID' FROM tbl_test");

        $test_id = 1;

        if ($results != null && count($results) > 0)
        {

            foreach ($results as $rows)
            {

                $test_id = $rows->ID + 1;

            }
            $data = array(
                'title' => "Excel Upload",
                'test_id' => $test_id
            );

        }
        return view('exam-controller/excel_upload')->with($data);
    }

    public static function upload_display(Request $request)
    {
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
       
        $var = DB::table('tbl_sprresult')->where('testid', ($request->test_id))
            ->get();
             //ExcelReadLogics::excel_data_entry($request);
             //exit;
           
        if ($var->count() === 0)
        {   
            
           
            $results = DB::select("SELECT MAX(tbl_test.id_test) AS 'ID' FROM tbl_test");

            $test_id = 1;

            if ($results != null && count($results) > 0)
            {

                foreach ($results as $rows)
                {
                    $test_id = $rows->ID + 1;
                }

                $data = array(
                    'title' => "Excel Upload",
                    'test_id' => $test_id
                );
            }
            ExcelReadLogics::excel_data_entry($request);
            $res_total = DB::table('tbl_sprresult')->where('testid', ($request->test_id))
                ->get();
            $final = json_encode($res_total);
            if ($request->test_quiz_type === "NEET")
            {
                $rest_r = array(
                    'title' => $res_total[0]->testid,
                    'data' => json_decode($final, true) ,
                    'columns' => array(
                        "Roll No",
                        "MaxMarks",
                        "TotalMarks",
                        "BioTotal",
                        "PhyTotal",
                        "ChemTotal",
                        "BioObt",
                        "PhyObt",
                        "ChemObt",
                        "T%",
                        "B%",
                        "P%",
                        "C%",
                        "AIR",
                        "TR",
                        "BioRank",
                        "PhyRank",
                        "ChemRank"
                    ) ,

                    'columns_data' => array(
                        "rollno",
                        "overallmaxmarks",
                        "overallmarks",
                        "biomaxmarks",
                        "phymaxmarks",
                        "chemmaxmarks",
                        "biomarks",
                        "phymarks",
                        "chemmarks",
                        "overallpercent",
                        "biopercent",
                        "phypercent",
                        "chempercent",
                        "overallrank",
                        "overallcrank",
                        "biorank",
                        "phyrank",
                        "chemrank"
                    )
                );
            }
            elseif($request->test_quiz_type === "FOUNDATION"){
                $rest_r = array(
                    'title' => $res_total[0]->testid,
                    'data' => json_decode($final, true) ,
                    'columns' => array(
                        "Roll No",
                        "MaxMarks",
                        "TotalMarks",
                        "MathsTotal",
                        "PhyTotal",
                        "ChemTotal",
                        "BioTotal",
                        "EngTotal",
                        "HindiTotal",
                        "SstTotal",
                        "MaTotal",
                        "SkTotal",
                        "ComTotal",
                        "MathsObt",
                        "PhyObt",
                        "ChemObt",
                        "BioObt",
                        "EngObt",
                        "HindiObt",
                        "SstObt",
                        "MaObt",
                        "SkObt",
                        "ComObt",
                        "T%",
                        "M%",
                        "P%",
                        "C%",
                        "B%",
                        "Eng%",
                        "Hi%",
                        "Sst%",
                        "Ma%",
                        "Sk%",
                        "Com%",
                        "AIR",
                        "TR",
                        "MathsRank",
                        "PhyR",
                        "ChemR",
                        "BioR",
                        "EngR",
                        "HindiR",
                        "SstR",
                        "MaR",
                        "SkR",
                        "ComR",
                    ) ,

                    'columns_data' => array(
                        "rollno",
                        "overallmaxmarks",
                        "overallmarks",
                        "mathsmaxmarks",
                        "phymaxmarks",
                        "chemmaxmarks",
                        "biomaxmarks",
                        "engmaxmarks",
                        "hindimaxmarks",
                        "sstmaxmarks",
                        "mamaxmarks",
                        "skmaxmarks",
                        "commaxmarks",
                        "mathsmarks",
                        "phymarks",
                        "chemmarks",
                        "biomarks",
                        "engmarks",
                        "hindimarks",
                        "sstmarks",
                        "mamarks",
                        "skmarks",
                        "commarks",
                        "overallpercent",
                        "mathspercent",
                        "phypercent",
                        "chempercent",
                        "biopercent",
                        "engpercent",
                        "hindipercent",
                        "sstpercent",
                        "mapercent",
                        "skpercent",
                        "compercent",
                        "overallrank",
                        "overallcrank",
                        "mathsrank",
                        "phyrank",
                        "chemrank",
                        "biorank",
                        "engrank",
                        "hindirank",
                        "sstrank",
                        "marank",
                        "skrank",
                        "comrank"
                    )

                );
            }
            else
            {
                $rest_r = array(
                    'title' => $res_total[0]->testid,
                    'data' => json_decode($final, true) ,
                    'columns' => array(
                        "Roll No",
                        "MaxMarks",
                        "TotalMarks",
                        "MathsTotal",
                        "PhyTotal",
                        "ChemTotal",
                        "MathsObt",
                        "PhyObt",
                        "ChemObt",
                        "T%",
                        "M%",
                        "P%",
                        "C%",
                        "AIR",
                        "TR",
                        "MathsRank",
                        "PhyR",
                        "ChemR"
                    ) ,

                    'columns_data' => array(
                        "rollno",
                        "overallmaxmarks",
                        "overallmarks",
                        "mathsmaxmarks",
                        "phymaxmarks",
                        "chemmaxmarks",
                        "mathsmarks",
                        "phymarks",
                        "chemmarks",
                        "overallpercent",
                        "mathspercent",
                        "phypercent",
                        "chempercent",
                        "overallrank",
                        "overallcrank",
                        "mathsrank",
                        "phyrank",
                        "chemrank"
                    )

                );
            }
            // return view('exam-controller/excel_display')->with($data);
            
        }

        else
        {
           
            $res_total = DB::table('tbl_sprresult')->where('testid', ($request->test_id))
                ->get();
            $final = json_encode($res_total);
            if ($request->test_quiz_type === "NEET")
            {
                $rest_r = array(
                    'title' => $res_total[0]->testid,
                    'data' => json_decode($final, true) ,
                    'columns' => array(
                        "Roll No",
                        "MaxMarks",
                        "TotalMarks",
                        "BioTotal",
                        "PhyTotal",
                        "ChemTotal",
                        "BioObt",
                        "PhyObt",
                        "ChemObt",
                        "T%",
                        "B%",
                        "P%",
                        "C%",
                        "AIR",
                        "TR",
                        "BioRank",
                        "PhyRank",
                        "ChemRank"
                    ) ,

                    'columns_data' => array(
                        "rollno",
                        "overallmaxmarks",
                        "overallmarks",
                        "biomaxmarks",
                        "phymaxmarks",
                        "chemmaxmarks",
                        "biomarks",
                        "phymarks",
                        "chemmarks",
                        "overallpercent",
                        "biopercent",
                        "phypercent",
                        "chempercent",
                        "overallrank",
                        "overallcrank",
                        "biorank",
                        "phyrank",
                        "chemrank"
                    )
                );
            }
            elseif($request->test_quiz_type === "FOUNDATION"){
                $rest_r = array(
                    'title' => $res_total[0]->testid,
                    'data' => json_decode($final, true) ,
                    'columns' => array(
                        "Roll No",
                        "MaxMarks",
                        "TotalMarks",
                        "MathsTotal",
                        "PhyTotal",
                        "ChemTotal",
                        "BioTotal",
                        "EngTotal",
                        "HindiTotal",
                        "SstTotal",
                        "MaTotal",
                        "SkTotal",
                        "ComTotal",
                        "MathsObt",
                        "PhyObt",
                        "ChemObt",
                        "BioObt",
                        "EngObt",
                        "HindiObt",
                        "SstObt",
                        "MaObt",
                        "SkObt",
                        "ComObt",
                        "T%",
                        "M%",
                        "P%",
                        "C%",
                        "B%",
                        "Eng%",
                        "Hi%",
                        "Sst%",
                        "Ma%",
                        "Sk%",
                        "Com%",
                        "AIR",
                        "TR",
                        "MathsRank",
                        "PhyR",
                        "ChemR",
                        "BioR",
                        "EngR",
                        "HindiR",
                        "SstR",
                        "MaR",
                        "SkR",
                        "ComR",
                    ) ,

                    'columns_data' => array(
                        "rollno",
                        "overallmaxmarks",
                        "overallmarks",
                        "mathsmaxmarks",
                        "phymaxmarks",
                        "chemmaxmarks",
                        "biomaxmarks",
                        "engmaxmarks",
                        "hindimaxmarks",
                        "sstmaxmarks",
                        "mamaxmarks",
                        "skmaxmarks",
                        "commaxmarks",
                        "mathsmarks",
                        "phymarks",
                        "chemmarks",
                        "biomarks",
                        "engmarks",
                        "hindimarks",
                        "sstmarks",
                        "mamarks",
                        "skmarks",
                        "commarks",
                        "overallpercent",
                        "mathspercent",
                        "phypercent",
                        "chempercent",
                        "biopercent",
                        "engpercent",
                        "hindipercent",
                        "sstpercent",
                        "mapercent",
                        "skpercent",
                        "compercent",
                        "overallrank",
                        "overallcrank",
                        "mathsrank",
                        "phyrank",
                        "chemrank",
                        "biorank",
                        "engrank",
                        "hindirank",
                        "sstrank",
                        "marank",
                        "skrank",
                        "comrank"
                    )

                );
            }
            else
            {
                $rest_r = array(
                    'title' => $res_total[0]->testid,
                    'data' => json_decode($final, true) ,
                    'columns' => array(
                        "Roll No",
                        "MaxMarks",
                        "TotalMarks",
                        "MathsTotal",
                        "PhyTotal",
                        "ChemTotal",
                        "MathsObt",
                        "PhyObt",
                        "ChemObt",
                        "T%",
                        "M%",
                        "P%",
                        "C%",
                        "AIR",
                        "TR",
                        "MathsRank",
                        "PhyRank",
                        "ChemRank"
                    ) ,

                    'columns_data' => array(
                        "rollno",
                        "overallmaxmarks",
                        "overallmarks",
                        "mathsmaxmarks",
                        "phymaxmarks",
                        "chemmaxmarks",
                        "mathsmarks",
                        "phymarks",
                        "chemmarks",
                        "overallpercent",
                        "mathspercent",
                        "phypercent",
                        "chempercent",
                        "overallrank",
                        "overallcrank",
                        "mathsrank",
                        "phyrank",
                        "chemrank"
                    )

                );
            }
            // return view('result_display')->with($rest_r);
            
        }
        
        return view('result_display')->with($rest_r);
    }
}

