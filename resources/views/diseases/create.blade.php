@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Input Data Klasifikasi Penyakit</div>

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
                      {!! Form::open(['action'=>'DiseasesController@store','method'=>'POST', 'enctype' =>'multipart/data'] ) !!}
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="disease_code">Kode ICD X</label>
                            <input type="text" class="form-control" id="disease_code" placeholder="Kode ICD X" name="disease_code">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="disease_name">Nama Penyakit</label>
                          <input type="text" class="form-control" id="disease_name" placeholder="Nama Penyakit" name="disease_name">
                        </div>
                        <div class="form-group">
                          <label for="class_code">Klasifikasi</label>
                          <select class="form-control" id="class_code" name="class_code">
                            @foreach ($classes as $class)
                              <option value="{{$class->class_code}}">{{$class->class_code.' '.$class->class_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        {{Form::submit('Add',['class' => 'btn btn-primary'])}}
                      {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
