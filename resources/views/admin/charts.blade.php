@extends('layouts.deals')
@section('content3')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>



        <div class = "beauty">
            <div class="beauty_one">
                <div class="tables">
                <canvas id="oilChart" ></canvas>
                </div>
            </div>
            <div class="beauty_two">
                <div class="tables">
                <table class="table1">
                    <tr class = "tr1">
                        <th class = "th1">Не вирішені справи</th>
                        <th class = "th1">Представник в суді</th>
                        <th class = "th1">Адвокат</th>

                    </tr>
                    @foreach($deals as $deal)
                        <tr class = "tr1">
                            <td class = "td1">{{$deal->number}}</td>

                            <td class = "td1">{{$deal->surname}} {{$deal->name}} {{$deal->fathersname}}</td>
                            <td class = "td1">{{$deal->name2}}</td>
                        </tr>
                    @endforeach
                </table>
                </div>
            </div>

    </div>




    <script>

        var oilCanvas = document.getElementById("oilChart");

        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 18;

        var oilData = {
            labels: [
                "Вирішені справи",
                "Не вирішені справи",
            ],
            datasets: [
                {
                    data: [ "<?= $charts3_1?>", "<?=$charts3?>"],
                    backgroundColor: [


                        "#84FF63",
                        "#FF9966"

                    ]
                }]
        };

        var pieChart = new Chart(oilCanvas, {
            type: 'pie',
            data: oilData
        });



    </script>
@endsection