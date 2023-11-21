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
        try {
            $messages = Message::select('users.name', 'messages.message', 'messages.created_at', 'messages.messages_id', 'messages.user_id')
                ->join('users', 'messages.user_id', '=', 'users.id');

            if ($request->has('keyword')) {
                $keyword = '%' . $request->input('keyword') . '%';

                $messages->where(function ($query) use ($keyword) {
                    $query->where('users.name', 'ILIKE', $keyword)
                        ->orWhere('messages.message', 'ILIKE', $keyword);
                });
            }

            return $messages->get();
        } catch (\Exception $e) {
            // Log the exception
            logger('Error fetching messages: ' . $e->getMessage());

            // Return a more detailed response during development
            return response()->json(['error' => 'Error fetching messages', 'message' => $e->getMessage()], 500);
        }
    }


    //return $messages->paginate(3);  use paginate then magbutang kag value pila ra ka book imong gusto e view.
    // return $messages->all(); e use lang ni if walay mga filters like select,join and where.




    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        $validated = $request->validated();

        // Set a default user_id if not provided in the request
        $validated['user_id'] = $validated['user_id'] ?? 1; // Replace 1 with a default user_id

        $message = Message::create($validated);

        return $message;
    }

    /**
     * Display show of the specified resource.
     */
    public function show(string $id)
    {
        // Assuming 'messages_id' is the primary key column name
        $message = Message::findOrFail($id);

        // Return the retrieved Message
        return $message;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(MessageRequest $request, $id)
    {
        $validated = $request->validated();

        $message = Message::findOrFail($id);
        $message->update($validated);

        return $message;
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
