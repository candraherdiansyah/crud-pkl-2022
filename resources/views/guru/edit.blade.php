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
                        <form action="{{ route('guru.update', $guru->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control  @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ $guru->nama }}">
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Induk Pengajar</label>
                                <input type="text" class="form-control  @error('nip') is-invalid @enderror"
                                    name="nip" value="{{ $guru->nip }}">
                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                @if (isset($guru) && $guru->foto)
                                    <p>
                                        <img src="{{ asset('images/guru/' . $guru->foto) }}"
                                            class="img-rounded img-responsive" style="width: 75px; height:75px;"
                                            alt="">
                                    </p>
                                @endif
                                <input type="file" class="form-control  @error('foto') is-invalid @enderror"
                                    name="foto" value="{{ $guru->foto }}">
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
