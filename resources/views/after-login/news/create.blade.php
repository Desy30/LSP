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
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="editor" class="form-label">Editor</label>
                <select class="form-select" aria-label="Default select example" id='editor' name="editor_id">
                    @foreach ($editors as $item)
                        <option value="{{ $item->id }}">{{ $item->user->fullname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" id='editor' name='category_id'>
                    <option value="3">category</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title
                </label>
                <input type="text" class="form-control" id="title" placeholder="title" name='title'>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="3" name='content'></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100"> submit</button>
    </div>

    </form>
@endsection
