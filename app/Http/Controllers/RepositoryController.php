<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use App\Models\Watcher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $query = Repository::with('user')->where('user_id', $user_id);
        $sort = $request->input('sort');
        if ($sort == 'latest') {
            $repository_list = $query->orderBy('created_at', 'desc')->paginate(10);
        } elseif ($sort == 'watchers') {
            $repository_list = $query->orderBy('number_of_watcher', 'desc')->paginate(10);
        } else {
            $repository_list = $query->orderBy('repository_name')->paginate(10);
        }
        foreach ($repository_list as $repository) {
            $repository->watchers_count = Watcher::where('repository_id', $repository->id)->count();
        }
        $data['repository_list'] = $repository_list;
        return view('repository.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["user_list"] = User::get();
        return view('repository.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'repository_name' => 'unique:repositories,repository_name|required|min:5|max:10|regex:/^[a-zA-Z0-9]+$/u',
        ]);
        $repo = new Repository();
        $repo->repository_name = $request->repository_name;
        $repo->user_id = Auth::id();
        $repo->created_at = Carbon::now();
        $repo->save();
        return redirect('/addrepo');
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

        $repo = Repository::find($id);
        if (!$repo) {
            return redirect("/addrepo");
        }
        $data["repo"] = $repo;
        $data["user_list"] = User::get();
        return view('repository.edit', $data);
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
        $validated = $request->validate([
            'repository_name' => 'unique:repositories,repository_name|required|min:5|max:10|regex:/^[a-zA-Z0-9]+$/u',
        ]);
        $repo = Repository::find($id);
        if (!$repo) {
            return redirect("/addrepo");
        }
        $repo->repository_name = $request->repository_name;
        $repo->user_id = Auth::id();;
        $repo->save();
        return redirect("/addrepo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repo = Repository::find($id);
        if (!$repo) {
            return redirect("/addrepo");
        }
        $repo->delete();
        return redirect("/addrepo");
    }
}
