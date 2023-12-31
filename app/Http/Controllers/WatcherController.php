<?php

namespace App\Http\Controllers;

use App\Models\Watcher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatcherController extends Controller
{
    public function updateWatchers(Request $request)
    {
        //dd($request);
        $user_id = Auth::id();
        $repository_id = $request->input('repository_id'); // Get repository_id from the request
        $watcher = Watcher::where(['user_id' => $user_id, 'repository_id' => $repository_id])->first();   
        if ($request->has('watcher')) {
            if (!$watcher) {
                $watch = new Watcher();
                $watch->user_id = $user_id;
                $watch->repository_id = $repository_id;
                $watch->created_at = Carbon::now();
                $watch->save();
                //Watcher::create(['user_id' => $user_id, 'repository_id' => $repository_id]);
            } else {
                    $watcher->delete();
            }
        } 
        else {
            if ($watcher) {
                $watcher->delete();
            }
        }
        return response()->json(['status' => 'success']);
        // return redirect()->back();
    }
}
