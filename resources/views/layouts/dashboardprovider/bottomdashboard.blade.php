<style>
    .chart-wrapper {
  height: 300px;
  width: 600px;
}
</style>

<div class="card card-info poChart mt-3">
    <div class="card-header">
        <h3 class="card-title"><strong>จำนวนผู้ประกอบการสมัครใช้งานในปี {{ $yearTH }}</strong></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <center><div class="chart-wrapper">
        <canvas id="myChart" class="reserveChart"></canvas>
        </div></center>
    </div>
</div>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    const labels = {!! $labels !!};

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'จำนวนผู้ประกอบการสมัครใช้งาน',
                data: {{ $data }},
                backgroundColor: [
                    'rgba(220,20,60, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(218,165,32, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(0,255,127, 0.2)',
                    'rgba(120,250,154, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(148,0,211, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(220,20,60)',
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(218,165,32)',
                    'rgb(255, 205, 86)',
                    'rgb(0,255,127)',
                    'rgb(120,250,154)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(148,0,211)',
                    'rgb(201, 203, 207)'
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
</script>
