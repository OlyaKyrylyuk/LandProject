<?php

namespace App\Http\Controllers;
use Date;
use DB;
use Carbon\Carbon;
use App\User;
use App\Deal;
use App\Claim;
use Auth;
use App\Step;
use App\Defendant;
use App\Institution;
use App\Profile;
use App\Phone;
use Illuminate\Http\Request;

class DealsController extends Controller
{
    public function adddeals()
    {
        $defendants = Defendant::all();
        $institutions = Institution::all();
        $claims = Claim::all()->where('number','!=',null);
        $workers = db::select("SELECT * FROM `users` WHERE role='member'");
        return view('admin/adddeals',[
            'defendants'=>$defendants,
            'claims'=>$claims,
            'institutions'=>$institutions,
            'workers'=>$workers,
        ]);
    }
    public function admin_deals()
    {
        return view('admin.deal.deals_all');
    }
    public function search(Request $request)
    {$query = $request->input('search');
        $deals = DB::table('deals')
            ->join('claims', 'claims.id', '=', 'deals.claim_id')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
            ->select('deals.id', 'deals.number', 'deals.judge', 'deals.subject_claim', 'steps.type', 'steps.deal_start', 'steps.deal_end', 'claims.number as number2', 'defendants.surname', 'defendants.name', 'defendants.fathersname')
            ->where('steps.type', 'like', '%' . $query . '%')
            ->orWhere('deals.judge', 'like', '%' . $query . '%')
            ->orWhere('deals.subject_claim', 'like', '%' . $query . '%')
            ->orWhere('claims.number', 'like', '%' . $query . '%')
            ->orWhere('defendants.surname', 'like', '%' . $query . '%')
            ->orWhere('defendants.name', 'like', '%' . $query . '%')
            ->orWhere('defendants.fathersname', 'like', '%' . $query . '%')

        //    ->orWhere('steps.deal_start', 'like', '%' . $query . '%')
          //  ->orWhere('steps.deal_end', 'like', '%' . $query . '%')
            ->paginate(3);
        return view('admin.deal.deals_all',['deals'=>$deals]);
/*
        if($request->ajax())
        {
            $output = '';
            //  $query = $request->input('query');
            $query = 'перша';
            if($query != '')
            {
                $data = DB::table('deals')
                    ->join('claims', 'claims.id', '=', 'deals.claim_id')
                    ->join('steps', 'steps.deal_id', '=', 'deals.id')
                    ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                    ->select('deals.id', 'deals.number', 'deals.judge', 'deals.subject_claim', 'steps.type', 'steps.deal_start', 'steps.deal_end', 'claims.number as number2', 'defendants.surname', 'defendants.name', 'defendants.fathersname')
                    ->where('deals.number', 'like', '%' . $query . '%')
                    ->orWhere('deals.judge', 'like', '%' . $query . '%')
                    ->orWhere('deals.subject_claim', 'like', '%' . $query . '%')
                    ->orWhere('claims.number', 'like', '%' . $query . '%')
                    ->orWhere('defendants.surname', 'like', '%' . $query . '%')
                    ->orWhere('defendants.name', 'like', '%' . $query . '%')
                    ->orWhere('defendants.fathersname', 'like', '%' . $query . '%')
                    ->orWhere('steps.type', 'like', '%' . $query . '%')
                    ->orWhere('steps.deal_start', 'like', '%' . $query . '%')
                    ->orWhere('steps.deal_end', 'like', '%' . $query . '%')
                    ->get();

            }
            else
            {
                $data = DB::table('deals')
                    ->join('claims', 'claims.id', '=', 'deals.claim_id')
                    ->join('steps', 'steps.deal_id', '=', 'deals.id')
                    ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                    ->select('deals.id','deals.number','deals.judge','deals.subject_claim','steps.type','steps.deal_start','steps.deal_end',
                        'claims.number as number2','defendants.surname','defendants.name','defendants.fathersname')
                    ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {

                foreach($data as $row)
                {
                    $output .= '
        <tr>
         <td>'.$row->number.'</td>
         <td>'.$row->judge.'</td>
         <td>'.$row->type.'</td>
         <td>'.$row->surname.'</td>
         <td>'.$row->name.'</td>
        </tr>
        ';
                }
            }
            else
            {
                $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            return  json_encode($data);
        }*/

    }
    public function show_edit_deals($id)
    {
        $defendants=Defendant::all();
        $claims=Claim::all();
        $deals = db::select("SELECT steps.id,deals.number,deals.judge,deals.subject_claim,steps.type,steps.deal_start,steps.deal_end,
        claims.number as number2,defendants.surname,defendants.name,defendants.fathersname 
        FROM `deals` 
        INNER JOIN claims ON claims.id=deals.claim_id 
        INNER JOIN steps ON steps.deal_id = deals.id 
        INNER JOIN defendants ON defendants.id = deals.defendant_id  ORDER BY `ID` ASC;");
        return view('admin.deal.edit_show',[
            'id'=>$id,
            'defendants'=>$defendants,
            'claims'=>$claims,
            'deals'=>$deals

        ]);
    }
    public function edit_deals(Request $req,$id)
    {
        $deal = Deal::find($id);
        $deal->number = $req->get('number');
        $deal->judge = $req->get('judge');
        $deal->subject_claim = $req->get('subject_claim');
        $deal->claim_id = $req->get('claim_id');
        $deal->defendant_id = $req->get('defendant_id');
        $deal->updated_at = Carbon::now();
        $deal->save();

        return redirect()->action('DealsController@admin_deals');
    }
    public function insertdeals(Request $req)
    {
        $deal = new Deal;

        $deal->number =  $req->input('number');
        $deal->judge =  $req->input('judge');
        $deal->subject_claim =  $req->input('subject_claim');
        $deal->defendant_id =  $req->input('defendant_id');
        $deal->claim_id=  $req->input('claim_id');
        $deal->worker_id = $req->input('worker_id');
        $deal->decided = false;
        $deal->created_at = Carbon::now();
        $deal->updated_at = Carbon::now();
        $deal->save();
        return redirect()->action('DealsController@admin_deals');
    }
    public function try(){

            return view('admin.deals');


    }
    public function trysearch(Request $request)
    {
        $query=$request->input('from_date');
        $query2 = $request->input('date');
       if($request->ajax())
        {
            if(($request->from_date != '')&&($request->date==''))
            {

                $data = DB::table('deals')
                    ->join('claims', 'claims.id', '=', 'deals.claim_id')
                    ->join('steps', 'steps.deal_id', '=', 'deals.id')
                    ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                    ->select('deals.id', 'deals.number', 'deals.judge', 'deals.subject_claim','steps.decision', 'steps.type', 'steps.deal_start', 'steps.deal_end', 'claims.number as number2', 'defendants.surname', 'defendants.name', 'defendants.fathersname')
                    ->where('deals.number', '=', $query )
                    ->orWhere('deals.judge',  '=', $query )
                    ->orWhere('deals.subject_claim',  '=', $query )
                    ->orWhere('claims.number',  '=',$query )
                    ->orWhere('defendants.surname',  '=', $query )
                    ->orWhere('defendants.name',  '=', $query )
                    ->orWhere('defendants.fathersname',  '=', $query )
                    ->orWhere('steps.type',  '=', $query )
                    ->get();
                $request->session()->put('key', $data);

            }
            else if(($request->from_date == '')&&($request->date !=''))
            {

                $data = DB::table('deals')
                    ->join('claims', 'claims.id', '=', 'deals.claim_id')
                    ->join('steps', 'steps.deal_id', '=', 'deals.id')
                    ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                    ->select('deals.id', 'deals.number', 'deals.judge', 'deals.subject_claim','steps.decision', 'steps.type', 'steps.deal_start', 'steps.deal_end', 'claims.number as number2', 'defendants.surname', 'defendants.name', 'defendants.fathersname')
                    //->whereDate('steps.deal_start', '=', $query2 )
                    ->whereDate('steps.deal_start', '=', date($query2) )
                    ->get();
                $request->session()->put('key', $data);

            }
            else if(($request->from_date != '')&&($request->date != ''))
            {

                $data = DB::table('deals')
                    ->join('claims', 'claims.id', '=', 'deals.claim_id')
                    ->join('steps', 'steps.deal_id', '=', 'deals.id')
                    ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                    ->select('deals.id', 'deals.number', 'deals.judge', 'deals.subject_claim','steps.decision', 'steps.type', 'steps.deal_start', 'steps.deal_end', 'claims.number as number2', 'defendants.surname', 'defendants.name', 'defendants.fathersname')
                   // ->where('steps.deal_start', '=', date($query2))
                    ->where('deals.number', '=', $query)
                    ->whereDate( 'steps.deal_start', '=', date($query2))
                    ->orWhere('deals.judge',  '=', $query)
                    ->whereDate( 'steps.deal_start', '=', date($query2))
                    ->orWhere('deals.subject_claim',  '=', $query)
                    ->whereDate( 'steps.deal_start', '=', date($query2))
                    ->orWhere('claims.number',  '=',$query)
                    ->whereDate( 'steps.deal_start', '=', date($query2))
                    ->orWhere('defendants.surname',  '=', $query)
                    ->whereDate( 'steps.deal_start', '=', date($query2))
                    ->orWhere('defendants.name',  '=', $query)
                    ->whereDate( 'steps.deal_start', '=', date($query2))
                    ->orWhere('defendants.fathersname',  '=', $query)
                    ->whereDate( 'steps.deal_start', '=', date($query2))
                    ->orWhere('steps.type',  '=', $query)
                    ->whereDate( 'steps.deal_start', '=', date($query2))
                    ->get();
                $request->session()->put('key', $data);

            }
            else
            {
                $data = DB::table('deals')
                    ->join('claims', 'claims.id', '=', 'deals.claim_id')
                    ->join('steps', 'steps.deal_id', '=', 'deals.id')
                    ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                    ->select('deals.id', 'deals.number', 'deals.judge', 'deals.subject_claim','steps.decision', 'steps.type', 'steps.deal_start', 'steps.deal_end', 'claims.number as number2', 'defendants.surname', 'defendants.name', 'defendants.fathersname')
                    ->get();
                $request->session()->put('key', $data);

            }

            echo json_encode($data);
        }

    }
    public function dealbydate(Request $request)
    {

        $deals = db::select("SELECT deals.id,deals.number,deals.judge,deals.subject_claim,steps.type,steps.deal_start,steps.deal_end,
        claims.number as number2,defendants.surname,defendants.name,defendants.fathersname 
        FROM `deals`
        INNER JOIN claims ON claims.id=deals.claim_id
        INNER JOIN steps ON steps.deal_id = deals.id
        INNER JOIN defendants ON defendants.id = deals.defendant_id  ORDER BY `ID` ASC;");
        /* $deal = [];


         if($request->has('q')){
             $search = $request->q;
             $searchdeals = db::select("SELECT deals.id,deals.number,deals.judge,deals.subject_claim,steps.type,steps.date,steps.deal_start,steps.deal_end,
         claims.number as number2,defendants.surname,defendants.name,defendants.fathersname
         FROM `deal`
         INNER JOIN claims ON claims.id=deal.claim_id
         INNER JOIN steps ON steps.deal_id = deals.id
         INNER JOIN defendants ON defendants.id = deals.defendant_id  ORDER BY `ID` ASC where date like"%$search%";");
         }


         //return response()->json($data);*/
        return view('admin.deal.deals_bydate',[
            'deals'=>$deals,
            //'searchdeals'
        ]);
    }
    public function dealbyinstansion()
    {
        $deals = db::select("SELECT deals.id,deals.number,deals.judge,deals.subject_claim,steps.type,steps.deal_start,steps.deal_end,
        claims.number as number2,defendants.surname,defendants.name,defendants.fathersname 
        FROM `deals`
        INNER JOIN claims ON claims.id=deals.claim_id
        INNER JOIN steps ON steps.deal_id = deals.id
        INNER JOIN defendants ON defendants.id = deals.defendant_id  ORDER BY `ID` ASC;");
        return view('admin.deal.deals_byinstances',[
            'deals'=>$deals,
        ]);
    }
    public function dealbyjudge()
    {
        $deals = db::select("SELECT deals.id,deals.number,deals.judge,deals.subject_claim,steps.type,steps.deal_start,steps.deal_end,
        claims.number as number2,defendants.surname,defendants.name,defendants.fathersname 
        FROM `deals`
        INNER JOIN claims ON claims.id=deals.claim_id
        INNER JOIN steps ON steps.deal_id = deals.id
        INNER JOIN defendants ON defendants.id = deals.defendant_id  ORDER BY `ID` ASC;");
        /* $deal = [];


         if($request->has('q')){
             $search = $request->q;
             $searchdeals = db::select("SELECT deals.id,deals.number,deals.judge,deals.subject_claim,steps.type,steps.date,steps.deal_start,steps.deal_end,
         claims.number as number2,defendants.surname,defendants.name,defendants.fathersname
         FROM `deal`
         INNER JOIN claims ON claims.id=deal.claim_id
         INNER JOIN steps ON steps.deal_id = deals.id
         INNER JOIN defendants ON defendants.id = deals.defendant_id  ORDER BY `ID` ASC where date like"%$search%";");
         }


         //return response()->json($data);*/
        return view('admin.deal.deals_byjudge',[
            'deals'=>$deals,
            //'searchdeals'
        ]);
    }
    public function first()
    {
        return view('admin.deals');
    }
    public function second(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != '')
            {
                if($request->from_date=='with_number'){
                $data = DB::table('claims')
                    ->join('users','users.id','=','claims.user_id')
                    ->join('profiles','profiles.user_id','=','users.id')
                    ->where('number','!=',NULL)
                    ->select('claims.id','claims.number','claims.reason','users.email','profiles.name')
                    ->get();
                }
                if($request->from_date=='without_number'){
                    $data = DB::table('claims')
                        ->join('users','users.id','=','claims.user_id')
                        ->join('profiles','profiles.user_id','=','users.id')
                        ->where('number','=',NULL)
                        ->select('claims.id','claims.number','claims.reason','users.email','profiles.name')
                        ->get();}
            }
            else
            {
                $data = DB::table('claims')
                    ->join('users','users.id','=','claims.user_id')
                    ->join('profiles','profiles.user_id','=','users.id')
                    ->select('claims.id','claims.number','claims.reason','users.email','profiles.name')
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
           ->join('users','users.id','=','claims.user_id')
            ->join('profiles','profiles.user_id','=','claims.user_id')
            ->join('institutions','institutions.id','=','steps.institution_id')
            ->join('phones','phones.object_id','=','claims.user_id')
            ->join('addresses','addresses.object_id','=','claims.user_id')
            ->where('steps.id',$id)
            ->select('steps.id','deals.number','claims.number as number2','claims.reason','steps.type','steps.deal_start'
            ,'steps.deal_end','profiles.name as name2','phones.phone','institutions.name as name3','institutions.email','defendants.surname','defendants.name','defendants.fathersname')
            ->first();
        $deal2 = DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->join('users','users.id','=','deals.worker_id')
            ->join('profiles','profiles.user_id','=','users.id')
            ->join('phones','phones.object_id','=','users.id')
            ->where('steps.id',$id)
            ->select('profiles.name','phones.phone')
            ->first();
        return view('admin.deal.find_one',[
            'deal'=>$deal,
            'deal2'=>$deal2
        ]);

    }

}
