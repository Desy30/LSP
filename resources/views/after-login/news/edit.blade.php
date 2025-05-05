@extends('layouting.guest.master')
@section('title', 'news')
@section('content')
    <h1>Create New</h1>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif
        <form action="{{ route('news.update', ['id' => $news->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="editor" class="form-label">Editor</label>
                <select class="form-select" aria-label="Default select example" id='editor' name="editor_id">
                    @foreach ($editors as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $news->category_id ? 'selected':'' }}
                            >{{ $item->user->fullname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" id='editor' name='category_id'>
                    <option value="3">category</option>
                    @foreach ($categories as $item)
                        <option {{ $item->id == $news->category_id ? 'selected' : '' }} value="{{ $item->id }}">
                            {{ $item->name }}</option>>
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title
                </label>
                <input type="text" class="form-control" id="title" placeholder="title" name='title'
                    value="{{ $news->title }}">
            </div>
            <div class="mb-3">
                <img src="{{ asset('storage/' . $news->image) }}" alt="Gambar{{ $news->title }}" width="100"
                    height="100" class="object-fit-contain">

            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="3" name='content'>{{ $news->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100"> submit</button>
    </div>

    </form>
@endsection
