<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

use App\Models\Bell;
use App\Models\Group;

class BellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bells = Auth::user()->bells()->where('group_id', null)
            ->select('updated_at', 'title', 'uid', 'status')
            ->get();
        $json = ["bells" => $bells];

        return response()->json($json);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bell = new Bell;
        $num = 1 + Auth::user()->bells()->where('group_id', null)->count();
        $title = Auth::user()->name."'s #".$num;

        $bell->title = $title;
        $bell->user_id = Auth::id();
        $bell->uid = Str::uuid();
        $bell->status = 'stand-by';

        $bell->save();

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bell = Auth::user()->bells()
            ->where('uid', $request->input('uid'))->first();

        $bell->title = $request->input('new_title');

        $bell->save();

        return back();
    }

    /**
     *
     * Display the specified resource.
     *
     * @param  str  $url
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bell = Bell::where('uid', $id)
            ->select('updated_at', 'title', 'uid', 'status', 'group_id')
            ->first();

        $group = $bell
            ->group()
            ->select('updated_at', 'title')
            ->first();

        unset($bell->group_id);

        $json = ["bell" => $bell, "group" => $group];

        return response()->json($json);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bell = Auth::user()->bells()->where('uid', $id)
            ->first();
        $bell->full_url = url($id);

        $group = $bell->group()->first();

        return view('edit',compact('bell', 'group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bell = Bell::where('uid', $id)->first();

        if ($bell->status == 'stand-by'):
            $bell->status = 'calling';
        else:
            $bell->status = 'stand-by';
        endif;

        $bell->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bell = Auth::user()->bells()->where('uid', $id)->first();
        $group = $bell->group()->first();

        if (is_null($bell->group_id)){
            $path = 'dashboard';
        }else{
            $path = '/group/edit/'. $group->uid;
        }

        $bell->delete();

        return redirect($path);

    }

}
