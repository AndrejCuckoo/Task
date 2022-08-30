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
        <input type="Stud" name="Stud" id="Stud" placeholder="Введите ФИО студента" class="form-control" style="width: 400px; padding-left: 10px;"><br>
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

    <form method="post" action="/StudDelete/Check">
        @csrf
        <input type="StudDelete" name="StudDelete" id="StudDelete" placeholder="Введите id студента" class="form-control" style="width: 400px; padding-left: 10px;"><br>
        <button type="submit" class="btn btn-success">Удалить</button>
    </form>

    <br>
    <h1>Студенты</h1>
    @foreach($cont as $el)
        <div class="alert alert-warning">
            <h3>{{$el->name}}</h3>
            <h5>id: {{ $el->id}}</h5>
        </div>
    @endforeach

<!--        NEW CODE        -->

    <div class="flex-center position-ref full-height" id="MainVue">
        <v-app>
            <v-main>
                <v-container>New Code</v-container>
                <v-text-field
                    v-model="FIO">
                </v-text-field>
                <v-btn
                    @click="sendName">
                    Добавить
                </v-btn>
                <br>
                <br>
                <br>
                <v-text-field
                    v-model="nameID">
                </v-text-field>
                <v-btn
                    @click="deleteName">
                    Удалить
                </v-btn>
            </v-main>

        </v-app>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        var r = new Vue({
            el: '#MainVue',
            vuetify: new Vuetify(),
            data(){
                return({
                    FIO:'Фамилия имя отчество',
                    nameID: 'ID студента',
                    vis: true,
                })},
            methods:{
                sendName(){
                    let data = new FormData()
                    data.append('FIO',this.FIO)
                    //this.vis = (this.vis == true) ? false : true
                    fetch('sendName',{
                        method:'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        body:data
                    })
                },
                deleteName(){
                    let data = new FormData()
                    data.append('deleteID',this.nameID)
                    //this.vis = (this.vis == true) ? false : true
                    fetch('deleteName',{
                        method:'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        body:data
                    })
                }
            }
        })
    </script>

@endsection

