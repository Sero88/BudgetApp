<?php

namespace App\Http\Controllers;

use App\Report;

class ReportController extends Controller
{
    public function annual(){
        $availableYears = Report::availableYears();

        return view('reports.annual', compact('availableYears'));
    }
}
