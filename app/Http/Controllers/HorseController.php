<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;
use Validator;

class HorseController extends Controller
{
    const RESULTS_IN_PAGE = 3;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horses = Reservoir::orderBy('name', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('horse.index', ['horses' => $horses]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horse.create');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {   
    //     $validator = Validator::make($request->all(),
    //         [
    //             'horse_title' => ['required', 'min:2', 'max:200'],
    //             'horse_area' => ['required', 'integer', 'min:1'],
    //             'horse_about' => ['required'],

    //         ]

    //         );
    //         if ($validator->fails()) {
    //             $request->flash();
    //             return redirect()->back()->withErrors($validator);
    //         }

    //     $horse = new Reservoir;
    //     $horse->title = $request->horse_title;
    //     $horse->area = $request->horse_area;
    //     $horse->about = $request->horse_about;

    //     $horse->save();
    //     return redirect()->route('horse.index')->with('success_message', 'New Reservoir added successful.');

    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\horse  $horse
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(horse $horse)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\horse  $horse
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(horse $horse)
    // {
    //     return view('horse.edit', ['horse' => $horse]);

    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\horse  $horse
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, horse $horse)
    // {

    //      $validator = Validator::make($request->all(),
    //         [
    //             'horse_title' => ['required', 'min:2', 'max:200'],
    //             'horse_area' => ['required', 'integer', 'min:1'],
    //             'horse_about' => ['required'],

    //         ]

    //         );
    //         if ($validator->fails()) {
    //             $request->flash();
    //             return redirect()->back()->withErrors($validator);
    //         }

    //     $horse->title = $request->horse_title;
    //     $horse->area = $request->horse_area;
    //     $horse->about = $request->horse_about;

    //     $horse->save();
    //     return redirect()->route('horse.index')->with('success_message', 'Update was successful.');

    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\horse  $horse
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(horse $horse)
    // {
    //     if($horse->getMember->count()){
    //    return redirect()->route('horse.index')->with('info_message', 'Reservoir cant be deleted.');


    //    }
    //    $horse->delete();
    //    return redirect()->route('horse.index')->with('success_message', 'Delete was successful.');
    // }
    
}
