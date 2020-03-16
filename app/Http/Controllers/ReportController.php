<?php

namespace App\Http\Controllers;

use App\Error;
use App\Report;
use App\Validator;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function annualReport( $year = null){
        if( empty($year) ){
            $year = Carbon::now()->year;
        } else{
            $year = Validator::validateNumber($year);
        }

        return $year ? Report::annual($year) : Error::showError(400, 'Invalid input. Year must be a number');
    }

    public function  monthlyReport($year = null, $month = null){
        $year = Validator::validateNumber($year);
        $month = Validator::validateNumber($month);

        return $month && $year ? Report::monthly($year, $month) : Error::showError(400, 'Invalid input. Year and month must be a number.');
    }
}
