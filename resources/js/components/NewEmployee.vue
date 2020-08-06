<template>
    <div class="columns">
        <div class="column"></div>
        <div class="column">


            <div class="field">
                <label class="label">Nombre</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Text input" v-model="employee.name">
                </div>
                <label class="label">Email</label>
                <div class="control">
                    <input  class="input"  placeholder="Text input" v-model="employee.email">
                </div>
                <label class="label">Puesto</label>
                <input  class="input" type="tel"  placeholder="Text input" v-model="employee.position">

                <label class="label">Fecha de nacimiento</label>
                <input type="date" id="start" name="trip-start" v-model="employee.birthday">


                <label class="label">Direccion</label>
                <input ref="googleAutocomplete"  type="text" placeholder="Ingresa el nombre de tu calle y número.." v-model="employee.address">



            </div>
            <button class="button pull-right is-success m-t-20" @click="save" :disabled="disabledButton">
				<span class="icon">
			      <i class="fa fa-save"></i>
			    </span>
                <span>Guardar</span>
            </button>

        </div>
        <div class="column">


        </div>

    </div>
</template>

<script>

    import { PlaceInput, Map } from 'vue-google-maps'

    export default {

        data(){
            return {
                autocomplete:null,
                events: [],
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
        mounted () {
        //key    AIzaSyC-G-sHLg8CeWkVoXdXFqN19QnRw15lTwY

         //   me.autocomplete = new window.google.maps.places.Autocomplete((me.$refs.googleAutocomplete), { types: ['geocode'] });
            var me = this;
            //me.autocomplete = new window.google.maps.places.Autocomplete((me.$refs.googleAutocomplete), { types: ['geocode'] });
           // const searchBox = new window.google.maps.places.SearchBox(me.$refs.googleAutocomplete);

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
                console.log(me.employee.address);
            });


        },
        methods:{



            save () {
                return this.axios.post('/employee', this.employee).then(response => {

                    window.location.href = "/";
                })
            },

        },
        components: {
            PlaceInput
        }

    }
</script>



<style scoped>

</style>
