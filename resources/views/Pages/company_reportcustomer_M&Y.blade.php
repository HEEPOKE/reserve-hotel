@extends('adminlte::page')
@section('content')
    @php

    $num = 1;

        $reserves2 = DB::table('reserves')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            ->orderBy('reserves.id', 'ASC')
            ->get();

    @endphp
    @php
        $reservesall2 = DB::table('reserves')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            ->orderBy('reserves.created_at', 'asc')
            ->get();
    @endphp

    @include('layouts.company_reportcustomer_M&Y.chart')
    @include('layouts.company_reportcustomer_M&Y.table')


    {{-- <script>
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['รายเดือน,รายปี', 'ลูกค้าจอง', 'ลูกค้าวอล์คอิน'],
                ['มกราคม', 100, 200],
                ['กุมภาพันธ์', 100, 200],
                ['มีนาคม', 100, 200],
                ['เมษายน', 100, 200],
                ['พฤษภาคม', 100, 200],
                ['มิถุนายน', 100, 200],
                ['กรกฎาคม', 100, 200],
                ['สิงหาคม', 100, 200],
                ['กันยายน', 100, 200],
                ['ตุลาคม', 100, 200],
                ['พฤศจิกายน', 100, 200],
                ['ธันวาคม', 100, 200],
            ]);

            var options = {
                chart: {
                    title: 'รายงานลูกค้าเข้าพัก (รายเดือน, รายปี)',
                    // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                },
                bars: 'vertical', // Required for Material Bar Charts.
                hAxis: {
                    format: 'decimal'
                },
                height: 400,
                width: 1200,
                colors: ['#D14325', '#BBE21C']
            };

            var chart = new google.charts.Bar(document.getElementById('chart_div'));

            chart.draw(data, google.charts.Bar.convertOptions(options));

            var btns = document.getElementById('btn-group');

            btns.onclick = function(e) {

                if (e.target.tagName === 'BUTTON') {
                    options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            }
        }
    </script> --}}
    @php
        $reservesbar1_1 = DB::table('reserves')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            ->orderBy('reserves.id', 'ASC')
            ->where('checkin_checkouts.walk_in_customers', 0)
            ->groupBy('reserves.reserve_quantity')
            ->count();
    @endphp


{{--
    <script>
        NO_FILTERING = "None"

        function populatePetTypeDropdown() {
            var options = [NO_FILTERING];

            $("#example1 tr").each(function(index, row) {
                google.charts.load('current', {
                    'packages': ['bar']
                });

                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['รายเดือน,รายปี', 'ลูกค้าจอง', 'ลูกค้าวอล์คอิน'],
                        [{{ $month }}, 100, 100],

                    ]);

                    var options = {
                        chart: {
                            title: 'รายงานลูกค้าเข้าพัก (รายเดือน, รายปี)',
                            // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                        },
                        bars: 'vertical', // Required for Material Bar Charts.
                        hAxis: {
                            format: 'decimal'
                        },
                        height: 400,
                        width: 1200,
                        colors: ['#D14325', '#BBE21C']
                    };

                    var chart = new google.charts.Bar(document.getElementById('chart_div'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));

                    var btns = document.getElementById('btn-group');

                    btns.onclick = function(e) {

                        if (e.target.tagName === 'BUTTON') {
                            options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    }
                }
                var petType = getPetTypeForRow(row);
                if ((petType) && (options.indexOf(petType.trim()) == -1)) {
                    options.push(petType);
                }
            });
            options.sort();
            addOptionsToDropdown(options, "#reportSelect");
        }

        function getPetTypeForRow(row) {
            return $(row).children("td").eq(1).html();
        }

        function addOptionsToDropdown(options, dropdownQuery) {
            for (var i = 0; i < options.length; i++) {
                $(dropdownQuery).append($("<option>", {
                    html: options[i],
                    value: options[i]
                }))
            }
        }

        function filterTableByPetType(petType) {
            $("#example1 tr").each(function(index, row) {
                var entryType = getPetTypeForRow(row);
                if (petType === entryType) {
                    $(row).show();
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['รายเดือน,รายปี', 'ลูกค้าจอง', 'ลูกค้าวอล์คอิน'],
                            ['มกราคม', {{ $reservesbar2_1 }}, {{ $reservesbar2_2 }}],
                            ['กุมภาพันธ์', {{ $reservesbar2_3 }}, {{ $reservesbar2_4 }}],
                            ['มีนาคม', {{ $reservesbar2_5 }}, {{ $reservesbar2_6 }}],
                            ['เมษายน', {{ $reservesbar2_7 }}, {{ $reservesbar2_8 }}],
                            ['พฤษภาคม', {{ $reservesbar2_9 }}, {{ $reservesbar2_10 }}],
                            ['มิถุนายน', {{ $reservesbar2_11 }}, {{ $reservesbar2_12 }}],
                            ['กรกฎาคม', {{ $reservesbar2_13 }}, {{ $reservesbar2_14 }}],
                            ['สิงหาคม', {{ $reservesbar2_15 }}, {{ $reservesbar2_16 }}],
                            ['กันยายน', {{ $reservesbar2_17 }}, {{ $reservesbar2_18 }}],
                            ['ตุลาคม', {{ $reservesbar2_19 }}, {{ $reservesbar2_20 }}],
                            ['พฤศจิกายน', {{ $reservesbar2_21 }}, {{ $reservesbar2_22 }}],
                            ['ธันวาคม', {{ $reservesbar2_23 }}, {{ $reservesbar2_24 }}],
                        ]);

                        var options = {
                            chart: {
                                title: 'รายงานลูกค้าเข้าพัก (รายเดือน, รายปี)',
                                // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                            },
                            bars: 'vertical', // Required for Material Bar Charts.
                            hAxis: {
                                format: 'decimal'
                            },
                            height: 400,
                            width: 1200,
                            colors: ['#D14325', '#BBE21C']
                        };

                        var chart = new google.charts.Bar(document.getElementById('chart_div'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));

                        var btns = document.getElementById('btn-group');

                        btns.onclick = function(e) {

                            if (e.target.tagName === 'BUTTON') {
                                options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        }
                    }
                } else {
                    @php
                        ///////////////////////////////////////////////////////////////////////////////
                        $reservesbar3_1 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('1'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_2 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('1'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_3 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('2'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_4 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('2'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_5 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('3'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_6 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('3'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_7 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('4'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_8 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('4'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_9 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('5'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_10 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('5'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_11 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('6'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_12 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('6'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_13 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('7'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_14 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('7'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_15 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('8'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_16 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('8'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_17 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('9'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_18 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('9'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_19 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('10'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_20 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('10'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_21 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('11'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_22 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('11'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_23 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 0)
                            ->whereMonth('reserves.created_at', '=', date('12'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                        $reservesbar3_24 = DB::table('reserves')
                            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
                            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
                            ->orderBy('reserves.id', 'ASC')
                            ->where('checkin_checkouts.walk_in_customers', 1)
                            ->whereMonth('reserves.created_at', '=', date('12'))
                            ->whereYear('reserves.created_at', '=', date('Y'))
                            ->count();
                    @endphp

                    $(row).hide();
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['รายเดือน,รายปี', 'ลูกค้าจอง', 'ลูกค้าวอล์คอิน'],
                            ['มกราคม', {{ $reservesbar3_1 }}, {{ $reservesbar3_2 }}],
                            ['กุมภาพันธ์', {{ $reservesbar3_3 }}, {{ $reservesbar3_4 }}],
                            ['มีนาคม', {{ $reservesbar3_5 }}, {{ $reservesbar3_6 }}],
                            ['เมษายน', {{ $reservesbar3_7 }}, {
                                {
                                    $reservesbar3_8
                                }
                            }],
                            ['พฤษภาคม', {{ $reservesbar3_9 }}, {{ $reservesbar3_10 }}],
                            ['มิถุนายน', {{ $reservesbar3_11 }}, {{ $reservesbar3_12 }}],
                            ['กรกฎาคม', {{ $reservesbar3_13 }}, {{ $reservesbar3_14 }}],
                            ['สิงหาคม', {{ $reservesbar3_15 }}, {{ $reservesbar3_16 }}],
                            ['กันยายน', {{ $reservesbar3_17 }}, {{ $reservesbar3_18 }}],
                            ['ตุลาคม', {{ $reservesbar3_19 }}, {{ $reservesbar3_20 }}],
                            ['พฤศจิกายน', {{ $reservesbar3_21 }}, {{ $reservesbar3_22 }}],
                            ['ธันวาคม', {{ $reservesbar3_23 }}, {{ $reservesbar3_24 }}],
                        ]);

                        var options = {
                            chart: {
                                title: 'รายงานลูกค้าเข้าพัก (รายเดือน, รายปี)',
                                // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                            },
                            bars: 'vertical', // Required for Material Bar Charts.
                            hAxis: {
                                format: 'decimal'
                            },
                            height: 400,
                            width: 1200,
                            colors: ['#D14325', '#BBE21C']
                        };

                        var chart = new google.charts.Bar(document.getElementById('chart_div'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));

                        var btns = document.getElementById('btn-group');

                        btns.onclick = function(e) {

                            if (e.target.tagName === 'BUTTON') {
                                options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        }
                    }
                }
            });
        }

        function removeFiltering() {
            $("#example1 tr").each(function(index, row) {
                $(row).show();
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['รายเดือน,รายปี', 'ลูกค้าจอง', 'ลูกค้าวอล์คอิน'],
                        ['มกราคม', 0, 0],
                        ['กุมภาพันธ์', 0, 0],
                        ['มีนาคม', 0, 0],
                        ['เมษายน', 0, 0],
                        ['พฤษภาคม', 0, 0],
                        ['มิถุนายน', 0, 0],
                        ['กรกฎาคม', 0, 0],
                        ['สิงหาคม', 0, 0],
                        ['กันยายน', 0, 0],
                        ['ตุลาคม', 0, 0],
                        ['พฤศจิกายน', 0, 0],
                        ['ธันวาคม', 0, 0],
                    ]);

                    var options = {
                        chart: {
                            title: 'รายงานลูกค้าเข้าพัก (รายเดือน, รายปี)',
                            // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                        },
                        bars: 'vertical', // Required for Material Bar Charts.
                        hAxis: {
                            format: 'decimal'
                        },
                        height: 400,
                        width: 1200,
                        colors: ['#D14325', '#BBE21C']
                    };

                    var chart = new google.charts.Bar(document.getElementById('chart_div'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));

                    var btns = document.getElementById('btn-group');

                    btns.onclick = function(e) {

                        if (e.target.tagName === 'BUTTON') {
                            options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    }
                }
            });

        }

        function setDropdownChangeHandler() {
            $("#reportSelect").change(function(event) {
                var selection = $("#reportSelect").val();
                if (selection !== NO_FILTERING) {
                    filterTableByPetType(selection);
                } else {
                    removeFiltering();
                }
            });
        }

        populatePetTypeDropdown();
        setDropdownChangeHandler();
    </script> --}}
@endsection
