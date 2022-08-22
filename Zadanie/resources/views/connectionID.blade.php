@extends('layoutHeader')

@section('title')Привязка студента к дисциплине@endsection

@section('main_content')
    <h1>Добавление привязки студента к предмету</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/connectionID/Check">
        @csrf
        <input type="StudID" name="StudID" id="StudID" placeholder="Введите id студента" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <input type="Subject" name="Subject" id="Subject" placeholder="Введите название предмета" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <button type="submit" class="btn btn-success">Добавить</button>
    </form>
    <br>

    <h1>Удаление привязки студента к предмету</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/connectionIDDelete/Check">
        @csrf
        <input type="StudIDDelete" name="StudIDDelete" id="StudIDDelete" placeholder="Введите id студента" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <input type="SubjectIDDelete" name="SubjectIDDelete" id="SubjectIDDelete" placeholder="Введите название предмета" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <button type="submit" class="btn btn-success">Удалить</button>
    </form>



@endsection
