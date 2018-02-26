<template>
    <div class="task">
        <div class="container">
            <div class="col-9 col-mx-auto">

                <div class="container">
                    <div class="col-4 col-ml-auto">
                        <div class="input-inline input-group" v-bind:class="{disabled : tasks === []}">
                            <input class="form-input" v-model="search" type="text" placeholder="Поиск">
                            <div class="btn btn-primary input-group-btn" v-bind:class="{loading : showLoadingSearch}">
                                <i class="form-icon icon icon-search"></i>
                            </div>

                        </div>
                        </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>title</th>
                        <th>date</th>
                    </tr>
                    </thead>
                        <tbody>
                            <tr v-for="task in paginateTasks(filterTasks)[currentPage - 1]">
                                <td class="text-bold">{{ task.id }}</td>
                                <td>
                                    <router-link :to="{name: 'info', params: {'id': task.id} }">{{ task.title }}
                                    </router-link>
                                </td>
                                <td>{{ task.date }}</td>
                            </tr>
                        </tbody>
                </table>
                <div style="padding: 1%" class="col-mx-auto col-4">
                    <div class="loading loading-lg" v-if="tasks.length === 0"></div>

                    <div v-else-if="filterTasks.length === 0">
                        <h5>Жаль, но ничего не найдено.</h5>
                    </div>

                    <pagination :current="currentPage" :perPage="perPage" :total="filterTasks.length" v-on:page-changed="onChangedPage" v-else>
                    </pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                tasks: [],
                showLoadingSearch: false,
                search: '',
                currentPage: 1,
                perPage: 10,
            }
        },
        methods: {
            paginateTasks: function(tasks){
                let tasks_paginate = [];

                for (let count = 0; count < Math.ceil(tasks.length / this.perPage); count++){
                    tasks_paginate[count] = tasks.slice((count * this.perPage), (count * this.perPage) + this.perPage);
                }
                return tasks_paginate;
            },
            onChangedPage: function (page) {
                if (page > 0 && page <= this.filterTasks.length) {
                    this.currentPage = page;
                }
            }
        },
        computed:{
            filterTasks: function(){
                let search = this.search;

                if  (search !== '') {
                    this.showLoadingSearch = true;
                    this.currentPage = 1;
                }

                let tasks = this.tasks.filter(function (elem) {
                        if (search === '') {
                            return true;
                        } else {
                            return elem.title.indexOf(search) > -1;
                        }
                });

                this.showLoadingSearch = false;

                return tasks;
            }
        },
        mounted() {
            let app = this;

            axios.get('api/v1/task')
                .then(function (resp) {
                    app.showLoading = false;
                    app.tasks = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не удалось загрузить список задач");
                });
        }
    }
</script>
