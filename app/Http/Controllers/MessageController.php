<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Conversation,App\Models\Chatting;
// use App\Models\UserDeviceToken,App\Models\User,DB;
use App\Traits\MessageChattings;

class MessageController extends Controller
{
    use MessageChattings;
}
