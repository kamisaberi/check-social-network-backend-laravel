<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function test()
    {

        $mc = new MessageController();
        $mc->sendNotifications("test", "hi", 'eWBBvTkRO7k:APA91bHFZew7aNOTS9fYCms3Kg7iAhdSjIW4Q0mQx9-Cs1g7-uALAaq7cSh0Ow2ksB0urBQvUeHJ4Ah1zsKMRS9Uq_8tFTCqnGZ9texNAt9JIINsLjE8wvgFyPFE8lyHU0vNe00XmQjv', 1);
//        return  Config::FIREBASE_API_KEY;

//        $firebase = new Firebase();
//        $push = new Push();
//        $push_type = 'individual';
//        $title = 'hello';
//        $message = 'hello this is a test';
//        $payload = array();
//        $payload['team'] = 'India';
//        $payload['score'] = '5.6';
//        $payload['score'] = '5.6';
//
//        $push->setTitle($title);
//        $push->setMessage($message);
//        $push->setImage('');
//        $push->setIsBackground(FALSE);
//        $push->setPayload($payload);
//
//        $regId = 'eWBBvTkRO7k:APA91bHFZew7aNOTS9fYCms3Kg7iAhdSjIW4Q0mQx9-Cs1g7-uALAaq7cSh0Ow2ksB0urBQvUeHJ4Ah1zsKMRS9Uq_8tFTCqnGZ9texNAt9JIINsLjE8wvgFyPFE8lyHU0vNe00XmQjv';
//        $json = $push->getPush();
//        $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
//        $response = $firebase->send($regId, $json);

//        return $response;

    }

    public function login($phone, $password)
    {
        $user_data = DB::table('users')
            ->where('phone', "=", trim($phone))
            ->where('password', "=", trim($password))
            ->select("users.id", 'users.username', 'users.name', 'users.email', 'users.avatar', 'users.fcm_token')
            ->get();

        if (count($user_data) > 0) {

            $user = [];
            $user['name'] = $user_data[0]->name;
            $user['id'] = $user_data[0]->id;
            $user['username'] = $user_data[0]->username;
            $user['email'] = $user_data[0]->email;
            $user['avatar'] = ($user_data[0]->avatar == null ? "" : $user_data[0]->avatar);
            if (is_null($user_data[0]->fcm_token) == true) {
                $user['fcm_token'] = "";
            } else {
                $user['fcm_token'] = $user_data[0]->fcm_token;
            }


            $exc = new ExpertController();
            $experts = $exc->getAll();

            $response = [];
            $response['error'] = false;
            $response['message'] = 'success';
            $response['user'] = $user;
            $response['experts'] = $experts['experts'];

            return $response;

        } else {
            $user = [];
            $user['name'] = "";
            $user['id'] = 0;
            $user['username'] = "";
            $user['email'] = "";
            $user['avatar'] = "";
            $response = [];
            $response['error'] = true;
            $response['message'] = 'failed';
            $response['user'] = $user;

            return $response;
        }

    }


    public function getUser($user)
    {
        $user_data = DB::table('users')
            ->where('users.id', "=", $user)
            ->select("users.id", 'users.username', 'users.name', 'users.email', 'users.avatar', 'users.fcm_token')
            ->get();

        if (count($user_data) > 0) {

            $user = [];
            $user['name'] = $user_data[0]->name;
            $user['id'] = $user_data[0]->id;
            $user['username'] = $user_data[0]->username;
            $user['email'] = $user_data[0]->email;
            $user['avatar'] = $user_data[0]->avatar;
            if (is_null($user_data[0]->fcm_token) == true) {
                $user['fcm_token'] = "";
            } else {
                $user['fcm_token'] = $user_data[0]->fcm_token;
            }

            $response = [];
            $response['error'] = false;
            $response['message'] = 'success';
            $response['user'] = $user;

            return $response;

        } else {
            $user = [];
            $user['name'] = "";
            $user['id'] = 0;
            $user['username'] = "";
            $user['email'] = "";
            $user['avatar'] = "";
            $response = [];
            $response['error'] = true;
            $response['message'] = 'failed';
            $response['user'] = $user;

            return $response;
        }

    }


    public function changeFcmToken($user, $fcm_token)
    {


        DB::table('users')
            ->where('users.id', "=", $user)
            ->update(
                [
                    'fcm_token' => $fcm_token
                ]
            );

        $response = [];
        $response['error'] = false;
        $response['message'] = 'success';

        return $response;

    }

    public function getUserUsingPhone($phone)
    {
        $data = DB::table("users")
            ->where("phone", "=", $phone)
            ->select("users.id")
            ->get();

        return $data[0]->id;
    }

    public function getUserUsingUsername($username)
    {
        $data = DB::table("users")
            ->where("username", "=", $username)
            ->select("users.id")
            ->get();

        return $data[0]->id;
    }

    public function getUserUsingEmail($email)
    {
        $data = DB::table("users")
            ->where("email", "=", $email)
            ->select("users.id")
            ->get();

        return $data[0]->id;
    }


    public function getRegisteredUsers1(Request $request)
    {

        $phones = $request->input('phones');
        $user = $request->input('user');
        $users_data = DB::table('users')
            ->whereIn('phone', explode(",", trim($phones)))
            ->select(
                'users.id',
                'users.name',
                'users.username',
                'users.phone',
//                DB::raw("(SELECT friends.id from friends WHERE (a=$user and b=users.id) or (a=users.id and b=$user)) as fid"),
//                DB::raw("(SELECT count(*) from friends WHERE (a=$user and b=users.id) or (a=users.id and b=$user)) as fcnt"),
//                DB::raw("(SELECT friends.friendship_type from friends WHERE (a=$user and b=users.id) or (a=users.id and b=$user)) as ffst"),
                DB::raw("(SELECT friends.friendship_type from friends WHERE (a=$user and b=users.id)) as ffst1"),
                DB::raw("(SELECT friends.friendship_type from friends WHERE (a=users.id and b=$user)) as ffst2")
            )
            ->get();

//        return $users_data;

        $types_data = DB::table("friendship_types")
            ->select("friendship_types.*")
            ->get();

        $users = [];
        foreach ($users_data as $user_data) {

            $user = [];
            $user['id'] = $user_data->id;
            $user['name'] = $user_data->name;
            $user['username'] = $user_data->username;
            $user['phone'] = $user_data->phone;

            $ffst = 0;
            if (is_null($user_data->ffst1) == true && is_null($user_data->ffst2) == true) {
                $ffst = 0;
            } else if ($user_data->ffst1 == 3 || $user_data->ffst2 == 3) {
                $ffst = 3;
            } else if ($user_data->ffst1 == 1 && is_null($user_data->ffst2) == true) {
                $ffst = 11;
            } else if (is_null($user_data->ffst1) == true && $user_data->ffst2 == 1) {
                $ffst = 12;
            } else if ($user_data->ffst1 == 2 && is_null($user_data->ffst2) == true) {
                $ffst = 21;
            } else if (is_null($user_data->ffst1) == true && $user_data->ffst2 == 2) {
                $ffst = 22;
            }

//            if (is_null($user_data->ffst) == true) {
//                $ffst = 0;
//            } else {
//                $ffst = $user_data->ffst;
//            }

            $type = [];
            switch ($ffst) {
                case 0 :
                    $type ['id'] = 0;
                    $type ['title'] = "none";
                    break;
                case 3 :
                    $type ['id'] = 3;
                    $type ['title'] = "accepted";
                    break;
                case 11 :
                    $type ['id'] = 11;
                    $type ['title'] = "i requested";
                    break;
                case 12:
                    $type ['id'] = 12;
                    $type ['title'] = "i got requested";
                    break;
                case 21 :
                    $type ['id'] = 21;
                    $type ['title'] = "i rejected";
                    break;
                case 22 :
                    $type ['id'] = 22;
                    $type ['title'] = "i got rejected";
                    break;
            }


//            $type = [];
//            if ($ffst == 0) {
//                $type ['id'] = 0;
//                $type ['title'] = "none";
//            } else {
//                $type ['id'] = $types_data[$ffst - 1]->id;
//                $type ['title'] = $types_data[$ffst - 1]->title;
//            }


            $user['friendship_type'] = $type;
            $users[] = $user;
        }

        $response = [];
        $response['error'] = false;
        $response['message'] = 'success';
        $response['users'] = $users;


        return $response;
    }


    public function getRegisteredUsers($user, $phones)
    {

        $users_data = DB::table('users')
            ->whereIn('phone', explode(",", trim($phones)))
            ->select(
                'users.id',
                'users.name',
                'users.username',
                'users.phone',
//                DB::raw("(SELECT friends.id from friends WHERE (a=$user and b=users.id) or (a=users.id and b=$user)) as fid"),
//                DB::raw("(SELECT count(*) from friends WHERE (a=$user and b=users.id) or (a=users.id and b=$user)) as fcnt"),
//                DB::raw("(SELECT friends.friendship_type from friends WHERE (a=$user and b=users.id) or (a=users.id and b=$user)) as ffst"),
                DB::raw("(SELECT friends.friendship_type from friends WHERE (a=$user and b=users.id)) as ffst1"),
                DB::raw("(SELECT friends.friendship_type from friends WHERE (a=users.id and b=$user)) as ffst2")
            )
            ->get();

//        return $users_data;

        $types_data = DB::table("friendship_types")
            ->select("friendship_types.*")
            ->get();

        $users = [];
        foreach ($users_data as $user_data) {

            $user = [];
            $user['id'] = $user_data->id;
            $user['name'] = $user_data->name;
            $user['username'] = $user_data->username;
            $user['phone'] = $user_data->phone;

            $ffst = 0;
            if (is_null($user_data->ffst1) == true && is_null($user_data->ffst2) == true) {
                $ffst = 0;
            } else if ($user_data->ffst1 == 3 || $user_data->ffst2 == 3) {
                $ffst = 3;
            } else if ($user_data->ffst1 == 1 && is_null($user_data->ffst2) == true) {
                $ffst = 11;
            } else if (is_null($user_data->ffst1) == true && $user_data->ffst2 == 1) {
                $ffst = 12;
            } else if ($user_data->ffst1 == 2 && is_null($user_data->ffst2) == true) {
                $ffst = 21;
            } else if (is_null($user_data->ffst1) == true && $user_data->ffst2 == 2) {
                $ffst = 22;
            }

//            if (is_null($user_data->ffst) == true) {
//                $ffst = 0;
//            } else {
//                $ffst = $user_data->ffst;
//            }

            $type = [];
            switch ($ffst) {
                case 0 :
                    $type ['id'] = 0;
                    $type ['title'] = "none";
                    break;
                case 3 :
                    $type ['id'] = 3;
                    $type ['title'] = "accepted";
                    break;
                case 11 :
                    $type ['id'] = 11;
                    $type ['title'] = "i requested";
                    break;
                case 12:
                    $type ['id'] = 12;
                    $type ['title'] = "i got requested";
                    break;
                case 21 :
                    $type ['id'] = 21;
                    $type ['title'] = "i rejected";
                    break;
                case 22 :
                    $type ['id'] = 22;
                    $type ['title'] = "i got rejected";
                    break;
            }


//            $type = [];
//            if ($ffst == 0) {
//                $type ['id'] = 0;
//                $type ['title'] = "none";
//            } else {
//                $type ['id'] = $types_data[$ffst - 1]->id;
//                $type ['title'] = $types_data[$ffst - 1]->title;
//            }


            $user['friendship_type'] = $type;
            $users[] = $user;
        }

        $response = [];
        $response['error'] = false;
        $response['message'] = 'success';
        $response['users'] = $users;


        return $response;
    }


    public function getDutyUsersFcmToken($duty)
    {
        $users_data = DB::table('users')
            ->join('user_duty', 'users.id', '=', 'user_duty.user')
            ->where('user_duty.duty', '=', $duty)
            ->select('users.fcm_token')
            ->get();

        $users = [];
        foreach ($users_data as $user_data) {
            $users[] = $user_data->fcm_token;
        }
        return $users;
    }


    public function register(Request $request)
    {
        $digits = 5;
        $verification_code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['username'] = $request->input('username');
        $data['phone'] = $request->input('phone');
        $data['password'] = $request->input('password');
        $data['fcm_token'] = $request->input('fcm_token');
        $data['verification_code'] = $verification_code;
        $data['activated'] = 0;


        $email_check = DB::table('users')
            ->where('users.email', '=', $request->input('email'))
            ->select('users.id')
            ->get();
        if (count($email_check) > 0) {
            $response = [];
            $response['error'] = true;
            $response['message'] = "email already used ";
            return $response;
        }

        $email_check = DB::table('users')
            ->where('users.phone', '=', $request->input('phone'))
            ->select('users.id')
            ->get();
        if (count($email_check) > 0) {
            $response = [];
            $response['error'] = true;
            $response['message'] = "phone already used ";
            return $response;
        }

        $email_check = DB::table('users')
            ->where('users.username', '=', $request->input('username'))
            ->select('users.id')
            ->get();
        if (count($email_check) > 0) {
            $response = [];
            $response['error'] = true;
            $response['message'] = "username already used ";
            return $response;
        }

        $user = new User();
        $user->insert($data);
        $id = $user->id;


        $this->sendSMS($data['phone'], $verification_code);

        $response = [];
        $response['error'] = false;
        $response['message'] = $data['name'] . ' added';
        return $response;
    }

    public function sendSMS($phone, $verification_code)
    {

//        $BASE_HTTP_URL = "http://www.sibsms.com/APISend.aspx?";

        $USERNAME = "09112450877";
        $PASSWORD = "Nemesis1358";
        $senderNumber = "50002030005969";
        $message = "your verification code is $verification_code";

        $url = "http://www.sibsms.com/APISend.aspx?";
        $options = array(
            "Username" => $USERNAME,
            "Password" => $PASSWORD,
            "From" => $senderNumber,
            "To" => $phone,
            "Text" => $message
        );

        $url .= http_build_query($options, '', '&');

        $myData = file_get_contents($url) or die(print_r(error_get_last()));

    }

    public function editProfile(Request $request)
    {
        $data['id'] = $request->input('id');
        $data['name'] = $request->input('name');
//        $data['email'] = $request->input('email');
        $data['username'] = $request->input('username');
//        $data['phone'] = $request->input('phone');
        $data['email'] = $request->input('email');

        $email_check = DB::table('users')
            ->where('users.username', '=', $request->input('username'))
            ->where('users.id', '<>', $request->input('id'))
            ->select('users.id')
            ->get();

        if (count($email_check) > 0) {
            $response = [];
            $response['error'] = true;
            $response['message'] = "username already used ";
            return $response;
        }

        $email_check = DB::table('users')
            ->where('users.email', '=', $request->input('email'))
            ->where('users.id', '<>', $request->input('id'))
            ->select('users.id')
            ->get();

        if (count($email_check) > 0) {
            $response = [];
            $response['error'] = true;
            $response['message'] = "email already used";
            return $response;
        }


        DB::table('users')->where('users.id', '=', $data['id'])
            ->update(
                [
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'email' => $data['email']
                ]
            );


        $response = [];
        $response['error'] = false;
        $response['message'] = $data['id'] . ' updated';
        return $response;
    }

    public function verify($phone, $verification_code)
    {
        $user_data = DB::table('users')
            ->where("users.phone", "=", $phone)
            ->where("users.activated", "=", 0)
            ->select("users.id", "users.verification_code")
            ->get();

        if (count($user_data) == 0) {
            $response = [];
            $response['error'] = true;
            $response['message'] = "phone number not registered";
            return $response;
        }

        $id = $user_data[0]->id;
        if ($user_data[0]->verification_code == $verification_code) {

            DB::table('users')->where('id', "=", $id)->update(array(
                'activated' => 1));
            $response = [];
            $response['error'] = false;
            $response['message'] = "account activated";
            return $response;

        } else {
            $response = [];
            $response['error'] = true;
            $response['message'] = "verification code is wrong";
            return $response;
        }

    }


    public function uploadImage(Request $request)
    {
        $file = $request->file('image');
        $user = $request->input('user');
//        echo "creator : " . $request->input('creator');
//        echo '<br>';

        //Display File Name
//        echo 'File Name: '.$file->getClientOriginalName();
//        echo '<br>';

        //Display File Extension
//        echo 'File Extension: '.$file->getClientOriginalExtension();
//        echo '<br>';

        //Display File Real Path
//        echo 'File Real Path: '.$file->getRealPath();
//        echo '<br>';

        //Display File Size
//        echo 'File Size: '.$file->getSize();
//        echo '<br>';

        //Display File Mime Type
//        echo 'File Mime Type: '.$file->getMimeType();

        //Move Uploaded File
        $new_name = round(microtime(true) * 1000, 0) . "." . $file->getClientOriginalExtension();
        $destinationPath = "uploads/$user/";
//        $file->move($destinationPath, "profile.". $file->getClientOriginalExtension());

        $file->move($destinationPath, $new_name);


//        $extension = pathinfo($filename, PATHINFO_EXTENSION);
//        switch ($file->getClientOriginalExtension()) {
//            case 'jpg':
//            case 'jpeg':
//                $image = imagecreatefromjpeg($filename);
//                break;
//            case 'gif':
//                $image = imagecreatefromgif($filename);
//                break;
//            case 'png':
//                $image = imagecreatefrompng($filename);
//                break;
//        }


        DB::table('users')->where('id', "=", $user)->update(array(
            'avatar' => $new_name));

        $response = [];
        $response['error'] = false;
        $response['message'] = $new_name;
        return $response;


    }


    public function removeImage($user)
    {

        DB::table('users')->where('id', "=", $user)->update(array(
            'avatar' => ""));

        $response = [];
        $response['error'] = false;
        $response['message'] = "removed";
        return $response;

    }


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
        //
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
