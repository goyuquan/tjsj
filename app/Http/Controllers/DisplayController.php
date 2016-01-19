<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Display;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DisplayController extends Controller
{
    public function __construct()
    {

    }


    public function index()
    {
        return "ddddddddddddddd";
        $displays = $displayss = Display::all();
        return view('admin.displays.index', ["displays" => $displays,"displayss" => $displayss]);
    }


    public function store(Request $request)
    {
        $request->parent_id = empty($request->parent_id)?1:$request->parent_id;

        $messages = [
            'name.required' => '分类名不能为空',
        ];
        $this->validate($request, [
            'name' => 'required',
        ],$messages);

        Display::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        Session()->flash('status', 'display create was successful!');

        return redirect('/admin/displays/');
    }

}
