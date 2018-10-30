<?php

namespace App\Http\Controllers;

use App\Disease;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientsController extends Controller
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
        $patients = DB::table('patients')
            ->leftJoin('diseases', 'patients.disease_code', '=', 'diseases.disease_code')
            ->select('patients.id', 'no_rm', 'treatment_type', 'name', 'birthday', 'gender', 'patients.disease_code', 'domicile',
                'patient_type', 'entry_date', 'exit_date', 'payment_type', 'release_note', 'diseases.disease_name')
            ->get();

        //return $patients;
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $diseases = Disease::all();
        return view('patients.create', compact('diseases'));
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
            'no_rm' => 'required',
            'treatment_type' => 'required',
            'name' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'disease_code' => 'required',
            'domicile' => 'required',
            'patient_type' => 'required',
            'entry_date' => 'required',
            'exit_date' => 'required',
            'payment_type' => 'required',
            'release_note' => 'required',
        ]);
        $patient = new Patient([
            'no_rm' => $request->get('no_rm'),
            'name' => $request->get('name'),
            'treatment_type' => $request->get('treatment_type'),
            'birthday' => $request->get('birthday'),
            'gender' => $request->get('gender'),
            'disease_code' => $request->get('disease_code'),
            'domicile' => $request->get('domicile'),
            'patient_type' => $request->get('patient_type'),
            'entry_date' => $request->get('entry_date'),
            'exit_date' => $request->get('exit_date'),
            'payment_type' => $request->get('payment_type'),
            'release_note' => $request->get('release_note'),
        ]);
        $patient->save();
        return redirect('/patients')->with('success', 'Pasien Berhasil Ditambahkan');
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
        $patient = DB::table('patients')
            ->leftJoin('diseases', 'patients.disease_code', '=', 'diseases.disease_code')
            ->where('patients.id', '=', $id)
            ->get();

        $diseases = Disease::all();

        //return $disease;
        return view('patients.edit', compact('patient', 'diseases'));
        //return compact('patient', 'diseases');
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
            'no_rm' => 'required',
            'treatment_type' => 'required',
            'name' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'disease_code' => 'required',
            'domicile' => 'required',
            'patient_type' => 'required',
            'entry_date' => 'required',
            'exit_date' => 'required',
            'payment_type' => 'required',
            'release_note' => 'required',
        ]);

        $patient = Patient::find($id);
        $patient->no_rm = $request->input('no_rm');
        $patient->treatment_type = $request->input('treatment_type');
        $patient->name = $request->input('name');
        $patient->birthday = $request->input('birthday');
        $patient->gender = $request->input('gender');
        $patient->disease_code = $request->input('disease_code');
        $patient->domicile = $request->input('domicile');
        $patient->patient_type = $request->input('patient_type');
        $patient->entry_date = $request->input('entry_date');
        $patient->exit_date = $request->input('exit_date');
        $patient->payment_type = $request->input('payment_type');
        $patient->release_note = $request->input('release_note');

        $patient->save();
        return redirect('/patients')->with('success', 'Pasien Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();

        return redirect('/patients')->with('success', 'Pasien Berhasil Dihapus');
    }
}
