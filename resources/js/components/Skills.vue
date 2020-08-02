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
                    <td>{{row.name}}</td>

                    <td><button class="button is-info" @click="edit(row.id)"><i class="fa fa-pencil-square-o"></i></button></td>
                    <td><button class="button is-danger" @click="deleteActor(row.id)"><i class="fa fa-trash" ></i></button></td>


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
            this.$refs.getEmployees();
            consol.log(events);
        },
        methods:{

        }

    }
</script>

<style scoped>

</style>