@extends('adminlte::page')
@section('content')

    @include('layouts.provider_reportnewproviderD&M.chart')
    @include('layouts.provider_reportnewproviderD&M.table')

    @if ($chart != '')
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['รายงานผู้ใช้งานรายวัน,รายเดือน', 'จำนวนผู้ใช้เเบบรายวัน',
                        'จำนวนผู้ใช้เเบบรายเดือน'
                    ],
                    @php
                        for ($i = 0; $i < count($chart); $i++) {
                            echo '[';
                            echo "'" . $chart[$i]['month'] . "',";
                            echo number_format($chart[$i]['countDay']) . ',';
                            echo number_format($chart[$i]['countMonth']);
                            echo '],';
                        }
                    @endphp
                ]);

                var options = {
                    chart: {
                        subtitle: 'รายงานผู้ใช้งานที่ต่ออายุรายวัน,รายเดือน ปี {{ $id ?? '' }}',
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
    @elseif($chart == '')
        <div class="chuchu" />{{ 'จ๊ะเอ๋ ตะเอง ทำไรอ่ะ' }}</div>
    @endif
@endsection
