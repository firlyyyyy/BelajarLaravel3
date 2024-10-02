<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>To Do List</title>
</head>

<body class="bg-light">
    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">To Do List Project</div>
        </div>
    </nav>

    <div class="container mt-4">

        {{-- CONTENT --}}

        <h1 class="text-center mb-4">To Do List</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- FORM INPUT DATA --}}

                        <form action="{{ route('todo.post') }}" id="todo-form" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="task" id="todo-input" class="form-control"
                                    placeholder="Tambah Task Baru" required value="{{ old('task') }}">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        {{-- SEARCHING --}}

                        <form action="{{ route('todo') }}" id="todo-form" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search"
                                    placeholder="Masukkan Kata Kunci" value="{{ request('search') }}">
                                <button class="btn btn-secondary" type="submit">Cari</button>
                            </div>
                        </form>

                        <ul class="list-group mb-4" id="todo-list">
                            @foreach ($data as $item)

                                {{-- DISPLAY DATA --}}

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="task-text">
                                        {!! $item->is_done == '1' ? '<del>' : '' !!}
                                        {{ $item->task }}
                                        {!! $item->is_done == '1' ? '</del>' : '' !!}
                                    </span>
                                    <input type="text" class="form-control edit-input" style="display: none;"
                                        value="{{ $item->task }}">
                                    <div class="btn-group">
                                        <form action="{{ route('todo.delete', ['id' => $item->id]) }}" method="POST"
                                            onsubmit="return confirm('yakin hapus data?')"  style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm delete-btn">hapus</button>
                                        </form>
                                        <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $loop->index }}"
                                            aria-expanded="false">edit</button>
                                    </div>
                                </li>

                                {{-- UPDATE DATA --}}

                                <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                    <form action="{{ route('todo.update', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="task"
                                                    value="{{ $item->task }}">
                                                <button class="btn btn-outline-primary" type="submit">Update</button>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="radio px-2">
                                                <label for="">
                                                    <input type="radio" value="1" name="is_done"
                                                        {{ $item->is_done == '1' ? 'checked' : '' }}> Selesai
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="">
                                                    <input type="radio" name="is_done" id="" value="0"
                                                        {{ $item->is_done == '0' ? 'checked' : '' }}>
                                                    Belum
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
