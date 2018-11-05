
<table class="table table-striped table-sm">
            <thead class="thead-dark text-center">
                <tr>
                    <th colspan="79">Rekap Data Kesakitan Bulan {{$time[1]." Tahun ".$time[0]}}</th>
                </tr>
                <tr>
                    <th rowspan="3">Kode DX</th>
                    <th rowspan="3">Nama Penyakit</th>    
                    <th rowspan="3">Total</th>
                    <th colspan="4">Jumlah</th>
                    <th colspan="4">0-7 HR</th>
                    <th colspan="4">8-28 HR</th>
                    <th colspan="4">29-1 TH</th>
                    <th colspan="4">1-4 TH</th>
                    <th colspan="4">{{"5-<6 TH"}}</th>
                    <th colspan="4">6-9 TH</th>
                    <th colspan="4">10-11 TH</th>
                    <th colspan="4">12-14 TH</th>
                    <th colspan="4">15-17 TH</th>
                    <th colspan="4">18-19 TH</th>
                    <th colspan="4">20-24 TH</th>
                    <th colspan="4">25-34 TH</th>
                    <th colspan="4">35-44 TH</th>
                    <th colspan="4">45-54 TH</th>
                    <th colspan="4">55-59 TH</th>
                    <th colspan="4">60-64 TH</th>
                    <th colspan="4">65-69 TH</th>
                    <th colspan="4">>=70 TH</th>
                </tr>
                <tr>
                    @for ($i = 0; $i < 19; $i++)
                        <th colspan="2">LK</th>
                        <th colspan="2">PR</th>
                    @endfor
                </tr>
                <tr>
                        @for ($i = 0; $i < 38; $i++)
                            <th>B</th>
                            <th>L</th>
                        @endfor
                    </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($listOfDiseases); $i++)
                    <tr>
                        <td>{{$listOfDiseases[$i]->disease_code}}</td>
                        <td>{{$listOfDiseases[$i]->disease_name}}</td>
                        <td>{{$totals[$i]}}</td>
                        @foreach ($results[$i] as $resultv2)
                            @foreach ($resultv2 as $resultv3)
                                <td>{{$resultv3}}</td>
                            @endforeach
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>