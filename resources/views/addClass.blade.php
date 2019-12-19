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



                <form action="{{ route('addClass.post') }}" method="post">
        <div class="modal-body">

        @csrf
        <!-- 打卡狀態 -->
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">班別名稱</span>
                </div>
                <input type="text" name="shift_type_name" id="shift_type_name"  class="form-control" >
            </div>

            <!-- 起始時間-->
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">上班時間</span>
                </div>
                <input type="Datetime-local"  class="form-control"  name="shift_type_start" id="shift_type_start">
            </div>

            <!-- 結束時間-->
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">下班時間</span>
                </div>
                <input type="Datetime-local"  class="form-control"  name="shift_type_end" id="shift_type_end">
            </div>

            <!-- status -->
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">使用的狀態</span>
                </div>
                <select class="form-control" name="shift_type_status" id="shift_type_status">
                    <option value="" selected disabled> 請選擇</option>
                        @foreach($statuses as $status)
                        <option value="{{$status->id}}">{{$status->name}}</option>
                        @endforeach
                </select>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary">送出</button>
        </div>
    </form>
</div>
        </div>
    </div>
@endsection














<script>
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

