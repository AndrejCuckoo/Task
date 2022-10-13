@extends('layoutHeader')

@section('title')Поиск студентов по дисциплине@endsection

@section('main_content')
    <h1>Отображение студентов по дисциплине</h1>

    <div class="flex-center position-ref full-height" id="MainVue">
        <v-app>
            <v-main>
                <h4>Выбор предмета</h4>

                <v-autocomplete
                    label="Предметы"
                    :items="subjs"
                    item-text="subject"
                    item-value="id"
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
                    @change="forma()"
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
                        <v-btn
                            color="grey darker-2"
                            dark
                            @click="openChangeDialog(item)"
                        >
                            Изменить оценку
                        </v-btn>


                    </template>
                    <template v-slot:top>
                    </template>
                </v-data-table>

                <br>


            </v-main>
            <v-dialog
                v-model="changeDialog"
                width="800"
            >

                <v-card>
                    <v-card-title class="text-h5 grey lighten-2">
                        Изменение оценок по КМ'ом
                    </v-card-title>

                    <v-card-text>
                        <v-text-field
                            v-model="KM[0]"
                            label="Простановка оценки KM 1"
                            class="mx-4"
                        ></v-text-field>

                        <v-text-field
                            v-model="KM[1]"
                            label="Простановка оценки KM 2"
                            class="mx-4"
                        ></v-text-field>

                        <v-text-field
                            v-model="KM[2]"
                            label="Простановка оценки KM 3"
                            class="mx-4"

                        ></v-text-field>

                        <v-text-field
                            v-model="KM[3]"
                            label="Простановка оценки  KM 4"
                            class="mx-4"
                        ></v-text-field>

                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-divider></v-divider>

                        <v-btn
                            color="primary"
                            text
                            icon @click="changeMark()"
                        >
                            Изменение
                        </v-btn>

                        <v-spacer></v-spacer>


                        <v-btn
                            color="primary"
                            text
                            @click="changeDialog = false"
                        >
                            Выйти
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>

            <!-- New dialog -->


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
                    KM:[null,null,null,null],
                    original_users: [],
                    names:[],
                    users_: [],
                    ids:[],
                    idsSubj:[],
                    changeDialog: false,
                    subjs:[],


                    changeStud:0,
                    changeSubj:0,

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
                        { text:'Изменить/удадлить',value:'_actions' },
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

                async changeMark(){
                    let data = new FormData()

                    //data.append('foo',this.JSON.stringify(this.KM))
                    data.append('StudID',this.changeStud)
                    data.append('SubjectID',this.selectedSubj)

                    for (var i = 0; i < this.KM.length; i++) {
                        data.append('KM[]', this.KM[i]);
                    }

                    //console.log(result)
                    //this.vis = (this.vis == true) ? false : true
                    await fetch('changeMark',{
                        method:'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        body:data
                    })
                        .then((response)=>{

                            this.showTable();

                            this.changeDialog = false

                    })

                },
                openChangeDialog(item){
                    //console.log('forma',this.KM)
                    //console.log('Selected',this.KM)
                    //console.log("KWWWW",this.KM)
                    //this.changeStud
                    //this.changeSubj

                    this.changeStud = item.id
                    this.KM[0] = item.KM1
                    this.KM[1] = item.KM2
                    this.KM[2] = item.KM3
                    this.KM[3] = item.KM4

                    this.changeDialog = true
                    //this.item = item
                },
                forma(){
                    //console.log(this.original_users)
                    let temp;
                    if ((this.ids == '') || (this.ids == null)){
                        this.users = this.original_users
                    }else{
                        temp = this.original_users.filter(ides => ides.id == this.ids);
                        this.users = temp
                    }


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

                    data.append('searchTable',result)
                    //console.log(result)
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
