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

    @foreach($subje as $el)
        <div class="alert alert-warning">
            <h3>{{$el->subject}}</h3>
        </div>
    @endforeach


    <!--        NEW CODE        -->
    <h1>New Code</h1>
    <div class="flex-center position-ref full-height" id="MainVue">
        <v-app>
            <v-main>

                <h3>Простановка оценки</h3>
                <v-data-table
                    v-model="selected"
                    :headers="headers"
                    :items="users"
                    :single-select=true
                    show-select
                    class="elevation-1"
                    :search="search">
                    <template v-slot:top>
                        <v-text-field
                            v-model="search"
                            label="Поиск"
                            class="mx-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="Grad">
                        </v-text-field>
                        <v-btn
                            @click="clk();showTable()">
                            Поставить оценку
                        </v-btn>
                    </template>
                </v-data-table>
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
                    search: '',
                    Grad: '',
                    selected: [],
                    headers: [
                        {
                            align: 'start',
                            sortable: false,
                        },
                        { text: 'ID привязки', value: 'id' },
                        { text: 'ФИО', value: 'name' },
                        { text: 'Оценка', value: 'Grade' },
                        { text: 'Предмет', value: 'subject' },
                    ],

                })},
            methods:{
                showTable(){
                    let data = new FormData()
                    //data.append('shwTable',this.FIO)
                    //this.vis = (this.vis == true) ? false : true
                    fetch('showTableConnection',{
                        method:'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    })
                        .then((response)=>{
                            return response.json()
                        })
                        .then((data)=>{
                            this.users = data.subj
                            //console.log(data.users)
                        })

                },
                clk(){
                    let data = new FormData()

                    let result = this.selected.map(({ id }) => id);

                    resulted = result[0]
                    data.append('resulted',resulted)
                    data.append('grad',this.Grad)

                    fetch('GradeSelect',{
                        method:'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        body:data
                    })
                }

            },
            mounted: function (){
                console.log("SCP")
                this.showTable();
            }
        })
    </script>

@endsection
