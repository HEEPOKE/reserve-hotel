@extends('adminlte::page')
@section('content')
    @php

        $num = 1;

    @endphp

    @include('layouts.company_reportcustomer_day.chart')
    @include('layouts.company_reportcustomer_day.table')

    <script>
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['รายวัน', 'ลูกค้าจอง', 'ลูกค้าวอล์คอิน'],
                ['1', 100, 200],
                ['2', 100, 200],
                ['3', 100, 200],
                ['4', 100, 200],
                ['5', 100, 200],
                ['6', 100, 200],
                ['7', 100, 200],
                ['8', 100, 200],
                ['9', 100, 200],
                ['10', 100, 200],
                ['11', 100, 200],
                ['12', 100, 200],
                ['13', 100, 200],
                ['14', 100, 200],
                ['15', 100, 200],
                ['16', 100, 200],
                ['17', 100, 200],
                ['18', 100, 200],
                ['19', 100, 200],
                ['20', 100, 200],
                ['21', 100, 200],
                ['22', 100, 200],
                ['23', 100, 200],
                ['24', 100, 200],
                ['25', 100, 200],
                ['26', 100, 200],
                ['27', 100, 200],
                ['28', 100, 200],
                ['29', 100, 200],
                ['30', 100, 200],
                ['31', 100, 200],
            ]);

            var options = {
                chart: {
                    title: 'รายงานลูกค้าเข้าพัก (รายวัน)',
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
    </script>

    </html>
@endsection
