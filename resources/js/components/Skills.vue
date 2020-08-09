<template>
    <div class="columns">
        <div class="column"></div>
        <div class="column">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="row in events">
                    <td>{{row.skill}}</td>

                    <td><button class="button is-info" @click="edit(row.id)"><i class="fa fa-pencil-square-o"></i></button></td>
                    <td><button class="button is-danger" @click="deleteSkill(row.id)"><i class="fa fa-trash" ></i></button></td>


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
        //name:skills,
        data(){
            return {
                events: [],
            }

        },
        mounted () {
            this.getSkills()
        },
        methods:{

            getSkills()
            {

                let url = '/listskills/';
                this.axios.get(url)
                    .then(res => {

                        this.events = []
                        for (var i = res.data.length - 1; i >= 0; i--) {
                            let skill = {}
                            let data = res.data[i]
                            skill.id = data.id
                            skill.skill = data.skill
                            this.events.push(skill)
                        }
                    })
            },
            deleteSkill(skill_id){

                let res = confirm("Seguro de querer borrar skill?")
                if (res) {
                    this.axios.delete('/skill/'+skill_id).then(response => {
                        this.getSkills();
                    })
                } else {
                    console.log("didnt delete")
                }
            },
            edit(actor_id){
                window.location.href = "skills/" + actor_id;
            }

        }

    }
</script>

<style scoped>

</style>
