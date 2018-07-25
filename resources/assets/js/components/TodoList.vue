<template>
    <div class="container">
        <div class="row"></div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Todo List</div>
                    <div class="panel-body">
                        <div class="form-group">
                                <input type="text" v-model="newTask" class="form-control" placeholder="New things to do..." @keyup.enter="createTask()" autofocus>
                        </div>
                        <div class="form-group">
                            <ul class="nav nav-tabs">
                              <li :class="{ active: tabActive == 'All' }" @click="tabActive = 'All'"><a>All</a></li>
                              <li :class="{ active: tabActive == 'Done' }" @click="tabActive = 'Done'"><a>Done</a></li>
                              <li :class="{ active: tabActive == 'Undo' }" @click="tabActive = 'Undo'"><a>Undo</a></li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <ul class="list-group">
                                <li class="list-group-item" v-for="task in filterTasks">
                                    <div v-show="task === editTask">
                                        <input type="text" class="form-control"
                                            @keyup.enter="updateTask(task)"
                                            @keyup.esc="editTask = ''"
                                            @blur="editTask = ''"
                                            v-task-focus="task === editTask"
                                            v-model="task.body"
                                        >
                                    </div>
                                    <div v-show="task !== editTask" @dblclick="editTask = task">
                                        <input style="vertical-align: middle;" type="checkbox" @click="toggleCheck(task)" :checked="task.checked == 1">
                                        <label style="padding: 7px 0;" :class="{ checked: task.checked == 1 }">{{ task.body }}</label>
                                        <button class="btn btn-default btn-xs pull-right"
                                            @click="deleteTask(task)"
                                        >x</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <span>Total {{ totalCount }}</span>
                            <button class="btn btn-default pull-right"
                                @click="deleteAllTasks()"
                            >Delete All</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                newTask: '',
                tasks: [],
                editTask: '',
                tabActive: 'All'
            }
        },
        mounted: function () {
            this.getAllTasks();
        },
        methods: {
            getAllTasks: function () {
                var self = this;
                this.$http.get('tasks').then(function (response) {
                    self.tasks = response.data;
                });
            },
            createTask: function () {
                if (this.newTask == '') return;
                this.$http.post('task/store', { body: this.newTask });
                this.newTask = '';
                this.getAllTasks();
            },
            updateTask: function (task) {
                this.$http.patch('task/' + task.id, { body: task.body });
                this.editTask = '';
            },
            deleteTask: function (task) {
                this.$http.delete('task/' + task.id);
                var index = this.tasks.indexOf(task);
                this.tasks.splice(index, 1);
            },
            toggleCheck: function (task) {
                task.checked = (task.checked == 0) ? 1 : 0;
                this.$http.patch('task/' + task.id, { checked: task.checked });
            },
            deleteAllTasks: function () {
                this.$http.delete('tasks');
                this.tasks = [];
            }
        },
        computed: {
            filterTasks: function () {
                var self = this;
                return self.tasks.filter(function (task) {
                    if (self.tabActive == 'All') return task;
                    if (self.tabActive == 'Done') return task.checked == 1;
                    if (self.tabActive == 'Undo') return task.checked == 0;
                });
            },
            totalCount: function () {
                return this.filterTasks.length;
            }
        },
        directives: {
            'task-focus': function (el, value) {
                if (value) {
                    el.focus();
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    .list-group-item {
        color: var(--gray-dark);
    }
    .nav-tabs > li {
        padding: 0 10px;
    }
    label {
        margin: 0 0 0 15px;
    }
</style>