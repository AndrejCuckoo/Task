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

                <v-autocomplete
                    label="Предметы"
                    :items="subjs"
                    item-text="subject"
                    v-model="selectedSubj"
                    @change="showTable()"
                    clearable
                    filled
                    rounded
                    solo
                ></v-autocomplete>

                <h3>Просмотр студентов изучающих дисциплину</h3>

                <v-autocomplete
                    label="Студенты"
                    :items="names"
                    item-text="name"
                    item-value="id"
                    v-model="ids"
                    @change="KEK()"
                    clearable
                    filled
                    rounded
                    solo
                ></v-autocomplete>


                <v-btn
                    @click="showTable()">
                    Показать
                </v-btn>

                <v-data-table
                    :headers="headers"
                    :items="users"
                    class="elevation-1"
                    :search="search"
                    no-data-text="Ошибка">
                    <template v-slot:top>
                        <v-text-field
                            v-model="search"
                            label="Поиск"
                            class="mx-4"
                        ></v-text-field>
                    </template>
                    <template
                        v-slot:item._actions="{ item }"
                    >
                        <v-chip-group>


                            <v-dialog
                                v-model="dialog"
                                width="800"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        color="red lighten-2"
                                        dark
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        Click Me
                                    </v-btn>
                                </template>

                                <v-card>
                                    <v-card-title class="text-h5 grey lighten-2">
                                        Privacy Policy
                                    </v-card-title>

                                    <v-card-text>
                                        Изменение оценок по КМ'ом
                                    </v-card-text>

                                    <v-divider></v-divider>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>

                                        <v-text-field
                                            v-model="selectKM"
                                            label="Выбор КМа"
                                            class="mx-4"
                                        ></v-text-field>

                                        <v-text-field
                                            v-model="selectGrade"
                                            label="Простановка оценки"
                                            class="mx-4"
                                        ></v-text-field>
                                        <v-divider></v-divider>

                                        <v-btn
                                            color="primary"
                                            text
                                            icon @click="Help(item)"
                                        >
                                            Изменение
                                        </v-btn>

                                        <v-spacer></v-spacer>


                                        <v-btn
                                            color="primary"
                                            text
                                            @click="dialog = false"
                                        >
                                            Выйти
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>


                            <v-btn
                                icon @click="Help(item)">
                                <v-icon>
                                    mdi-pencil
                                </v-icon>
                            </v-btn>

                            <v-btn icon @click="Help()">
                                <v-icon
                                >
                                    mdi-delete
                                </v-icon>
                            </v-btn>
                        </v-chip-group>
                    </template>
                    <template v-slot:top>
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
                    original_users: [],
                    names:[],
                    users_: [],
                    ids:[],
                    dialog: false,
                    subjs:[],
                    KEKS:[],
                    item:[],
                    search: '',
                    selectKM:'',
                    selectGrade:'',
                    searchSubj: '',
                    selectedSubj:[],
                    headers: [
                        {
                            align: 'start',
                            sortable: false,
                        },
                        { text: 'ФИО', value: 'name' },
                        { text: 'ID', value: 'id' },
                        { text: 'Предмет', value: 'subject' },
                        { text: 'KM1', value: 'KM1' },
                        { text: 'KM2', value: 'KM2' },
                        { text: 'KM3', value: 'KM3' },
                        { text: 'KM4', value: 'KM4' },
                        {text:'Изменить/удадлить',value:'_actions'},
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

                Help(item){
                    //this.selectKM
                    //this.selectGrade
                    //item.id
                    console.log(this.users[item.id-1])

                },
                KEK(){
                    //console.log(this.original_users)
                    let temp;
                    if ((this.ids == '') || (this.ids == null)){
                        this.users = this.original_users
                    }else{
                        temp = this.original_users.filter(ides => ides.id == this.ids);
                        this.users = temp
                    }

                    //console.log('KEKW',this.users)
                    //console.log('original_users',temp)
                    //console.log('original_users',this.original_users)
                },
                Studs_fill(){
                    let this_ = this
                    this.users = []
                    //console.log('This',this.users_[0].id)
                    let id_stud=this.users_[0].id
                    //console.log("ID",id_stud)
                    let row = {id:'',name:'',subject:'',KM1:'0',KM2:'0',KM3:'0',KM4:'0'}
                    this.users_.forEach(function fun (curVal){
                        //console.log('Grade =',this_.users_)
                        if(curVal.id === id_stud){

                        }else{
                            //console.log("ROW = ",row)
                            this_.users.push(row)
                            row = {id:'',name:'',subject:'',KM1:'0',KM2:'0',KM3:'0',KM4:'0'}
                            id_stud = curVal.id
                        }
                        row['id'] = curVal.id
                        row['name'] = curVal.name
                        row['subject'] = curVal.subject

                        if(curVal.KM_Num==1){
                            row['KM1']=curVal.Grade

                        }
                        else if(curVal.KM_Num==2){
                            row['KM2']=curVal.Grade
                        }
                        else if(curVal.KM_Num==3){
                            row['KM3']=curVal.Grade
                        }
                        else if(curVal.KM_Num==4){
                            row['KM4']=curVal.Grade
                        }
                        //console.log(row)
                        //console.log(curVal.Grade)
                    })

                    this_.users.push(row)
                    this.original_users = this_.users;
                },
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
                        })
                },

                showTableUsersBySubj(){

                    let data = new FormData()
                    fetch('showTable',{
                        method:'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    })
                        .then((response)=>{
                            return response.json()
                        })
                        .then((data)=>{
                            this.names = data.users
                            //this.ids= temp.map(({ id }) => id)
                            //this.names= temp.map(({ name }) => name)
                            //console.log("NAmes",temp.map(({ name }) => name))
                            //console.log("ids",this.ids)
                        })


                },

                showTable(){
                    let data = new FormData()

                    let result = this.selectedSubj//.map(({ subject }) => subject)
                    //console.log("KEK",result[0])
                    data.append('searchTable',result)
                    console.log(result)
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
                            tem = data.contente
                            arr = Object.values(tem)
                            this.users_ = arr
                            //console.log("KEKKK",arr[0])
                            this.Studs_fill()
                        })

                },

            },
            mounted: function (){
                console.log("SCP")
                this.showTableSubj();
                this.showTableUsersBySubj();
            }
        })
    </script>

@endsection
