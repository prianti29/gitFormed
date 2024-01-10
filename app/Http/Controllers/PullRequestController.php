<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\PullRequest;
use App\Models\Repository;
use App\Models\Watcher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PullRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['pull_list'] = PullRequest::with('repository')->paginate(10);
        return view('pullRequest.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        $data["repo_list"] = Repository::where('user_id', $user_id)->pluck('repository_name', 'id');
        return view('pullRequest.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pull = new PullRequest();
        $pull->title = $request->title;
        $pull->repository_id = $request->repository_id;
        $pull->created_at = Carbon::now();
        $response = $pull->save();
        if($response == true) {
            $watchers = Watcher::where('repository_id', $request->repository_id)->get();
            foreach ($watchers as $watcher) {
                Notification::create([
                    'user_id' => $watcher->user_id,
                    'pull_request_id' => $pull->id,
                ]);
            }

        }
        return redirect('/add-pull-req');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pull = PullRequest::find($id);
        if (!$pull) {
            return redirect("/add-pull-req");
        }
        $data["pull"] = $pull;
        $data["repo_list"] = Repository::pluck('repository_name', 'id');
        return view('pullRequest.edit', $data);
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

        $pull = PullRequest::find($id);
        if (!$pull) {
            return redirect("/add-pull-req");
        }
        $pull->title = $request->title;
        $pull->repository_id = $request->repository_id;
        $pull->save();
        return redirect("/add-pull-req");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pull = PullRequest::find($id);
        if (!$pull) {
            return redirect("/add-pull-req");
        }
        $pull->delete();
        return redirect("/add-pull-req");
    }
    public function getPullRequestByRepository($repository_id)
    {
        if ($repository_id) {
            $pull_list = PullRequest::where('repository_id', $repository_id)->paginate(10);
        } else {
            $pull_list = PullRequest::paginate(10);
        }
        return view('pullRequest.index', compact('pull_list'));
    }
}
