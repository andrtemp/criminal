<?php

namespace App\Http\Controllers;

use App\Criminal;
use App\FileCriminal;
use http\Env\Response;
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

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loadFile(){
        if  (auth()->id() != 1){
            abort(403);
        }
        $fileCriminal = new FileCriminal();

        $file = \request()->file('file');
        $id = \request('id');
        $filename = $file->hashName();

        $fileCriminal->filename = $filename;
        $fileCriminal->criminal_id = $id;
        $fileCriminal->save();
        $file->storeAs('public/files', $file->hashName());

        return redirect('/criminals');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function file($id){
        if  (auth()->id() != 1){
            abort(403);
        }

        $file = FileCriminal::query()->where(['id' => $id])->first();
//        //PDF file is stored under project/public/download/info.pdf
//        $file= public_path(). "/download/info.pdf";
//
//        $headers = array(
//            'Content-Type: application/pdf',
//        );
//
//        return Response::download($file, 'filename.pdf', $headers);
        if (!empty($file->filename)) {
            return response()->download(public_path(). DIRECTORY_SEPARATOR . 'storage/files/' . $file->filename);
        } else{
            abort(403);
        }
    }
}
