@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Data Klasifikasi Penyakit</div>

                <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                        </div><br />
                      @endif
                      {!! Form::open(['action'=>['ClassificationsController@update', $class->id],'method'=>'POST'] ) !!}
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="class_code">Kode DX</label>
                            <input type="text" class="form-control" id="class_code" placeholder="Kode DX" 
                            name="class_code" value="{{ $class->class_code }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="class_name">Nama Klasifikasi</label>
                          <input type="text" class="form-control" id="class_name" placeholder="Nama Klasifikasi" 
                          name="class_name" value="{{ $class->class_name }}">
                        </div>
                        {{Form::hidden('_method','PUT')}}
                        {{Form::submit('Update',['class' => 'btn btn-primary'])}}
                      {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
