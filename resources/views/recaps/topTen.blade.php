@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-2">Data 10 Besar Penyakit Rawat Inap</h1>
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
                        
            </tbody>
                    
        </table>
    </div>            
@endsection
