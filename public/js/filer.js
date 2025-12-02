(function ($) {

    "use strict";

    // ===============================================
    // Feather Icons Refresh
    // ===============================================
    function refreshIcons() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }

    // ===============================================
    // Image Preview (Logo, Avatar, Item Image…)
    // ===============================================
    $(document).on("change", ".image-preview-input", function () {
        let target = $(this).data("preview-target");
        let file = this.files[0];

        if (file && target) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $(target).attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // ===============================================
    // DataTable Basic Initialization
    // ===============================================
    function initDataTable(tableID) {

        let table = $(tableID).DataTable({
            responsive: true,
            stateSave: true,
            autoWidth: false,
            pageLength: 10,
            order: [],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search here...",
                lengthMenu: "_MENU_",
            }
        });

        refreshIcons();
        return table;
    }

    // ===============================================
    // Apply Global Table Filter
    // ===============================================
    function attachGlobalSearch(tableID, inputID) {
        $(inputID).on("keyup", function () {
            $(tableID).DataTable().search(this.value).draw();
        });
    }

    // ===============================================
    // Filter by Dropdown (Warehouse, Supplier, Role…)
    // ===============================================
    function attachDropdownFilter(tableID, dropdownID, columnIndex) {
        $(dropdownID).on("change", function () {
            let value = $(this).val();
            $(tableID).DataTable().column(columnIndex).search(value).draw();
        });
    }

    // ===============================================
    // Date Range Filter (Created_at Filter)
    // ===============================================
    $.fn.dataTable.ext.search.push(function (settings, data) {

        let min = $("#filter-date-start").val();
        let max = $("#filter-date-end").val();

        let createdAt = data[0]; // column 0 or change to correct index

        if (!min && !max) return true;

        if ((min === "" || createdAt >= min) &&
            (max === "" || createdAt <= max)) {
            return true;
        }

        return false;
    });

    function attachDateFilter(tableID) {
        $("#filter-date-start, #filter-date-end").on("change", function () {
            $(tableID).DataTable().draw();
        });
    }

    // ===============================================
    // Initialize All Tables Automatically
    // ===============================================
    $(document).ready(function () {

        $("table.data-table").each(function () {
            let id = "#" + $(this).attr("id");
            initDataTable(id);
        });

        refreshIcons();
    });

    // Expose Functions Globally
    window.StockUI = {
        initDataTable,
        attachDropdownFilter,
        attachGlobalSearch,
        attachDateFilter
    };

})(jQuery);
