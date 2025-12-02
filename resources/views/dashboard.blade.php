@extends('layouts.app')

@section('content')
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="row g-3">

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Total Items</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $total_items }}
                                    </div>
                                    <div class="me-auto">
                                        <span class="text-primary d-inline-flex align-items-center">
                                            15%
                                            <i data-feather="trending-up" class="ms-1"
                                                style="height: 22px; width: 22px;"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="website-visitors" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Total Stock</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ \App\Models\Item::sum('stock') }}
                                    </div>
                                    <div class="me-auto">
                                        <span class="text-danger d-inline-flex align-items-center">
                                            10%
                                            <i data-feather="trending-down" class="ms-1"
                                                style="height: 22px; width: 22px;"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="conversion-visitors" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Total Warehouses</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ \App\Models\Warehouse::count() }}
                                    </div>
                                    <div class="me-auto">
                                        <span class="text-success d-inline-flex align-items-center">
                                            25%
                                            <i data-feather="trending-up" class="ms-1"
                                                style="height: 22px; width: 22px;"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="session-visitors" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Stock Movements Today</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">
                                        {{ $total_movements }}</div>
                                    <div class="me-auto">
                                        <span class="text-success d-inline-flex align-items-center">
                                            4%
                                            <i data-feather="trending-up" class="ms-1"
                                                style="height: 22px; width: 22px;"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="active-users" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <div class="card-title-icon me-2">
                                        <i data-feather="activity"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Stock Flow (IN vs OUT)</h5>
                                </div>
                                <div class="card-body">
                                    <div id="stock-flow-chart" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <div class="card-title-icon me-2">
                                        <i data-feather="database"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Warehouse Capacity Usage</h5>
                                </div>
                                <div class="card-body">
                                    <div id="warehouse-capacity-chart" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div> <!-- end sales -->
        </div> <!-- end row -->

        @php
            $monthly_sales = DB::table('stock_movements')
                ->select(
                    DB::raw("strftime('%m', created_at) as month_number"), // SQLite
                    DB::raw("strftime('%Y-%m', created_at) as month_label"),
                    DB::raw("COALESCE(SUM(CASE WHEN movement_type='IN' THEN quantity END), 0) as total_in"),
                    DB::raw("COALESCE(SUM(CASE WHEN movement_type='OUT' THEN quantity END), 0) as total_out"),
                )
                ->groupBy('month_number', 'month_label')
                ->orderBy('month_number')
                ->limit(12)
                ->get();

        @endphp

        <!-- Start Monthly Sales -->
        <div class="row">
            <div class="col-md-6 col-xl-8">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                <i data-feather="bar-chart" class="widgets-icons"></i>
                            </div>
                            <h5 class="card-title mb-0">Monthly Sales</h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="monthly-sales" class="apex-charts"></div>
                    </div>

                </div>
            </div>


        </div>
        <!-- End Monthly Sales -->



    </div> <!-- container-fluid -->
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // -----------------------------
        // MONTHLY SALES CHART DATA
        // -----------------------------

        var months = [
            @foreach ($monthly_sales as $m)
                "{{ $m->month_label }}",
            @endforeach
        ];

        var monthlyIn = [
            @foreach ($monthly_sales as $m)
                {{ $m->total_in }},
            @endforeach
        ];

        var monthlyOut = [
            @foreach ($monthly_sales as $m)
                {{ $m->total_out }},
            @endforeach
        ];

        // -----------------------------
        // APEXCHARTS OPTIONS
        // -----------------------------

        var monthlyOptions = {
            chart: {
                height: 350,
                type: "line",
                toolbar: {
                    show: false
                }
            },

            stroke: {
                width: [3, 3],
                curve: 'smooth'
            },

            colors: ['#0d6efd', '#dc3545'], // blue + red

            series: [{
                    name: "Stock IN",
                    type: 'line',
                    data: monthlyIn
                },
                {
                    name: "Stock OUT",
                    type: 'line',
                    data: monthlyOut
                }
            ],

            dataLabels: {
                enabled: false
            },

            xaxis: {
                categories: months,
                labels: {
                    rotate: -45
                }
            },

            yaxis: [{
                    title: {
                        text: "Stock IN"
                    },
                },
                {
                    opposite: true,
                    title: {
                        text: "Stock OUT"
                    },
                }
            ],

            grid: {
                borderColor: "#f1f1f1"
            },

            tooltip: {
                shared: true,
                intersect: false,
                theme: "light",
            },

            legend: {
                position: 'top'
            }
        };

        var monthlyChart = new ApexCharts(
            document.querySelector("#monthly-sales"),
            monthlyOptions
        );

        monthlyChart.render();

        // ---------------------------------
        // STOCK FLOW CHART (IN vs OUT)
        // ---------------------------------

        var flowDays = [
            @foreach ($stock_flow as $sf)
                "{{ $sf->day }}",
            @endforeach
        ];

        var flowIn = [
            @foreach ($stock_flow as $sf)
                {{ $sf->total_in }},
            @endforeach
        ];

        var flowOut = [
            @foreach ($stock_flow as $sf)
                {{ $sf->total_out }},
            @endforeach
        ];

        var stockFlowOptions = {
            chart: {
                type: 'bar',
                height: 360,
                stacked: false,
                toolbar: {
                    show: false
                }
            },

            series: [{
                    name: "Stock IN",
                    type: 'column',
                    data: flowIn
                },
                {
                    name: "Stock OUT",
                    type: 'column',
                    data: flowOut
                },
                {
                    name: "Flow Trend",
                    type: 'line',
                    data: flowIn.map((value, index) => value - flowOut[index])
                }
            ],

            stroke: {
                width: [0, 0, 3],
                curve: 'smooth'
            },

            fill: {
                opacity: [0.9, 0.9, 1]
            },

            colors: [
                '#0d6efd', // IN (blue)
                '#dc3545', // OUT (red)
                '#20c997' // Trend (green)
            ],

            xaxis: {
                categories: flowDays,
                labels: {
                    rotate: -45
                }
            },

            dataLabels: {
                enabled: false
            },

            legend: {
                position: "top",
            },

            tooltip: {
                shared: true,
                intersect: false,
            }
        };

        var flowChart = new ApexCharts(
            document.querySelector("#stock-flow-chart"),
            stockFlowOptions
        );

        flowChart.render();

        // ==============================
        //  WAREHOUSE CAPACITY CHART
        // ==============================

        var whNames = [
            @foreach ($warehouse_capacity as $w)
                "{{ $w->name }}",
            @endforeach
        ];

        var whPercentUsed = [
            @foreach ($warehouse_capacity as $w)
                {{ $w->percent }},
            @endforeach
        ];

        var whCurrent = [
            @foreach ($warehouse_capacity as $w)
                {{ $w->current_stock }},
            @endforeach
        ];

        var whCapacity = [
            @foreach ($warehouse_capacity as $w)
                {{ $w->capacity }},
            @endforeach
        ];

        var warehouseCapacityOptions = {
            chart: {
                type: 'bar',
                height: 360,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: '50%',
                    dataLabels: {
                        position: 'right'
                    }
                }
            },
            colors: ['#0d6efd'],
            series: [{
                name: 'Capacity Used (%)',
                data: whPercentUsed
            }],
            xaxis: {
                categories: whNames,
                max: 100,
                labels: {
                    formatter: function(val) {
                        return val + '%';
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val, opts) {
                    var idx = opts.dataPointIndex;
                    return val + '% (' + whCurrent[idx] + '/' + whCapacity[idx] + ')';
                },
                style: {
                    fontSize: '12px'
                }
            },
            tooltip: {
                y: {
                    formatter: function(val, opts) {
                        var idx = opts.dataPointIndex;
                        return val + '% used — ' +
                            whCurrent[idx] + ' / ' + whCapacity[idx] + ' units';
                    }
                }
            },
            grid: {
                borderColor: '#f1f1f1'
            },
            legend: {
                show: false
            }
        };

        var warehouseCapacityChart = new ApexCharts(
            document.querySelector("#warehouse-capacity-chart"),
            warehouseCapacityOptions
        );

        warehouseCapacityChart.render();
    </script>
@endsection
