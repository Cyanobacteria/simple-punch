<?php

namespace App\Http\Controllers;

use App\User_time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class WokerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        dd(Auth::user());
        return view('ok');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function __construct()
    {
        $this->message=[];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function returnHome(){

//        return view('home',[
//            'time_data'=>$this->record,
//            'message'=>$this->message
//            ]);
    }
    public function store(Request $request)
    {
        $this->record=User_time::where('name','=',Auth::user()->name)->get();
//        print_r($request);
//        dd($request['status']);
//        dd($request['user_name']);
//        $test=DB::table('user_time')->insert(
//            ['name' => $request['user_name'],
//                'status' => $request['status']]
//        );

        if($request['status']=='上班'){
            $cheack_time=User_time::where('name','=',Auth::user()->name)
                ->where('status','=','上班')
                ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"), DB::raw('CURRENT_DATE()'))
                ->get();
            if(count($cheack_time)!=0){
                $this->message[]='data already exist!!';
            }else{
               $now=date('H:i');
               $cknow=date('9:30');

               if(strtotime($now)>strtotime($cknow)){
                   $ut= new User_time;
                   $ut->{'name'}=$request['user_name'];
                   $ut->{'status'}=$request['status'];
                   $ut->{'detail'}='未準時';
                   $ut->save();
                   $this->message[]="success punch in time: {$ut->created_at}";
                   //return view('ok',['time'=> $ut->created_at]);
            }else{
                   $ut= new User_time;
                   $ut->{'name'}=$request['user_name'];
                   $ut->{'status'}=$request['status'];
                   $ut->{'detail'}='正常';
                   $ut->save();
                   $this->message[]="success punch in time: {$ut->created_at}";
                   //return view('ok',['time'=> $ut->created_at]);
            }

            }
        }else if($request['status']=='下班'){

            $cheack_time=User_time::where('name','=',Auth::user()->name)
                ->where('status','=','下班')
                ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"), DB::raw('CURRENT_DATE()'))
                ->get();

            if(count($cheack_time)!=0){
                $this->message[]='data already exist!!';


            }else{

                $now=date('H:i');
                $cknow=date('18:00');

                if(strtotime($now)<strtotime($cknow)){
                    $ut= new User_time;
                    $ut->{'name'}=$request['user_name'];
                    $ut->{'status'}=$request['status'];
                    $ut->{'detail'}='異常';
                    $ut->save();

                    $this->message[]="success punch out time: {$ut->created_at}";
                }else{
                    $ut= new User_time;
                    $ut->{'name'}=$request['user_name'];
                    $ut->{'status'}=$request['status'];
                    $ut->{'detail'}='正常';
                    $ut->save();
                    $this->message[]="success punch out time: {$ut->created_at}";
                }
            }
        }
        header("location:http://time.funcity18.com/home?message={$this->message[0]}");
        //die();
        //Redirect::to('home', ['message' => $this->message[0]]);
//        die('ff');
        //redirect('/home?message='.$this->message[0]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
