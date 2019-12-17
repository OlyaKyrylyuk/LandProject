@extends('layouts.deals')
@section('content3')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <div class="container">


        <div class = "beauty">
            <div class="beauty_two">

                <table class="table1">
                    <tr class = "tr1">
                        <th class = "th1">№</th>
                        <th class = "th1">Представник в суді</th>
                    </tr>
                    @foreach($deals2 as $deal)
                        <tr class = "tr1">
                            <td class = "td1">{{$deal->id}}</td>
                            <td class = "td1">{{$deal->name}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="beauty_one">
                <canvas id="popChart" ></canvas>
            </div>

</div>
        <table class="table1">

            <tr>
                <td>№</td>
                @foreach($deals as $deal)
                <td>{{$deal->id}}</td>
                    @endforeach
            </tr>
            <tr>
                <td>Номер справи</td>
                @foreach($deals as $deal)
                    <td>{{$deal->number}}</td>
                @endforeach
            </tr>


        </table>
        <script>
            var popData = {
                datasets: [{
                    label: ['Статистика'],
                    data:[
                         @foreach($charts_f as $f)
                        {x:"<?= $f->id?>" ,y: "<?= $f->id2?>",r: 10},
                        @endforeach
                         @foreach($charts_s as $s)
                        {x: "<?= $s->id?>",y: "<?= $s->id2?>",r: 15},
                        @endforeach
                            @foreach($charts_t as $t)
                        {x:"<?= $t->id?>",y: "<?= $t->id2?>" ,r: 20},
                        @endforeach
                    ],
                   /* data: [{
                        x: 1,
                        y: 3,
                        r: 10
                    }, {
                        x: 2,
                        y: 2,
                        r: 20
                    }, {
                        x: 3,
                        y: 1,
                        r: 25
                    }, {
                        x: 4,
                        y: 2,
                        r: 50
                    }, {
                        x: 5,
                        y: 3,
                        r: 25
                    }, {
                        x: 6,
                        y: 2,
                        r: 5
                    },
                        {
                            x: 7,
                            y: 2,
                            r: 5
                        },
                        {
                            x: 8,
                            y: 2,
                            r: 5
                        }],*/
                    backgroundColor: "#FF9966"
                }]
            };

            var bubbleChart = new Chart(popChart, {
                type: 'bubble',
                data: popData,


            });





        </script>
@endsection