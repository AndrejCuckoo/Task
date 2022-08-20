@extends('layoutHeader')

@section('title')Создание студента@endsection

@section('main_content')
    <h1>Добавление студента</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/StudCreate/Check">
        @csrf
        <input type="Stud" name="Stud" id="Stud" placeholder="Введите ФИО студента" class="form-control"><br>
        <button type="submit" class="btn btn-success">Добавить</button>
    </form>
    <br>
    <h1>Студенты</h1>
    @foreach($cont as $el)
        <div class="alert alert-warning">
            <h3>{{$el->name}}</h3>
        </div>
    @endforeach

@endsection

