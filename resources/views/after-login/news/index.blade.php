@extends('layouting.guest.master')
@section('title', 'news')
@section('content')
    <h5>News</h5>
    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    <ol>
        <li>Nama:{{ auth()->user()->fullname }}</li>
        <li>role:{{ auth()->user()->role }}</li>
    </ol>
    @haspermission('create news')
        <div class="text-end">
            <a href="{{ route('news.create') }}" class= "btn btn-primary"> Tambah</a>
        </div>
    @endhaspermission
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Author</th>
                <th scope="col">Editor</th>
                <th scope="col">Status</th>
                @haspermission('update news')
                    <th scope="col">Aksi</th>
                @endhaspermission
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $index => $item)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->title }}</td>
                    <td><img src="{{ asset('storage/' . $item->image) }}" width="50" height="50"
                            alt="{{ $item->title }}"></td>
                    <td>{{ $item->author->user->fullname }}</td>
                    <td>{{ $item->editor->user->fullname }}</td>
                    <td>
                        <span class="badge {{ $item->status == 'draft' ? 'bg-danger' : 'bg-success' }}">
                            {{ $item->status }}</span>
                    </td>
                    @haspermission('update news')
                        <td>
                            <a href="{{ route('news.edit', $item->id) }}">
                                <span class="material-symbols-outlined">
                                    edit
                                </span>
                            </a>
                            <a>
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                    </button>
                                </form>
                            </a>
                        </td>
                    @endhaspermission
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
