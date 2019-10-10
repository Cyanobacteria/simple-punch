@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{--            <div>{{Auth::user()->name}}</div>--}}





                @if(Auth::user()->admin != 1)
                    @if(isset($_GET['message']) )
                        <div class="alert alert-success">
{{--                            @foreach($message as $m)--}}
                                <strong>{{$_GET['message']}}</strong>
{{--                            @endforeach--}}
                        </div>
                    @endif

                    <form method="post" action="{{ route('Worker.store') }}">
                        @csrf
                        <input hidden type="text" name="user_name" value="{{ Auth::user()->name }}">
                        <br>
                        <div class="form-group">
                            <select class="form-control" name="status">
                                　
                                <option value="上班">上班</option>
                                　
                                <option value="下班">下班</option>
                            </select>
                        </div>
                        <button class="btn btn-danger" type="submit">送出</button>
                    </form>
                    @if(isset($time_data))
                        <table class="table" style="margin-top: 50px;">
                            <thead>
                            <tr>
                                <th>名稱</th>
                                <th>狀態</th>
                                <th>時間</th>
                                <th>描述</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($time_data as $time)
                                <tr>
                                    <td>{{$time->name}}</td>
                                    <td>{{$time->status}}</td>
                                    <td>{{$time->created_at}}</td>
                                    <td>{{$time->detail}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @endif
                @else

                    @if(isset($allRecord))
                        <table class="table" style="margin-top: 50px;">
                            <thead>
                            <tr>
                                <th>名稱</th>
                                <th>狀態</th>
                                <th>時間</th>
                                <th>描述</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($allRecord as $time)
                                <tr>
                                    <td>{{$time->name}}</td>
                                    <td>{{$time->status}}</td>
                                    <td>{{$time->created_at}}</td>
                                    <td>{{$time->detail}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
