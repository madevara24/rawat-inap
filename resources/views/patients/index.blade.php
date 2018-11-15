@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-2">Register Rawat Inap</h1>
    </div>
    <div class="row py-2">
        <div class="float-left">
            <div class="card p-1">
                <form class="form-inline" method="POST" action="{{ action('RecapsController@treatmentRegistrationRedirect') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <select class="form-control" id="month" name="month">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <select class="ml-2 form-control" id="year" name="year">
                        @for ($i = $option['first']; $i <= $option['last']; $i++)
                            <option value={{$i}}>{{$i}}</option>
                        @endfor
                    </select>
                    <input type="submit" class="ml-2 btn btn-primary" value="Cari">
                </form>
            </div>
        </div>
        <div class="float-left ml-1">
            <div class="card p-1">
                <form class="form-inline" method="POST" action="{{ action('RecapsController@treatmentRegistrationExport') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <input type="hidden" name="year" value="{{$year}}">
                    <input type="hidden" name="month" value="{{$month}}">
                    <input type="submit" class="btn btn-success" value="Cetak">
                </form>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th class="align-middle">No</th>
                    <th class="align-middle">No RM</th>
                    <th class="align-middle">Nama</th>    
                    <th>Tanggal Lahir</th>
                    <th class="align-middle">Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Jenis Perawatan</th>
                    <th>Jenis Pasien</th>
                    <th class="align-middle">Domisili</th>
                    <th class="align-middle">Diagnosis</th>
                    <th>Kode Diagnosis</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Lama Dirawat</th>
                    <th>Keterangan Keluar</th>
                    <th>Jenis Pembayaran</th>
                    <th colspan="2" class="align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1;?>
                @foreach($patients as $patient)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$patient->no_rm}}</td>
                    <td>{{$patient->name}}</td>
                    <td>{{date('d F Y',strtotime($patient->birthday))}}</td>
                    <td>{{$patient->age." tahun"}}</td>
                    <td>{{$patient->gender}}</td>
                    <td>{{$patient->treatment_type}}</td>
                    <td>{{$patient->patient_type}}</td>
                    <td>{{$patient->domicile}}</td>
                    <td>{{$patient->disease_name}}</td>
                    <td>{{$patient->disease_code}}</td>
                    <td>{{date('d F Y',strtotime($patient->entry_date))}}</td>
                    <td>{{date('d F Y',strtotime($patient->exit_date))}}</td>
                    <td class="text-right">{{$patient->duration}} Hari</td>
                    <td>{{$patient->release_note}}</td>
                    <td>{{$patient->payment_type}}</td>
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
        {{-- $patients->links() --}}
    </div>            
@endsection
