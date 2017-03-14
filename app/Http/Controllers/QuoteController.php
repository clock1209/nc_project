<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Client;
use Illuminate\Support\Facades\Input;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $var = 0;
        $client = Client::pluck('name', 'lastNameFather');
        foreach ($client as $key => $value) {
            $var += 1;
            $clients[$var] =  $value . " ". $key;
        }

        $date = Carbon::now();

        return view('quote.create')->with(compact('date', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = Input::get('radio');
        $user = Input::get('username');
        // $motive = implode(Input::get('motives'));
        var_dump($user);
        dd($request);
        // $domain = Input::get('domains');

      $quote = Quote::create([
          'client' => $request['client'],
          'user' => $user,
          'quote_date' => $request['date'],
          'phone_number' => $request['phone_number'],
          'email' => $request['email'],
          'address' => $request['address'],
          'description' => $request['description'],
          'budget' => $request['budget'],
      ]);

      return redirect('websupport')->with('message','La información se ha guardado.');
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
