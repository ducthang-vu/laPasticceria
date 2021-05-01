<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\CakeType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CakeTypeController extends Controller
{
    /* UTILITIES */

    /**
     * Verify that a request contains at least one ingerdient.
     *
     */
    private function verityIngredients(Request $request) {
        $ingredientsSlug = Ingredient::getAllNamesSlug();
        $filtered =  array_filter(
            $request->all(),
            function ($key) use ($ingredientsSlug ) {
                return in_array($key, $ingredientsSlug );
            },
            ARRAY_FILTER_USE_KEY
        );
        $totalIngredients = array_reduce($filtered, function($a, $b) {return $a + $b;});
        return boolval($totalIngredients);
    }

    private function searchCakeTypebySlug($slug) {
        return CakeType::where('slug', $slug)->firstOrFail();
    }

    private function validateRules($id=null)
    {
        $nameRules = ['required', 'min:1'.'max:75'];
        $nameRules[] = $id ? Rule::unique('cake_types', 'name')->ignore($id) : 'unique:cake_types';
        $baseRules = [
            'name' => $nameRules,
            'price' => 'required|numeric|min:1|max:100',
            'image' => 'image' . ($id ? '' : '|required'),
        ];
        $ingredientsRules = array_fill_keys(Ingredient::getAllNamesSlug(), 'required|integer|min:0|max:2000');
        return array_merge($baseRules, $ingredientsRules);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cakeTypes = CakeType::all();
        return view('user.cakeTypes.index', compact('cakeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cakeTypes = CakeType::all();
        $ingredients = Ingredient::all();
        return view('user.cakeTypes.create', compact('cakeTypes', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validateRules());
        if (!$this->verityIngredients($request)) {
            return back()->withErrors('Non puoi creare ricette senza ingredienti');
        }

        $data = $request->all();

        $newCakeType = new CakeType();
        $newCakeType->name = $data['name'];
        $newCakeType->price = $data['price'] * 100;
        $newCakeType->slug = str_replace(' ', '-', $data['name']);
        $newCakeType->image = Storage::disk('public')->put('images', $data['image']);
        if ($newCakeType->save()) {
            foreach (Ingredient::getAllNamesSlug() as $ingredientSlug) {
                if ($data[$ingredientSlug]) {
                    $newCakeType->ingredients()->attach(Ingredient::getIdBySlug($ingredientSlug), ['quantity' => $data[$ingredientSlug]]);
                }
            }
            return redirect()->route('user.cake_types.show', $newCakeType->slug)->with('cakeTypeSaved', $newCakeType->title);
        } else {
            abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $cakeType = $this->searchCakeTypebySlug($slug);
        return view('user.cakeTypes.show', compact('cakeType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $cakeType = $this->searchCakeTypebySlug($slug);
        $ingredients = Ingredient::all();
        return view('user.cakeTypes.edit', compact('cakeType', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $cakeType = $this->searchCakeTypebySlug($slug);
        $request->validate($this->validateRules($cakeType->id));
        if (!$this->verityIngredients($request)) {
            return back()->withErrors('Non puoi lasciare una ricetta senza ingredienti');
        }

        $data = $request->all();

        if (isset($data['image'])) {
            if (!empty($cakeType->image)) Storage::disk('public')->delete($cakeType->image);
            $data['image'] = Storage::disk('public')->put('images', $data['image']);
        } else {
            $data['image'] = $cakeType->image;
        }
        $data['price'] = $data['price'] * 100;
        $data['slug'] = str_replace(' ', '-', $data['name']);
        if ($cakeType->update($data)) {
            foreach (Ingredient::getAllNamesSlug() as $ingredientSlug) {
                if ($data[$ingredientSlug]) {
                    $ingredient_quantity [Ingredient::getIdBySlug($ingredientSlug)] = ['quantity' => $data[$ingredientSlug]];
                }
            }
            $cakeType->ingredients()->sync($ingredient_quantity);
            return redirect()->route('user.cake_types.show', $cakeType->slug )->with('cakeTypeUpdated', $cakeType->name);
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
    public function destroy($slug)
    {
        $cakeType = $this->searchCakeTypebySlug($slug);

        $cakeTypeName = $cakeType->name;
        $cakeType->ingredients()->detach();
        if ($cakeType->delete()) {
            Storage::disk('public')->delete($cakeType->image);
            return redirect()->route('user.cake_types.index')->with('cakeTypeDeleted', $cakeTypeName);
        } else {
            abort('500');
        }
    }

    public function redirectShow($id) {
        $slug = CakeType::find($id)->slug;
        return $this->show($slug);
    }
}

