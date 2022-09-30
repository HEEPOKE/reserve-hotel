@extends('adminlte::page')
@section('content')
    @php
        
        $num = 1;
        
    @endphp
    @include('layouts.provider_reportnewproviderYear.chart')
    @include('layouts.provider_reportnewproviderYear.table')

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {{ $labelsyear_alls }},
                datasets: [{
                    label: 'จำนวนผู้ใช้งานที่มาสมัครใหม่รายปี',
                    data: {{ $datayear_alls }},
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const changeYear = document.getElementById('selectyear');
        changeYear.addEventListener('change', Change);

        function Change() {
            const yearSelect = changeYear.options[changeYear.selectedIndex].text;

            if (yearSelect == 'ทั้งหมด') {
                myChart.data.labels = {{ $labelsyear_alls }};
                myChart.data.datasets[0].data = {{ $datayear_alls }};
            } else {
                myChart.data.labels = [yearSelect];
                myChart.data.datasets[0].data = changeYear.value;
            }

            myChart.update();
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#selectyear").on("change", function() {
                var year = $('#selectyear').find("option:selected").text();
                SearchData(year)
            });
        });

        function SearchData(year) {
            if (year.toUpperCase() == 'ทั้งหมด') {
                $('#listyear tbody tr').show();
            } else {
                $('#listyear tbody tr:has(td)').each(function() {
                    var rowyear = $.trim($(this).find('td:eq(0)').text());
                    if (year.toUpperCase() != 'ทั้งหมด') {
                        if (rowyear.toUpperCase() == year.toUpperCase()) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    } else if ($(this).find('td:eq(0)').text() != '' || $(this).find('td:eq(0)').text() != '') {
                        if (year != 'ทั้งหมด') {
                            if (rowyear.toUpperCase() == year.toUpperCase()) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        }
                    }

                });
            }
        }
    </script>
@endsection
