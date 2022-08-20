<?php

namespace App\Http\Controllers;

use App\StudModel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
        return view('home');
    }

    public function about(){
        $cont = new StudModel();

        return view('about',['cont' => $cont->all()]);
    }

    public function Stud_check(Request $request){
        $valid = $request->validate([
            'Stud' => 'required'
        ]);
        $about = new StudModel();
        $about->name = $request->input('Stud');

        $about->save();

        return redirect()->route('home');
    }
}
