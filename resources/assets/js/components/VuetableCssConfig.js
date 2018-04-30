export default {
    table: {
        tableClass: 'table table-striped table-bordered',
        ascendingIcon: 'fa fa-sort-up',
        descendingIcon: 'fa fa-sort-down',
        handleIcon: 'fa fa-hashtag',
        renderIcon: function (classes, options) {
            return `<i class="${classes.join(' ')}"></i>`
        }
    },
    pagination: {
        wrapperClass: "pagination float-right",
        activeClass: "btn-primary",
        disabledClass: "disabled",
        pageClass: "btn btn-border",
        linkClass: "btn btn-border",
        icons: {
            first: "",
            prev: "",
            next: "",
            last: ""

        }
    }
}