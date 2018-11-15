@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6"><canvas id="prevMonthChart"></canvas></div>
      <div class="col-md-6"><canvas id="thisMonthChart"></canvas></div>
            <script>
              var diseaseCount = [];
              var diseaseData = [];
              if (<?php echo $disease_count[0] ?>>10) {
                diseaseCount[0] = 10;
              }else{
                diseaseCount[0] = <?php echo $disease_count[0] ?>;
              }

              if (<?php echo $disease_count[1] ?>>10) {
                diseaseCount[1] = 10;
              }else{
                diseaseCount[1] = <?php echo $disease_count[1] ?>;
              }
              
              diseaseData = new Array(<?php echo json_encode($prevMonth, JSON_PRETTY_PRINT)?>,<?php echo json_encode($thisMonth, JSON_PRETTY_PRINT)?>);
              
              console.log(diseaseData);
              console.log(diseaseData[0]);
              console.log(diseaseData[0][0]);
              console.log(diseaseCount[0]);
              console.log(diseaseData[0][0].code);
              var prevMonthlabelData = [];
              var prevMonthbarData = [];

              var thisMonthLabelData = [];
              var thisMonthBarData = [];

              for (let i = 0; i < diseaseCount[0]; i++) {
                prevMonthlabelData[i] = diseaseData[0][i].code;
                prevMonthbarData[i] = diseaseData[0][i].total;
              }

              for (let i = 0; i < diseaseCount[1]; i++) {
                thisMonthLabelData[i] = diseaseData[1][i].code;
                thisMonthBarData[i] = diseaseData[1][i].total;
              }
              

              console.log(thisMonthLabelData);
              console.log(thisMonthBarData);
              
              var ctx = document.getElementById("prevMonthChart").getContext('2d');
              var prevMonthChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: prevMonthlabelData,
                  datasets: [{
                    label: '10 Besar Penyakit Bulan ' + '<?php echo($monthsName[0]);?>',
                    data: prevMonthbarData,
                    backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                  }]
                },
                options: {scales: {yAxes: [{ticks: {beginAtZero: true}}]}}
              });
              var ctx = document.getElementById("thisMonthChart").getContext('2d');
              var thisMonthChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: thisMonthLabelData,
                  datasets: [{
                    label: '10 Besar Penyakit Bulan ' + '<?php echo($monthsName[1]);?>',
                    data: thisMonthBarData,
                    backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                  }]
                },
                options: {scales: {yAxes: [{ticks: {beginAtZero: true}}]}}
              });
                  
            </script>
    </div>
</div>
@endsection
