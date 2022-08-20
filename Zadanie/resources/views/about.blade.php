@extends('layoutHeader')

@section('title')Создание студента@endsection

@section('main_content')
    <h1>Добавление студента</h1>
    <form method="post" action="/StudCreate/Check">
        @csrf
        <input type="Stud" name="Stud" id="stud" placeholder="Введите ФИО студента" class="form-control"><br>
        <button type="submit" class="btn btn-success">Добавить</button>
    </form>
@endsection

