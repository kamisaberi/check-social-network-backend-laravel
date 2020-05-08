<?php

namespace App\Http\Controllers;

use App\Duty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getDuties($creator)
    {

        $duties_data = DB::table('duties')
            ->where('creator', "=", $creator)
            ->join('users', "users.id", "=", 'duties.creator')
            ->select('duties.id as did', 'duties.title', 'duties.parent', 'duties.creator', 'users.id as uid', 'users.name', 'users.email', 'users.username', 'users.phone')
            ->get();

        $duties = [];

        foreach ($duties_data as $duty_data) {
            $duty = [];

            $duty['id'] = $duty_data->did;
            $duty['title'] = $duty_data->title;
            $duty['parent'] = $duty_data->parent;

            $user = [];
            $user['id'] = $duty_data->uid;
            $user['name'] = $duty_data->name;
            $user['email'] = $duty_data->email;
            $user['username'] = $duty_data->username;
            $user['phone'] = $duty_data->phone;

            $duty['creator'] = $user;

            $records_data = DB::table("records")
                ->join('users', "records.user", "=", "users.id")
                ->join('record_types', 'record_types.id', '=', 'records.record_type')
                ->where('records.duty', "=", $duty_data->did)
                ->select(
                    'records.id as lid',
                    'records.log',
                    'records.date',
                    'records.record_type',
                    'record_types.title',
                    'users.id as uid',
                    'users.username',
                    'users.phone',
                    'users.email',
                    'users.name'
                )
                ->get();


            $logs = [];
            foreach ($records_data as $record_data) {

                $log = [];
                $log['id'] = $record_data->lid;
                $log['log'] = $record_data->log;
                $log['date'] = $record_data->date;
                $log['record_type'] = $record_data->title;

                $user = [];
                $user['id'] = $record_data->uid;
                $user['name'] = $record_data->name;
                $user['username'] = $record_data->username;
                $user['phone'] = $record_data->phone;
                $user['email'] = $record_data->email;

                $log['user'] = $user;

                $logs[] = $log;
            }
            $duty['records'] = $logs;
//            $duties[] = $duty;







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
            $duties[] = $duty;
        }

        $response = [];
        $response['error'] = false;
        $response['message'] = "success";
        $response['duties'] = $duties;

        return $response;
    }


    public function getDuty($duty)
    {
        $duties_data = DB::table('duties')
            ->join('groups', 'duties.group', '=', 'groups.id')
            ->join('users', 'duties.creator', '=', 'users.id')
            ->join('priorities', 'duties.priority', '=', 'priorities.id')
            ->where('duties.id', '=', $duty)
            ->select(
                'duties.id as did',
                'duties.title as dtl',
                'duties.description as dds',
                'duties.start_date',
                'duties.duration',
                'duties.exact_time',
                'duties.can_continue_after_timeout',
                'duties.finish_type',
                'duties.finish_time',
                'duties.parent',
                'groups.id as gid',
                'groups.title as gtl',
                'groups.description as gds',
                'users.id as uid',
                'users.name',
                'users.email',
                'users.username',
                'users.phone',
                'priorities.id as pid',
                'priorities.title as ptl'
            )
            ->get();

        if (count($duties_data) == 0) {
            $response = [];
            $response['error'] = true;
            $response['message'] = "not found";
            return $response;
        }

        $duty = [];
        $duty['id'] = $duties_data[0]->did;
        $duty['title'] = $duties_data[0]->dtl;
        $duty['description'] = $duties_data[0]->dds;
        $duty['start_date'] = $duties_data[0]->start_date;
        $duty['duration'] = $duties_data[0]->duration;
        $duty['can_continue_after_timeout'] = $duties_data[0]->can_continue_after_timeout;
        $duty['finish_type'] = $duties_data[0]->finish_type;
        $duty['finish_time'] = $duties_data[0]->finish_time;

        $user = [];
        $user['id'] = $duties_data[0]->uid;
        $user['name'] = $duties_data[0]->name;
        $user['email'] = $duties_data[0]->email;
        $user['username'] = $duties_data[0]->username;
        $user['phone'] = $duties_data[0]->phone;
        $duty['creator'] = $user;

        $group = [];
        $group['id'] = $duties_data[0]->gid;
        $group['title'] = $duties_data[0]->gtl;
        $duty['group'] = $group;

        $priority = [];
        $priority['id'] = $duties_data[0]->pid;
        $priority['title'] = $duties_data[0]->ptl;
        $duty['priority'] = $priority;


        $users_data = DB::table('user_duty')
            ->join('users', 'user_duty.user', '=', 'users.id')
            ->where('user_duty.duty', '=', $duty)
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.username',
                'users.phone'
            )
            ->get();

        $users = [];
        foreach ($users_data as $users_datum) {
            $user = [];
            $user ['id'] = $users_datum->id;
            $user ['name'] = $users_datum->name;
            $user ['email'] = $users_datum->email;
            $user ['username'] = $users_datum->username;
            $user ['phone'] = $users_datum->phone;
            $users[] = $user;
        }
        $duty['users'] = $users;


        $logs_data = DB::table('logs')
            ->join('users', 'users.id', '=', 'logs.user')
            ->where('logs.duty', '=', $duty)
            ->select(
                'logs.id as lid',
                'logs.log',
                'logs.date',
                'users.id as uid',
                'users.name',
                'users.email',
                'users.username',
                'users.phone'
            )
            ->get();

        $logs = [];
        foreach ($logs_data as $logs_datum) {
            $log = [];
            $log ['id'] = $logs_datum->lid;
            $log ['log'] = $logs_datum->log;
            $log ['date'] = $logs_datum->date;
            $user = [];
            $user ['id'] = $logs_datum->uid;
            $user ['name'] = $logs_datum->name;
            $user ['email'] = $logs_datum->email;
            $user ['username'] = $logs_datum->username;
            $user ['phone'] = $logs_datum->phone;
            $log ['user'] = $user;
            $logs [] = $log;
        }
        $duty['logs'] = $logs;


        $response = [];
        $response['error'] = false;
        $response['message'] = "success";
        $response['duty'] = $duty;
        return $response;

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
                'duties.exact_time',
                'duties.can_continue_after_timeout',
                'duties.finish_type',
                'duties.finish_time',
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
        $index = -1;
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
            $duty['exact_time'] = $duty_data->exact_time == 0 ? false : true;
            $duty['can_continue_after_timeout'] = $duty_data->can_continue_after_timeout == 0 ? false : true;
            $duty['finish_type'] = $duty_data->finish_type;
            $duty['finish_time'] = $duty_data->finish_time;

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


            $users_data = DB::table('users')
                ->join('user_duty', 'user_duty.user', '=', 'users.id')
                ->where('user_duty.duty', '=', $duty_data->did)
                ->select('users.id', 'users.name', 'users.email', 'users.username', 'users.phone')
                ->get();
            $duty['users'] = $users_data;


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

            $experts_data = DB::table('experts')
                ->join('duty_expert', 'duty_expert.expert', '=', 'experts.id')
                ->where('duty_expert.duty', '=', $duty_data->did)
                ->select('experts.id', 'experts.title')
                ->get();

            $experts = [];
            foreach ($experts_data as $expert_data) {
                $expert = [];
                $expert ['id'] = $expert_data->id;
                $expert ['title'] = $expert_data->title;
                $experts[] = $expert;
            }
            $duty['experts'] = $experts;


            $groups[$cur]['duties'][] = $duty;

        }

        $response = [];
        $response['error'] = false;
        $response['message'] = "success";
        $response['groups'] = $groups;

        return $response;
    }


    public function finishDuty($user, $duty, $finish_type)
    {

        // finish_types :
        // 0 = not finished
        // 1 = success
        // 2 = failed


        $finish_time = round(microtime(true) * 1000, 0);
        DB::table('duties')
            ->where('duties.id', '=', $duty)
            ->update(
                [
                    'finish_type' => $finish_type,
                    'finish_time' => $finish_time
                ]
            );

        $response = [];
        $response['error'] = false;
        $response['message'] = "success";
        return $response;

    }


    public function getDutiesAndGroups1($creator)
    {

        $groups = [];

        $duties_data = DB::table('duties')
            ->where('creator', "=", $creator)
            ->join('users', "users.id", "=", 'duties.creator')
            ->join('priorities', "priorities.id", "=", 'duties.priority')
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
                'priorities.id as prid',
                'priorities.title as prtt')
            ->where("duties.group", "=", 0)
            ->get();

        $no_grouped_duties = [];

        foreach ($duties_data as $duty_data) {
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
            $no_grouped_duties[] = $duty;
        }


        $duties_data = DB::table('duties')
            ->join('user_duty', "user_duty.duty", "=", 'duties.id')
            ->join('users', "users.id", "=", 'duties.creator')
            ->join('priorities', "priorities.id", "=", 'duties.priority')
            ->select('duties.id as did', 'duties.title', 'duties.description', 'duties.parent', 'duties.creator', 'duties.start_date', 'duties.duration', 'duties.group', 'users.id as uid', 'users.name', 'users.email', 'users.username', 'users.phone', 'priorities.id as prid', 'priorities.title as prtt')
            ->where("duties.group", "=", 0)
            ->where('user_duty.user', "=", $creator)
            ->get();

        foreach ($duties_data as $duty_data) {
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
            $no_grouped_duties[] = $duty;
        }


        $group = [];
        $group ['id'] = 0;
        $group ['title'] = "no_group";
        $group["duties"] = $no_grouped_duties;
        $groups[] = $group;


//        $grouped_groups = [];


        $duties_data = DB::table('duties')
            ->where('duties.creator', "=", $creator)
            ->join('users', "users.id", "=", 'duties.creator')
            ->join('groups', "groups.id", "=", 'duties.group')
            ->join('priorities', "priorities.id", "=", 'duties.priority')
            ->select('duties.id as did', 'duties.title', 'duties.description', 'duties.parent', 'duties.creator', 'duties.start_date', 'duties.duration', 'duties.group', 'users.id as uid', 'users.name', 'users.email', 'users.username', 'users.phone', 'groups.id as gid', 'groups.title as gtl', 'priorities.id as prid', 'priorities.title as prtt')
            ->orderBy("groups.id", "ASC")
            ->get();

        $rgid = 0;
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


        $duties_data = DB::table('duties')
            ->join('user_duty', 'user_duty.duty', "=", 'duties.id')
            ->join('users', "users.id", "=", 'duties.creator')
            ->join('groups', "groups.id", "=", 'duties.group')
            ->join('priorities', "priorities.id", "=", 'duties.priority')
            ->select('duties.id as did', 'duties.title', 'duties.description', 'duties.parent', 'duties.creator', 'duties.start_date', 'duties.duration', 'duties.group', 'users.id as uid', 'users.name', 'users.email', 'users.username', 'users.phone', 'groups.id as gid', 'groups.title as gtl', 'priorities.id as prid', 'priorities.title as prtt')
            ->where('user_duty.user', "=", $creator)
            ->orderBy("groups.id", "ASC")
            ->get();


        $rgid = 0;
//        $index = 0;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data['title'] = $request->input('title');
        $data['description'] = $request->input('description');
        $data['parent'] = $request->input('parent');
        $data['group'] = $request->input('group');
        $data['priority'] = $request->input('priority');
        $data['start_date'] = $request->input('start_date');
        $data['duration'] = $request->input('duration');
        $data['creator'] = $request->input('creator');
        $data['exact_time'] = $request->input('exact_time');
        $data['can_continue_after_timeout'] = $request->input('can_continue_after_timeout');


        $duty = new Duty();
        $duty->title = $data['title'];
        $duty->description = $data['description'];
        $duty->parent = $data['parent'];
        $duty->group = $data['group'];
        $duty->priority = $data['priority'];
        $duty->start_date = $data['start_date'];
        $duty->duration = $data['duration'];
        $duty->creator = $data['creator'];
        $duty->exact_time = $data['exact_time'];
        $duty->can_continue_after_timeout = $data['can_continue_after_timeout'];
        $duty->save();
        $id = $duty->id;


        $usrs = $request->input('users');
        $users = explode(',', $usrs);

        foreach ($users as $user) {
            DB::table("user_duty")
                ->insert(
                    array("duty" => $id, "user" => $user)
                );
        }


        $exprts = $request->input('experts');
        $experts = explode(',', $exprts);
        foreach ($experts as $expert) {
            DB::table("duty_expert")
                ->insert(
                    array("duty" => $id, "expert" => $expert)
                );
        }


        $response = [];
        $response['error'] = false;
        $response['message'] = "$id";
        return $response;
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
    public function update(Request $request)
    {
        $duty = Duty::find($request->input('id'));
        $duty->title = $request->input('title');
        $duty->description = $request->input('description');
        $duty->parent = $request->input('parent');
        $duty->group = $request->input('group');
        $duty->priority = $request->input('priority');;
        $duty->start_date = $request->input('start_date');
        $duty->duration = $request->input('duration');
        $duty->creator = $request->input('creator');
        $duty->exact_time = $request->input('exact_time');
        $duty->can_continue_after_timeout = $request->input('can_continue_after_timeout');
        $duty->save();

        $usrs = $request->input('users');
        $users = explode(',', $usrs);

        DB::table('user_duty')
            ->where('user_duty.duty', '=', $request->input('id'))
            ->delete();
        foreach ($users as $user) {
            DB::table("user_duty")
                ->insert(
                    array(
                        "duty" => $request->input('id'),
                        "user" => $user
                    )
                );
        }

        $exprts = $request->input('experts');
        $experts = explode(',', $exprts);

        DB::table('duty_expert')
            ->where('duty_expert.duty', '=', $request->input('id'))
            ->delete();
        foreach ($experts as $expert) {
            DB::table("duty_expert")
                ->insert(
                    array(
                        "duty" => $request->input('id'),
                        "expert" => $expert
                    )
                );
        }

        $response = [];
        $response['error'] = false;
        $response['message'] = "edited";
        return $response;

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
