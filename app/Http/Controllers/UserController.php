<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $page = request()->get('page', false);
        $limit = request()->get('limit', false);
        $filters = json_decode(request()->get('filters', "{}"), true);

        $users = User::where('id', '>', 0);
        foreach ($filters as $filter => $value) {
            if ($value) {
                $users->where($filter, $value);
            }
        }
        $data = $users->get();
        $count = $data->count();
        if ($limit && $page) {
            $data = $data->slice(($page - 1) * $limit)->take($limit)->values();
        }


        return compact('data', 'count');
    }
}
