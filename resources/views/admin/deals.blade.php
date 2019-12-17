@extends('layouts.deals')
@section('content3')

    <div class="usrs">
            <div class="need">
                <div class="cl1">
                    <input id="from_date" type="text" class="form-control" name="from_date"  required autofocus />
                    </div>
                <div class="cl2">
                    <button type="button" name="filter" id="filter" class="btn btn-info btn-md">Вибрати</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-md">Відмінити</button>
                </div>
            </div>
            <div class="appl">
                <h1 class="forh1">Справи</h1>
                <table class="table table-striped">
                    <thead>
                    <th class="tt">№</th>
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
            function fetch_data(from_date='')
            {

                $.ajax({
                    url:"{{ route('route2') }}",
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
                            output += '<td>' + dat[count].judge+ '</td>';
                            output += '<td>' + dat[count].subject_claim+ '</td>';
                            output += '<td>' + dat[count].number2 + '</td>';
                            output += '<td>' + dat[count].surname+' '+dat[count].name+' '+dat[count].fathersname + '</td>';
                            output += '<td>' + dat[count].type + '</td>';
                            output += '<td>' + dat[count].deal_start +' '+dat[count].deal_end+ '</td>';
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
