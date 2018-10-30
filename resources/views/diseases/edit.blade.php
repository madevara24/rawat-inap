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
                      {!! Form::open(['action'=>['DiseasesController@update', $disease[0]->id],'method'=>'POST'] ) !!}
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="disease_code">Kode ICD X</label>
                            <input type="text" class="form-control" id="disease_code" placeholder="Kode DX" 
                            name="disease_code" value="{{ $disease[0]->disease_code }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="disease_name">Nama Klasifikasi</label>
                          <input type="text" class="form-control" id="disease_name" placeholder="Nama Klasifikasi" 
                          name="disease_name" value="{{ $disease[0]->disease_name }}">
                        </div>
                        <div class="form-group">
                          <label for="class_code">Klasifikasi</label>
                          <select class="form-control" id="class_code" name="class_code">
                            <option value="{{$disease[0]->class_code}}">{{$disease[0]->class_code.' '.$disease[0]->class_name}}</option>
                            @foreach ($classes as $class)
                              <option value="{{$class->class_code}}">{{$class->class_code.' '.$class->class_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        {{Form::hidden('_method','PUT')}}
                        {{Form::submit('Update',['class' => 'btn btn-primary'])}}
                      {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
