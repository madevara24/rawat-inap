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
                            <input type="date" class="form-control" id="birthday" name="birthday" onchange=onChangeBirthday()>
                        </div>
                        <script>
                          function onChangeBirthday(){
                            setAge();
                            if(document.getElementById("entry_date").value != null)
                              setAgeClass();
                          }

                          function onChangeEntryDate(){
                            if(document.getElementById("birthday").value != null)
                              setAgeClass();
                          }

                          function setAge(){
                            var birthday = new Date($('#birthday').val());
                            var today = new Date();
                            var age = today.getFullYear() - birthday.getFullYear();
                            if(today.getMonth()==birthday.getMonth() && today.getDate()<birthday.getDate()){
                              age -=1;
                            }else if(today.getMonth()<birthday.getMonth()){
                              age -=1;
                            }
                            document.getElementById("age").value = age;
                          }

                          function setAgeClass(){
                            var birthday = new Date($('#birthday').val());
                            var entry_date = new Date($('#entry_date').val());
                            var year_diff = entry_date.getFullYear() - birthday.getFullYear();
                            var day_diff = parseInt((entry_date.getTime() - birthday.getTime())/(24*3600*1000));
                            if(entry_date.getMonth()<=birthday.getMonth()){
                              if(entry_date.getDate()<birthday.getDate()){
                                year_diff -=1;
                              }
                            }
                            if(year_diff > 0){
                              if(year_diff<5)
                                document.getElementById("age_class").value = 3;
                              else if(year_diff<6)
                                document.getElementById("age_class").value = 4;
                              else if(year_diff<10)
                                document.getElementById("age_class").value = 5;
                              else if(year_diff<12)
                                document.getElementById("age_class").value = 6;
                              else if(year_diff<15)
                                document.getElementById("age_class").value = 7;
                              else if(year_diff<18)
                                document.getElementById("age_class").value = 8;
                              else if(year_diff<20)
                                document.getElementById("age_class").value = 9;
                              else if(year_diff<25)
                                document.getElementById("age_class").value = 10;
                              else if(year_diff<35)
                                document.getElementById("age_class").value = 11;
                              else if(year_diff<45)
                                document.getElementById("age_class").value = 12;
                              else if(year_diff<55)
                                document.getElementById("age_class").value = 13;
                              else if(year_diff<60)
                                document.getElementById("age_class").value = 14;
                              else if(year_diff<65)
                                document.getElementById("age_class").value = 15;
                              else if(year_diff<70)
                                document.getElementById("age_class").value = 16;
                              else
                                document.getElementById("age_class").value = 17;
                            }else{
                              if(day_diff < 8)
                                document.getElementById("age_class").value = 0;
                              else if(day_diff<29)
                                document.getElementById("age_class").value = 1;
                              else
                                document.getElementById("age_class").value = 2;
                            }
                          }
                        </script>
                        <div class="col-md-6">
                            <label for="age">Umur</label>
                            <input type="text" class="form-control" id="age" name="age" readonly>
                            <input type="hidden" id="age_class" name="age_class">
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
                          <input type="date" class="form-control" id="entry_date" name="entry_date" onchange=onChangeEntryDate()>
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
