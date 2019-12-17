<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Справи</title>
</head>
<body>
<style>
    body { font-family: DejaVu Sans, sans-serif; }
    th,td {border: 1px solid grey;}
    th{background-color:#2ab27b; border: 1px solid #000000;
    color: #000000;}
    th,h1{text-align: center;}
    .tt{vertical-align: top;padding-top:10px;padding-left: 0px;}
    .td{background-color: #d3ffd8;}
    .t1{ width:40px;}
    .t2{width:90px; text-align: center;}
    .tt2{text-align: center;}

</style>


        <div class="col-md-12">
<h1 class="forh1_2">Cправи</h1>
<table class="table table-bordered">

    <thead>
    <tr>
    <th class="t1">№ Справи</th>
    <th class="t2">Суддя</th>
    <th class="t2">Предмет позову</th>
    <th class="t2">Адвокат</th>
    <th class="t1">Інстанція</th>
    <th class="t2">Дата проведення справи</th>
    <th class="t2">Рішення</th>
    </tr>
    </thead>

    <tbody>
    @foreach($deals as $deal)

        <tr>
            <td class="td">{{$deal->number}}</td>
            <td class="tt">{{$deal->judge}}</td>
            <td class="tt">{{$deal->subject_claim}}</td>
            <td class="tt">{{$deal->surname}} {{$deal->name}} {{$deal->fathersname}}</td>
            <td class="tt2">{{$deal->type}}</td>
            @if(($deal->deal_start!=NULL)&&($deal->deal_end))<td> Початок: {{$deal->deal_start}}  Кінець:  {{$deal->deal_end}}</td>@endif
            @if($deal->decision==NULL)<td class="tt2"> Не вирішено</td> @else <td class="tt2">{{$deal->decision}}</td>@endif
        </tr>

    @endforeach
    </tbody>

</table>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
