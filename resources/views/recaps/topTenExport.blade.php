
        <table class="table table-striped table-sm">
            <thead class="thead-dark text-center">
                <tr>
                    <th rowspan="2" class="align-middle">No Urut</th>
                    <th rowspan="2" class="align-middle">Kode ICD X</th>    
                    <th rowspan="2" class="align-middle">Deskripsi</th>
                    <th colspan="2">Pasien Keluar Hidup Menurut Jenis Kelamin</th>
                    <th colspan="2">Pasien Keluar Meninggal Menurut Jenis Kelamin</th>
                    <th rowspan="2" class="align-middle">Total</th>
                </tr>
                <tr>
                    <th>LK</th>
                    <th>PR</th>
                    <th>LK</th>
                    <th>PR</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < $disease_count; $i++)
                    <tr>
                        <td class="text-right">{{$i+1}}</td>
                        <td>{{$result['count'][$i]->code}}</td>
                        <td>{{$result['count'][$i]->name}}</td>
                        <td class="text-center">{{$result['count'][$i]->alive_male}}</td>
                        <td class="text-center">{{$result['count'][$i]->alive_female}}</td>
                        <td class="text-center">{{$result['count'][$i]->deceased_male}}</td>
                        <td class="text-center">{{$result['count'][$i]->deceased_female}}</td>
                        <td class="text-center">{{$result['count'][$i]->total}}</td>
                    </tr>
                @endfor    
            </tbody>
                    
        </table>