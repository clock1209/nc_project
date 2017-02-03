<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Motive;
use App\webSupport;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\WebSupportRequest;

class WebSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::pluck('username', 'username');
        $motives = Motive::pluck('description', 'description');

        return view('support.websupport')->with(compact('users', 'motives'));
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
    public function store(WebSupportRequest $request)
    {
      $status = Input::get('radio');
      $user = implode(Input::get('users'));
      $motive = implode(Input::get('motives'));

      $support = webSupport::create([
          'date' => $request['date'],
          'user' => $user,
          'client' => $request['client'],
          'domain' => $request['domain'],
          'motive' => $motive,
          'description' => $request['description'],
          'status' => $status,
          'attentiontime' => $request['attentiontime'],
      ]);

      return redirect('/home')->with('message','La información se ha guardado.');
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
}
