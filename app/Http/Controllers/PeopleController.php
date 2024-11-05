<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeopleRequest;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function fetchAll() {
        $people = People::paginate(15);
        return $people;
    }

    public function store(StorePeopleRequest $people) {
        $newPeople = People::create($people->all());
        if ($newPeople) {
            return response()->json([
                'message' => 'Nova pessoa criada com sucesso'
            ]);
        }
        else {
            return response()->json([
                'message' => 'Deu ruim manin.'
            ], 422);
        }
    }
}