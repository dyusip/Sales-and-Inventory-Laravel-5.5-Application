<?php

namespace App\Http\Controllers;

use App\SalesHeader;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    //
    public function index()
    {
        return view('User.report');
    }
    public function show(Request $request)
    {
        $from = Carbon::createFromFormat('m/d/Y', $request->start)->format('Y-m-d');
        $to = Carbon::createFromFormat('m/d/Y', $request->end)->format('Y-m-d');

        $reports = SalesHeader::whereBetween('date', [$from, $to])
            ->join('sales_details as sd','sh_no','=','sd.sd_no')
            ->get();
        return view('User.report',compact('reports'));
    }
}
