@extends('layoutHeader')

@section('title')Поиск студентов по дисциплине@endsection

@section('main_content')
    <h1>Отображение студентов по дисциплине</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/searchBySubject/Check">
        @csrf
        <input type="Subj" name="Subj" id="Subj" placeholder="Введите название предмета" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <button type="submit" class="btn btn-success">Добавить</button>
    </form>
    <br>
    <h3>{{$content}}</h3>



@endsection
