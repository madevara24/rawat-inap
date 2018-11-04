@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Laporan Data Kesakitan</div>

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
                  {!! Form::open(['action'=>'RecapsController@testForm','method'=>'POST', 'enctype' =>'multipart/data'] ) !!}
                  <div class="form-group">
                        <div class="form-row">
                          <div class="col-md-4">
                              <label for="year">Tahun</label>
                              <select class="form-control" id="year" name="year">
                                  @for ($i = $years[0]->year; $i <= $years[1]->year; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                  @endfor
                                </select>
                          </div>
                        </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-4">
                          <div class="custom-control custom-checkbox custom-control-inline">
                              <input type="checkbox" class="custom-control-input" id="month_jan" name="month_jan">
                              <label class="custom-control-label" for="month_jan">Januari</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_feb" name="month_feb">
                                <label class="custom-control-label" for="month_feb">Februari</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_mar" name="month_mar">
                                <label class="custom-control-label" for="month_mar">Maret</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_apr" name="month_apr">
                                <label class="custom-control-label" for="month_apr">April</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_may" name="month_may">
                                <label class="custom-control-label" for="month_may">Mei</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_jun" name="month_jun">
                                <label class="custom-control-label" for="month_jun">Juni</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_jul" name="month_jul">
                                <label class="custom-control-label" for="month_jul">Juli</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_aug" name="month_aug">
                                <label class="custom-control-label" for="month_aug">Agustus</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_sep" name="month_sep">
                                <label class="custom-control-label" for="month_sep">September</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_oct" name="month_oct">
                                <label class="custom-control-label" for="month_oct">Oktober</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_nov" name="month_nov">
                                <label class="custom-control-label" for="month_nov">November</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="month_des" name="month_dec">
                                <label class="custom-control-label" for="month_des">Desember</label>
                            </div>
                        </div>
                    </div>
                  </div>
                    {{Form::submit('Print',['class' => 'btn btn-primary'])}}
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>          
@endsection
