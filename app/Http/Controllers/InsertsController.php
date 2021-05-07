<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Insert;
use Carbon\Carbon;

class InsertsController extends Controller
{
    public function insert(){
        return view('insert');
    }

    public function uploadFile(Request $request){

        if ($request->input('submit') != null ){

            $file = $request->file('file');

            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // 2MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){

                // Check file size
                if($fileSize <= $maxFileSize){

                    // File upload location
                    $location = 'uploads';

                    // Upload file
                    $file->move($location,$filename);

                    // Import CSV to Database
                    $filepath = public_path($location."/".$filename);

                    // Reading file
                    $file = fopen($filepath,"r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata );
                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // Insert to MySQL database
                    foreach($importData_arr as $importData){

                        // print_r($filename);
                        // dd($importData);

                        if ($filename == "candidates.csv") {
                            $insertData = array(
                                "id"         => $importData[0],
                                "first_name" => $importData[1],
                                "last_name"  => $importData[2],
                                "email"      => $importData[3]
                            );
                            Insert::insertData($insertData, $filename);
                        }
                        else if ($filename == "jobs.csv") {

                            $id = $importData[0];
                            $former_employee = $importData[1];
                            $job_title = $importData[2];
                            $company_name = $importData[3];

                            $start_date = $importData[4];
                            $end_date   = $importData[5];

                            // $start_date = Carbon::parse($importData[4]);
                            // $end_date   = Carbon::parse($importData[5]);

                            // format date for sql insert
                            $start_date = date("Y-m-d H:i:s", strtotime($importData[4]));
                            $end_date   = date("Y-m-d H:i:s", strtotime($importData[5]));

                            // dd($importData);
                            // dd(
                            //     $importData[4],
                            //     $start_date,
                            //     $importData[5],
                            //     $end_date,
                            // );

                            $insertData = array(
                                "id"=> $id,
                                "former_employee"=> $former_employee,
                                "job_title"=> "'" . $job_title . "'",
                                "company_name"=> "'" . $company_name . "'",
                                "start_date"=> $start_date,
                                "end_date"=> $end_date,
                            );

                            // dd($insertData);

                            // $importData = str_replace(' ', '', $importData);
                            // $importData = preg_replace('/\s+/', '', $importData);

                            Insert::insertData($insertData, $filename);
                        }
                        else {
                            sprintf("Unknow scv file.");
                        }

                        // print_r($importData);
                        // var_dump($importData);
                    }

                    Session::flash('message','Import Successful.');
                }
                else {
                    Session::flash('message','File too large. File must be less than 2MB.');
                }

            }
            else {
                Session::flash('message','Invalid File Extension.');
            }

        }

        // Redirect to insert page
        return redirect()->action('InsertsController@insert');
    }

}
