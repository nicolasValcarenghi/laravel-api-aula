<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeopleRequest;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function list(Request $request){
        return People::paginate(15);
    }
    public function store(StorePeopleRequest $people){
        return true;
    }
}
