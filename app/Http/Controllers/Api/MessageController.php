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
    public function index()
    {
        return Message::all();
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
