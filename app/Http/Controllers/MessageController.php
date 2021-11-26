<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Chatting;
use App\Models\UserDeviceToken;
use App\Models\User;

class MessageController extends Controller
{
    // get Chat Contacts with Messages
    public function getMessageForUser(Request $req)
    {
        $rules = [
            'userId' => 'required|min:1|numeric',
        ];
        $validator = validator()->make($req->all(), $rules);
        if (!$validator->fails()) {
            $user = User::where('id', $req->userId)->first();
            if ($user) {
                $conversation = Conversation::where('senderId', $user->id)->orWhere('receiverId', $user->id)->latest('updated_at')->get();
                $contactData = [];
                foreach ($conversation as $index => $conversation) {
                    if ($conversation->senderId == $user->id) {
                        $contact = User::select('id', 'first_name', 'last_name', 'image', 'email')->where('id', $conversation->receiverId)->first();
                    } elseif ($conversation->receiverId == $user->id) {
                        $contact = User::select('id', 'first_name', 'last_name', 'image', 'email')->where('id', $conversation->senderId)->first();
                    }
                    if ($contact) {
                        $contact->newMessage = count($conversation->message->where('read', 0));
                        $contact->lastChat = '';
                        if ($lstChat = $conversation->message->first()) {
                            $contact->lastChat = $lstChat->message;
                        }
                        $contactData[] = $contact;
                    }
                }
                return successResponse('Contact List with message', $contactData);
            }
            return errorResponse('This user is not registred with us');
        }
        return errorResponse($validator->errors()->first());
    }

    // Add to Contact and Send the Message to Any User
    public function sendMessageUniversal(Request $req)
    {
        $rules = [
            'senderId' => 'required|min:1|numeric',
            'receiverId' => 'required|min:1|numeric',
            'message' => 'nullable|string|max:255',
        ];
        $validator = validator()->make($req->all(), $rules);
        if (!$validator->fails()) {
            DB::beginTransaction();
            try {
                $sender = User::where('id', $req->senderId)->first();
                $receiver = User::where('id', $req->receiverId)->first();
                if ($receiver && $sender) {
                    $conversation = Conversation::where('senderId', $sender->id)->where('receiverId', $receiver->id)->first();
                    if (!$conversation) {
                        $conversation = Conversation::where('senderId', $receiver->id)->where('receiverId', $sender->id)->first();
                        if (!$conversation) {
                            $conversation = new Conversation();
                            $conversation->senderId = $sender->id;
                            $conversation->receiverId = $receiver->id;
                            $conversation->save();
                        }
                    }
                    $conversation->updated_at = date('Y-m-d H:i:s');
                    $conversation->save();
                    if (!empty($req->message)) {
                        $message = new Chatting();
                        $message->conversationId = $conversation->id;
                        $message->senderId = $sender->id;
                        $message->receiverId = $receiver->id;
                        $message->message = strQuotationCheck($req->message);
                        $message->save();
                        DB::commit();
                        return successResponse('Message Submitted Successfully', $message);
                    } else {
                        DB::commit();
                        return successResponse('Added to Contact list');
                    }
                }
                return errorResponse('Invalid Contact Selected');
            } catch (Exception $e) {
                DB::rollback();
                return errorResponse('Something went wrong please try after sometime');
            }
        }
        return errorResponse($validator->errors()->first());
    }

    public function updateDeviceToken(Request $req)
    {
        $rules = [
            'userId' => 'required|min:1|numeric',
            'deviceToken' => 'required|string',
        ];
        $validator = validator()->make($req->all(), $rules);
        if (!$validator->fails()) {
            $token = UserDeviceToken::where('userId', $req->userId)->where('deviceToken', $req->deviceToken)->first();
            if (!$token) {
                $token = new UserDeviceToken();
                $token->userId = $req->userId;
                $token->deviceToken = $req->deviceToken;
                $token->save();
            }
            return successResponse('Device Token Updated Success', $token);
        }
        return errorResponse($validator->errors()->first());
    }

    public function getUserDevieToken($user)
    {
        $deviceTokens = UserDeviceToken::select('deviceToken')->where('userId', $user->id)
            ->where('revoked', false)->groupBy('deviceToken')->pluck('deviceToken');
        return $deviceTokens;
    }

    public function sendPushNotification($deviceToken = [], $payload = [])
    {
        // device token must be an array
        if (count($deviceToken) > 0) {
            $API_ACCESS_KEY = 'AAAABTBaXyw:APA91bEO9aSMDXRqOfHX62UqcucWAq31dkjhidUygr5_i7eGKKYOQTn-mQ4pYJz4gVcgmL-hEWnmGE0ppc_cy44Vlu_ecXqi1mylEwnx4rplLLPs5zZ6OQcPjX12_n1ES7kG9pfL9dD9';
            $firebaseToken = $deviceToken;
            $data = [
                "registration_ids" => $firebaseToken,
                "notification" => [
                    'data' => $payload,
                ],
            ];
            $headers = [
                'Authorization: key=' . $API_ACCESS_KEY,
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($ch);
            return $response;
        }
    }

    // Update to Chat mark as Read
    public function messageRead(Request $req)
    {
        $rules = [
            'chatId' => 'nullable|min:1|numeric',
        ];
        $validator = validator()->make($req->all(), $rules);
        if (!$validator->fails()) {
            $sender = $req->user();
            $chatting = Chatting::where('senderId', $sender->id);
            if (!empty($req->chatId)) {
                $chatting = $chatting->where('id', $req->chatId);
            }
            $chatting = $chatting->update(['read' => 1]);
            return successResponse('Message Marked as Read');
        }
        return errorResponse($validator->errors()->first());
    }
}
