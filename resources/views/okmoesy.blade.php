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

                <form  id="test123" name="myForm123" method="post">
                    @csrf
                    <br>

                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">打卡動作類型</span>
                            <input type="text">
                        </div>

                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">班別</span>
                            <input type="text">
                        </div>

                    </div>

                    <div   class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">起始時間</span>
                            <input type="text">
                        </div>

                    </div>




                    <div   class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">終止時間</span>
                            <input type="text">
                        </div>

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


            </div>
        </div>
    </div>
@endsection




<script>

    let n = 0
    let b1 = !!n
    let b2 = Boolean(n)




    console.log(n,b1,b2)



</script>

<script src="/js/jquery-3.4.1.min.js"></script>

