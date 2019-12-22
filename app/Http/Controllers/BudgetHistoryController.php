<?php

namespace App\Http\Controllers;

use App\BudgetHistory;

class BudgetHistoryController extends Controller
{

    /**
     * Store new budget history data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cron()
    {
        BudgetHistory::storePreviousMonth();
    }

}
