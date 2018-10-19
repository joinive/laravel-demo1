<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    //
    public function index(Request $request) {
        return view('chat.index');
    }
}
