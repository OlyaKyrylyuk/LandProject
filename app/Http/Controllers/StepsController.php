<?php

namespace App\Http\Controllers;
use Date;
use DB;
use Charts;
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

class StepsController extends Controller
{
    public function addsteps()
    {
        $institutions = Institution::all();
        $deals = Deal::all();
        return view('admin/addsteps',[
            'deals'=>$deals,
            'institutions'=>$institutions
        ]);
    }
    public function deletesteps($id)
    {
        $step=Step::find($id);
        $step->delete();
        return redirect()->action('DealsController@admin_deals');
    }
    public function insertsteps(Request $req)
    {
        $type = $req->input('type');
        $deal_start = $req->input('deal_start');
        $deal_end = $req->input('deal_end');
        $decision = $req->input('decision');
        $deal_id = $req->input('deal_id');
        $institution_id = $req->input('institution_id');
        $created_at = Carbon::now();
        $updated_at = Carbon::now();

        if($type=="перша") {

        $step = Step::create([
            'type'=>$type,
            'deal_start'=>$deal_start,
            'deal_end'=>$deal_end,
            'decision'=>$decision,
            'deal_id'=>$deal_id,
            'institution_id'=>$institution_id,
            'created_at'=>$created_at,
            'updated_at'=>$updated_at
        ]);
        $deal = Deal::find($deal_id);

        $deal->steps()->save($step);
        if($decision!=NULL)
        {
            $deal=Deal::find($deal_id);
            $deal->decided = true;
            $deal->save();
            return redirect()->action('DealsController@admin_deals');
        }
        else if($decision==NULL) {
            return redirect()->action('DealsController@admin_deals');
        }
      }
        elseif ($type=="друга")
        {
            $deals = DB::table('deals')
                ->join('claims', 'claims.id', '=', 'deals.claim_id')
                ->join('steps', 'steps.deal_id', '=', 'deals.id')
                ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                ->where('deals.id', $deal_id)
                ->where('steps.type', "перша")
                ->count();

                if ($deals!=0) {
                    $step = Step::create([
                        'type'=>$type,
                        'deal_start'=>$deal_start,
                    'deal_end'=>$deal_end,
                    'decision'=>$decision,
                    'deal_id'=>$deal_id,
                    'institution_id'=>$institution_id,
                    'created_at'=>$created_at,
                    'updated_at'=>$updated_at
                ]);
                $deal = Deal::find($deal_id);
                $deal->steps()->save($step);
                    $deals1 = DB::table('deals')
                        ->join('claims', 'claims.id', '=', 'deals.claim_id')
                        ->join('steps', 'steps.deal_id', '=', 'deals.id')
                        ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                        ->where('deals.id', $deal_id)
                        ->where('steps.type', "перша")
                        ->select('steps.decision')
                        ->first();
                    if($deals1->decision==NULL)
                    {
                        $deals1->decision="Вирішена справа в 2 інстанції";
                        $deals1->save();
                    }


                return redirect()->action('DealsController@admin_deals');
            }
            else if ($deals==0)
                {
                    echo "<script>alert(\"Не можна створити другу інстанцію без першої.\");</script>";
                    return redirect()->action('StepsController@addsteps');
                }
            }
        elseif($type=="третя")
        {
            $deals = DB::table('deals')
                ->join('claims', 'claims.id', '=', 'deals.claim_id')
                ->join('steps', 'steps.deal_id', '=', 'deals.id')
                ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                ->where('deals.id', $deal_id)
                ->where('steps.type', "перша")
                ->count();
            $deals2 = DB::table('deals')
                ->join('claims', 'claims.id', '=', 'deals.claim_id')
                ->join('steps', 'steps.deal_id', '=', 'deals.id')
                ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                ->where('deals.id', $deal_id)
                ->where('steps.type', "друга")
                ->count();
            $deals_d1 = DB::table('deals')
                ->join('claims', 'claims.id', '=', 'deals.claim_id')
                ->join('steps', 'steps.deal_id', '=', 'deals.id')
                ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                ->where('deals.id', $deal_id)
                ->where('steps.type', "перша")
                ->select('steps.decision')
                ->first();
            $deals_d2= DB::table('deals')
                ->join('claims', 'claims.id', '=', 'deals.claim_id')
                ->join('steps', 'steps.deal_id', '=', 'deals.id')
                ->join('defendants', 'defendants.id', '=', 'deals.defendant_id')
                ->where('deals.id', $deal_id)
                ->where('steps.type', "друга")
                ->select('steps.decision')
                ->first();

            if(($deals_d1->decision==NULL)||($deals_d2->decision==NULL))
            {
                $deals_d1->decision="Вирішена справа в 3 інстанції";
                $deals_d1->save();
                $deals_d2->decision="Вирішена справа в 3 інстанції";
                $deals_d2->save();
            }
            if (($deals!=0)&&($deals2!=0)) {
                $step = Step::create([
                    'type'=>$type,
                    'deal_start'=>$deal_start,
                    'deal_end'=>$deal_end,
                    'decision'=>$decision,
                    'deal_id'=>$deal_id,
                    'institution_id'=>$institution_id,
                    'created_at'=>$created_at,
                    'updated_at'=>$updated_at
                ]);
                $deal = Deal::find($deal_id);
                $deal->steps()->save($step);
                return redirect()->action('DealsController@admin_deals');
            }
            else if (($deals==0)||($deals2==0))
            {
                echo "<script>alert(\"Не можна створити другу інстанцію без першої.\");</script>";
                return redirect()->action('StepsController@addsteps');
            }
        }


    }

}
