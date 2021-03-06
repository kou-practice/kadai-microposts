<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }

        return view('welcome', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'content' => 'required|max:191',
        ]);
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);

        return back();
    }

    public function destroy($id)
    {
        $micropost = \App\Micropost::find($id);
        if (\Auth::id() === $micropost->user_id || \App\User::find(\Auth::id())->role <= 5) {
            $micropost->delete();
        }

        return back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'content' => 'required|max:191',
        ]);
        $micropost = \App\Micropost::find($id);
        $micropost->content = $request->content;
        $micropost->save();

        return back();
    }

    public function search(Request $request)
    {
        if ($request->content){
            $microposts = \App\Micropost::where('content', 'like', '%'.$request->content.'%')->paginate(10);
            $data = [
                'microposts' => $microposts,
            ];

            return view('microposts.search',$data);
        }
        return redirect()->back();
    }
}
