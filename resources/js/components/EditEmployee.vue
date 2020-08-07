<template>
    <div class="columns">
        <div class="column"></div>
        <div class="column">


            <div class="field">

                <label class="label">Nombre</label>
                <div class="control">
                    <input  class="input" type="text"  placeholder="Text input" v-model="employee.name">
                </div>
                <label class="label">Email</label>
                <div class="control">
                    <input  class="input" type="text"  placeholder="Text input" v-model="employee.email">
                </div>
                <label class="label">Puesto</label>
                <div class="control">
                    <input  class="input" type="text"  placeholder="Text input" v-model="employee.position">
                </div>

                <label class="label">Direccion</label>
                <div class="control">
                    <!--<input  class="input" type="text"  placeholder="Text input" v-model="employee.address">-->
                    <input ref="googleAutocomplete"  type="text" placeholder="Ingresa el nombre de tu calle y número.." v-model="employee.address">
                </div>

                <label class="label">Fecha de Nacimiento</label>
                <div class="control">
                    <input type="date" id="start" name="trip-start" v-model="employee.birthday">
                </div>
                <div class="control">
                    <div ref="map" style="height: 200px;"></div>
                </div>
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
                    <th>Skills</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="row in list_skills">
                    <td>{{row.skill}}</td>

                    <td><input type="checkbox" :value="row.id" v-model="employee_skills"></td>



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
                list_skills: [],
                employee_skills: [],
                coordinates:'',

                employee: {
                    name: '',
                    email: '',
                    position: '',
                    address: '',
                    birthday: '',
                    coordinates: '',
                    skills:[]
                },

                disabledButton: false,

            }

        },
        props: {
            employee_id: {type: String, required:false},

        },
        mounted () {

            this.getEmployee();
            this.getSkills()

            this.autocomplete = new google.maps.places.Autocomplete(
                (this.$refs.googleAutocomplete),
                {types: ['geocode']}
            );




            this.autocomplete.addListener('place_changed', () => {
                let place = this.autocomplete.getPlace();
                let ac = place.address_components;
                let lat = place.geometry.location.lat();
                let lon = place.geometry.location.lng();
                let address = `${ac[1]["short_name"]} ${ac[0]["short_name"]} ${ac[2]["short_name"]} ${ac[3]["short_name"]}`;

                //  console.log(ac);

                me.employee.coordinates = `${lat}, ${lon}`
                me.employee.address = address;

            });





        },
        methods:{

            getSkills()
            {

                let url = '/listskills/';
                this.axios.get(url)
                    .then(res => {

                        this.list_skills = []
                        for (var i = res.data.length - 1; i >= 0; i--) {
                            let skill = {}
                            let data = res.data[i]
                            skill.id = data.id
                            skill.skill = data.skill
                            this.list_skills.push(skill)
                        }
                    })
            },
            save () {
                this.employee.skills = this.employee_skills;
                return this.axios.put('/employee/' + this.employee_id, this.employee).then(response => {

                  //  window.location.href = "/";
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
                        this.employee.position = val.position;
                        this.employee.address = val.address;
                        this.employee.birthday = val.birthday;
                        this.employee.coordinates = val.coordinates;

                       // console.log( this.coordinates )
                        //console.log(this.employee.coordinates)
                        for (var propiedad in val.skills) {
                            if (val.skills.hasOwnProperty(propiedad)) {
                                skills_ids.push(val.skills[propiedad].id);
                            }
                        }
                        this.employee_skills = skills_ids;


                        var lat = '19.3665953';
                        var lon = '-99.1832562';
                        console.log(this.employee.coordinates)
                        let coordinates = this.employee.coordinates


                        if (coordinates && (coordinates = coordinates.split(",")).length > 0) {

                            lat = coordinates[0]
                            lon =  coordinates[1]
                        }



                        var userLatLng = new window.google.maps.LatLng(lat, lon);

                        var myOptions = {
                            zoom: 20,
                            center: userLatLng,
                            disableDefaultUI: true,
                            mapTypeId: window.google.maps.MapTypeId.HYBRID,
                            styles: [{ featureType: "poi.business", elementType: "labels", stylers: [{ visibility: "off" }] }, { featureType: "poi.park", elementType: "labels", stylers: [{ visibility: "off" }] }]
                        };
                        // Draw the map
                        var mapObject = new window.google.maps.Map(this.$refs.map, myOptions);

                      //  var myLatLng = {lat: -25.363, lng: 131.044};

                        var marker = new google.maps.Marker({
                            position: userLatLng,
                            map: mapObject,
                            title: 'Hello World!'
                        });


                    })






            },

        }

    }
</script>

<style scoped>

</style>
