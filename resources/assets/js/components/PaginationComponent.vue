<template>
    <div class="container">
        <ul class="pagination">
            <li class="page-item" v-on:click.prevent="changePage(prevPage)" v-bind:class="{disabled: !hasPrev()}">
                <a>Предыдущая</a>
            </li>
            <li class="page-item" v-if="hasFirst()">
                <a href="#" v-on:click.prevent="changePage(1)">1</a>
            </li>

            <li class="page-item" v-if="hasFirst()">...</li>

            <li class="page-item" v-for="page in pages" v-on:click.prevent="changePage(page)" v-bind:class="{active: current == page }">
                <a href="#" >{{ page }}</a>
            </li>

            <li class="page-item" v-if="hasLast()">...</li>

            <li class="page-item" v-if="hasLast()">
                <a href="#" v-on:click.prevent="changePage(totalPages)">{{ totalPages }}</a>
            </li>
            <li class="page-item" v-on:click.prevent="changePage(nextPage)" v-bind:class="{disabled: !hasNext()}">
                <a>Следующая</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                pageRange: 2
            }
        },
        props: {
            current: {
                type: Number,
                default: 1
            },
            perPage: {
                type: Number,
                default: 10
            },
            total: {
                type: Number,
                default: 0
            },

        },
        computed: {
            pages: function() {
                let pages = [];

                for(let i = this.rangeStart; i <= this.rangeEnd; i++) {
                    pages.push(i)
                }

                return pages
            },
            rangeStart: function() {
                let start = this.current - this.pageRange;

                return (start > 0) ? start : 1
            },
            rangeEnd: function() {
                let end = this.current + this.pageRange;

                return (end < this.totalPages) ? end : this.totalPages
            },
            totalPages: function() {
                return Math.ceil(this.total / this.perPage)
            },
            nextPage: function() {
                return this.current + 1
            },
            prevPage: function() {
                return this.current - 1
            }
        },
        methods: {
            hasFirst: function() {
                return this.rangeStart !== 1
            },
            hasLast: function() {
                return this.rangeEnd < this.totalPages
            },
            hasPrev: function() {
                return this.current > 1
            },
            hasNext: function() {
                return this.current < this.totalPages
            },
            changePage: function(page) {
                this.$emit('page-changed', page)
            }
        }
    }
</script>
