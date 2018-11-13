<template>
    <div class="container">
        <div class="column">
            <!-- Add task form -->
            <div class="container mt-5 mb-3">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <form action="#" @submit.prevent="addTask()">
                            <div class="input-group">
                                <input v-model="newTask" name="text" type="text" class="form-control" placeholder="Enter Task" autofocus autocomplete="off" aria-label="Task text" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-primary">Add Task</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Errors -->
            <div v-if="errors.length !== 0" class="container my-3">
                <div class="alert alert-danger mt-2 mb-0">
                    <ul class="mb-0">
                        <li v-for="error in errors" :key="error">{{ error }}</li>
                    </ul>
                </div>
            </div>
            <!-- Tasks list -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card card-default">
                            <div class="card-header">Tasks</div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <div v-for="task in tasks" :key="task.id" class="list-group-item d-flex justify-content-between">
                                        <span>{{ task.text }}</span>
                                        <div>
                                            <button @click="toggleTask(task.id)" :class="[{ 'btn-outline-success': task.completed }, 'btn btn-sm btn-outline-secondary']" class="">
                                                <i class="fas" :class="task.completed ? 'fa-check' : 'fa-minus'"></i>
                                            </button>
                                            <button @click="deleteTask(task.id)" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                tasks: [],
                newTask: '',
                errors: []
            }
        },

        created() {
            this.fetchData();
        },

        methods: {
            fetchData() {
                axios.get('/api/tasks')
                .then((response) => {
                    this.tasks = response.data;
                })
                .catch((err) => console.log(err));  
            },
            addTask() {
                axios.post('/api/tasks', { text: this.newTask })
                .then((response) => {
                    this.newTask = '';
                    this.fetchData();
                })
                .catch((err) => this.errors.push(err.response.data.message));                
            },
            toggleTask(id) {
                axios.post('/api/tasks/'+id+'/toggle')
                .then((response) => {
                    this.fetchData();
                })
                .catch((err) => console.log(err));                
            },
            deleteTask(id) {
                axios.delete('/api/tasks/'+id)
                .then((response) => {
                    this.fetchData();
                })
                .catch((err) => console.log(err));                
            }
        }
    }
</script>
