<template>
        <div class="modal active">
            <a v-on:click="goBack" class="modal-overlay" aria-label="Close"></a>
            <div class="modal-container">
                <div class="modal-header">
                    <a v-on:click="goBack" class="btn btn-clear btn-lg float-right" aria-label="Close"></a>
                    <div class="modal-title h3">Информация о задаче № {{id}}</div>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="tile pt-2">
                            <div class="tile-title text-bold text-large">Заголовок:</div>
                            <div class="tile-content">{{task.title}}</div>
                        </div>
                        <div class="tile pt-2">
                            <div class="tile-title text-bold text-large">Дата выполнения:</div>
                            <div class="tile-content">{{task.date}}</div>
                        </div>
                        <div class="tile pt-2">
                            <div class="tile-title text-bold text-large">Автор:</div>
                            <div class="tile-content">{{task.author}}</div>
                        </div>
                        <div class="tile pt-2">
                            <div class="tile-title text-bold text-large">Статус:</div>
                            <div class="tile-content">{{task.status}}</div>
                        </div>
                        <div class="tile pt-2">
                            <div class="tile-title text-bold text-large">Описание:</div>
                            <div class="tile-content">{{task.description}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

<script>
    export default {
        props: {
            id: Number,
        },
        data: function () {
            return {
                task: [],
            }
        },
        methods: {
            goBack () {
                window.history.length > 1
                    ? this.$router.go(-1)
                    : this.$router.push('/')
            }
        },
        mounted() {
            let app = this;
            axios.get('api/v1/task/' + app.id)
                .then(function (resp) {
                    app.task = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не удалось загрузить информацию о задаче");
                    app.goBack();
                });
        }
    }
</script>