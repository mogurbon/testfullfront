<template>
    <div class="columns">
        <div class="column"></div>
        <div class="column">


            <div class="field">
                <label class="label">Skill</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Text input" v-model="skill.skill">
                </div>

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



    export default {
        data(){
            return {
                events: [],
                skill: {
                    skill: '',

                },
                disabledButton: false,

            }

        },
        mounted () {


        },
        methods:{

            save () {
                return this.axios.post('/skill', this.skill).then(response => {

                    window.location.href = "/skills";
                })
            },

        }

    }
</script>

<style scoped>

</style>
