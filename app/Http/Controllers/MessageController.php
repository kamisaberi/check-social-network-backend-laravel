<?php

namespace App\Http\Controllers;

use App\Firebase;
use App\Message;
use App\Push;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
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


    public function sendNotifications($title, $message, $regId, $duty)
    {


        $firebase = new Firebase();
        $push = new Push();
        $push_type = 'individual';
//        $title = 'hello';
//        $message = 'hello this is a test';
        $payload = array();
        $payload['duty'] = $duty;

        $push->setTitle($title);
        $push->setMessage($message);
        $push->setImage('');
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);

//        $regId = 'eWBBvTkRO7k:APA91bHFZew7aNOTS9fYCms3Kg7iAhdSjIW4Q0mQx9-Cs1g7-uALAaq7cSh0Ow2ksB0urBQvUeHJ4Ah1zsKMRS9Uq_8tFTCqnGZ9texNAt9JIINsLjE8wvgFyPFE8lyHU0vNe00XmQjv';
        $json = $push->getPush();
//        $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
        $response = $firebase->send($regId, $json);

        return $response;


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

        $data['user'] = $request->input('user');
        $data['content'] = $request->input('content');
        $data['date'] = round(microtime(true) * 1000, 0);
        $data['duty'] = $request->input('duty');

        $message = new Message();
        $message->content = $data['content'];
        $message->user = $data['user'];
        $message->date = $data['date'];
        $message->duty = $data['duty'];
        $message->save();
        $id = $message->id;


        $uc = new UserController();
        $users = $uc->getDutyUsersFcmToken($data['duty']);

        foreach ($users as $user) {

            $this->sendNotifications('duty', $data['content'], $user,$data['duty'] );
        }


        $response = [];
        $response['error'] = false;
        $response['message'] = "$id";

        return $response;
        //
    }


    public function getMessages($duty, $date)
    {
        $messages_data = DB::table('messages')
            ->join('users', 'users.id', '=', 'messages.user')
            ->where('messages.date', ">", $date)
            ->where('messages.duty', '=', $duty)
            ->select('messages.id as mid', 'messages.content', 'messages.date', 'users.id as uid', 'users.username', 'users.name', 'users.phone')
            ->get();

        $messages = [];
        foreach ($messages_data as $message_data) {

            $message = [];
            $message['id'] = $message_data->mid;
            $message['content'] = $message_data->content;
            $message['date'] = $message_data->date;

            $user = [];
            $user ['id'] = $message_data->uid;
            $user ['username'] = $message_data->username;
            $user ['name'] = $message_data->name;
            $user ['phone'] = $message_data->phone;
            $message['user'] = $user;

            $messages[] = $message;
        }

        $response = [];
        $response['error'] = false;
        $response['message'] = "success";
        $response['messages'] = $messages;
        return $response;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
