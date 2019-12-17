<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Step;
use Charts;
use DB;
use Carbon\Carbon;
class ChartsController extends Controller
{
    public function charts()
    {
        $charts=DB::table('deals')
            ->select('deals.id','deals.number')
            ->get();
        $charts3=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.decision','=',NULL)
            ->select('deals.number')
            ->count();
        $charts3_1=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.decision','!=',NULL)
            ->select('deals.number')
            ->count();
        $chartsfirst=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.type','=','перша')
            ->orderby('deals.number')
            ->select('deals.id','deals.number','steps.type')
        ->get();
        $chartssecond=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.type','=','друга')
            ->orderby('deals.number')
            ->select('deals.id','deals.number','steps.type')
            ->get();
        $chartsthird=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.type','=','третя')
            ->orderby('deals.number')
            ->select('deals.id','deals.number','steps.type')
            ->get();
        $deals=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->join('users','users.id','=','deals.worker_id')
            ->join('defendants','defendants.id','=','deals.defendant_id')
            ->where('steps.decision','=',NULL)
            ->select('deals.number','defendants.surname','users.name as name2','defendants.name','defendants.fathersname')
            ->get();

     /*   $var = [];
        $var1 = [];
        foreach ($charts as $key => $chart) {
            $var[] = $chart->number;
            $var1[] = $chart->type;
        }*/
        $charts2=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->orderby('deals.number')
            ->count();


        //dd($var);*/
        return view('admin.charts',[
            'charts_f'=>$chartsfirst,
            'charts_s'=>$chartssecond,
            'charts_t'=>$chartsthird,
            // 'var'=>$var,
         //  'var1'=>$var1,
            'charts'=>$charts,
            'charts2'=>$charts2,
            'charts3'=>$charts3,
            'charts3_1'=>$charts3_1,
            'deals'=>$deals,


        ]);
    }
    public function charts2()
    {
        $charts=DB::table('deals')
            ->select('deals.id','deals.number')
            ->get();
        $charts3=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.decision','=','')
            ->select('deals.number')
            ->count();
        $charts3_1=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.decision','!=','')
            ->select('deals.number')
            ->count();
        $chartsfirst=DB::table('deals')
            ->join('steps','steps.deal_id' , '=', 'deals.id')
            ->join('users','users.id','=','deals.worker_id')
            ->where('steps.type','=','перша')
            ->orderby('deals.number')
            ->select('deals.id','users.id as id2','deals.number','steps.type','users.name')
            ->get();
        $chartssecond=DB::table('deals')
            ->join('steps','steps.deal_id' , '=', 'deals.id')
            ->join('users','users.id','=','deals.worker_id')
            ->where('steps.type','=','друга')
            ->orderby('deals.number')
            ->select('deals.id','users.id as id2','deals.number','steps.type','users.name')
            ->get();
        $chartsthird=DB::table('deals')
            ->join('steps','steps.deal_id' , '=', 'deals.id')
            ->join('users','users.id','=','deals.worker_id')
            ->where('steps.type','=','третя')
            ->orderby('deals.number')
            ->select('deals.id','users.id as id2','deals.number','steps.type','users.name')
            ->get();
        $deals=DB::table('deals')
            ->select('deals.id','deals.number')
            ->get();
        $deals2=DB::table('users')
            ->where('role','member')
            ->select('users.id','users.name')
            ->get();
       /* $chartssecond=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.type','=','друга')
            ->orderby('deals.number')
            ->select('deals.id','deals.number','steps.type')
            ->get();
        $chartsthird=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->where('steps.type','=','третя')
            ->orderby('deals.number')
            ->select('deals.id','deals.number','steps.type')
            ->get();*/

        /*   $var = [];
           $var1 = [];
           foreach ($charts as $key => $chart) {
               $var[] = $chart->number;
               $var1[] = $chart->type;
           }*/
        $charts2=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->orderby('deals.number')
            ->count();

        //dd($var);*/
        return view('admin.charts2',[
            'charts_f'=>$chartsfirst,
            'charts_s'=>$chartssecond,
            'charts_t'=>$chartsthird,
            // 'var'=>$var,
            //  'var1'=>$var1,
            'charts'=>$charts,
            'charts2'=>$charts2,
            'charts3'=>$charts3,
            'charts3_1'=>$charts3_1,
            'deals'=>$deals,
            'deals2'=>$deals2



        ]);
    }
    public function charts3()
    {
       /* $charts=db::table('deals')
            ->join('users','users.id','=','deals.worker_id')
            ->groupBy('deals.worker_id')
            ->select(DB::raw('count(1) as count'),'deals.worker_id')
            ->get();
        $charts1=db::table('deals')
            ->join('users','users.id','=','deals.worker_id')
            ->where('deals.decided','=',true)
            ->groupBy('deals.worker_id')
            ->select(DB::raw('count(1) as count'),'deals.worker_id')
            ->get();
        $charts1_2=db::table('deals')
            ->join('users','users.id','=','deals.worker_id')
            ->where('deals.decided','=',false)
            ->groupBy('deals.worker_id')
            ->select(DB::raw('count(1) as count'),'deals.worker_id')
            ->get();
        $charts2=db::table('users')
          ->where('users.role','=','member')
          ->select('users.id','users.name')
            ->orderby('users.id')
            ->get();*/
        $charts = db::select("SELECT count(deals.decided) as count ,users.name FROM `deals` inner join users on deals.worker_id = users.id where deals.decided is true group by users.name;");
        $charts2 = db::select("SELECT count(deals.decided) as count ,users.name FROM `deals` inner join users on deals.worker_id = users.id where deals.decided is false group by users.name;");
        //dd($charts);
       /* $charts = db::table('users')
            ->select('users.id')
            ->where('role','=','member')
            ->get();
        $nn=array();
        $i=0;
        foreach($charts as $chart)
        {
            $nn[$i] = $chart->id;
            $i++;
        }
        for($t =0;$t<count($nn);$t++) {
            $catpostsnum[$t] = DB::table('deals')
                ->where('deals.decision', '=',0)
                ->where('deals.worker_id', '=', $nn[$t])
                ->groupBy('deals.worker_id')
                ->select(DB::raw('count(1) AS count'))
                ->get();
        }
        for($t =0;$t<count($nn);$t++) {
            $catpostsnum2[$t] = DB::table('deals')
                ->where('deals.decision', '=',1)
                ->where('deals.worker_id', '=', $nn[$t])
                ->groupBy('deals.worker_id')
                ->select(DB::raw('count(1) AS count'))
                ->get();
        }*/
       // dd( $catpostsnum2);

        //$charts=db::select('SELECT count(deals.id),users.name FROM `deals` INNER JOIN users ON users.id=deals.worker_id INNER JOIN steps ON steps.deal_id = deals.id where steps.decision is null group by users.id;');

/*$charts = db::table('deals')
    ->join('users','users.id','=','deals.worker_id')
    ->select('users.name')
    ->get();
$nn=array();
$i=0;
foreach($charts as $chart)
{
    $nn[$i] = $chart->name;
    $i++;
}

$chart = array();
$chart2 = array();
for($t =0;$t<count($nn);$t++){
    $chart[$t] = db::select('deals')
        ->join('steps','steps.deal_id','=','deals.id')
        ->join('users','users.id','=','deals.worker_id')
        ->where('users.name','=',$nn[$t])
        ->where('steps_decision','=',NULL)
        ->select(DB::raw('count(1) AS count'))
        ->get();
   // dd($chart[$t]);

}
        dd($chart);
    /*    for($t =0;$t<$nn.count();$t++){
            $chart2[$t] = db::select('deals')
                ->join('steps','steps.deal_id','=','deals.id')
                ->join('users','users.id','=','deals.worker_id')
                ->where('users.name','=',$nn[$t])
                ->where('steps_decision','!=',NULL)
                ->count();
        }*/
//$charts = db::select();

/*SELECT deals.id, deals.number,steps.decision,
  users.name
        FROM `users`
          INNER JOIN profiles ON profiles.user_id = users.id
       INNER JOIN deals ON deals.worker_id = users.id
        INNER JOIN steps ON steps.deal_id = deals.id where steps.decision = NULL;*/
        /*$charts1=DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->join('users','users.id','=','deals.worker_id')
            ->where('steps.decision','=',NULL)
            ->get();*/
        return view('admin.charts3',[
           /*'catpostsnum'=> $catpostsnum,
           'catpostsnum2'=> $catpostsnum2,
            'nn'=>$nn,*/
           'charts'=>$charts,
            //'charts1'=>$charts1,
           // 'charts1_2'=>$charts1_2,
            'charts2'=>$charts2
        ]);
    }
}
