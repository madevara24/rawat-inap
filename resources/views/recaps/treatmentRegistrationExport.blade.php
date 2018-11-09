
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>No RM</th>
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
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                <tr>
                    <td>{{$patient->no_rm}}</td>
                    <td>{{$patient->name}}</td>
                    <td>{{$patient->birthday}}</td>
                    <td>{{$patient->age}}</td>
                    <td>{{$patient->gender}}</td>
                    <td>{{$patient->treatment_type}}</td>
                    <td>{{$patient->patient_type}}</td>
                    <td>{{$patient->domicile}}</td>
                    <td>{{$patient->disease_name}}</td>
                    <td>{{$patient->disease_code}}</td>
                    <td>{{$patient->entry_date}}</td>
                    <td>{{$patient->exit_date}}</td>
                    <td class="text-right">{{$patient->duration}} Hari</td>
                    <td>{{$patient->release_note}}</td>
                    <td>{{$patient->payment_type}}</td>       
                </tr>
                @endforeach
                        
            </tbody>
                    
        </table>
        