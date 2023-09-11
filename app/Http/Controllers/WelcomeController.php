<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\background;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function about(){
        // About::all();
      $abouts=  DB::table('abouts')->get();
    //   $programs=  DB::table('programs')->get();
      $programs =  Program::with('category')->get();
      $background=  DB::table('backgrounds')->get();
      $staffs=  DB::table('staff')->get();
//  dd($abouts);
      return view('welcome', compact('abouts','programs','background', 'staffs'));
    }

    public function backgrounds(string $id){
        // $background =
         dd( DB::table('backgrounds')->findOrFail($id));
        // return view('home.show',compact('background'));
    }
}
