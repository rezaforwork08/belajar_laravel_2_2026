@extends('layouts.app')
@section('title', 'Locker Management')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <div class="mb-3" align="right">
                <a href="{{ route('locker.create') }}" class="btn btn-primary">Create New User</a>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Locker Code</th>
                        <th>Major Name</th>
                        <th>Batch</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lockers as $index => $locker)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $locker->locker_name }}</td>
                            <td>{{ $locker->major_name }}</td>
                            <td>{{ $locker->batch }}</td>
                            <td>
                                @if ($locker->status == 'Available')
                                    <span class="badge text-white bg-primary">{{ $locker->status }}</span>
                                @elseif ($locker->status == 'Unavailable')
                                    <span class="badge text-white bg-secondary">{{ $locker->status }}</span>
                                @elseif ($locker->status == 'Damaged')
                                    <span class="badge text-white bg-warning">{{ $locker->status }}</span>
                                @elseif ($locker->status == 'Missing')
                                    <span class="badge text-white bg-danger">{{ $locker->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('locker.edit', $locker->id) }}" class="btn icon btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('locker.destroy', $locker->id) }}" method="POST"
                                    class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger icon btn-delete">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('click', function(e) {

            const button = e.target.closest('.btn-delete');

            if (button) {
                e.preventDefault();
                const form = button.closest('.form-delete');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data user yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
@endsection
