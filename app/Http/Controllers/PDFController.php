<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class PDFController extends Controller
{
    public function pdf()
    {

      /*  $deals = DB::table('deals')
            ->join('claims', 'claims.id', '=', 'deals.claim_id')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
            ->select('deals.id','deals.number','deals.judge','deals.subject_claim','steps.decision','steps.type','steps.deal_start','steps.deal_end',
                'claims.number as number2','defendants.surname','defendants.name','defendants.fathersname')
            ->orderby('deals.number')
            ->get();*/
        $value = session('key');
        $pdf = PDF::loadView('admin.deal.pdf', ['deals'=>$value])->setPaper('a4','portrait');

        return   $pdf->download('Справи.pdf');
    }
}
