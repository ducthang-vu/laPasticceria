<?php

namespace App\Http\Controllers\User;

use App\Cake;
use App\Cake_type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CakeController extends Controller
{
    /**
     * Validation rules
     */
    private function validationRules() {
        return array_fill_keys(Cake_type::getAllSlugs(), 'required|integer|min:0|max:5000');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cakes = Cake::all()->sortByDesc('created_at');
        return view('user.cakes.index', compact('cakes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cakeTypes = Cake_type::all();
        return view('user.cakes.create', compact('cakeTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules());
        $created = [];
        foreach(Cake_type::getAllSlugs() as $slug) {
            for ($i = 0; $i < $request->all()[$slug] ; $i++) {
                $newCake = new Cake;
                $newCake->cake_type_id = Cake_type::getIdBySlug($slug);
                if ($newCake->save()) {
                    $created[] = $newCake->id;
                };
            }
        }
        return redirect()->route('user.cakes.index')->with('cakeCreatedList', $created);
    }


    public function destroy(Cake $cake)
    {
        $id = $cake->id;
        return $cake->delete() ?
            redirect()->route('user.cakes.index')->with('cakeDeleted', $id) : abort('500');
    }
}
