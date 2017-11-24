<?php

namespace App\Http\Modules\Pages\Backend\Controllers;

use App\Http\Controllers\BackendController;
use App\Http\Modules\Pages\Models\PagesSystem;
use Illuminate\Http\Request;

class SystemController extends BackendController
{

    public function index()
    {
        $list = PagesSystem::all();
        return $this->view('pages::system.index', compact('list'));
    }

    public function edit($id)
    {
        $obj = PagesSystem::find($id);
        return $this->view('pages::system.edit', compact('obj'));
    }

    public function save(Request $request, $id)
    {
        $obj = PagesSystem::find($id);
        $obj->status = (boolean)$request->input('status');
        $obj->alias = $request->input('alias');
        $obj->name = $request->input('name');
        $obj->h1 = $request->input('h1');
        $obj->text = $request->input('text');

        try {
            $obj->save();
        } catch(\Exception $e) {}

        return $this->view('pages::system.edit', compact('obj'));
    }
}
