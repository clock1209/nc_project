<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\webSupport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

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

        // dd($request);
        
        switch ($rbSelected) {
            case 'Rango de fechas':
                // echo "hola range";
                break;

            case 'Mes':
                $supports = webSupport::select(['id', 'date', 'user', 'client', 'domain', 'motive', 'description', 'status', 'attentiontime'])->where('date', '2017-')->get();
                dd($supports);
                // $this->dateFormat($request->months);
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

        switch ($data) {
            case 'Rango de fechas':
                $html =
                '<div class="col-sm-4 col-md-offset-2">
                    <input class="form-control datepicker" name="date" type="date" value="date">
                </div>
                <div class="col-sm-1 text-center">
                    <span>ó</span>
                </div>
                <div class="col-sm-4">
                    <input class="form-control datepicker" name="date" type="date" value="date">
                </div>';
                break;

            case 'Mes':
                $html =
                '<div class="col-sm-4 col-md-offset-2"><select class="form-control" id="months" name="months"></select></div>';
                break;
            
            default:
                # code...
                break;
        }

        return response()->json(["datos"=>$data, "html"=>$html, $months]);
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

    private function dateFormat($date)
    {
        $today = explode(' ', Carbon::now());
        $today = explode('-', $today[0]);
        $today = $today[0] .'-'. $date .'-'. $today[2];
        // var_dump($today);
    }
}
