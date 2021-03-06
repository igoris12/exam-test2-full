<?php

namespace App\Http\Controllers;

use App\Models\Better;
use Illuminate\Http\Request;
use App\Models\Horse;
use Validator;

class BetterController extends Controller
{
   const RESULTS_IN_PAGE = 10;

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

            if ($request->sort) {
                if ('name' == $request->sort && 'asc' == $request->sort_dir) {
                    $betters = Better::orderBy('name')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else if ('name' == $request->sort && 'desc' == $request->sort_dir) {
                    $betters = Better::orderBy('name', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else if ('surname' == $request->sort && 'asc' == $request->sort_dir) {
                    $betters = Better::orderBy('surname')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else if ('surname' == $request->sort && 'desc' == $request->sort_dir) {
                    $betters = Better::orderBy('surname', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else if ('bet' == $request->sort && 'asc' == $request->sort_dir) {
                    $betters = Better::orderBy('bet')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else if ('bet' == $request->sort && 'desc' == $request->sort_dir) {
                    $betters = Better::orderBy('bet', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else {
                    $betters = Better::paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }

            }
            else if ($request->filter && 'horse' == $request->filter) { 
                $betters = Better::where('horse_id', $request->horse_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }else {
                $betters = Better::orderBy('bet', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
        
        $horses = Horse::orderBy('name', 'desc')->get();
        return view('better.index', ['betters' => $betters,
         'horses' => $horses,
         'sortDirection' => $request->sort_dir ?? 'asc',
        'horse_id' => $request->horse_id ?? '0'
        ]
    );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horses = Horse::orderBy('name', 'desc')->get();
        return view('better.create', ['horses' => $horses]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

         $validator = Validator::make($request->all(),
            [
                'better_name' => ['required', 'min:3', 'max:100'],
                'better_surname' => ['required', 'min:3', 'max:150'],
                'better_bet' => ['required', 'integer', 'min:20'],
                'horse_id' => ['required' ,'integer', 'min:1'],
            ]

            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $better = new Better;
        $better->name = $request->better_name;
        $better->surname = $request->better_surname;
        $better->bet = $request->better_bet;
        $better->horse_id = $request->horse_id;

        $better->save();
       return redirect()->route('better.index')->with('success_message', 'New Better added successful.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(better $better)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(better $better)
    {
       $horses  =Horse::orderBy('name')->get();
       return view('better.edit', ['better' => $better, 'horses' => $horses]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, better $better)
    {

            $validator = Validator::make($request->all(),
            [
                'better_name' => ['required', 'min:3', 'max:100'],
                'better_surname' => ['required', 'min:3', 'max:150'],
                'better_bet' => ['required', 'integer', 'min:20'],
                'horse_id' => ['required' ,'integer', 'min:1'],
            ]

            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }



        $better->name = $request->better_name;
        $better->surname = $request->better_surname;
        $better->bet = $request->better_bet;
        $better->horse_id = $request->horse_id;

        $better->save();
       return redirect()->route('better.index')->with('success_message', 'New Better edited successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(better $better)
    {
    $better->delete();
       return redirect()->route('better.index')->with('success_message', 'Delete was successful.');;

    }
}
