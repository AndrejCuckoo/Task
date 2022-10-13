@extends('layoutHeader')

@section('title')Привязка студента к дисциплине@endsection

@section('main_content')
    <h1>Добавление привязки студента к предмету</h1>


    <div class="flex-center position-ref full-height" id="MainVue">
        <v-app>
            <v-main>
                <h3>Просмотр привязок</h3>
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
                        <v-btn
                            @click="deleteByName();showTable()">
                            Удалить выбранное
                        </v-btn>
                    </template>
                </v-data-table>
                <br>
                <br>
                <h1>Создание привязок</h1>
                <br>
                <h4>Выбор студента</h4>
                <v-data-table
                    v-model="selectedStud"
                    :headers="headers1"
                    :items="studs"
                    :single-select=true
                    show-select
                    class="elevation-1"
                    :search="searchStud">
                    <template v-slot:top>
                        <v-text-field
                            v-model="searchStud"
                            label="Поиск"
                            class="mx-4"
                        ></v-text-field>
                    </template>
                </v-data-table>
                <br>
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
                <br>
                <v-btn
                    @click="selectObjc();showTable()">
                    Связать
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
                    users: [],
                    studs: [],
                    subjs: [],
                    search: '',
                    searchStud: '',
                    searchSubj: '',
                    selected: [],
                    selectedStud: [],
                    selectedSubj: [],
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
                    headers1: [
                        {
                            align: 'start',
                            sortable: false,
                        },
                        { text: 'ID', value: 'id' },
                        { text: 'ФИО', value: 'name' },
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
                showTableStud(){
                    let data = new FormData()
                    //data.append('shwTable',this.FIO)
                    //this.vis = (this.vis == true) ? false : true
                    fetch('showTable',{
                        method:'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    })
                        .then((response)=>{
                            return response.json()
                        })
                        .then((data)=>{
                            this.studs = data.users
                            //console.log(data.users)
                        })

                },
                showTableSubj(){
                    let data = new FormData()
                    //data.append('shwTable',this.FIO)
                    //this.vis = (this.vis == true) ? false : true
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
                selectObjc(){
                    let data = new FormData()

                    let resultStud = this.selectedStud.map(({ id }) => id);
                    let resultSubj = this.selectedSubj.map(({ id }) => id);

                    nameStud = resultStud[0]
                    nameSubj = resultSubj[0]
                    data.append('nameStud',nameStud)
                    data.append('nameSubj',nameSubj)
                    fetch('createConnection',{
                        method:'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        body:data
                    })
                },
                deleteByName(){
                    let data = new FormData()
                    let result = this.selected.map(({ id }) => id);
                    nameID = result[0]
                    data.append('deleteID',nameID)
                    //this.vis = (this.vis == true) ? false : true
                    fetch('deleteConnection',{
                        method:'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        body:data
                    })
                },
            },
            mounted: function (){
                console.log("SCP")
                this.showTable();
                this.showTableStud();
                this.showTableSubj();
            }
        })
    </script>

@endsection
