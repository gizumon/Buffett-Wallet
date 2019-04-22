<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Evaluation;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $evaluations = Evaluation::all();
        return view('list',[
            "evaluations" => $evaluations
        ]);
    }

    /**
     * Add the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addList()
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'stock_code' => 'required|max:4',

        ]);

        $evaluations = Evaluation::all();
        return view('list',[
            "evaluations" => $evaluations
        ]);
    }
}
