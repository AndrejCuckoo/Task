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

    @foreach($content as $el)
        <div class="alert alert-warning">
            <h3>ФИО: {{$el->name}}</h3>
            <h3>Оценка: {{$el->Grade}}</h3>
        </div>
    @endforeach

    <h1>New Code</h1>
    <div class="flex-center position-ref full-height" id="MainVue">
        <v-app>
            <v-main>
                <h4>Выбор предмета</h4>
                <v-data-table
                    v-model="selectedSubj"
                    :headers="headers2"
                    :items="subjs"
                    :single-select=true
                    show-select
                    class="elevation-1"
                    :search="searchSubj">
                    <template v-slot:top>
                        <v-text-field
                            v-model="searchSubj"
                            label="Поиск"
                            class="mx-4"
                        ></v-text-field>
                    </template>
                </v-data-table>

                <h3>Просмотр студентов изучающих дисциплину</h3>

                <v-btn
                    @click="showTable()">
                    Показать
                </v-btn>
                <v-data-table
                    :headers="headers"
                    :items="users"
                    class="elevation-1"
                    :search="search">
                    <template v-slot:top>
                        <v-text-field
                            v-model="search"
                            label="Поиск"
                            class="mx-4"
                        ></v-text-field>
                    </template>
                </v-data-table>
                <br>



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
                    users: [],
                    subjs:[],
                    search: '',
                    searchSubj: '',
                    selectedSubj:[],
                    headers: [
                        {
                            align: 'start',
                            sortable: false,
                        },
                        { text: 'ФИО', value: 'name' },
                        { text: 'Оценка', value: 'Grade' },
                        { text: 'ID', value: 'id' },
                    ],
                    headers2: [
                        {
                            align: 'start',
                            sortable: false,
                        },
                        { text: 'ID', value: 'id' },
                        { text: 'Предмет', value: 'subject' },
                    ],
                })},
            methods:{

                showTableSubj(){
                    let data = new FormData()
                    fetch('showTableSubj',{
                        method:'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    })
                        .then((response)=>{
                            return response.json()
                        })
                        .then((data)=>{
                            this.subjs = data.subje
                            //console.log(data.users)
                        })


                },

                showTable(){
                    let data = new FormData()

                    let result = this.selectedSubj.map(({ id }) => id)
                    //console.log(result[0])
                    data.append('searchTable',result[0])
                    //this.vis = (this.vis == true) ? false : true
                    fetch('searchBySubjectTable',{
                        method:'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        body:data
                    })
                        .then((response)=>{
                            return response.json()
                        })
                        .then((data)=>{
                            temp = data.contente
                            arr = Object.values(temp)
                            this.users = arr
                        })

                },

            },
            mounted: function (){
                console.log("SCP")
                this.showTableSubj();
            }
        })
    </script>

@endsection
