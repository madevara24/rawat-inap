@extends('layouts.app')

@section('content')
<main role="main" class="container">
    <div class="row justify-content-center">
        <h1 class="py-2">Data 10 Besar Penyakit Rawat Inap</h1>
    </div>
    <div class="row py-2">
        <div class="float-left">
            <div class="card p-1">
                <form class="form-inline" method="POST" action="{{ action('RecapsController@topTenRedirect') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <select class="form-control" id="month" name="month">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <select class="ml-2 form-control" id="year" name="year">
                        @for ($i = $option['first']; $i <= $option['last']; $i++)
                            <option value={{$i}}>{{$i}}</option>
                        @endfor
                    </select>
                    <input type="submit" class="ml-2 btn btn-primary" value="Cari">
                </form>
            </div>
        </div>
        <div class="float-left ml-1">
            <div class="card p-1">
                <form class="form-inline" method="POST" action="{{ action('RecapsController@topTenExport') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <input type="hidden" name="year" value="{{$year}}">
                    <input type="hidden" name="month" value="{{$month}}">
                    <input type="submit" class="btn btn-success" value="Cetak">
                </form>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
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
    </div>
</main>
@endsection
