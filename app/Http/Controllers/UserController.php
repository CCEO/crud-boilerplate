<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $page = request()->get("page", false);
        $limit = request()->get("limit", false);
        $filters = json_decode(request()->get("filters", "{}"), true);

        $users = User::where("id", ">", 0);
        foreach ($filters as $filter => $value) {
            if ($value && $filter != "reload")
                $users->where($filter, $value);
        }
        $data = $users->get();
        $count = $data->count();
        if ($limit && $page)
            $data = $data->slice(($page - 1) * $limit)->take($limit)->values();


        return compact("data", "count");
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $data["password"] = bcrypt($data["password"]);
        return User::create($data);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        if (isset($data["password"])) {
            $data["password"] = bcrypt($data["password"]);
        }
        $user->fill($data);
        $user->save();
        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }
}
