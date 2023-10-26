<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselItemsRequest;
use App\Models\CarouselItems;
use App\Models\User;
use Egulias\EmailValidator\Parser\FoldingWhiteSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class CarouselItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarouselItems::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(CarouselItemsRequest $request)
    // {
    //     $validated = $request->validated();

    //     $carouselitem = CarouselItems::create($validated);

    //     return $carouselitem;
    // }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return $user;

    }
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CarouselItems::find($id);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarouselItemsRequest $request, string $id)
    {
        $validated = $request->validated();

        $carouseltitem = CarouselItems::findOrFail($id);
        $carouseltitem->update($validated);

        return $carouseltitem;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carouselItems = CarouselItems::findOrFail($id);

        $carouselItems->delete();
        return $carouselItems;

    }


}