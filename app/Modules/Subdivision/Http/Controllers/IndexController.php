<?php

namespace App\Modules\Subdivision\Http\Controllers;

use App\Modules\Subdivision\Http\Requests\CreateSubdivisionRequest;
use App\Modules\Subdivision\Http\Requests\UpdateSubdivisionRequest;
use App\Subdivision;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->checkPerm('view.subdivision'))
            return $this->noAccess('Not enough rights to view');

        $subdivisions = Subdivision::all()->take(10);
        return view('subdivision::index',[
            'subdivisions' => $subdivisions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->checkPerm('create.subdivision'))
            return $this->noAccess('Not enough rights to create');

        $users = User::all();
        return view('subdivision::create',[
            'responsibles' => $users
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->checkPerm('show.subdivision'))
            return $this->noAccess('Not enough rights to view');

        $sub = Subdivision::where('id',$id)->firstOrFail();
        return view('subdivision::show',['subdivision' => $sub]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->checkPerm('edit.subdivision'))
            return $this->noAccess('Not enough rights to edit');

        $sub = Subdivision::where('id',$id)->firstOrFail();
        $users = User::all();
        return view('subdivision::edit',[
            'subdivision' => $sub,
            'responsibles' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSubdivisionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSubdivisionRequest $request)
    {
        $newSub = Subdivision::createNewSub($request->all());

        if($newSub instanceof Subdivision){
            \Flash::success('New subdivision created!');
            return redirect()->route('subdivision.show',['id' => $newSub->id]);
        } else {
            \Flash::error('New subdivision not created!');
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSubdivisionRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSubdivisionRequest $request, $id)
    {
        $sub = Subdivision::updateSub($id, $request->all());

        if($sub instanceof Subdivision){
            \Flash::success('Subdivision ' . $sub->name . ' updated!');
            return redirect()->route('subdivision.show',['id' => $sub->id]);
        } else {
            \Flash::error('Subdivision not updated!');
            return redirect()->route('subdivision.show',['id' => $id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->checkPerm('delete.subdivision'))
            return $this->noAccess('Not enough rights to delete');

        if(Subdivision::all()->count() <= 1){
            \Flash::warning('You can not delete the last subdivision!');
            return redirect()->back();
        }

        $sub = Subdivision::where('id',$id)->firstOrFail();
        if($sub->delete()){
            \Flash::success('Subdivision Deleted!');
            return redirect()->route('subdivision');
        } else {
            \Flash::error('Subdivision not deleted!');
            return redirect()->route('subdivision');
        }
    }
}
