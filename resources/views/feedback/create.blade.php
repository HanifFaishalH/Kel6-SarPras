@extends('layout.template')

@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-1">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Berikan Umpan Balik</h4>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('feedback.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="laporan_id">Pilih Laporan</label>
                                @if ($laporans->isEmpty())
                                    <p>Tidak ada laporan yang tersedia untuk diberi umpan balik.</p>
                                @else
                                    <select name="laporan_id" class="form-control" required>
                                        @foreach ($laporans as $laporan)
                                            <option value="{{ $laporan->laporan_id }}">{{ $laporan->laporan_judul }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="rating">Rating (1-5)</label>
                                <input type="number" name="rating" class="form-control" min="1" max="5" required>
                            </div>
                            <div class="form mechanical-group">
                                <label for="komentar">Komentar</label>
                                <textarea name="komentar" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection