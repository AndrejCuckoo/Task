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

        $users = DB::table('stud_models')->get();

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

        $index = $request->input('StudDelete');
        DB::delete('delete from stud_models where id = ?',[$index]);
        DB::delete('delete from conn where StudId = ?',[$index]);
        return redirect()->route('StudCreate');
    }

    public function Subject(){
        //$cont = new StudModel();
        $subjec = DB::table('subjects')->get();

        return view('subjects',['conte' => $subjec]);
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
        DB::delete('delete from conn where SubjectId = ?',[$ind]);
        return redirect()->route('SubjectCreate');
    }

    public function connectionID(){

        return view('connectionID',['err' => '']);
    }

    public function connectionID_check(Request $request){
        $valid = $request->validate([
            'StudID' => 'required|numeric|min:1',
            'Subject' => 'required'
        ]);


        $indexStud = $request->input('StudID');
        $indexSubj = $request->input('Subject');

        $indSub = DB::table('subjects')->where('subject',$indexSubj)->value('id');

        $idSubjCheck = DB::table('subjects')->where('id',$indSub)->value('subject');
        $idStudCheck = DB::table('stud_models')->where('id',$indexStud)->value('name');

        if($idSubjCheck == NULL){
            return view('connectionID',['err' => 'Данный предмет отсутствует']);
        }

        if($idStudCheck == NULL){
            return view('connectionID',['err' => 'Данный студент отсутствует']);
        }

        DB::table('conn')->insert(
            ['StudId' => $indexStud,
                'SubjectId' => $indSub
            ]);


        return redirect()->route('connectionID');
    }

    public function connectionID_delete(Request $req){

        $ind = $req->input('SubjectDelete');
        DB::delete('delete from subjects where id = ?',[$ind]);
        return redirect()->route('SubjectCreate');
    }

    public function searchBySubject(Request $request){
        //$searchBy = DB::table('conn')->get();
        return view('searchBySubj',['content' => []]);
    }

    public function searchBySubject_check(Request $request){
        $valid = $request->validate([
            'Subj' => 'required|min:1',
        ]);


        $indexSubj = $request->input('Subj');

        $idSubj = DB::table('subjects')->where('subject',$indexSubj)->value('id');

        $idStud = DB::table('conn')->where('SubjectId',$idSubj)->get();
        //dd($idStud);
        $StudT = $idStud->toArray();
        //dd($idStud->toArray()[0]->id);
        $Stud = array_column($StudT,'StudId');
        $Student = DB::table('stud_models')->whereIn('id',$Stud)->get();

        //dd($Stud);
        return view('searchBySubj',['content' => $Student]);

    }

    public function Grade(){

        $users = DB::table('stud_models')->get();

        return view('grades',['erro' => NULL]);
    }

    public function Grade_check(Request $request){
        $valid = $request->validate([
            'SubjGrade' => 'required',
            'StudGradeID' => 'required|numeric',
            'Grade' => 'required|numeric|min:0|max:5'
        ]);

        $indexSubjGrade = $request->input('SubjGrade');
        $indexStudGrade = $request->input('StudGradeID');
        $indexGrade = $request->input('Grade');



        $idSubj = DB::table('subjects')->where('subject',$indexSubjGrade)->value('id');

        $idSubjCheck = DB::table('subjects')->where('subject',$indexSubjGrade)->value('id');
        $idStudCheck = DB::table('subjects')->where('subject',$indexSubjGrade)->value('id');

        if($idSubjCheck == NULL){
            return view('grades',['erro' => 'Данный предмет отсутствует']);
        }

        if($idStudCheck == NULL){
            return view('grades',['erro' => 'Данный студент отсутствует']);
        }

        DB::table('conn')
            ->where('SubjectId', $idSubj)
            ->where('StudId', $indexStudGrade)
            ->update(['Grade' => $indexGrade]);



        return redirect()->route('Grade');
    }
}
