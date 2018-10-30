<?php

namespace App\Http\Controllers;

use App\Classification;
use Illuminate\Http\Request;

class ClassificationsController extends Controller
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
        $classes = Classification::all();

        return view('classifications.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_code'=>'required',
            'class_name'=> 'required'
        ]);
        $class = new Classification([
            'class_code' => $request->get('class_code'),
            'class_name' => $request->get('class_name')
        ]);
        $class->save();
        return redirect('/classifications')->with('success', 'Klasifikasi Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Classification::find($id);
        
        //return $class;
        return view('classifications.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_code'=>'required',
            'class_name'=> 'required'
        ]);
        
        $class = Classification::find($id);
        $class->class_code = $request->input('class_code');
        $class->class_name = $request->input('class_name');

        $class->save();
        return redirect('/classifications')->with('success', 'Klasifikasi Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Classification::find($id);
        $class->delete();

        return redirect('/classifications')->with('success', 'Klasifikasi Berhasil Dihapus');
    }
}
