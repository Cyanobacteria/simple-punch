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
                          <option value="" disabled selected>選擇檢視月份</option>
                            @foreach($month as $m)
                                @if($sMonth == $m)
                                    <option value="{{$m}}" selected>{{$m}}</option>
                                @else
                                    <option value="{{$m}}">{{$m}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-danger align-content-sm-end" type="submit">查詢</button>


<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter1">
    代打請假
  </button>


                </form>


                <div id="workRecord">


                <!-- [ 資料呈現區 ]-->

                @foreach($workersPunchData as $workId=>$workMonthData)
                @if(  !($workMonthData['monthData']==[]))
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">姓名</th>
                        <th scope="col">工作日</th>
                        <th scope="col">總時數</th>
                        <th scope="col">遲到</th>
                        <th scope="col">早退</th>
                        <th scope="col">請假</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <th scope="row">{{$workMonthData['name']}}</th>
                      <td>{{$workMonthData['workDay']}}</td>
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
                        <th scope="col">狀態</th>
                        <th scope="col">日期</th>
                        <th scope="col">事由</th>
                        <th scope="col">修改</th>
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
                      <td>
                            <button type="button"  class="btn btn-primary"  data-username={{$workMonthData['name']}}  data-punchrecordid={{$lateData->punchRecordId }}  data-userid={{$lateData->userId }}   data-toggle="modal" data-target="#exampleModalCenter">
                                    編輯
                                  </button>
                      </td>
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
                <td>
                        <button type="button"  class="btn btn-primary"  data-username={{$workMonthData['name']}}  data-punchrecordid={{$leaveEarlyData->punchRecordId }}  data-userid={{$leaveEarlyData->userId }}   data-toggle="modal" data-target="#exampleModalCenter">
                                編輯
                              </button>
                  </td>
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
                <td>
                        <button type="button"  class="btn btn-primary"  data-username={{$workMonthData['name']}}  data-punchrecordid={{$leaveData->punchRecordId }}  data-userid={{$leaveData->userId }}   data-toggle="modal" data-target="#exampleModalCenter">
                                編輯
                              </button>
                  </td>
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
                <td>
                        <button type="button"  class="btn btn-primary"  data-username={{$workMonthData['name']}}  data-punchrecordid={{$otherData->punchRecordId }}  data-userid={{$otherData->userId }}   data-toggle="modal" data-target="#exampleModalCenter">
                                編輯
                              </button>
                  </td>
                </tr>
                @endforeach
                @endif
                    </tbody>
                  </table>
                   @endif
                  @endforeach



                </div>

            </div>
        </div>
    </div>
@endsection

<!-- Button trigger modal -->


      <!-- Modal-編輯卡片元件 -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">管理者更新</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{ route('updatedRecord.post') }}" method="post">
              @csrf
            <div class="modal-body">
                <input class="d-none" type="text" id="punchid" name="punchid">
            <!-- 員工姓名 -->
                    <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">員工姓名</span>
                            </div>
                              <input  id="workname" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  disabled>
                          </div>
                            <!-- 打卡時間 -->
                    <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">打卡時間</span>
                            </div>
                            <input  id="workpunchtime" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" disabled>
                          </div>
                            <!-- 打卡結果 -->
                    <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span  class="input-group-text" id="inputGroup-sizing-sm">打卡結果</span>
                            </div>

                         <select name="workpunchresult" id="workpunchresult" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >


                            <option value="1">遲到</option>
                             <option value="2">早退</option>
                             <option value="3" >正常</option>
                         </select>

                        </div>
                            <!-- 備註 -->
                    <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">備註</span>
                            </div>
                            <input type="text"  name="workpunchremark" id="workpunchremark" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                          </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
              <button type="submit" class="btn btn-primary">確認修改</button>
            </div>
        </form>
          </div>
        </div>
      </div>
       <!-- Modal - 管理者代為打卡-->
  <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">管理者代打卡</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('punchLeave.post') }}" method="post">
          <div class="modal-body">

              @csrf
             <!-- 員工姓名 -->
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">員工姓名</span>
              </div>
             <select class="form-control" name="user_id" id="">
               <option value="" selected disabled> 請選擇</option>
               @foreach($workers as $worker )
             <option value="{{$worker ->id}}">{{$worker ->name}}</option>
             @endforeach
             </select>

              </div>
              <!-- 日期-->
              <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">日期</span>
                  </div>
                  <input type="datetime-local"  class="form-control"  name='date'>

                </div>
              <!-- 班別 -->
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">班別</span>
                  </div>
                  <select class="form-control" name="shift_type_id" id="">
                      <option value="" selected disabled> 請選擇</option>
                     @foreach($shiftTypes as $shiftType)
                  <option value="{{$shiftType->id}}">{{$shiftType->name}}</option>
                  @endforeach
                </select>

                </div>
                  <!-- 假別 -->
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">假別</span>
                    </div>
                    <select class="form-control" name="punch_type_id" id="">
                        <option value="" selected disabled> 請選擇</option>
                        @foreach($punchTypes  as $punchType)
                    <option value="{{$punchType->id}}">{{$punchType->name}}</option>
                    @endforeach
                      </select>

                  </div>
                    <!-- 備註 -->
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">備註</span>
                    </div>
                    <input type="text" name="remark" id=""  class="form-control" >

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
<script src="/js/workerReocrd1.js"></script>
