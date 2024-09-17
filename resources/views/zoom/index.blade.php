@extends('layouts.index')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Daftar Media Teleconference</h1>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th>Meeting ID</th>
                                    <th>Passcode</th>
                                    <th>Link Zoom</th>
                                    <th>Media Teleconference</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($zooms as $zoom)
                                <tr>
                                    <td>{{ $zoom->meeting_id }}</td>
                                    <td>{{ $zoom->passcode }}</td>
                                    <td><a href="{{ $zoom->link_zoom }}" class="text-primary">{{ $zoom->link_zoom }}</a></td>
                                    <td>{{ $zoom->media_teleconference }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('zoom.show', $zoom->id) }}" class="btn btn-info mb-2">Lihat</a>
                                            <a href="{{ route('zoom.edit', $zoom->id) }}" class="btn btn-warning mb-2">Edit</a>

                                            <div class="mb-2">
                                                @if ($zoom->is_zoom_active == 0)
                                                <a href="{{ route('set-active', ['id' => $zoom->id]) }}" class="btn btn-primary">Set Aktif</a>
                                                @elseif ($zoom->is_zoom_active == 1)
                                                <a href="{{ route('set-inactive', ['id' => $zoom->id]) }}" class="btn btn-danger">Set Nonaktif</a>
                                                @endif
                                            </div>

                                            <form action="{{ route('zoom.destroy', $zoom->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus Zoom Meeting ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="{{ route('zoom.create') }}" class="btn btn-primary">Tambah Zoom Meeting</a>
</div>
</div>
</div>
@endsection