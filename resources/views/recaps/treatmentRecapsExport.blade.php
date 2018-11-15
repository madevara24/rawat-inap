
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th rowspan="5">No</th>
                    <th rowspan="5">Form</th>
                    <th colspan="92">Form</th>
                    <th rowspan="5">Jumlah</th>
                </tr>
                <tr class="text-center">
                    <th colspan="10">Jumlah Penderita R.I.</th>
                    <th colspan="16">Jumlah Penderita R.I.</th>
                    <th colspan="30">Hari Perawatan</th>
                    <th colspan="22">Rujukan Penderita</th>
                    <th colspan="6">Pulang</th>
                    <th colspan="8">Mati</th>
                </tr>
                <tr class="text-center">
                    <th colspan="4">Lama</th>
                    <th colspan="4">Baru</th>
                    <th colspan="2" rowspan="2">Jumlah</th>
                    <th colspan="2" rowspan="2">UM</th>
                    <th colspan="2" rowspan="2">ASK</th>
                    <th colspan="2" rowspan="2">JAMKESMAS</th>
                    <th colspan="2" rowspan="2">JAMKESDA</th>
                    <th colspan="2" rowspan="2">BPJS</th>
                    <th colspan="2" rowspan="2">KIS</th>
                    <th colspan="2" rowspan="2">SPM</th>
                    <th colspan="2" rowspan="2">Jumlah</th>
                    <th colspan="4">UM</th>
                    <th colspan="4">ASK</th>
                    <th colspan="4">JAMKESMAS</th>
                    <th colspan="4">JAMKESDA</th>
                    <th colspan="4">BPJS</th>
                    <th colspan="4">KIS</th>
                    <th colspan="4">SPM</th>
                    <th colspan="2" rowspan="2">Jumlah</th>
                    <th colspan="4">UM</th>
                    <th colspan="4">ASK</th>
                    <th colspan="4">JAMKESMAS</th>
                    <th colspan="4">JAMKESDA</th>
                    <th colspan="4">BPJS</th>
                    <th colspan="2" rowspan="2">Jumlah</th>
                    <th colspan="2" rowspan="2">DW</th>
                    <th colspan="2" rowspan="2">LW</th>
                    <th colspan="2" rowspan="2">Jumlah</th>
                    <th colspan="4">{{"< 48 JAM"}}</th>
                    <th colspan="4">{{"> 48 JAM"}}</th>
                </tr>
                <tr class="text-center">
                    @for ($i = 0; $i < 6; $i++)
                        <th colspan="2">DW</th>
                        <th colspan="2">LW</th>
                    @endfor
                </tr>
                <tr class="text-center">
                    @for ($i = 0; $i < 46; $i++)
                        <th>L</th>
                        <th>P</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="4" class="text-center">1</td>
                    <td class="text-center">Umum</td>
                    @for ($i = 0; $i < 93; $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    <td class="text-center">{{"< 55"}}</td>
                    @for ($i = 0; $i < 93; $i++)
                        <td>{{$result[$i][0]}}</td>
                    @endfor
                </tr>
                <tr>
                    <td class="text-center">{{"> 55"}}</td>
                    @for ($i = 0; $i < 93; $i++)
                        <td>{{$result[$i][1]}}</td>
                    @endfor
                </tr>
                <tr>
                    <td class="text-center">Jumlah</td>
                    @for ($i = 0; $i < 93; $i++)
                        <td>{{$result[$i][2]}}</td>
                    @endfor
                </tr>
                <tr>
                    @for ($i = 0; $i < 95; $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    <td rowspan="4" class="text-center">2</td>
                    <td class="text-center">Persalinan</td>
                    @for ($i = 0; $i < 93; $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    <td class="text-center">{{"< 55"}}</td>
                    @for ($i = 0; $i < 93; $i++)
                        <td>{{$result[$i][3]}}</td>
                    @endfor
                </tr>
                <tr>
                    <td class="text-center">{{"> 55"}}</td>
                    @for ($i = 0; $i < 93; $i++)
                        <td>{{$result[$i][4]}}</td>
                    @endfor
                </tr>
                <tr>
                    <td class="text-center">Jumlah</td>
                    @for ($i = 0; $i < 93; $i++)
                        <td>{{$result[$i][5]}}</td>
                    @endfor
                </tr>
                <tr>
                    <td colspan="2">Jumlah 1 + 2</td>
                    @for ($i = 0; $i < 93; $i++)
                        <td>{{$result[$i][6]}}</td>
                    @endfor
                </tr>
            </tbody>
        </table>
        