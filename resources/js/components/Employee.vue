<template>
    <div class="columns">
        <div class="column"></div>
        <div class="column">
            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Puesto</th>
                    <th>Direccion</th>
                    <th>Fecha de nacimiento</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="row in events">
                    <td>{{row.name}}</td>
                    <td>{{row.email}}</td>
                    <td>{{row.position}}</td>
                    <td>{{row.address}}</td>
                    <td>{{row.birthday}}</td>
                    <td><button class="button is-info" @click="edit(row.id)"><i class="fa fa-pencil-square-o"></i></button></td>
                    <td><button class="button is-danger" @click="deleteEmployee(row.id)"><i class="fa fa-trash" ></i></button></td>


                </tr>
                </tbody>
            </table>
        </div>

        <div class="column">


        </div>

    </div>
</template>

<script>



    export default  {
        data(){
            return {
                events: [],

            }

        },
        mounted () {

            this.getEmployees();
        },
        methods:{
            getEmployees()
            {

                let url = '/employees/';
                this.axios.get(url)
                    .then(res => {

                    this.events = []
                for (var i = res.data.length - 1; i >= 0; i--) {
                    let employee = {}
                    let data = res.data[i]
                    employee.id = data.id
                    employee.name = data.name
                    employee.email = data.email
                    employee.position = data.position
                    employee.address = data.address
                    employee.birthday = data.birthday
                    this.events.push(employee)
                }




            })
            },
            deleteEmployee(employee_id){
                //console.log(employee_id);
                let res = confirm("Seguro de borrar el empleado?")
                if (res) {
                    this.axios.delete('/employee/'+employee_id).then(response => {
                        this.getEmployees();
                })
                } else {
                    console.log("didnt delete")
                }
            },
            edit(employee_id){
                window.location.href = "employees/" + employee_id;
            }
        }

    }
</script>

<style scoped>

</style>
