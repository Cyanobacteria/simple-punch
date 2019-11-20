@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- [ 訊息提示清單]-->
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
                <!-- [ 月份選擇-下拉選單]-->
                <form method="post" action="{{ route('workerRecord.post') }}">
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
                <!-- [ 資料呈現區 ]-->
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">姓名</th>
                        <th scope="col">總時數</th>
                        <th scope="col">遲到</th>
                        <th scope="col">早退</th>
                        <th scope="col">請假</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">water</th>
                        <td>20</td>
                        <td>5</td>
                        <td>4</td>
                        <td>3</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col-3">狀態</th>
                        <th scope="col-3">日期</th>
                        <th scope="col-6">事由</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">遲到</th>
                        <td>2019-11-01</td>
                        <td>睡過頭</td>

                      </tr>
                    </tbody>
                  </table>



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
