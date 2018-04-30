<template>
    <div>
        <filter-bar></filter-bar>
        <vuetable ref="vuetable"
                  api-url="/api/fencers"
                  :fields="fields"
                  pagination-path="meta"
                  @vuetable:pagination-data="onPaginationData"
                  :css="css.table"
                  :append-params="moreParams"
        >
            <template slot="actions" slot-scope="props">
                <div class="btn-group">
                    <a role="button" class="btn btn-primary" :href="'/fencers/' + props.rowData.id"><i class="fa fa-edit"></i></a>
                    <a role="button" class="btn btn-danger" :href="'/fencers/' + props.rowData.id"><i class="fa fa-trash"></i></a>
                </div>
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
                        name: 'person.forename',
                        title: 'Vorname'
                    },
                    {
                        name: 'person.surname',
                        title: 'Nachname'
                    },
                    {
                        name: 'person.sex.name',
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
            }
        },
        mounted() {
            this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
            this.$events.$on('filter-reset', e => this.onFilterReset())
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
            onFilterSet (filterText) {
                this.moreParams = {
                    'filter': filterText
                }
                Vue.nextTick( () => this.$refs.vuetable.refresh())
            },
            onFilterReset () {
                this.moreParams = {}
                Vue.nextTick( () => this.$refs.vuetable.refresh())
            }
        }
    }
</script>
