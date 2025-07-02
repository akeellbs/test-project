<?php


namespace App\Utils;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExcelReadLogics
{
    public static function excel_data_entry(Request $request){
        if ($request->hasFile('file_upload')){
            $path = base_path()."/storage/app/".$request->file('file_upload')->store('file_upload');
        }
        else{
            /**  In case if the value of file is null  **/
            echo 'No File Is Selected';
        }
        
        $test_id = DB::table('tbl_test')->insertGetId([
                'id_test' => $request->test_id,
                'id_exams' => 2,
                'test_class' => $request->test_class,
                'test_date' => $request->test_date,
                'test_name' => strtoupper($request->test_name),
                'test_pattern' => 'OMR',
                'test_target_rank' => $request->test_target_rank,
                'test_excel_file_path' => $path,
				'test_stream' => $request->post('test_quiz_type'),
				'test_type' => $request->post('test_type'),
				'is_upload_excel' => 1
            ]);
       

        $columns = array('rollno', 'mathsmarks', 'mathspercent', 'mathsrank', 'phymarks', 'phypercent', 
                    'phyrank', 'chemmarks', 'chempercent', 'chemrank', 'overallmarks', 'overallpercent', 
                    'overallrank', 'overallcrank', 'overallmaxmarks', 'mathsmaxmarks', 'phymaxmarks', 'chemmaxmarks', 
                    'biomarks', 'engmarks', 'hindimarks', 'sstmarks', 'mamarks', 'biopercent', 'engpercent', 
                    'hindipercent', 'sstpercent', 'mapercent', 'biomaxmarks', 'engmaxmarks', 'hindimaxmarks', 
                    'sstmaxmarks', 'mamaxmarks', 'biorank', 'engrank', 'hindirank', 'sstrank', 'marank', 
                    'skmarks', 'skpercent', 'skmaxmarks', 'skrank', 'commarks', 'compercent', 
                    'commaxmarks', 'comrank', 'starperformer');
		//$result[] = array();
		$read_excel = AppLogicsUtils::read_upload_excel_file($path);
        $roll_no_arr = (AppLogicsUtils::return_roll_numbers_excel($read_excel));
		//dd($roll_no_arr);
        foreach ($roll_no_arr as $roll_nos){
            $roll_no_data = (AppLogicsUtils::return_specific_array_excel($read_excel, array($roll_nos), false));
            $result[$roll_nos] = array();

           for ($i=0; $i<46; $i++){
                $result[$roll_nos][$columns[$i+1]] =  $roll_no_data[$roll_nos][$i][$columns[$i+1]];
            } 
			// dd($result[$roll_nos]);
           
            $r = $result[$roll_nos] ;
            $paper_id = DB::table('tbl_sprresult')->insertGetId([
                'rollno'            =>  $roll_nos,
                'testid'            =>  $request->test_id,
                'overallmarks'      =>  $r['overallmarks'],
                'stream'            =>  $request->test_quiz_type,
                'class'             =>  $request->test_class,
				'testdate'          =>  $request->test_date,
				'testname'          =>  $request->test_name,
                'overallmaxmarks'   =>  !empty($r['overallmaxmarks']) ? $r['overallmaxmarks'] : 0,
                'overallpercent'    =>  !empty($r['overallpercent']) ? $r['overallpercent'] : 0 ,
                'mathsmaxmarks'     =>  !empty($r['mathsmaxmarks']) ?  $r['mathsmaxmarks'] : 0 ,
                'phymaxmarks'       =>  !empty($r['phymaxmarks']) ?  $r['phymaxmarks'] : 0 ,
                'chemmaxmarks'      =>  !empty($r['chemmaxmarks']) ?  $r['chemmaxmarks'] : 0 ,
                'mathsmarks'        =>  !empty($r['mathsmarks']) ?  $r['mathsmarks'] : 0 ,
                'phymarks'          =>  !empty($r['phymarks']) ?  $r['phymarks'] : 0 ,
                'chemmarks'         =>  !empty($r['chemmarks']) ?  $r['chemmarks'] : 0 ,
                'mathspercent'      =>  !empty($r['mathspercent']) ?  $r['mathspercent'] : 0 ,
                'phypercent'        =>  !empty($r['phypercent']) ?  $r['phypercent'] : 0 ,
                'chempercent'       =>  !empty($r['chempercent']) ?  $r['chempercent'] : 0 ,
                'overallrank'       =>  !empty($r['overallrank']) ?  $r['overallrank'] : 0 ,
                'overallcrank'      =>  !empty($r['overallcrank']) ?  $r['overallcrank'] : 0 ,
                'biomaxmarks'       =>  !empty($r['biomaxmarks']) ?  $r['biomaxmarks'] : 0 ,
                'biomarks'          =>  !empty($r['biomarks']) ? $r['biomarks'] : 0  ,
                'biopercent'        =>  !empty($r['biopercent']) ? $r['biopercent'] : 0  ,
                'biorank'           =>  !empty($r['biorank']) ?  $r['biorank'] : 0 ,
                'phyrank'           =>  !empty($r['phyrank']) ?  $r['phyrank'] : 0 ,
                'mathsrank'         =>  !empty($r['mathsrank']) ?  $r['mathsrank'] : 0 ,
                'chemrank'          =>  !empty($r['chemrank']) ?  $r['chemrank'] : 0 ,
                'engmarks'          =>  !empty($r['engmarks']) ?  $r['engmarks'] : 0 ,
                'hindimarks'        =>  !empty($r['hindimarks']) ?  $r['hindimarks'] : 0 ,
                'sstmarks'          =>  !empty($r['sstmarks']) ?  $r['sstmarks'] : 0 ,
                'mamarks'           =>  !empty($r['mamarks']) ?  $r['mamarks'] : 0 ,
                'skmarks'           =>  !empty($r['skmarks']) ?  $r['skmarks'] : 0 ,
                'commarks'          =>  !empty($r['commarks']) ?  $r['commarks'] : 0 ,
                'engpercent'        =>  !empty($r['engpercent']) ?  $r['engpercent'] : 0 ,
                'hindipercent'      =>  !empty($r['hindipercent']) ?  $r['hindipercent'] : 0 ,
                'sstpercent'        =>  !empty($r['sstpercent']) ?  $r['sstpercent'] : 0 ,
                'mapercent'         =>  !empty($r['mapercent']) ?  $r['mapercent'] : 0 ,
                'skpercent'         =>  !empty($r['skpercent']) ?  $r['skpercent'] : 0 ,
                'compercent'        =>  !empty($r['compercent']) ?  $r['compercent'] : 0 ,
                'engmaxmarks'       =>  !empty($r['engmaxmarks']) ?  $r['engmaxmarks'] : 0 ,
                'hindimaxmarks'     =>  !empty($r['hindimaxmarks']) ?  $r['hindimaxmarks'] : 0 ,
                'sstmaxmarks'       =>  !empty($r['sstmaxmarks']) ?  $r['sstmaxmarks'] : 0 ,
                'mamaxmarks'        =>  !empty($r['mamaxmarks']) ?  $r['mamaxmarks'] : 0 ,
                'skmaxmarks'        =>  !empty($r['skmaxmarks']) ?  $r['skmaxmarks'] : 0 ,
                'commaxmarks'       =>  !empty($r['commaxmarks']) ?  $r['commaxmarks'] : 0 ,
                'engrank'           =>  !empty($r['engrank']) ?  $r['engrank'] : 0 ,
                'hindirank'         =>  !empty($r['hindirank']) ?  $r['hindirank'] : 0 ,
                'sstrank'           =>  !empty($r['sstrank']) ? $r['sstrank'] : 0 ,
                'marank'            =>  !empty($r['marank']) ? $r['marank'] : 0 , 
                'skrank'            =>  !empty($r['skrank']) ? $r['skrank'] : 0 ,
                'comrank'           =>  !empty($r['comrank']) ? $r['comrank'] : 0 ,
                'expectedrank'      =>  '',
				'mode'              =>  "OMR",
                'type'              =>  $request->test_quiz_type,
            ]);
			
			// print_r($paper_id);
            
            
        }
		
		 // dd($result);
            
            // $dataAvg        = DB::Select("select max(mathsmarks) maths, max(phymarks) phy, max(chemmarks) chem, max(biomarks) bio, max(engmarks) eng, max(hindimarks) hindi, max(sstmarks) sst, max(mamarks) ma, max(skmarks) sk, max(commarks) com, avg(mathsmarks) mathsaverage, avg(phymarks) phyaverage, avg(chemmarks) chemaverage, avg(biomarks) bioaverage,avg(engmarks) engaverage, avg(hindimarks) hindiaverage, avg(sstmarks) sstaverage, avg(mamarks) maaverage, avg(skmarks) skaverage, avg(commarks) comaverage, avg(overallmarks) overallaverage, max(overallmarks) overallhighest, count(rollno) student_nos from tbl_sprresult WHERE testid = '".$request->test_id."'");


            // $maths_highest      =   $dataAvg[0]->maths;
            // $phy_highest        =   $dataAvg[0]->phy;
            // $chem_highest       =   $dataAvg[0]->chem;
            // $bio_highest        =   $dataAvg[0]->bio;
            // $enghighest         =   $dataAvg[0]->eng;
            // $hindihighest       =   $dataAvg[0]->hindi;
            // $ssthighest         =   $dataAvg[0]->sst;
            // $mahighest          =   $dataAvg[0]->ma;
            // $skhighest          =   $dataAvg[0]->sk;
            // $comhighest         =   $dataAvg[0]->com;

            // $maths_average      =   $dataAvg[0]->mathsaverage;
            // $phy_average        =   $dataAvg[0]->phyaverage;
            // $chem_average       =   $dataAvg[0]->chemaverage;
            // $bio_average        =   $dataAvg[0]->bioaverage;
            // $engaverage         =   $dataAvg[0]->engaverage;
            // $hindiaverage       =   $dataAvg[0]->hindiaverage;
            // $sstaverage         =   $dataAvg[0]->sstaverage;
            // $maaverage          =   $dataAvg[0]->maaverage;
            // $skaverage          =   $dataAvg[0]->skaverage;
            // $comaverage         =   $dataAvg[0]->comaverage;

            // $overall_average    =   $dataAvg[0]->overallaverage;
            // $overall_highest    =   $dataAvg[0]->overallhighest;
            // $student_appeared   =   $dataAvg[0]->student_nos;



            // $affected = DB::table('tbl_sprresult')
                        // ->where([['testid', $request->test_id]])
                        // ->update( array(
                                        // 'mathshighest'      => $maths_highest,
                                        // 'phyhighest'        => $phy_highest,
                                        // 'chemhighest'       => $chem_highest,
                                        // 'biohighest'        => $bio_highest,
                                        // 'enghighest'        => $enghighest,
                                        // 'hindihighest'      => $hindihighest,
                                        // 'ssthighest'        => $ssthighest,
                                        // 'mahighest'         => $mahighest,
                                        // 'skhighest'         => $skhighest,
                                        // 'comhighest'        => $comhighest,
                                        // 'mathsaverage'      => $maths_average,
                                        // 'phyaverage'        => $phy_average,
                                        // 'chemaverage'       => $chem_average,
                                        // 'bioaverage'        => $bio_average,
                                        // 'engaverage'        => $engaverage,
                                        // 'hindiaverage'      => $hindiaverage,
                                        // 'sstaverage'        => $sstaverage,
                                        // 'maaverage'         => $maaverage,
                                        // 'skaverage'         => $skaverage,
                                        // 'comaverage'        => $comaverage,

                                        // 'overallhighest'    => $overall_highest,
                                        // 'overallaverage'    => $overall_average,
                                        // 'studentsappeared'  => $student_appeared,
                                        // 'paper'             => $request->paper_type
                                    // )
                                // );
           // dd(
           // dd(DB::getQueryLog()); exit;







/*



            $maths_highest = DB::select("select max(mathsmarks) maths from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->maths;
            $phy_highest   = DB::select("select max(phymarks) phy from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->phy;
            $chem_highest  = DB::select("select max(chemmarks) chem from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->chem;
            $bio_highest   = DB::select("select max(biomarks) bio from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->bio;
        
            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['mathshighest' => $maths_highest]
                );

            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['phyhighest' => $phy_highest]
                );

            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['chemhighest' => $chem_highest]
                );

            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['biohighest' => $bio_highest]
                );
               
        

            $maths_average = DB::select("select avg(mathsmarks) mathsaverage from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->mathsaverage;
            $phy_average = DB::select("select avg(phymarks) phyaverage from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->phyaverage;
            $chem_average = DB::select("select avg(chemmarks) chemaverage from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->chemaverage;
            $bio_average = DB::select("select avg(biomarks) bioaverage from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->bioaverage;
             
            // dd($maths_highest, $phy_highest, $chem_highest, $bio_highest);
            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['mathsaverage' => $maths_average]
                );

            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['phyaverage' => $phy_average]
                );

            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['chemaverage' => $chem_average]
                );

            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['bioaverage' => $bio_average]
                );
        
           
            $overall_average = DB::select("select avg(overallmarks) overallaverage from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->overallaverage;
            $overall_highest = DB::select("select max(overallmarks) overallhighest from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->overallhighest;
            $student_appeared = DB::select("select count(rollno) student_nos from tbl_sprresult WHERE testid = '".$request->test_id."'")[0]->student_nos;

            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['overallhighest' => $overall_highest]
                );

            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['overallaverage' => $overall_average]
                );

            $affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['studentsappeared' => $student_appeared]
                );
				
			$affected = DB::table('tbl_sprresult')
                ->where([
                    ['testid', $request->test_id]
                ])
                ->update(
                    ['paper' => $request->paper_type]
                );
        */

    }
}


