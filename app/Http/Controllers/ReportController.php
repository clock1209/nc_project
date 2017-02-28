<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\webSupport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Datatables;
use Response;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::pluck('username','username');
        $status = webSupport::pluck('status','status');
        $date = Carbon::now();

        return view('report.index')->with(compact('users','status','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function result(Request $request)
    {
        $rbSelected = Input::get('rbReport');
        
        $date1 = '';
        $date2 = '';
        $username = '';
        $status = '';
        
        switch ($rbSelected) {
            case 'Rango de fechas':
                $date1 = $request->date1;
                $date2 = '/'.$request->date2;
                $username = $request->users;
                $status = $request->status;
                
                return view('report/report')->with(compact('date1', 'date2', 'username', 'status'));
                break;

            case 'Mes':
                // var_dump($request->year);
                $date1 = $this->dateFormat($request->months);
                $date2 = '/'.$request->year;
                $username = $request->users;
                $status = $request->status;

                return view('report/report')->with(compact('date1', 'date2', 'username', 'status'));
                break;
            
            default:
                # code...
                break;
        }
    }

    protected function radio($data)
    {
        $html = '';
        $months = $this->months();
        $years = $this->years();
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;

        switch ($data) {
            case 'Rango de fechas':
                $html =
                '<div class="col-sm-4 col-md-offset-2">
                    <input class="form-control datepicker" name="date1" type="date" value="date">
                </div>
                <div class="col-sm-1 text-center">
                    <label for="status_lbl" class="col-sm-2 control-label">a</label>
                </div>
                <div class="col-sm-4">
                    <input class="form-control datepicker" name="date2" type="date" value="date">
                </div>';
                break;

            case 'Mes':
                $html =
                '<div class="col-sm-4 col-md-offset-2"><select class="form-control" id="months" name="months"></select></div>
                <div class="col-sm-1 text-center">
                    <label for="status_lbl" class="col-sm-2 control-label">Año</label>
                </div>
                <div class="col-sm-4">
                    <select class="form-control" id="years" name="year"></select>
                </div>';
                break;
            
            default:
                # code...
                break;
        }

        return response()->json(["datos"=>$data, "html"=>$html, $months, $years, $month, $year]);
    }

    private function months(){
        $months = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];

        return $months;
    }

    private function years(){
        $year = 0;
        // $n = 0;

        for ($i=1980; $i <= 2099; $i++) { 
            // $n++;
            $years[$i] = $i;
        }
        return $years;
        // dd($years);
    }

    private function dateFormat($date)
    {
        $res = ($date <= 9) ? '0'.$date : $date;
        // var_dump($today);
        return $res;
    }

    public function buildDatatable($date1, $username, $status, $date2)
    {
        if (preg_match('/^20[0-9]{2}$/', $date2)) {
            $support = webSupport::select(['id', 'date', 'user', 'client', 'domain', 'motive', 'description', 'status', 'attentiontime'])
            ->where('user', $username)
            ->where('status', $status)
            ->where('date', 'like', $date2.'-'.$date1.'%');

        }elseif(preg_match('/20[0-9]{2}-[0-9]{2}-[0-9]{2}/', $date2)){
            $support = webSupport::select(['id', 'date', 'user', 'client', 'domain', 'motive', 'description', 'status', 'attentiontime'])
            ->where('user', $username)
            ->where('status', $status)
            ->whereBetween('date', [$date1, $date2]);
        }

        return Datatables::of($support)
            ->addColumn('action', function ($support) {
                
                return $this->botones($support);
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        
    }


    private function botones($support)
    {
        $see_report = "";
        // if(Entrust::can('see_report')){
            $see_report =
            '<a data-toggle="modal" rpt_id="'. $support->id .'" data-target="#support" class="btn btn-info get-support"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
        // }

        return $see_report;
    }
}
