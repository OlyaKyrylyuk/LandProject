@extends('layouts.deals')
@section('content3')

    <div class="usrs">
        <div class="need1">

                <input id="date" type="date" class="form-control" name="date"  required autofocus />

                <input id="from_date" type="text" class="form-control" name="from_date"  required autofocus />

                <button type="button" name="filter" id="filter" class="btn btn-info btn-md">Вибрати</button>
                <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-md">Відмінити</button>

                <form action="/admin/PDF" method="get">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger btn-md">Сформувати звіт</button>
                </form>

        </div>
        <div class="appl">
            <h1 class="forh1">Справи</h1>
            <div class="tables">
            <table class="table table-stripped table-hover">
                <thead>
                <th class="tt">Номер справи</th>
                <th class="tt">Суддя</th>
                <th class="tt">Предмет позову</th>
                <th class="tt">Заява</th>
                <th class="tt">Адвокат</th>
                <th class="tt">Інстанція</th>
                <th class="tt">Дата проведення справи</th>
                </thead>

                <tbody>

                </tbody>


            </table>
            {{ csrf_field() }}

        </div>
    </div></div>
    <script>
        $(document).ready(function(){

            var _token = $('input[name="_token"]').val();

            fetch_data();
            function fetch_data(from_date='',date='')
            {
console.log(date);
                console.log(from_date);
                $.ajax({
                    url:"{{ route('route2') }}",
                    method:"POST",
                    data:{from_date:from_date,date:date, _token:_token},
                    dataType:"json",
                    success:function(dat)
                    {

                        var output = '';
                        $('#total_records').text(dat.length);
                        for(var count = 0; count < dat.length; count++)
                        {
                            output += '<tr>';
                            output += '<td>' + dat[count].number + '</td>';
                            output += '<td>' + dat[count].judge+ '</td>';
                            output += '<td>' + dat[count].subject_claim+ '</td>';
                            output += '<td>' + dat[count].number2 + '</td>';
                            output += '<td>' + dat[count].surname+' '+dat[count].name+' '+dat[count].fathersname + '</td>';
                            output += '<td>' + dat[count].type + '</td>';
                            output += '<td>' + dat[count].deal_start +' '+dat[count].deal_end+ '</td>';
                            output += '<td>' + '<form method="post" action="/admin/steps/delete/'+dat[count].id+'">{{method_field('POST')}}{{ csrf_field() }} <input type="submit" class="btn btn-danger" value="Видалити"></button></form>' + '</td></tr>';

                        }
                        $('tbody').html(output);

                    }
                })
            }

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var date = $('#date').val();

                if((from_date != '')&&(date!=''))
                {
                    fetch_data(from_date,date);
                }
                else if((from_date != '')||(date!=''))
                {
                    fetch_data(from_date,date);
                }

                else
                {
                    $('#from_date').val('');
                    $('#date').val('');
                    fetch_data();
                }
            });

            $('#refresh').click(function(){
                $('#from_date').val('');
                $('#date').val('');
                fetch_data();
            });


        });
    </script>
@endsection
