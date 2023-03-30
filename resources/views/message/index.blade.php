@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success pb-0" role="alert">
                <h4 class="alert-heading">Berhasil !</h4>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger pb-0" role="alert">
                <h4 class="alert-heading">Berhasil !</h4>
                <p>{{ session('error') }}</p>
            </div>
        @endif
        <div class="text-end">
            <a href="{{ route('message.create') }}" class="btn btn-primary mb-3">Kirim Pesan</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="my_table">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-nowrap text-center" style="width:50px">No</th>
                                <th class="text-nowrap">Pesan</th>
                                <th class="text-nowrap text-center" style="width: 100px">Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($message as $item)
                                <tr>
                                    <td class="text-nowrap text-center">{{ $loop->iteration }}</td>
                                    <td class="text-nowrap">{{ $item->message }}</td>
                                    <td class="text-nowrap text-center" width="20%">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('message.edit', $item->id) }}"
                                                class="btn btn-warning me-2">Edit</a>
                                            <form action="{{ route('message.destroy', $item->id) }}" method="post"
                                                id="delete_form{{ $item->id }}">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="delete_item('delete_form{{ $item->id }}')">Hapus</button>
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
    <script>
        function delete_item(form) {
            let cf = confirm('Yakin Menghapus Data ?')
            if (cf) {
                document.getElementById(form).submit();
            }
        }
    </script>
@endsection
