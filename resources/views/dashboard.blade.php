@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Guru</h5>
                    <p class="card-text fs-3">{{ $guruCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Wali Murid</h5>
                    <p class="card-text fs-3">{{ $waliCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Kelas</h5>
                    <p class="card-text fs-3">{{ $kelasCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Siswa</h5>
                    <p class="card-text fs-3">{{ $siswaCount }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
