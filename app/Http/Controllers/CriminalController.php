<?php

namespace App\Http\Controllers;

use App\Criminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CriminalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criminals = Criminal::all();
        return view('criminals.list', [
            'criminals' => $criminals
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        if  (auth()->id() != 1){
            abort(403);
        }
        return view('criminals.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if  (auth()->id() != 1){
            abort(403);
        }
        $criminal = new Criminal();
        $criminal->name = $request->post('name');
        $file = $request->file('photo');
        $filename = md5($criminal->name . date('Y-m-d H:i:s')) . '.' . $file->extension();
        $criminal->photo = $filename;
        $file->storeAs('public/images', $filename);
        $criminal->article = $request->post('article');
        $criminal->birth_date = $request->post('birth_date');

        $criminal->save();

        return redirect('/criminals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Criminal  $criminal
     * @return \Illuminate\Http\Response
     */
    public function show(Criminal $criminal)
    {
        return view('criminals.view', [
            'criminal' => $criminal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Criminal  $criminal
     * @return \Illuminate\Http\Response
     */
    public function edit(Criminal $criminal)
    {
        if  (auth()->id() != 1){
            abort(403);
        }
        return view('criminals.form', [
            'criminal' => $criminal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Criminal  $criminal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criminal $criminal)
    {
        if  (auth()->id() != 1){
            abort(403);
        }
        $criminal->name = $request->post('name');
        $file = $request->file('photo');
        $filename = $criminal->photo;
        if(!empty($file)){
            $file->storeAs('public/images', $filename);
        }
        $criminal->article = $request->post('article');
        $criminal->birth_date = $request->post('birth_date');
        $criminal->save();

        return redirect('/criminals');
    }

    /**
     * @param Criminal $criminal
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Criminal $criminal)
    {
        if  (auth()->id() != 1){
            abort(403);
        }
        $criminal->delete();
        return redirect('/criminals');
    }
}
