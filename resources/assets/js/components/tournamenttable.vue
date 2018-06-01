<template>
    <div>
        <filter-bar></filter-bar>
        <vuetable ref="vuetable"
                  api-url="/api/tournaments"
                  :fields="fields"
                  pagination-path="meta"
                  @vuetable:pagination-data="onPaginationData"
                  :css="css.table"
                  :append-params="moreParams"
        >
            <template slot="actions" slot-scope="props">
                <form method="post" :action="'/tournament/' + props.rowData.id" class="form-inline pull-right">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" :value="csrf_token">
                    <div class="btn-group form" role="group">
                        <a class="btn btn-outline-secondary" :href="'/tournament/' + props.rowData.id"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary" :href="'/tournament/' + props.rowData.id + '/edit'"><i
                                class="fa fa-edit"></i></a>
                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                </form>
            </template>
        </vuetable>
        <vuetable-pagination ref="pagination"
                             @vuetable-pagination:change-page="onChangePage"
                             :css="css.pagination"
        ></vuetable-pagination>
    </div>
</template>

<script>
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
    import CssConfig from './VuetableCssConfig'
    import FilterBar from './FilterBar'

    Vue.component('filter-bar', FilterBar)

    export default {
        components: {
            Vuetable,
            VuetablePagination
        },
        data() {
            return {
                fields: [
                    {
                        name: 'id',
                        title: 'ID'
                    },
                    {
                        name: 'name',
                        title: 'Name'
                    },
                    {
                        name: 'ageclass.name',
                        title: 'Altersklasse'
                    },
                    {
                        name: 'weaponclass.name',
                        title: 'Waffengattung'
                    },
                    {
                        name: 'ruleset.name',
                        title: 'Regelsatz'
                    },
                    {
                        name: 'sex.name',
                        title: 'Geschlecht',
                        callback: 'sexLabel',
                        titleClass: 'text-center',
                        dataClass: 'text-center'
                    },
                    {
                        name: '__slot:actions',
                        title: 'Aktionen',
                        titleClass: 'text-center fit',
                        dataClass: 'text-right fit'
                    }
                ],
                css: CssConfig,
                moreParams: {},
                csrf_token: '',
            }
        },
        mounted() {
            this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
            this.$events.$on('filter-reset', e => this.onFilterReset())
            this.csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        methods: {
            sexLabel(value) {
                return value === "male"
                    ? '<i class="fa fa-15x fa-male">'
                    : '<i class="fa fa-15x fa-female">'
            },
            onPaginationData(paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage(page) {
                this.$refs.vuetable.changePage(page)
            },
            onFilterSet(filterText) {
                this.moreParams = {
                    'filter': filterText
                }
                Vue.nextTick(() => this.$refs.vuetable.refresh())
            },
            onFilterReset() {
                this.moreParams = {}
                Vue.nextTick(() => this.$refs.vuetable.refresh())
            }
        }
    }
</script>
