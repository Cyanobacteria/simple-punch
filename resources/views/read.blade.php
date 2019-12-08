@extends('layouts.app')

@section('content')






    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(isset($_GET['message']) )
                    <div class="alert alert-success">
                        {{--                            @foreach($message as $m)--}}
                        <strong>{{$_GET['message']}}</strong>
                        {{--                            @endforeach--}}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-5">
                        當前用戶 : {{Auth::user()->name}}
                    </div>

                    <div class="col-md-6">

                        <div id="showbox" class="text-danger"></div>
                    </div>


                </div>


                <script>ShowTime()</script>
                <form method="post" action="{{ route('read.post') }}">
                    @csrf
                    <br>

                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">月份</span>
                        </div>
                        <select class="form-control" name="month">
                            @foreach($month as $m)
                                <option value="{{$m}}">{{$m}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-danger align-content-sm-end" type="submit">查詢</button>
                </form>
                @if( $records!=null)
                    <h2 class="text-center" style="margin-top: 30px;">今日打卡紀錄</h2>
                    <table class="table" style="margin-top: 10px;">
                        <thead class="thead-dark">
                        <tr>
                            <th>班別</th>
                            <th>動作</th>
                            <th>結果</th>
                            <th>時間</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($records as $month=>$days)
                            <tr>
                                <td class="text-center" colspan="4">{{$month}}</td>
                            </tr>
                            @foreach($days as $day)
                                <tr>
                                    <td>{{$day->shift}}</td>
                                    <td>{{$day->action}}</td>
                                    @if($day->result<>'正常')
                                        <td class="table-danger">{{$day->result}}</td>
                                    @else
                                        <td class="">{{$day->result}}</td>
                                    @endif
                                    <td>{{$day->time}}</td>
                                </tr>
                            @endforeach
                        @endforeach

                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection


<script>
    let NowDate = new Date('{{$now}}');
    const getTime = (NowDate) => {
        NowDate.setSeconds(NowDate.getSeconds() + 1);
        let h = NowDate.getHours();
        let m = NowDate.getMinutes();
        let s = NowDate.getSeconds();
        return {h, m, s};
    }

    function ShowTime() {
        let {h, m, s} = getTime(NowDate);
        document.getElementById('showbox').innerHTML = '當前時間 : ' + h + ':' + m + ':' + s;
        setTimeout('ShowTime()', 1000);
    }
</script>
