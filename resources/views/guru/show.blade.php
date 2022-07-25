@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts/_flash')
                <div class="card">
                    <div class="card-header">
                        Data Guru
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $guru->nama }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Induk Pengajar</label>
                            <input type="text" class="form-control" name="nip" value="{{ $guru->nip }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Guru</label>
                            @if (isset($guru) && $guru->foto)
                                <p>
                                    <img src="{{ asset('images/guru/' . $guru->foto) }}" class="img-rounded img-responsive"
                                        style="width: 75px; height:75px;" alt="">
                                </p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Daftar Siswa</label>
                            <ol>
                                @foreach ($guru->siswa as $data)
                                    <li>{{ $data->nama }}</li>
                                @endforeach
                            </ol>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid gap-2">
                                <a href="{{ route('guru.index') }}" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
