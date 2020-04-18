<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return array
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return User
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $data["password"] = bcrypt($data["password"]);
        return User::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return User
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param $id
     * @return User
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return User
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }
}
