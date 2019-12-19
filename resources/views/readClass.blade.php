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



                    <form action="{{ route('readClass.post') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <table class="table" style="text-align:center;" name="updateClass" >
                                <thead class="thead-dark">
                                <tr>
                                    <th>id</th>
                                    <th>班別</th>
                                    <th>起始時間</th>
                                    <th>結束時間</th>
                                    <th>狀態</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shift_types as $shift_type )
                                    <tr>
                                        <td ><input  style="width:60px" name="shift_type_id[]"  class=" form-control" value="{{$shift_type->id}}" type="text" readonly></td>
                                        <td ><input style="width:120px" name="shift_type_name[]" class="form-control" value="{{$shift_type->name}}" type="text" readonly></td>
                                        <td ><input style="width:120px" name="shift_type_start[]" class="form-control" value="{{$shift_type->start}}" type="text" readonly> </td>
                                        <td ><input style="width:120px" name="shift_type_end[]" class="form-control" type="text" value="{{$shift_type->end}}"   readonly></td>
                                        <td align="center">
                                            <div class="center">
                                                <div class="switch_demo">
                                                    <select class="form-control" name="shift_type_status[]" >
                                                        @if($shift_type->status == 1)
                                                            <option value="1" selected>可用</option>
                                                            <option value="2">不可用</option>
                                                        @else
                                                            <option value="1">可用</option>
                                                            <option value="2" selected>不可用</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary float-right">送出</button>
                            </div>

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
    };


    //動態時間
    function ShowTime() {
        let {h,m,s}=getTime(NowDate);
        document.getElementById('showbox').innerHTML = '當前時間 : '+h + ':' + m + ':' + s ;
        setTimeout('ShowTime()', 1000);
    }

</script>

