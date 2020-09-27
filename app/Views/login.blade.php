@extends('layouts.app')

@section('title', 'Login')
@section('content')
    <h1>Login</h1>
    <form method="POST" action="/login">
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" class="form-control"
                value="{{ isset($data) ? $data['email'] : '' }}" required />
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control" required />
        </div>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
@endsection
