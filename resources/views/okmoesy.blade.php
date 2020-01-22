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

    const small = Number.EPSILON
    const bigInt = Number.MAX_SAFE_INTEGER
    const max= Number.MAX_VALUE
    const nInf = Number.NEGATIVE_INFINITY
    const Inf = Number.POSITIVE_INFINITY

    const dialog1 = "He looked up and said \"don't do that!\" to MAX.";
    const dialog2 = 'He looked up and said "don\'t do that!" to MAX.';

    const result1 = 3 + '30';
    const result2 = 3 * 30;

    let heating = true;
    let cooling = false;

    const RED = Symbol();
    const ORANGE = Symbol("The color of a sunset!")

    const sam1 = {
        name: 'Sam',
        age: 4,
    }

    const sam2 = { name: 'Sam', age: 4};

    const sam3 = {
        name: 'Sam',
        classification:{
            kingdom: 'Anamalia',
            family: 'Felidae',
        }
    }

    let test1 = sam3.classification.family;
    let test2 = sam3["classification"].family
    let test3 = sam3.classification["family"]
    let test4 = sam3["classification"]["family"]

    sam3.speak = function(){
        return "Meow!";
    }

    let test5 = sam3.speak();
    console.log(sam1,sam2,test1,test2,test3,test4,test5)


</script>

<script src="/js/jquery-3.4.1.min.js"></script>

