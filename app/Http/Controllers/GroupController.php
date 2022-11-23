<?php

namespace App\Http\Controllers;

use App\Models\Bell;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class GroupController extends Controller
{
    public function index()
    {
        $groups = Auth::user()->groups()
            ->select('updated_at', 'title', 'uid')
            ->get();

        return view('dashboard',compact('groups'));
    }

    public function showMembers($id)
    {
        $group = Auth::user()->groups()->where('uid', $id)->first();
        $bells = $group->bells()->get();

        $json = ["bells" => $bells];

        return response()->json($json);
    }

    public function create()
    {
        $group = new Group();
        $num = 1 + Auth::user()->groups()->count();
        $title = Auth::user()->name."'s Group ".$num;

        $group->title = $title;
        $group->user_id = Auth::id();
        $group->uid = Str::uuid();

        $group->save();

        return back();
    }


    public function store(Request $request)
    {
        $group = Auth::user()->groups()
            ->where('uid', $request->input('uid'))->first();
        $group->title = $request->input('new_title');

        $group->save();

        return back();
    }


    public function edit($id)
    {
        $group = Auth::user()->groups()->where('uid', $id)->first();
        $group->full_url = url($id . '/addbell');

        return view('edit_group',compact('group'));
    }


    public function destroy($id)
    {
        $group = Auth::user()->groups()->where('uid', $id)->first();

        $group->bells()->each(function ($bell){$bell->delete();});
        $group->delete();

        return redirect('dashboard');
    }

    public function addBell($id)
    {
        $group = Group::where('uid', $id)->first();

        $bell = new Bell;
        $num = 1 + $group->count_bell;
//        $title = $group->title." :BELL ".$num;
        $title = $num;

        $bell->title = $title;
        $bell->user_id = $group->user_id;
        $bell->uid = Str::uuid();
        $bell->status = 'stand-by';
        $bell->group_id = $group->id;

        $bell->save();

        $group->count_bell = $num;
        $group->save();

        return redirect($bell->uid);
    }
}
