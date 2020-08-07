<template>
    <div class="columns">
        <div class="column"></div>
        <div class="column">


            <div class="field">
                <label class="label">Name</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Text input" v-model="skills.skill">
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
                skills: {
                    skill: '',

                },
                disabledButton: false,

            }

        },
        props: {
            skill_id: {type: String, required:false},

        },
        mounted () {

            this.getSkill();


        },
        methods:{

            save () {
                return this.axios.put('/skill/' + this.skill_id, this.skills).then(response => {

                    window.location.href = "/skills";
                })
            },
            getSkill(){

                let url = '/skill/' + this.skill_id;
                this.axios.get(url)
                    .then(res => {

                        let val = res.data
                        this.skills.skill = val.skill;

                    })

            }

        }

    }
</script>

<style scoped>

</style>
