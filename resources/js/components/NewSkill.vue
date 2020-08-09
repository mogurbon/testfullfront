<template>
    <div class="columns">
        <div class="column"></div>
        <div class="column">
            <ValidationObserver v-slot="{ invalid, reset }">

            <div class="field">
                <label class="label">Skill</label>
                <ValidationProvider name="Skill" :rules="{required: true, max: 50}" v-slot="v">
                <div class="control">
                    <input class="input" type="text" placeholder="Text input" v-model="skill.skill">
                </div>
                    <span>{{ v.errors[0] }}</span>
                </ValidationProvider>
            </div>
            <button class="button pull-right is-success m-t-20" @click="save" :disabled="invalid" >
				<span class="icon">
			      <i class="fa fa-save"></i>
			    </span>
                <span>Guardar</span>
            </button>
            </ValidationObserver>
        </div>
        <div class="column">


        </div>

    </div>
</template>

<script>
    import { ValidationObserver, ValidationProvider, extend } from 'vee-validate';
    import * as rules from 'vee-validate/dist/rules';
    Object.keys(rules).forEach(rule => {
        extend(rule, rules[rule]);
    });


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
        ,
        components: {
             ValidationProvider,
            ValidationObserver
        }

    }
</script>

<style scoped>

</style>
