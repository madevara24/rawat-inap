@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Input Data Pasien</div>

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
                  {!! Form::open(['action'=>'PatientsController@store','method'=>'POST', 'enctype' =>'multipart/data'] ) !!}
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label for="no_rm">No RM</label>
                        <input type="text" class="form-control" id="no_rm" placeholder="No RM" name="no_rm">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" placeholder="Nama" name="name">
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="gender">Jenis Kelamin</label>
                          <select class="form-control" id="gender" name="gender">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                            <label for="birthday">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" onchange=setAge()>
                        </div>
                        <script>
                          function setAge(){
                            var birthday = new Date($('#birthday').val());
                            var today = new Date();
                            var age = today.getFullYear() - birthday.getFullYear();
                            if(today.getMonth()<=birthday.getMonth()){
                              if(today.getDate()<birthday.getDate()){
                                age -=1;
                              }
                            }
                            document.getElementById("age").value = age;
                          }
                        </script>
                        <div class="col-md-6">
                            <label for="age">Umur</label>
                            <input type="text" class="form-control" id="age" name="age" disabled>
                        </div>
                      </div>
                    </div>
                  
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="domicile">Domisili</label>
                          <select class="form-control" id="domicile" name="domicile">
                            <option value="DW">DW</option>
                            <option value="LW">LW</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-row">
                          <div class="col-md-6">
                            <label for="treatment_type">Jenis Perawatan</label>
                            <select class="form-control" id="treatment_type" name="treatment_type">
                              <option value="Umum">Umum</option>
                              <option value="Persalinan">Persalinan</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label for="patient_type">Jenis Pasien</label>
                            <select class="form-control" id="patient_type" name="patient_type">
                              <option value="Lama">Lama</option>
                              <option value="Baru">Baru</option>
                            </select>
                          </div>
                        </div>
                      </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="disease_code">Kode Diagnosa</label>
                          <select class="form-control" id="disease_code" name="disease_code">
                            @foreach ($diseases as $disease)
                              <option value="{{$disease->disease_code}}">{{$disease->disease_code." ".$disease->disease_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="entry_date">Tanggal Masuk</label>
                          <input type="date" class="form-control" id="entry_date" name="entry_date">
                        </div>
                        <div class="col-md-6">
                          <label for="exit_date">Tanggal Keluar</label>
                          <input type="date" class="form-control" id="exit_date" name="exit_date">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="payment_type">Pembayaran</label>
                          <select class="form-control" id="payment_type" name="payment_type">
                            <option value="UM">UM</option>
                            <option value="ASK">ASK</option>
                            <option value="JAMKESMAS">JAMKESMAS</option>
                            <option value="BPJS">BPJS</option>
                            <option value="KIS">KIS</option>
                            <option value="SPM">SPM</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <label for="release_note">Keterangan Keluar</label>
                          <select class="form-control" id="release_note" name="release_note">
                            <option value="Pulang">Pulang</option>
                            <option value="Dirujuk">Dirujuk</option>
                            <option value="Meninggal > 48 jam">Meninggal > 48 jam</option>
                            <option value="Meninggal < 48 jam">Meninggal < 48 jam</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    {{Form::submit('Add',['class' => 'btn btn-primary'])}}
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection