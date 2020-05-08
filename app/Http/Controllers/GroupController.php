<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getDuties2($creator)
    {
        $datas = DB::select("SELECT DISTINCT
	duties.*
FROM
	duties
	INNER JOIN users ON duties.creator = users.id
	INNER JOIN priorities ON duties.priority = priorities.id
	INNER JOIN groups ON duties.`group` = groups.id
	INNER JOIN user_duty ON duties.id = user_duty.duty 
	OR user_duty.`user` = users.id 
WHERE
	duties.creator = $creator 
	OR user_duty.`user` = $creator");

        return $datas;


    }


    public function getDuties3($creator)
    {
        $datas = DB::table('duties')
            ->distinct('duties.id')
            ->join('users', 'users.id', "=", 'duties.creator')
            ->join('priorities', 'priorities.id', "=", 'duties.priority')
            ->join('groups', 'groups.id', "=", 'duties.group')
            ->join('user_duty', function ($join) {
                $join->on('user_duty.duty', '=', 'duties.id'); // i want to join the users table with either of these columns
                $join->orOn('user_duty.user', '=', 'users.id');
            })
            ->where('duties.creator', "=", $creator)
            ->orWhere('user_duty.user', "=", $creator)
            ->select('duties.*')
            ->get();

        return $datas;

    }

    public function getDutiesAndGroups($creator)
    {

        $groups = [];

        $duties_data = DB::table('duties')
            ->distinct('duties.id')
            ->join('users', 'users.id', "=", 'duties.creator')
            ->join('priorities', 'priorities.id', "=", 'duties.priority')
            ->join('groups', 'groups.id', "=", 'duties.group')
            ->join('user_duty', function ($join) {
                $join->on('user_duty.duty', '=', 'duties.id'); // i want to join the users table with either of these columns
                $join->orOn('user_duty.user', '=', 'users.id');
            })
            ->where('duties.creator', "=", $creator)
            ->orWhere('user_duty.user', "=", $creator)
            ->select(
                'duties.id as did',
                'duties.title',
                'duties.description',
                'duties.parent',
                'duties.creator',
                'duties.start_date',
                'duties.duration',
                'duties.group',
                'users.id as uid',
                'users.name',
                'users.email',
                'users.username',
                'users.phone',
                'groups.id as gid',
                'groups.title as gtl',
                'priorities.id as prid',
                'priorities.title as prtt'
            )
            ->orderBy("groups.id", "ASC")
            ->get();


//        return $duties_data;

        $rgid = -1;
        $index = 0;
        $ids = [];
        $cur = 0;
        //$group = [];
        foreach ($duties_data as $duty_data) {
            if ($rgid != $duty_data->gid) {
                $rgid = $duty_data->gid;
                if (in_array($rgid, $ids) == false) {
                    $index++;
                    $cur = $index;
                    $groups[$cur]['id'] = $duty_data->gid;
                    $groups[$cur]['title'] = $duty_data->gtl;
                } else {
                    $cur = array_search($rgid, $ids);
                }
            }

            $duty = [];
            $duty['id'] = $duty_data->did;
            $duty['title'] = $duty_data->title;
            $duty['description'] = $duty_data->description;
            $duty['parent'] = $duty_data->parent;
            $duty['start_date'] = $duty_data->start_date;
            $duty['duration'] = $duty_data->duration;
            $duty['group'] = $duty_data->group;

            $priority = [];
            $priority['id'] = $duty_data->prid;
            $priority['title'] = $duty_data->prtt;
            $duty['priority'] = $priority;


            $user = [];
            $user['id'] = $duty_data->uid;
            $user['name'] = $duty_data->name;
            $user['email'] = $duty_data->email;
            $user['username'] = $duty_data->username;
            $user['phone'] = $duty_data->phone;

            $duty['creator'] = $user;

            $logs_data = DB::table("logs")
                ->join('users', "logs.user", "=", "users.id")
                ->where('logs.duty', "=", $duty_data->did)
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
            $duty['logs'] = $logs;
            $groups[$cur]['duties'][] = $duty;

        }

        $response = [];
        $response['error'] = false;
        $response['message'] = "success";
        $response['groups'] = $groups;

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

    public function remove($id)
    {

        $duties = DB::table('duties')
            ->where('duties.group', '=', $id)
            ->select('duties.id')
            ->get();

        if (count($duties) > 0) {
            $response = [];
            $response['error'] = true;
            $response['message'] = "tasks belongs to this group . you cant remove this group";
            return $response;
        } else {

            DB::table('groups')
                ->where('groups.id', '=', $id)
                ->delete();

            DB::table('user_group')
                ->where('user_group.group', '=', $id)
                ->delete();

            $response = [];
            $response['error'] = false;
            $response['message'] = "success";
            return $response;
        }
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

        $data['id'] = $request->input("id");
        $data['creator'] = $request->input("creator");
        $data['title'] = $request->input("title");
        $data['description'] = $request->input("description");
        $data['users'] = $request->input("users");

        if ($data['id'] == 0) {
            $group = new Group();
            $group->creator = $data['creator'];
            $group->title = $data['title'];
            $group->description = $data['description'];
            $group->save();
            $id = $group->id;

            if ($request->input("users") != "") {
                $users = explode(",", trim($request->input("users")));
            } else {
                $users = [];
            }

            $users[] = trim($request->input("creator"));
            foreach ($users as $user) {
                DB::table('user_group')->insert(
                    [
                        'group' => $id,
                        'user' => $user
                    ]
                );
            }

            $response = [];
            $response['error'] = false;
            $response['message'] = "$id";

            return $response;

        } else {

//            $group = new Group();
//            $group->creator = $data['creator'];
//            $group->title = $data['title'];
//            $group->description = $data['description'];
//            $group->save();
//            $id = $group->id;

            DB::table('groups')->where('groups.id', '=', $data['id'])
                ->update(
                    [
                        'title' => $data['title'],
                        'description' => $data['description']
                    ]
                );


            if ($request->input("users") != "") {
                $users = explode(",", trim($request->input("users")));
            } else {
                $users = [];
            }


            DB::table('user_group')->
            where('user_group.group', '=', $data['id'])->
            delete();

            $users[] = trim($request->input("creator"));
            foreach ($users as $user) {
                DB::table('user_group')->insert(
                    [
                        'group' => $data['id'],
                        'user' => $user
                    ]
                );
            }

            $response = [];
            $response['error'] = false;
            $response['message'] = $data['id'];

            return $response;


        }

        //
    }


    public function getGroups($creator)
    {


        $grous_data = DB::table("groups")
            ->join("user_group", "groups.id", "=", "user_group.group")
            ->where("user_group.user", "=", $creator)
            ->select("groups.id", "groups.title", 'groups.description')
            ->get();


        $no = [];
        $no['id'] = 0;
        $no['title'] = "no_group";
        $no['description'] = "";
//        array_splice($grous_data, 0, 0, $no);
        $groups = [];
        $groups [] = $no;

        foreach ($grous_data as $gr) {
            $group = [];
            $group ['id'] = $gr->id;
            $group ['title'] = $gr->title;
            $group ['description'] = $gr->description;
            $groups[] = $group;
        }

        $response = [];
        $response['error'] = false;
        $response['message'] = "success";
        $response['groups'] = $groups;
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
