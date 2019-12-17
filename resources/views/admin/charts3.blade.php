@extends('layouts.deals')
@section('content3')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


<div class="part">
    <div class="part1">
                <canvas id="myChart" height="400px" width="370px" ></canvas>
    </div>
    <div class="part2">
                <canvas id="myChart2" height="400px" width="370px"></canvas>
    </div>

</div>

    <script type="text/javascript">
        var ctx = document.getElementById("myChart").getContext("2d");
        var data = {
            labels: [
                @foreach($charts as $t)
                    '<?= $t->name?>',
                @endforeach ],
            datasets: [

                {backgroundColor: "green",
                    label: 'Вирішені справи',
                    data: [ @foreach($charts as $t)
                        '<?= $t->count?>',
                        @endforeach ],
                },


            ]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }]
                }
            }
        });
        var ctx2 = document.getElementById("myChart2").getContext("2d");
        var data2 = {
            labels: [
                @foreach($charts2 as $t)
                    '<?= $t->name?>',
                @endforeach ],
            datasets: [

                {backgroundColor: "red",
                    label: 'Невирішені справи',
                    data: [ @foreach($charts2 as $t)
                        '<?= $t->count?>',
                        @endforeach ],
                },


            ]
        };

        var myBarChart = new Chart(ctx2, {
            type: 'bar',
            data: data2,
            options: {
                barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }]
                }
            }
        });
    </script>
@endsection