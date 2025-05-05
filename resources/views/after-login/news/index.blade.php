@extends('layouting.guest.master')
@section('title', 'News')
@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h5>News</h5>
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>

    <div class="card shadow-lg bg-light" style="background-color: #f8d7da;">
        <div class="card-body">
            <h5 class="card-title">User Information</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Nama:</strong> {{ auth()->user()->fullname }}
                </li>
                <li class="list-group-item">
                    <strong>Role:</strong> {{ auth()->user()->role }}
                </li>
            </ul>
        </div>
    </div>


    @haspermission('create news')
    <div class="text-end my-3">
        <a href="{{ route('news.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Berita
        </a>
    </div>
@endhaspermission


<div class="row">
    @foreach ($news as $index => $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-light">
                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text">
                        <strong>Category:</strong> {{ $item->category->name }}<br>
                        <strong>Author:</strong> {{ $item->author->user->fullname }}<br>
                        <strong>Editor:</strong> {{ $item->editor->user->fullname }}<br>
                        <span class="badge {{ $item->status == 'draft' ? 'bg-danger' : 'bg-success' }}">{{ ucfirst($item->status) }}</span>
                    </p>

                    @haspermission('update news')
                        <div class="d-flex justify-content-between mt-3">
                            <!-- Edit Button -->
                            <a href="{{ route('news.edit', $item->id) }}" class="btn btn-sm btn-info text-white" style="transition: all 0.3s ease;">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" style="transition: all 0.3s ease;">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endhaspermission
                </div>
            </div>
        </div>
    @endforeach
</div>


@endsection
