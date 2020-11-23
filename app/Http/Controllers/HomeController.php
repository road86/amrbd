<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Specimen;
use App\Pathogen;
use App\Antibiotic;
use App\Breed;

class HomeController extends Controller
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
        $antibiotic = Antibiotic::count();
        $pathogen = Pathogen::count();
        $breed = Breed::count();
        $speciman = Specimen::count();
        return view('home',compact('antibiotic','pathogen','breed','speciman'));
    }

   /** public function store(Request $request) {
        
        $user = Auth::user();
        $current_time = Carbon::now();

        DB::table('institution')->insert(['inst_name' => $request->inst_name, 'created_by' => $user->id, 'created_at' => $current_time]);

        return view('home');
    }

    public function storeSpecies(Request $request) {
        
        $user = Auth::user();
        $current_time = Carbon::now();

        DB::table('species')->insert(['species_name' => $request->species_name, 'created_by' => $user->id, 'created_at' => $current_time]);

        return view('species.create');
    } */
}
