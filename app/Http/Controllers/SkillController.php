<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SkillController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


/**
 * Create a new skill.
 *
 * @param  Request  $request
 * @return Response
 */
public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required|max:255',
    ]);

  $request->user()->skills()->create([
        'name' => $request->name,
    ]);

    return redirect('/home');
}


/**
 * Destroy the given task.
 *
 * @param  Request  $request
 * @param  Task  $task
 * @return Response
 */
public function destroy(Request $request, Skill $skill)
{
//    $this->authorize('destroy', $skill);

    $skill->delete();

    return redirect('/home');
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $data = Item::select("title as name")->where("title","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }




}
