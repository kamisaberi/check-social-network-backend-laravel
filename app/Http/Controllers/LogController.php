<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        $data['user'] = $request->input("user");
        $data['duty'] = $request->input("duty");
        $data['log'] = $request->input("log");
        $data['date'] = $request->input("date");
        $log = new Log();
        $log->duty = $data['duty'];
        $log->log = $data['log'];
        $log->date = $data['date'];
        $log->user = $data['user'];


        $log->save();
        $id = $log->id;

        $response = [];
        $response['error'] = false;
        $response['message'] = "$id";

        return $response;
        //
    }


    public function getLogs($duty)
    {

        $logs_data = DB::table("logs")
            ->join('users', "logs.user", "=", "users.id")
            ->where('logs.duty', "=", $duty)
            ->select('logs.id as lid', 'logs.log', 'logs.date', 'users.id as uid', 'users.username', 'users.phone', 'users.email', 'users.name')
            ->get();

        $logs = [];
        foreach ($logs_data as $log_data) {

            $log = [];
            $log['id'] = $log_data->lid;
            $log['log'] = $log_data->log;
            $log['date'] = $log_data->date;

            $user = [];
            $user['id'] = $log_data->uid;
            $user['name'] = $log_data->name;
            $user['username'] = $log_data->username;
            $user['phone'] = $log_data->phone;
            $user['email'] = $log_data->email;

            $log['user'] = $user;

            $logs[] = $log;
        }

        $cnt = count($logs);

        $response = [];
        $response['error'] = false;
        $response['message'] = "$cnt";
        $response['logs'] = $logs;
        return $response;

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
