
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th rowspan="5">No</th>
                    <th rowspan="5">Form</th>
                    <th colspan="84">Form</th>
                    <th rowspan="5">Jumlah</th>
                </tr>
                <tr class="text-center">
                    <th colspan="10">Jumlah Penderita R.I.</th>
                    <th colspan="14">Jumlah Penderita R.I.</th>
                    <th colspan="26">Hari Perawatan</th>
                    <th colspan="18">Rujukan Penderita</th>
                    <th colspan="6">Pulang</th>
                    <th colspan="8">Mati</th>
                </tr>
                <tr class="text-center">
                    <th colspan="4">Lama</th>
                    <th colspan="4">Baru</th>
                    <th colspan="2" rowspan="2">Jumlah</th>
                    <th colspan="2" rowspan="2">Jumlah</th>
                    <th colspan="2" rowspan="2">Jumlah</th>
                    <th colspan="2" rowspan="2">Jumlah</th>
                    <th colspan="2" rowspan="2">Jumlah</th>
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
        