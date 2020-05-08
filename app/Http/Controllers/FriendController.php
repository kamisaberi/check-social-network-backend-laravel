<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function changeFriendshipSituation(Request $request)
    {
        $user = $request->user;
        $another = $request->another;
        $command = $request->command;

        $friends_data = DB::table("friends")
            ->where("friends.a", "=", $user)
            ->where("friends.b", "=", $another)
            ->orWhere("friends.a", "=", $another)
            ->where("friends.b", "=", $user)
            ->select("friends.id")
            ->get();


        if (count($friends_data) == 0) {
            if ($command != 0) {
                DB::table("friends")->insert(
                    array(
                        "a" => $user,
                        "b" => $another,
                        "friendship_type" => $command
                    )
                );
            }
        } else {
            $fid = $friends_data[0]->id;
            if ($command != 0) {
                DB::table("friends")
                    ->where("friends.id", "=", $fid)
                    ->update(
                        array(
                            "friendship_type" => $command
                        )
                    );
            } else {
                DB::table("friends")
                    ->where("friends.id", "=", $fid)
                    ->delete();
            }
        }

        $response = [];
        $response['error'] = false;
        $response['message'] = "success";

        return $response;
    }

    public function addFriendship(Request $request)
    {

        $a = $request->input('a');
        $b = $request->input('b');
        $data = DB::table("friends")
            ->insert(array(
                "a" => $a,
                "b" => $b
            ));

        $response = [];
        $response['error'] = false;
        $response['message'] = "$a and $b are now friends";
        return $response;


    }

    public function removeFriendship(Request $request)
    {
        $a = $request->input('a');
        $b = $request->input('b');
        $data = DB::table("friends")
            ->where("a", "=", $a)
            ->where("b", "=", $b)
            ->delete();

        $response = [];
        $response['error'] = false;
        $response['message'] = "$a and $b are not friends";
        return $response;

    }

    public function getFiendListForUserUsingUsername($username)
    {
        $uc = new UserController();
        $id = $uc->getUserUsingUsername($username);

        $users_data = DB::table('friends')
            ->join('users', 'friends.b', "=", "users.id")
            ->where('friends.a', '=', $id)
            ->select('users.id', 'users.username', 'users.name', 'users.email', 'users.phone')
            ->get();

        $users = [];
        foreach ($users_data as $user_data) {
            $user = [];
            $user ['id'] = $user_data->id;
            $user ['name'] = $user_data->name;
            $user ['username'] = $user_data->username;
            $user ['email'] = $user_data->email;
            $user ['phone'] = $user_data->phone;
            $users[] = $user;
        }


        $users_data = DB::table('friends')
            ->join('users', 'friends.a', "=", "users.id")
            ->where('friends.b', '=', $id)
            ->select('users.id', 'users.username', 'users.name', 'users.email', 'users.phone')
            ->get();

        foreach ($users_data as $user_data) {
            $user = [];
            $user ['id'] = $user_data->id;
            $user ['name'] = $user_data->name;
            $user ['username'] = $user_data->username;
            $user ['email'] = $user_data->email;
            $user ['phone'] = $user_data->phone;
            $users[] = $user;
        }

        $response = [];
        $response['error'] = false;
        $response['message'] = "friends";
        $response['users'] = $users;
        return $response;

    }

    public function getFiendListForUser($id)
    {

        $users_data = DB::table('friends')
            ->join('users', 'friends.b', "=", "users.id")
            ->where('friends.a', '=', $id)
            ->select('users.id', 'users.username', 'users.name', 'users.email', 'users.phone')
            ->get();

        $users = [];
        foreach ($users_data as $user_data) {
            $user = [];
            $user ['id'] = $user_data->id;
            $user ['name'] = $user_data->name;
            $user ['username'] = $user_data->username;
            $user ['email'] = $user_data->email;
            $user ['phone'] = $user_data->phone;
            $users[] = $user;
        }


        $users_data = DB::table('friends')
            ->join('users', 'friends.a', "=", "users.id")
            ->where('friends.b', '=', $id)
            ->select('users.id', 'users.username', 'users.name', 'users.email', 'users.phone')
            ->get();

        foreach ($users_data as $user_data) {
            $user = [];
            $user ['id'] = $user_data->id;
            $user ['name'] = $user_data->name;
            $user ['username'] = $user_data->username;
            $user ['email'] = $user_data->email;
            $user ['phone'] = $user_data->phone;
            $users[] = $user;
        }

        $response = [];
        $response['error'] = false;
        $response['message'] = "friends";
        $response['friends'] = $users;
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
