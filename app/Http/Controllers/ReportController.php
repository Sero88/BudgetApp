<?php

namespace App\Http\Controllers;

use App\Report;
use App\ReportValidator;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function annualReport( $year = null){
        if( empty($year) ){
            $year = Carbon::now()->year;
        } else{
            $year = ReportValidator::validateYear($year);
        }

        Report::annual($year);
    }
}
