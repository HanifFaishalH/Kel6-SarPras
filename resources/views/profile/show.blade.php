@extends('layout.template')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->nama) }}" class="form-control">
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control" readonly>
    </div>

    <div class="form-group">
        <label>Foto Profil</label><br>
        @if($user->foto)
            <img src="{{ asset('uploads/foto/' . $user->foto) }}" width="100" class="mb-2">
        @endif
        <input type="file" name="foto" class="form-control-file">
        @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>
@endsection
