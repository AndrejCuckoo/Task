@extends('layoutHeader')

@section('title')Простановка оценок@endsection

@section('main_content')
    <h1>Поставить оценку</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/Grade/Check">
        @csrf
        <input type="SubjGrade" name="SubjGrade" id="SubjGrade" placeholder="Введите название предмета" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <input type="StudGradeID" name="StudGradeID" id="StudGradeID" placeholder="Введите id студента" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <input type="Grade" name="Grade" id="Grade" placeholder="Введите оценку" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <button type="submit" class="btn btn-success">Поставить оценку</button>
    </form>
    <br>




@endsection
