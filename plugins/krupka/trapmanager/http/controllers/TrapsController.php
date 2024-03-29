<?php namespace Krupka\TrapManager\Http\Controllers;

use Krupka\TrapManager\Http\Resources\TrapResource;
use Krupka\TrapManager\Controllers\Traps;
use Krupka\TrapManager\Models\Trap;
use Illuminate\Routing\Controller;

class TrapsController extends Controller
{
    public function index()
    {
        $traps = Trap::all();
        return TrapResource::collection($traps);
        
    }

    public function show($id)
    {
        $trap = Trap::findOrFail($id);
        return TrapResource::make($trap);
    }

    public function save()
    {
        $trap = new Trap();
        $user = auth()->user();
        $trap->type = post('type');

        $trap->percentage = post('percentage');
        $trap->count = post('count');
        $trap->name = $user;
        $trap->save();

        return TrapResource::make($trap);
    }
    public function edit($id)
    {

        $trap = Trap::findOrFail($id);
        $user = auth()->user();

        $trap->type = post('type');
        $trap->percentage = post('percentage');
        $trap->count = post('count');
        $trap->name =  $user->username;
        $trap->save();

        return TrapResource::make($trap);
    }
}