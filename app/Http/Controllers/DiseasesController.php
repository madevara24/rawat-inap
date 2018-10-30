<?php

namespace App\Http\Controllers;

use App\Classification;
use App\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiseasesController extends Controller
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
        $classes = DB::table('diseases')
            ->select('class_code')
            ->groupBy('class_code')
            ->get();

        for ($i = 0; $i < count($classes); $i++) {
            $diseases[$classes[$i]->class_code] = DB::table('diseases')
                ->leftJoin('classifications', 'diseases.class_code', '=', 'classifications.class_code')
                ->select('diseases.id', 'disease_code', 'disease_name', 'diseases.class_code', 'class_name')
                ->where('diseases.class_code', $classes[$i]->class_code)
                ->get();
        }
        return view('diseases.index', compact('diseases', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classification::all();
        return view('diseases.create', compact('classes'));
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
            'disease_code' => 'required',
            'disease_name' => 'required',
            'class_code' => 'required',
        ]);
        $disease = new Disease([
            'class_code' => $request->get('class_code'),
            'disease_name' => $request->get('disease_name'),
            'disease_code' => $request->get('disease_code'),
        ]);
        $disease->save();
        return redirect('/diseases')->with('success', 'Data Penyakit Berhasil Ditambahkan');
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
        $disease = DB::table('diseases')
            ->leftJoin('classifications', 'diseases.class_code', '=', 'classifications.class_code')
            ->where('diseases.id', '=', $id)
            ->get();

        $classes = Classification::all();

        //return $disease;
        return view('diseases.edit', compact('disease', 'classes'));
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
            'disease_code' => 'required',
            'disease_name' => 'required',
            'class_code' => 'required',
        ]);

        $disease = Disease::find($id);
        $disease->disease_code = $request->input('disease_code');
        $disease->disease_name = $request->input('disease_name');
        $disease->class_code = $request->input('class_code');

        $disease->save();
        return redirect('/diseases')->with('success', 'Data Penyakit Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disease = Disease::find($id);
        $disease->delete();

        return redirect('/diseases')->with('success', 'Data Penyakit Berhasil Dihapus');
    }
}
