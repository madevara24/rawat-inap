@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-2">Pasien</h1>
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>No RM</th>
                    <th>Nama</th>    
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Domisili</th>
                    <th>Jenis Pasien</th>
                    <th>Jenis Perawatan</th>
                    <th>Nama Penyakit</th>
                    <th>Jenis Pembayaran</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Ket. Keluar</th>
                    <th colspan="2" class="text-center">Aksi</th>
                </tr>
            </thead>
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
                    <td>{{$patient->disease_code." ".$patient->disease_name}}</td>
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
                        
            </tbody>
                    
        </table>
        {{ $patients->links() }}
    </div>            
@endsection
