@extends('layouts.app')

@section('content')
    <div class="row justify-content-center flex-row flex-nowrap">
        <h1 class="py-2">Data Kesakitan</h1>
        <table class="table table-striped table-sm">
            <thead class="thead-dark text-center">
                <tr>
                    <th rowspan="3">Kode DX</th>
                    <th rowspan="3">Nama Penyakit</th>    
                    <th rowspan="3">Total</th>
                    <th colspan="4">Jumlah</th>
                    <th colspan="4">0-7 HR</th>
                    <th colspan="4">8-28 HR</th>
                    <th colspan="4">29-1 TH</th>
                    <th colspan="4">1-4 TH</th>
                    <th colspan="4">{{"5-<6 TH"}}</th>
                    <th colspan="4">6-9 TH</th>
                    <th colspan="4">10-11 TH</th>
                    <th colspan="4">12-14 TH</th>
                    <th colspan="4">15-17 TH</th>
                    <th colspan="4">18-19 TH</th>
                    <th colspan="4">20-24 TH</th>
                    <th colspan="4">25-34 TH</th>
                    <th colspan="4">35-44 TH</th>
                    <th colspan="4">45-54 TH</th>
                    <th colspan="4">55-59 TH</th>
                    <th colspan="4">60-64 TH</th>
                    <th colspan="4">65-69 TH</th>
                    <th colspan="4">>=70 TH</th>
                    <th colspan="2" rowspan="3" class="text-center">Aksi</th>
                </tr>
                <tr>
                    @for ($i = 0; $i < 19; $i++)
                        <th colspan="2">LK</th>
                        <th colspan="2">PR</th>
                    @endfor
                </tr>
                <tr>
                        @for ($i = 0; $i < 38; $i++)
                            <th>B</th>
                            <th>L</th>
                        @endfor
                    </tr>
            </thead>{{--
            <tbody>
                @foreach($patients as $patient)
                <tr>
                    <td>{{$patient->no_rm}}</td>
                    <td>{{$patient->name}}</td>
                    <td>{{$patient->birthday}}</td>
                    <td>{{$patient->gender}}</td>
                    <td>{{$patient->domicile}}</td>
                    <td>{{$patient->patient_type}}</td>
                    <td>{{$patient->treatment_type}}</td>
                    <td>{{$patient->payment_type}}</td>
                    <td>{{$patient->entry_date}}</td>
                    <td>{{$patient->exit_date}}</td>
                    <td>{{$patient->release_note}}</td>
                    <td><a href="{{ route('patients.edit',$patient->id)}}" class="btn btn-primary btn-sm" class="text-center">Edit</a></td>
                    <td>
                        {!!Form::open(['action' => ['PatientsController@destroy',$patient->id], 'method' => 'POST', 'class' => 'text-center'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Delete',['class'=>'btn btn-danger btn-sm'])}}
                        {!!Form::close()!!}
                    </td>                
                </tr>
                @endforeach
                        
            </tbody>--}}
                    
        </table>
    </div>            
@endsection
