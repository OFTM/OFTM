<template>
    <div class="float-right">
        <div class="form-inline search">
            <label class="sr-only" for="filter-input">Suche</label>
            <input type="text" v-model="filterText" class="form-control search-element" id="filter-input" @keyup.enter="doFilter" placeholder="Suche..." disabled>
            <div class="btn-group">
                <button class="btn btn-primary" @click="doFilter"><i class="fa fa-search"></i></button>
                <button class="btn btn-danger" @click="resetFilter"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                filterText: ''
            }
        },
        methods: {
            doFilter() {
                this.$events.fire('filter-set', this.filterText)
            },
            resetFilter() {
                this.filterText = ''
                this.$events.fire('filter-reset')
            }
        }
    }
</script>
