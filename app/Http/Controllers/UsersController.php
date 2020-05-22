<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];

        $data += $this->counts($user);

        return view('users.show', $data);
    }

    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }

    public function favoritings($id)
    {
        $user = User::find($id);
        $favoritings = $user->favoritings()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'favoritings' => $favoritings,
        ];

        $data += $this->counts($user);

        return view('users.favoritings', $data);
    }

    public function edit($id)
    {
        $data = [];
        $user = User::find($id);

        $data = [
            'user' => $user,
        ];

        return view('users.edit',$data);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|max:191',
            'email' => 'required|max:191',
        ]);

        $user = \App\User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->address = $request->address;
        $user->profile = $request->profile;
        $user->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        $user = \App\User::find($id);
        if (\Auth::id() === $user->id) {
            $user->delete();
        }

        return redirect('/');
    }

    public function withdrawal()
    {
        return view('users.delete');
    }
}