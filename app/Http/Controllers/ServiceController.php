<?php
/*---------------------------------------------------------------------------------*/
/*-----------------------------NOT USED IN THE PROJECT-----------------------------*/
/*---------------------------------------------------------------------------------*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Unirest\Request as Request2;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $response = Request2::get("https://aerodatabox.p.rapidapi.com/flights/airports/icao/UUEE/2019-12-26T12%253A00/2019-12-27T00%253A00?withLeg=false&direction=Both",
                  array(
                        "X-RapidAPI-Host" => "aerodatabox.p.rapidapi.com",
                        "X-RapidAPI-Key"  => "b28f34eee1msh952cb6d3f7acba4p12468ajsn5bb9084e42df" 
                      )
                    );

        return view('services.index')->with('services',$response);

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
}
