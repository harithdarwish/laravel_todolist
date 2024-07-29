<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Define the new color scheme */
        :root {
            --color-primary: #98D0C1;
            --color-secondary: #FFD862;
            --color-dark: #28255C;
            --color-danger: #E74133;
        }

        body {
            background-color: var(--color-primary);
        }

        .navbar {
            background-color: var(--color-dark);
        }

        .navbar-brand {
            color: var(--color-secondary) !important;
        }

        .card {
            border: none;
            background-color: var(--color-secondary);
        }

        .btn-primary {
            background-color: var(--color-dark);
            border-color: var(--color-dark);
        }

        .btn-primary:hover {
            background-color: var(--color-dark);
            border-color: var(--color-dark);
        }

        .btn-danger {
            background-color: var(--color-danger);
            border-color: var(--color-danger);
        }

        .btn-danger:hover {
            background-color: var(--color-danger);
            border-color: var(--color-danger);
        }

        .alert-success {
            background-color: var(--color-secondary);
            border-color: var(--color-dark);
            color: var(--color-dark);
        }

        .alert-danger {
            background-color: var(--color-danger);
            border-color: var(--color-dark);
            color: white;
        }

        .btn-danger .delete-symbol {
        color: var(--color-danger);
        }

        .list-group-item {
            background-color: white;
        }

        .edit-btn,
        .delete-btn {
            background-color: var(--color-dark);
            border-color: var(--color-dark);
        }

        .edit-btn:hover,
        .delete-btn:hover {
            background-color: var(--color-dark);
            border-color: var(--color-dark);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">Simple CheckList</div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <!-- Content -->
        <h1 class="text-center mb-4">Nak Buat Apa</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- Success Alert -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Error Alert -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form Input Data -->
                        <form id="todo-form" action="{{ route('todo.post') }}" method="post" onsubmit="disableSubmitButton(this)">
                            @csrf 
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="task" id="todo-input" placeholder="Tambah task baru" required>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Searching -->
                        <form id="todo-form" action="{{ route('todo') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">Cari</button>
                            </div>
                        </form>
                        
                        <ul class="list-group mb-4" id="todo-list">
                            <!-- Display Data -->
                            @foreach ($data as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="task-text">
                                        {!! $item->is_done == '1'?'<del>':'' !!}
                                        {{ $item->task }}
                                        {!! $item->is_done == '1'?'</del>':'' !!}
                                    </span>

                                    <input type="text" class="form-control edit-input" style="display: none;" value="{{ $item->task }}">
                                    <div class="btn-group">
                                        <form action="{{ route('todo.delete',['id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Are you sure ?')">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm delete-btn"><span class="delete-symbol">✕</span></button>

                                        </form>

                                        <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">✎</button>
                                    </div>
                                </li>
                                <!-- Update Data -->
                                <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                    <form action="{{ route('todo.update', ['id'=>$item->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="task" value="{{ $item->task }}">
                                                <button class="btn btn-outline-primary" type="submit">Update</button>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="radio px-2">
                                                <label>
                                                    <input type="radio" value="1" name="is_done" {{ $item->is_done == '1'?'checked':'' }}> Done
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="0" name="is_done" {{ $item->is_done == '0'?'checked':'' }}> Not yet
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
                             
    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
