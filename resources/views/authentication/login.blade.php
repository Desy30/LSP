@extends('layouting.guest.secondary')
@section('title', 'Login')
@section('content')
    <div class='container '>
        <div class="card">
            <div class="card-header">
                <h5>LOGIN</h5>
            </div>
            <form action="{{route('login.process')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Desy" name='username'>
                    </div>
    
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="****" name='password'>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
            </form>
        </div>
    @endsection
