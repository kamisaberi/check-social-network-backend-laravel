<?php

namespace App\Http\Controllers;

use App\Record;
use App\RecordType;
use DB;
use Illuminate\Http\Request;

class RecordController extends Controller
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


    public function getRecords($duty, $record_type)
    {

        if ($record_type == 'all') {
            $logs_data = DB::table("records")
                ->join('users', "records.user", "=", "users.id")
                ->where('records.duty', "=", $duty)
                ->select('records.id as lid', 'records.log', 'records.date', 'users.id as uid', 'users.username', 'users.phone', 'users.email', 'users.name')
                ->get();

        } else {

            $rec_tpe = RecordType::where('title', '=', $record_type)->first();
            $record_type_id = $rec_tpe->id;
            $logs_data = DB::table("records")
                ->join('users', "records.user", "=", "users.id")
                ->where('records.duty', "=", $duty)
                ->where('records.record_type', "=", $record_type_id)
                ->select('records.id as lid', 'records.log', 'records.date', 'users.id as uid', 'users.username', 'users.phone', 'users.email', 'users.name')
                ->get();
        }


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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $record_type)
    {

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $ext = $image->getClientOriginalExtension();
            $name = sha1(time()) . "." . $ext;
            $image->move(public_path('uploads'), $name);


        }

        $rec_tpe = RecordType::where('title', '=', $record_type)->first();
        $record_type_id = $rec_tpe->id;

        $record = new Record();
        $record->duty = $request->input("duty");
        $record->content = $request->input("content");
        $record->date = $request->input("date");
        $record->user = $request->input("user");
        $record->record_type = $record_type_id;
        $record->content_type = $request->input("content_type");


        $record->save();
        $id = $record->id;

        $response = [];
        $response['error'] = false;
        $response['message'] = "$id";

        return $response;
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Record $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Record $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }
}
