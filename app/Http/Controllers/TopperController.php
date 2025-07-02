<?php


namespace App\Http\Controllers;


use App\Utils\SecondaryDBControls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class TopperController extends Controller {
	
	public function generate_pdf_view(Request $request){
		
		
        $data = array(
            'title' => 'PDF View'
        );
		return view('exam-controller/topten')->with($data);
	}

    public function generate_pdf(Request $request){

        $data = array(
            'title' => 'PDF View'
        );
		
            if ($request->post('test_id')){
					$qr = "select * from tbl_sprresult where testid = '".$request->post('test_id')."' order by overallmarks desc limit 0,10" ;
				
				$data2 = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))-> orderBy('overallmarks', 'DESC')->limit(10)->get();
				$data3 = DB::table('quiztable')->where('quizid', $request->session()->get('test_id'))->get();
				// dd($data3);
				
				$rest_r = array(
                'title' => $request->session()->get('test_id'),
				'test_id' => $request->session()->get('test_id'),
				'data0' => json_decode($data3, true),
                'data' => json_decode($data2, true),
				
                'columns' => array("Roll No", "MaxMarks", "TotalMarks", "MathsTotal", "PhyTotal", "ChemTotal", 
                                "MathsObt", "PhyObt", "ChemObt", "T%", "M%", "P%", "C%",
                                "AIR", "ClassRank", "MathsRank", "PhyRank", "ChemRank"
                                ),

                'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "mathsmaxmarks", "phymaxmarks", "chemmaxmarks", 
                                "mathsmarks", "phymarks", "chemmarks", "overallpercent", "mathspercent", "phypercent", "chempercent",
                                "overallrank", "overallcrank", "mathsrank", "phyrank", "chemrank"
                ),
				"columns1" => array("QNo", "Subject", "Correct Answer"),
				"columns1_data" => array("questionnumber", "subject", "correct")
            );
			  $request->session()->put('test_id', $request->post('test_id'));
			 
            return view('pdf_display')->with($rest_r);
			
			
			
    }
	}
	
	public function createPDF(Request $request) {
		$data2 = DB::table('tbl_sprresult')->where('testid', $request->session()->get('test_id'))-> orderBy('overallmarks', 'DESC')->limit(10)->get();
		
		$data3 = DB::table('quiztable')->where('quizid', $request->session()->get('test_id'))->get();
		
		
				
		$rest_r = array(
                'title' => 'sj',
                'data' => json_decode($data2, true),
				'data0' => json_decode($data3, true),
                'columns' => array("Roll No", "MaxMarks", "TotalMarks", "MathsTotal", "PhyTotal", "ChemTotal", 
                                "MathsObt", "PhyObt", "ChemObt", "T%", "M%", "P%", "C%",
                                "AIR", "ClassRank", "MathsRank", "PhyRank", "ChemRank"
                                ),

                'columns_data' => array("rollno", "overallmaxmarks", "overallmarks", "mathsmaxmarks", "phymaxmarks", "chemmaxmarks", 
                                "mathsmarks", "phymarks", "chemmarks", "overallpercent", "mathspercent", "phypercent", "chempercent",
                                "overallrank", "overallcrank", "mathsrank", "phyrank", "chemrank"
                ),
				
				"columns1" => array("QNo", "Subject", "Correct Answer"),
				"columns1_data" => array("questionnumber", "subject", "correct")
            );
	  view()->share('rest_r',$rest_r);
    

      $pdf = PDF::loadView('pdf_display', $rest_r);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
	}

}