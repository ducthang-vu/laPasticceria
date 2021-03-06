<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::orderBy('name', 'asc')->get();
        return view('user.ingredients.index', compact('ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:ingredients|min:1|max:75',
        ]);
        $data = $request->all();

        $newIngredient = new ingredient();
        $newIngredient->name = $data['name'];
        if ($newIngredient->save()) {
            return redirect()->route('user.ingredients.index')->with('ingredientSaved', $newIngredient->name);
        } else {
            abort(500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        if ($ingredient->cakeTypes->isNotEmpty()) {
            return back()->withErrors("L'ingrediente " . $ingredient->name . " è usato in alcune ricette. Impossibile procedere con l'eliminazione.");
        }

        $ingedientName = $ingredient->name;
        $ingredient->cakeTypes()->detach();
        return $ingredient->delete() ?
            redirect()->route('user.ingredients.index')->with('ingredientDeleted', $ingedientName)
            : abort('500');
    }
}
