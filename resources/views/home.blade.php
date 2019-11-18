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
                        當前---用戶 : {{Auth::user()->name}}
                    </div>

                    <div class="col-md-6">

                        <div id="showbox" class="text-danger"></div>
                    </div>


                </div>


                <script>ShowTime()</script>
                <form  id="punchForm" method="post" action="{{ route('Worker.store') }}">
                    @csrf
                    <br>
                
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">打卡動作類型</span>
                        </div>
                        <select  id="punchType" class="form-control" name="punch-type">
                            <option value="1">上班</option>
                            <option value="2">下班</option>
                        </select>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">班別</span>
                        </div>
                        <select  id="shiftType"  class="form-control" name="shift-type">
                            <option value="3">全班</option>
                            <option value="1">早班</option>
                            <option value="2">午班</option>
                        </select>
                    </div>

                    <div class="input-group input-group-sm mb-3 d-none">
                        <input  id="punchResult"  type="text" class="form-control" name="punchResult" >
                    </div> 

                    <div  id="remark" class="input-group input-group-sm mb-3 d-none">
                        <div class="input-group-prepend">
                            <label for="remark" class="input-group-text" >遲到/早退原因</label>
                        </div>
                        <input type="text" class="form-control"  name="remark" placeholder="請輸入遲到or早退原因">
                    </div>

                   


                    <button id="punchSubmit" class="btn btn-danger align-content-sm-end" type="submit">punch!!</button>
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

                        @foreach($records as $time)
                            <tr>
                                <td>{{$time->shift}}</td>
                                <td>{{$time->action}}</td>
                                @if($time->result<>'正常')
                                    <td class="table-danger">{{$time->result}}</td>
                                @else
                                    <td class="">{{$time->result}}</td>
                                @endif
                                <td>{{$time->time}}</td>
                            </tr>
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
    const getTime=(NowDate)=>{
        NowDate.setSeconds(NowDate.getSeconds()+1);
        let h = NowDate.getHours();
        let m = NowDate.getMinutes();
        let s = NowDate.getSeconds();
        return {h,m,s};
    }
    

    //動態時間
    function ShowTime() {
        let {h,m,s}=getTime(NowDate);
        document.getElementById('showbox').innerHTML = '當前時間 : '+h + ':' + m + ':' + s ;
        setTimeout('ShowTime()', 1000);
    }
    
</script>

<script src="/js/punch.js"></script>
