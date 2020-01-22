@extends('layouts.app')

@section('content')

@if( \Session::has('message') )
<div class="alert alert-danger">
    {{--                            @foreach($message as $m)--}}
    <strong>{!! \Session::get('message') !!}</strong>
    {{--                            @endforeach--}}
</div>
@endif
@if( \Session::has('messageSuccess') )
<div class="alert alert-success">
{{--                            @foreach($message as $m)--}}
<strong>{!! \Session::get('messageSuccess') !!}</strong>
{{--                            @endforeach--}}
</div>
@endif




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
                <form  id="punchForm" name="myForm" method="post" action="{{ route('Worker.store') }}">
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
                        <select id="shiftType"  class="form-control" onchange="Gearing(this.selectedIndex);"   name="shift-type">           //onchange事件監聽
                            @foreach($shift_types as $shift_type)
                                @if( $shift_type->status == 1)
                                <option value="{{$shift_type->id}}">{{$shift_type ->name}}</option>
                                @else
                                    @endif
                            @endforeach
                        </select>
                    </div>

                    <div   class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">起始時間</span>
                        </div>
                        <select  id="start"   disabled class="form-control" name="shiftTypeStart">
                            @foreach($shift_types as $shift_type)
                                    <option value="{{$shift_type->start}}">{{$shift_type ->start}}</option>
                            @endforeach
                        </select>
                    </div>




                    <div   class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">終止時間</span>
                        </div>
                        <select  id="end"  disabled class="form-control" name="shiftTypeEnd">
                            @foreach($shift_types as $shift_type)
                                    <option value="{{$shift_type->end}}" >{{$shift_type ->end}}</option>
                            @endforeach
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
                            <th>備註</th>
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
                                <td>{{$time->remark}}</td>
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



    function Gearing(index) {
        let type = [document.getElementById('shiftType').options[index].value];     //利用欄位ID抓取type的資料,options[index]為目前所選取到的值
        let start = document.getElementById('start').options[index].value;          //利用欄位ID抓取start的資料,options[index]為目前所選取到的值
        let end = document.getElementById('end').options[index].value;              //利用欄位ID抓取end的資料,options[index]為目前所選取到的值
        type.push(start)        //將start的資料丟進type陣列做資料合併成新陣列 , 此處陣列格式[type,start]
        type.push(end)          //將end的資料丟進type陣列做資料合併成新陣列  , 此處陣列格式[type,start,end]
        console.log(type)      //印出type陣列


            //班別跟起始時間連動   (.on為向"某"元素添加"某"事件處理程序,此處 .on為向 div 元素添加 click 事件處理程序)
            $('#shiftType').click(function () {                            //寫一個click監聽事件
                $('div').on('click','#shiftType', function() {            // $('div')為DOM寫法,當'#shiftType'欄位 click 時, 就執行底下的function
                    $('#start').val(type[[1]]);                            //$('#start')為欲連動的欄位,val為欲輸出的值,(type[[1]])抓取陣列內第一欄位值 陣列格式type[[0],[1],[2]....]
                    });
                });

            //班別跟終止時間連動
            $('#shiftType').click(function () {                            //寫一個click監聽事件
                $('div').on('click','#shiftType', function() {             // $('div')為DOM寫法,當'#shiftType'欄位 click 時, 就執行底下的function
                    $('#end').val(type[[2]]);                               //$('#end')為欲連動的欄位,val為欲輸出的值,(type[[2]])抓取陣列內第二欄位值 陣列格式type[[0],[1],[2]....]
                    });
                });

    }

</script>

<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/punch.js"></script>
