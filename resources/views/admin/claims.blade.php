
@extends('layouts.admin')
@section('content2')
    <div class="all1">
        <div class="usrs">
            <div class="need2">
                <div class="cl1">
                    <select id="from_date" type="text" class="form-control" name="from_date"  required autofocus>
                        <option name = "from_date" value="with_number">Заява з номером</option>
                        <option name = "from_date" value="without_number">Заява без номеру</option>
                    </select></div>
                <div class="cl2">
                    <button type="button" name="filter" id="filter" class="btn btn-info btn-md">Вибрати</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-md">Відмінити</button>
                </div>
            </div>
            <div class="appl">
                <h1 class="forh1">Заяви</h1>
                <div class="tables">
                <table class="table table-striped">
                    <thead>
                    <th class='tt'>Номер заяви</th>
                    <th class='tt'>Скарга</th>
                    <th class='tt'>ПІБ/Компанія</th>
                    <th class='tt'>Email</th>
                    </thead>

                    <tbody>

                    </tbody>


                </table>
                </div>
                {{ csrf_field() }}

            </div>
        </div></div>
    <script>
        $(document).ready(function(){

            var _token = $('input[name="_token"]').val();

            fetch_data();
            function fetch_data(from_date='')
            {

                $.ajax({
                   url:"{{ route('route') }}",
                    method:"POST",
                    data:{from_date:from_date, _token:_token},
                    dataType:"json",
                    success:function(dat)
                    {

                        var output = '';
                        $('#total_records').text(dat.length);
                        for(var count = 0; count < dat.length; count++)
                        {
                            output += '<tr>';
                            output += '<td>' + dat[count].number + '</td>';
                            output += '<td>' + dat[count].reason+ '</td>';
                            output += '<td>' + dat[count].name + '</td>';
                            output += '<td>' + dat[count].email + '</td>';
                            output += '<td>' + '<form method="post" action="/admin/claim/'+dat[count].id+'">{{method_field('PUT')}}{{ csrf_field() }}<input type="text" name="number" placeholder="Введіть номер заяви.."/> <input type="submit" class="btn btn-success" value="Змінити"></button></form>' + '</td></tr>';
                        }
                        $('tbody').html(output);

                    }
                })
            }

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                if(from_date != '')
                {
                    fetch_data(from_date);
                }
                else
                {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function(){
                $('#from_date').val('');

                fetch_data();
            });


        });
    </script>
@endsection
