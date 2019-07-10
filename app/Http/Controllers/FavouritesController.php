<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavouritesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Reply $reply
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        $reply->favourite(Auth::id());
        return back();
//        $reply->favourites()->create(['user_id' => auth()->user()->id,]);

    }

}
