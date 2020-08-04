<template>
    <div class="columns">
        <div class="column"></div>
        <div class="column">


            <div class="field">
                <label class="label">Name</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Text input" v-model="movie.name">
                </div>
                <label class="label">Year</label>
                <div class="control">
                    <input  class="input" type="tel" maxlength="4" placeholder="Text input" v-model="movie.year">
                </div>
                <label class="label">Genre</label>
                <select v-model="movie.genre_id">
                    <option v-for="option in events" v-bind:value="option.id">
                        {{ option.name }}
                    </option>
                </select>
            </div>
            <button class="button pull-right is-success m-t-20" @click="save" :disabled="disabledButton">
				<span class="icon">
			      <i class="fa fa-save"></i>
			    </span>
                <span>Guardar</span>
            </button>
            <br>
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="row in list_actors">
                    <td>{{row.name}}</td>

                    <td><input type="checkbox" :value="row.id" v-model="movie_actors"></td>



                </tr>
                </tbody>
            </table>

        </div>
        <div class="column">


        </div>

    </div>
</template>

<script>



    export default {
        data(){
            return {
                events: [],
                list_actors: [],
                movie_actors: [],
                movie: {
                    name: 'hola',
                    year: '',
                    genre_id: 1,
                    actors:[]
                },

                employee: {
                    name: '',
                    email: '',
                    position: '',
                    address:'',
                    birthday:'',
                    coordinates:''
                },

                disabledButton: false,

            }

        },
        props: {
            employee_id: {type: String, required:false},

        },
        mounted () {

            this.getGenres();
            this.getEmployee();
            this.getActors()
        },
        methods:{
            getGenres()
            {

                let url = '/genres/';
                this.axios.get(url)
                    .then(res => {

                        this.events = []
                        for (var i = res.data.length - 1; i >= 0; i--) {
                            let genre = {}
                            let data = res.data[i]
                            genre.id = data.id
                            genre.name = data.name

                            this.events.push(genre)
                        }
                    })
            },
            getActors()
            {

                let url = '/listactors/';
                this.axios.get(url)
                    .then(res => {

                        this.list_actors = []
                        for (var i = res.data.length - 1; i >= 0; i--) {
                            let actor = {}
                            let data = res.data[i]
                            actor.id = data.id
                            actor.name = data.name
                            this.list_actors.push(actor)
                        }
                    })
            },
            save () {
                this.movie.actors = this.movie_actors;
                return this.axios.put('/movie/' + this.movie_id, this.movie).then(response => {

                    window.location.href = "/";
                })
            },
            getEmployee(){
                let url = '/employee/' + this.employee_id;
                this.axios.get(url)
                    .then(res => {
                        let skills_ids =[];
                        let val = res.data
                        this.employee.name = val.name;
                        this.employee.email = val.email;
                        this.employee.position = val.position();
                        this.employee.birthday = val.birthday;
                       /* for (var propiedad in val.actors) {
                            if (val.actors.hasOwnProperty(propiedad)) {
                                actor_ids.push(val.actors[propiedad].id);
                            }
                        }
                        this.movie_actors = actor_ids;*/
                    })
            },

        }

    }
</script>

<style scoped>

</style>
