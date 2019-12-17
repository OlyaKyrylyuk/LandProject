<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Auth;

class MemberController extends Controller
{
    public function home()
    {
        $id=Auth::user()->id;
        $events = db::table('deals')
            ->join('claims','claims.id','=','deals.claim_id')
            ->join('steps','steps.deal_id','=','deals.id')
            ->join('defendants','defendants.id','=','deals.defendant_id')
            ->where('deals.worker_id',$id)
            ->get();

       /* $events = db::select("SELECT deals.id,deals.number,deals.judge,deals.subject_claim,
        steps.type,steps.deal_start,steps.deal_end,
        claims.number as number2,defendants.surname,defendants.name,defendants.fathersname 
        FROM `deals` 
        INNER JOIN claims ON claims.id=deals.claim_id 
        INNER JOIN steps ON steps.deal_id = deals.id 
        INNER JOIN defendants ON defendants.id = deals.defendant_id where deals.worker_id="%$id%" ORDER BY `ID` ASC;");*/
        $event_list = [];
        foreach ($events as  $event) {
            $event_list[] = \Calendar::event(
                $event->number,
                false,
                new \DateTime($event->deal_start),
                new \DateTime($event->deal_end),
                null,
                [
                    'color' => '#5fb591',
                    'url' => '/member/deals/find/'.$event->id,
                    'start time'=>$event->deal_start,
                    'end time'=>$event->deal_end,
                    'defaultView'=> 'month'

                ]
            );
        }
        //$calendar = \Calendar::addEvents($events)->setOptions([ 'defaultDate' => $book->day,'defaultView' => 'agendaDay']);
        $calendar_details = Calendar::addEvents($event_list)->setOptions([
            'defaultView'=> 'month',
            'contentHeight' => 430,
            'themeSystem' => 'bootstrap3',
            'firstDay'=>1,
            'weekends'=> false,


        ]);
        $date = date('Y-m-d');
        $nextDay = date('Y-m-d', strtotime($date. ' + 1 days'));
        $deals_tommorow = DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->select('deals.id','deals.number','steps.type')
            ->where('deals.worker_id','=',$id)
            ->whereDate('steps.deal_start','=',$nextDay)
            ->count();
        return view('member.home', compact('calendar_details'),[
            'deals_tommorow'=>$deals_tommorow
        ] );
    }
    public function try(){

        return view('member.deals');


    }
    public function trysearch(Request $request)
    {
        $worker_id=Auth::user()->id;
        $query=$request->input('from_date');
        if($request->ajax())
        {
            if($request->from_date != '')
            {

                $data = DB::table('deals')
                    ->join('claims', 'claims.id', '=', 'deals.claim_id')
                    ->join('steps', 'steps.deal_id', '=', 'deals.id')
                    ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                    ->select('deals.id', 'deals.number', 'deals.judge', 'deals.subject_claim', 'steps.type', 'steps.deal_start', 'steps.deal_end', 'claims.number as number2', 'defendants.surname', 'defendants.name', 'defendants.fathersname')
                    ->where('deals.number', '=', $query )
                    ->orWhere('deals.judge',  '=', $query )
                    ->orWhere('deals.subject_claim',  '=', $query )
                    ->orWhere('claims.number',  '=',$query )
                    ->orWhere('defendants.surname',  '=', $query )
                    ->orWhere('defendants.name',  '=', $query )
                    ->orWhere('defendants.fathersname',  '=', $query )
                    ->orWhere('steps.type',  '=', $query )
                    ->get();

            }
            else
            {
                $data = DB::table('deals')
                    ->join('claims', 'claims.id', '=', 'deals.claim_id')
                    ->join('steps', 'steps.deal_id', '=', 'deals.id')
                    ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                    ->select('deals.id', 'deals.number', 'deals.judge', 'deals.subject_claim', 'steps.type', 'steps.deal_start', 'steps.deal_end', 'claims.number as number2', 'defendants.surname', 'defendants.name', 'defendants.fathersname')
                    ->where('deals.worker_id',$worker_id)
                    ->get();
            }
            echo json_encode($data);
        }


    }
    public function charts()
    {
        $id=Auth::user()->id;
        $charts=DB::table('deals')
            ->select('deals.id','deals.number')
            ->where('deals.worker_id','=',$id)
            ->get();
        $charts3=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.decision','=',NULL)
            ->where('deals.worker_id','=',$id)
            ->select('deals.number')
            ->count();
        $charts3_1=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.decision','!=',NULL)
            ->where('deals.worker_id','=',$id)
            ->select('deals.number')
            ->count();
        $deals=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->join('users','users.id','=','deals.worker_id')
            ->join('defendants','defendants.id','=','deals.defendant_id')
            ->where('steps.decision','=',NULL)
            ->where('deals.worker_id','=',$id)
            ->select('deals.number','defendants.surname','users.name as name2','defendants.name','defendants.fathersname')
            ->get();
        return view('member.charts',[
            'charts'=>$charts,
            'charts3'=>$charts3,
            'charts3_1'=>$charts3_1,
            'deals'=>$deals
        ]);
    }
    public function notifications()
    {
        $id=Auth::user()->id;
        $date = date('Y-m-d');
        $nextDay = date('Y-m-d', strtotime($date. ' + 1 days'));
        $deals_tommorow = DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->select('deals.id','deals.number','steps.type')
            ->where('deals.worker_id','=',$id)
            ->whereDate('steps.deal_start','=',$nextDay)
            ->get();
        $deals_today = DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('deals.worker_id','=',$id)
            ->select('deals.id','deals.number','steps.type')
            ->whereDate('steps.deal_start','=',$date)
            ->get();

        return view('member.notification',[
            'deals_tommorow'=>$deals_tommorow,
            'deals_today'=>$deals_today
        ]);

    }
    public function searchdeals(Request $request)
    {
        $id=Auth::user()->id;
        $query=$request->input('from_date');
        if($request->ajax())
        {
            if($request->from_date != '')
            {

                $data = DB::table('deals')
                    ->join('claims', 'claims.id', '=', 'deals.claim_id')
                    ->join('steps', 'steps.deal_id', '=', 'deals.id')
                    ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                    ->where('deals.worker_id','=',$id)
                    ->select('deals.id', 'deals.number', 'deals.judge', 'deals.subject_claim', 'steps.type', 'steps.deal_start', 'steps.deal_end', 'claims.number as number2', 'defendants.surname', 'defendants.name', 'defendants.fathersname')
                    ->where('deals.number', '=', $query )
                    ->orWhere('deals.judge',  '=', $query )
                    ->orWhere('deals.subject_claim',  '=', $query )
                    ->orWhere('claims.number',  '=',$query )
                    ->orWhere('defendants.surname',  '=', $query )
                    ->orWhere('defendants.name',  '=', $query )
                    ->orWhere('defendants.fathersname',  '=', $query )
                    ->orWhere('steps.type',  '=', $query )
                    ->get();

            }
            else
            {
                $data = DB::table('deals')
                    ->join('claims', 'claims.id', '=', 'deals.claim_id')
                    ->join('steps', 'steps.deal_id', '=', 'deals.id')
                    ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                    ->where('deals.worker_id','=',$id)
                    ->select('deals.id', 'deals.number', 'deals.judge', 'deals.subject_claim', 'steps.type', 'steps.deal_start', 'steps.deal_end', 'claims.number as number2', 'defendants.surname', 'defendants.name', 'defendants.fathersname')
                    ->get();
            }
            echo json_encode($data);
        }

    }
    public function findone($id)
    {
        $deal = DB::table('deals')
            ->join('claims', 'claims.id', '=', 'deals.claim_id')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
            ->join('users','users.id','=','deals.worker_id')
            ->join('profiles','profiles.user_id','=','claims.user_id')
            ->join('institutions','institutions.id','=','steps.institution_id')
            ->join('phones','phones.object_id','=','claims.user_id')
            ->join('addresses','addresses.object_id','=','claims.user_id')
            ->where('deals.id',$id)
            ->select('deals.number','claims.number as number2','claims.reason','steps.type','steps.deal_start'
                ,'steps.deal_end','profiles.name as name2','phones.phone','institutions.name as name3','institutions.email','defendants.surname','defendants.name','defendants.fathersname')
            ->first();
        return view('member.find_one',[
            'deal'=>$deal
        ]);

    }
}
