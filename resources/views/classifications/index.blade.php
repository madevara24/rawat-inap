@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-2">Klasifikasi Penyakit</h1>
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">Kode DX</th>    
                    <th>Nama Klasifikasi</th>
                    <th colspan="2" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $class)
                <tr>
                    <td style="width:7%" class="text-right">{{$class->class_code}}</td>
                    <td>{{$class->class_name}}</td>
                    <td style="width:6%"><a href="{{ route('classifications.edit',$class->id)}}" class="btn btn-primary btn-sm" class="text-center">Edit</a></td>
                    <td style="width:8%">
                        {!!Form::open(['action' => ['ClassificationsController@destroy',$class->id], 'method' => 'POST', 'class' => 'text-center'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Delete',['class'=>'btn btn-danger btn-sm'])}}
                        {!!Form::close()!!}
                    </td>                
                </tr>
                @endforeach
                        
            </tbody>
                    
        </table>
    </div>            
@endsection
