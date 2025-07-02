<?php


namespace App\Utils;

use phpDocumentor\Reflection\Types\Self_;
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class AppLogicsUtils
{

    public static function read_excel_file($path): array
    {

        /**  result array for fetching and displaying data objects fetched  **/
        $res = array();

        try {
            /**  Identify the type of $inputFileName  **/
            $inputFileType = IOFactory::identify($path);

            /**  Create a new Reader of the type that has been identified  **/
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

            /**  Load $inputFileName to a Spreadsheet Object  **/
            $spreadsheet = $reader->load($path);

            $worksheet = $spreadsheet->getActiveSheet();

            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);


            /**  Key value defined for each kinda of rows such as Questions, Positive Marks, Negative Marks, Roll No  **/
            $title ="0";


            /**  Started Reading of Excel file and storing the data into respective dynamically generated arrays  **/
            for($row=1; $row <= $highestRow ; $row++){

                if ($row<6 || $row>6){

                    for($col = 1; $col <= $highestColumnIndex; $col++){

                        if ($col===1){

                            $title = strtoupper($worksheet->getCellByColumnAndRow($col,$row)->getValue());
                            $res[$title] = array();
                        }
                        else{

                            $value = $worksheet->getCellByColumnAndRow($col,$row)->getValue();
                            array_push($res[$title],array(
                                'Values' => $value
                            ));

                        }

                    }
                }

            }

        }

        catch (Exception $e){

            print_r($e);

        }

        return $res;

    }

    public static function read_upload_excel_file($path): array
    {


        $res = array();

        try {
            $inputFileType = IOFactory::identify($path);

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $spreadsheet = $reader->load($path);

            $worksheet = $spreadsheet->getActiveSheet();

            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

            // dd($highestRow/, $highestColumn, $highestColumnIndex);
            $columns = array('rollno', 'mathsmarks', 'mathspercent', 'mathsrank', 'phymarks', 'phypercent',
                    'phyrank', 'chemmarks', 'chempercent', 'chemrank', 'overallmarks', 'overallpercent',
                    'overallrank', 'overallcrank', 'overallmaxmarks', 'mathsmaxmarks', 'phymaxmarks', 'chemmaxmarks',
                    'biomarks', 'engmarks', 'hindimarks', 'sstmarks', 'mamarks', 'biopercent', 'engpercent',
                    'hindipercent', 'sstpercent', 'mapercent', 'biomaxmarks', 'engmaxmarks', 'hindimaxmarks',
                    'sstmaxmarks', 'mamaxmarks', 'biorank', 'engrank', 'hindirank', 'sstrank', 'marank',
                    'skmarks', 'skpercent', 'skmaxmarks', 'skrank', 'commarks', 'compercent',
                    'commaxmarks', 'comrank', 'starperformer');

            /**  Key value defined for each kinda of rows such as Questions, Positive Marks, Negative Marks, Roll No  **/
            $title ="0";

            /**  Started Reading of Excel file and storing the data into respective dynamically generated arrays  **/
            for($row=1; $row <= $highestRow ; $row++){

                    for($col = 1; $col <= $highestColumnIndex; $col++){

                        if ($col===1){

                            $title = $worksheet->getCellByColumnAndRow($col,$row)->getValue();
                            $res[$title] = array();
                        }
                        else{

                            $value = $worksheet->getCellByColumnAndRow($col,$row)->getValue();
                            array_push($res[$title], array($columns[$col-1] => $value));

                        }

                }



            }

        }

        catch (Exception $e){

            print_r($e);

        }

        return $res;

    }
	public static function read_excel_file_for_advance($path): array
    {

        /**  result array for fetching and displaying data objects fetched  **/
        $res = array();

        try {
            /**  Identify the type of $inputFileName  **/
            $inputFileType = IOFactory::identify($path);


            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);


            $spreadsheet = $reader->load($path);

            $worksheet = $spreadsheet->getActiveSheet();

            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);


            /**  Key value defined for each kinda of rows such as Questions, Positive Marks, Negative Marks, Roll No  **/
            $title ="0";


            /**  Started Reading of Excel file and storing the data into respective dynamically generated arrays  **/
            for($row=1; $row <= $highestRow ; $row++){

                if ($row<6 || $row>=6){

                    for($col = 1; $col <= $highestColumnIndex; $col++){

                        if ($col===1){

                            $title = strtoupper($worksheet->getCellByColumnAndRow($col,$row)->getValue());
                            $res[$title] = array();
                        }
                        else{

                            $value = $worksheet->getCellByColumnAndRow($col,$row)->getValue();
                            array_push($res[$title],array(
                                'Values' => $value
                            ));

                        }

                    }
                }

            }

        }

        catch (Exception $e){

            print_r($e);

        }

        return $res;

    }

    public static function return_roll_numbers($arr=array()): array
    {

        return self::return_key_values($arr, true);

    }

    public static function return_roll_numbers_excel($arr=array()): array
    {

        return self::return_key_values_excel($arr, true);

    }

    public static function return_specific_array($arr=array(), $keys=array(), $is_SUB=false): array
    {
        $output_arr['Result'] = array();

        if ($is_SUB){
            foreach($keys as $key) {

                foreach ($arr[strtoupper($key)] as $rows){

                    array_push($output_arr['Result'], ($rows['Values']));

                }
            }
            return array_unique($output_arr['Result']);
        }
        else{
            foreach($keys as $key) {
                foreach ($arr[$key] as $rows){
                    array_push($output_arr['Result'], ($rows['Values']));

                }
            }
            return $output_arr['Result'];
        }


    }


    public static function return_specific_array_excel($arr=array(), $keys=array(), $is_SUB=false): array
        {
            $output_array = array();
            $output_array[$keys[0]] = array();
            $values = $arr[$keys[0]];
            foreach($values as $key) {

                    array_push($output_array[$keys[0]], $key);


            }
            return $output_array;

        }



    /**  All private methods are defined below  *
     * @param array $arr
     * @param bool $roll
     * @return array
     */
    private static function return_key_values($arr = array(), $roll=false): array
    {
        $temp_res = array();
        if ($roll){

            for ($i=5; $i<count(array_keys($arr)); $i++):

                array_push($temp_res, array_keys($arr)[$i]);

            endfor;

            return $temp_res;

        }

        return $temp_res;
    }

    private static function return_key_values_excel($arr = array(), $roll=false): array
    {
        $temp_res = array();
        if ($roll){

            for ($i=1; $i<count(array_keys($arr)); $i++):

                array_push($temp_res, array_keys($arr)[$i]);

            endfor;

            return $temp_res;

        }

        return $temp_res;
    }





}
