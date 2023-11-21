<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Auth\Events\Validated;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $messages = Message::select('users.name', 'messages.message', 'messages.created_at', 'messages.messages_id', 'messages.user_id')
            ->join('users', 'messages.user_id', '=', 'users.id');

        if ($request->keyword) {
            $messages->where(function ($query) use ($request) {
                $query->where('users.name', 'ilike', '%' . $request->keyword . '%')
                    ->orWhere('messages.message', 'ilike', '%' . $request->keyword . '%');
            });
        }

        return $messages->get();
        //return $messages->paginate(3);  use paginate then magbutang kag value pila ra ka book imong gusto e view.
        // return $messages->all(); e use lang ni if walay mga filters like select,join and where.
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    { {
            $validated = $request->validated();

            $Message = Message::create($validated);

            return $Message;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Message::findorFail($id);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(MessageRequest $request, string $id)
    {
        $validated = $request->validated();

        $Message = Message::findOrFail($id);
        $Message->update($validated);

        return $Message;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Message = Message::findOrFail($id);

        $Message->delete();
        return $Message;
    }
}
