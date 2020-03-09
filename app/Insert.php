<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Insert extends Model
{
    public static function insertData($data, $filename) {

        echo "<pre>";
        print_r($data);
        // var_dump($data);
        print_r($filename);
        // var_dump($filename);
        echo "</pre>";

        if ($filename == "candidates.csv") {
            $value=DB::table('candidates')->where('email', $data['email'])->get();
            if($value->count() == 0){
                DB::table('candidates')->insert($data);
            }
        }
        else {
            $value=DB::table('jobs')->where('job_title', $data['job_title'])->get();
            if($value->count() == 0){
                DB::table('jobs')->insert($data);
            }
        }
        
    }
}


