<?php

namespace App\Http\Controllers;

use App\StudModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
        return view('home');
    }

    public function about(){
        //$cont = new StudModel();
        $users = DB::table('stud_models')->get();
        //DB::delete('delete from stud_models where id = 5');


        return view('about',['cont' => $users->all()]);
    }

    public function Stud_check(Request $request){
        $valid = $request->validate([
            'Stud' => 'required'
        ]);

        $about = new StudModel();
        $about->name = $request->input('Stud');

        $about->save();

        return redirect()->route('StudCreate');
    }

    public function Stud_delete(Request $request){
        //$cont = new StudModel();
        //$users = DB::table('stud_models')->get();
        //DB::delete('delete from stud_models where id = 5');
        $index = $request->input('StudDelete');
        DB::delete('delete from stud_models where id = ?',[$index]);
        return redirect()->route('StudCreate');
    }

    public function Subject(){
        //$cont = new StudModel();
        $subjec = DB::table('subjects')->get();
        //DB::delete('delete from stud_models where id = 5');


        return view('subjects',['conte' => $subjec->all()]);
    }

    public function Subject_check(Request $request){
        $valid = $request->validate([
            'Subject' => 'required'
        ]);


        $index = $request->input('Subject');
        DB::table('subjects')->insert(
            ['subject' => $index]
        );


        return redirect()->route('SubjectCreate');
    }

    public function Subject_delete(Request $req){

        $ind = $req->input('SubjectDelete');
        DB::delete('delete from subjects where id = ?',[$ind]);
        return redirect()->route('SubjectCreate');
    }
}
