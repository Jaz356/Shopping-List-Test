<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function index()
    {
        return response()->json(ShoppingList::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        $shoppingList = ShoppingList::create($request->all());

        return response()->json($shoppingList, 201);
    }

    public function show(ShoppingList $shoppingList)
    {
        return response()->json($shoppingList, 200);
    }

    public function update(Request $request, ShoppingList $shoppingList)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        $shoppingList->update($request->all());

        return response()->json($shoppingList, 200);
    }

    public function destroy(ShoppingList $shoppingList)
    {
        $shoppingList->delete();

        return response()->json(null, 204);
    }

    public function destroyAll()
    {
        ShoppingList::truncate();

        return response()->json(null, 204);
    }
}