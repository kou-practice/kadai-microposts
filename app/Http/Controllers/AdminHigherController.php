<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHigherController extends Controller
{
    public function index()
    {
        $users = \App\User::orderBy('id', 'desc')->paginate(10);
        $admin = \App\User::find(\Auth::id());

        return view('admin.index', [
            'users' => $users,
            'admin' => $admin,
        ]);
    }

    public function destroy($id)
    {
        $user = \App\User::find($id);
        if (\App\User::find(\Auth::id())->role <= 5) {
            $user->delete();
        }

        return redirect()->back();
    }

    public function freeze($id)
    {
        $user = \App\User::find($id);
        if (\App\User::find(\Auth::id())->role <= 5) {
            $user->freeze = 1;
            $user->save();
        }

        return redirect()->back();
    }

    public function unzip($id)
    {
        $user = \App\User::find($id);
        if (\App\User::find(\Auth::id())->role <= 5) {
            $user->freeze = 0;
            $user->save();
        }

        return redirect()->back();
    }

}
