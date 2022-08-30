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

        $sel = DB::select('SELECT
            stud_models.name,
            subjects.subject,
            conn.Grade,
            conn.id
        FROM stud_models
        JOIN conn
        ON stud_models.id = conn.StudId
        JOIN subjects
        ON subjects.id = conn.SubjectId;');
        return view('connectionID',['contente' => $sel]);
    }

    public function connectionID_check(Request $request){



        $indexStud = $request->input('StudID');
        $indexSubj = $request->input('Subject');

        $indSub = DB::table('subjects')->where('subject',$indexSubj)->value('id');

        $idSubjCheck = DB::table('subjects')->where('id',$indSub)->value('subject');
        $idStudCheck = DB::table('stud_models')->where('id',$indexStud)->value('name');

        $idStudAlready = DB::table('conn')->where('StudId',$indexStud)->value('StudId');
        $idSubjAlready = DB::table('conn')->where('SubjectId',$indSub)->value('SubjectId');

        if(($idSubjAlready != NULL) and ($idStudAlready != NULL)){
            return view('connectionID',['err' => 'Данная связь уже существует']);
        }

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

        $ind = $req->input('IDDelete');
        DB::delete('delete from conn where id = ?',[$ind]);
        return redirect()->route('connectionID');
    }

    public function searchBySubject(Request $request){
        return view('searchBySubj',['content' => []]);
    }

    public function searchBySubject_check(Request $request){
        $valid = $request->validate([
            'Subj' => 'required|min:1',
        ]);


        $indexSubj = $request->input('Subj');

        $sel = DB::select('SELECT
            stud_models.name,
            subjects.subject,
            conn.Grade,
            conn.id
        FROM stud_models
        JOIN conn
        ON stud_models.id = conn.StudId
        JOIN subjects
        ON subjects.id = conn.SubjectId;');

        $tempSel = collect($sel);
        $TSel = $tempSel ->whereIn('subject',$indexSubj);

        return view('searchBySubj',['content' => $TSel]);

    }

    public function Grade(){


        $users = DB::table('subjects')->get();

        return view('grades',['subje' => $users]);
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

    public function index(){
        return view('welcome');
    }

    public function sendName(request $request){

        $index = $request->input('FIO');
        DB::table('stud_models')->insert(
            ['name' => $index]
        );

    }

    public function deleteName(request $request){

        $index = $request->input('deleteID');
        DB::delete('delete from stud_models where id = ?',[$index]);
        DB::delete('delete from conn where StudId = ?',[$index]);

    }

    public function showTable(){

        //$items = DB::select('id', 'name', 'slug')->where('order', 1)->get();
        $users = DB::table('stud_models')->get();
        //return view('about',['cont' => $users->all()]);

        return response()->json(['users' => $users]);

    }

}
