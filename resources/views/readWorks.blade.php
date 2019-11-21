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
                @if( $workersPunchData!=null)
                @foreach($workersPunchData as $workId=>$workMonthData)
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
                      <th scope="row">{{$workMonthData['name']}}</th>
                      <td>{{$workMonthData['hours']}}</td>
                        <td>{{$workMonthData['late']['count']}}</td>
                        <td>{{$workMonthData['leaveEarly']['count']}}</td>
                        <td>{{$workMonthData['leave']['count']}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- 詳細資料區-->
                  <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col-3">狀態</th>
                        <th scope="col-3">日期</th>
                        <th scope="col-6">事由</th>
                      </tr>
                     </thead>
                    <tbody>
                        <!--遲到 -->
                        @if($workMonthData['late']['data'] !=null )
                            @foreach($workMonthData['late']['data'] as $lateData)
                      <tr>
                        <th scope="row">遲到</th>
                        <td>{{$lateData->day}}</td>
                      <td>{{$lateData->remark}}</td>
                      </tr>
                      @endforeach
                      @endif
                      <!--早退-->
                      @if($workMonthData['leaveEarly']['data'] !=null )
                      @foreach($workMonthData['leaveEarly']['data'] as $leaveEarlyData)
                <tr>
                  <th scope="row">早退
                  </th>
                  <td>{{$leaveEarlyData->day}}</td>
                <td>{{$leaveEarlyData->remark}}</td>
                </tr>
                @endforeach
                @endif
                      <!--請假-->
                      @if($workMonthData['leave']['data'] !=null )
                      @foreach($workMonthData['leave']['data'] as $leaveData)
                <tr>
                  <th scope="row">請假</th>
                  <td>{{$leaveData->day}}</td>
                <td>{{$leaveData->remark}}</td>
                </tr>
                @endforeach
                @endif
                      <!--異常-->
                      @if($workMonthData['other']['data'] !=null )
                      @foreach($workMonthData['other']['data'] as $otherData)
                <tr>
                  <th scope="row" class="text-danger">異常</th>
                  <td>{{$otherData->day}}</td>
                  @if($otherData->actionId==1)
                <td>下班未打卡</td>
                @elseif($otherData->actionId==2)
                <td>上班未打卡</td>
                @endif
                </tr>
                @endforeach
                @endif
                    </tbody>
                  </table>
                  @endforeach
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
