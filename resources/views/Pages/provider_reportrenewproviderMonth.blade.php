@extends('adminlte::page')
@section('content')

    @include('layouts.provider_reportrenewproviderMonth.chart')
    @include('layouts.provider_reportrenewproviderMonth.table')

    @if ($chart != '')
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['รายงานผู้ใช้งานที่ต่ออายุรายเดือน', 'จำนวนผู้ใช้งานต่ออายุรายเดือน'],
                    @php
                        for ($i = 0; $i < count($chart); $i++) {
                            echo '[';
                            echo "'" . $chart[$i]['month'] . "',";
                            echo number_format($chart[$i]['countMonth']);
                            echo '],';
                        }
                    @endphp
                ]);

                var options = {
                    chart: {
                        title: 'รายงานผู้ใช้งานที่ต่ออายุรายเดือน ปี {{ $id ?? '' }}',
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
    @elseif ($chart == '')
         <div class="chuchu" />{{ 'จ๊ะเอ๋ ตะเอง ทำไรอ่ะ' }}</div>
    @endif
@endsection
