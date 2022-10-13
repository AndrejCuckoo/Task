@extends('layoutHeader')

@section('title')Простановка оценок@endsection

@section('main_content')
    <h1>Поставить оценку</h1>



    <!--        NEW CODE        -->
    <div class="flex-center position-ref full-height" id="MainVue">
        <v-app>
            <v-main>
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
                async showTable(){
                    let data = new FormData()
                    //data.append('shwTable',this.FIO)
                    //this.vis = (this.vis == true) ? false : true
                    await fetch('showTableConnection',{
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
                async clk(){
                    let data = new FormData()

                    let result = this.selected.map(({ id }) => id);

                    resulted = result[0]
                    data.append('resulted',resulted)
                    data.append('grad',this.Grad)

                    await fetch('GradeSelect',{
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
