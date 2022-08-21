@extends('layoutHeader')

@section('title')Добавление предмета@endsection

@section('main_content')
    <h1>Добавление предмета</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/SubjectCreate/Check">
        @csrf
        <input type="Subject" name="Subject" id="Subject" placeholder="Введите название предмета" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <button type="submit" class="btn btn-success">Добавить</button>
    </form>
    <br>

    <h1>Удаление студента</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/SubjectDelete/Check">
        @csrf
        <input type="SubjectDelete" name="SubjectDelete" id="SubjectDelete" placeholder="Введите id предмета" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <button type="submit" class="btn btn-success">Добавить</button>
    </form>

    <br>
    <h1>Студенты</h1>
    @foreach($cont as $el)
        <div class="alert alert-warning">
            <h3>{{$el->name}}</h3>
            <h5>id: {{ $el->id}}</h5>
        </div>
    @endforeach

@endsection
