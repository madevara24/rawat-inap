@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-2">Daftar Penyakit</h1>
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>Kode ICD X</th>    
                    <th>Nama Penyakit</th>
                    <th>Klasifikasi</th>
                    <th colspan="2" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr style="background-color:#fffdd0"><th colspan="5">{{$diseases[$class->class_code][0]->class_name}}</th></tr>
                    @foreach($diseases[$class->class_code] as $disease)
                    <tr>
                        <td style="width:10%">{{$disease->disease_code}}</td>
                        <td>{{$disease->disease_name}}</td>
                        <td>{{$disease->class_code.' '.$disease->class_name}}</td>
                        <td style="width:4%"><a href="{{ route('diseases.edit',$disease->id)}}" class="btn btn-primary btn-sm" class="text-center">Edit</a></td>
                        <td style="width:6%">
                            {!!Form::open(['action' => ['DiseasesController@destroy',$disease->id], 'method' => 'POST', 'class' => 'text-center'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class'=>'btn btn-danger btn-sm'])}}
                            {!!Form::close()!!}
                        </td>                
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
                    
        </table>
    </div>            
@endsection
