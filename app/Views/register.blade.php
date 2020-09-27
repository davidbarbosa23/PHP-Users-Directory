@extends('layouts.app')

@section('title', 'Register')
@section('content')
    <h1>Register</h1>
    <form method="POST" action="/register">
        <div class="form-group">
            <input type="text" name="name" placeholder="Name" class="form-control"
                value="{{ isset($data) ? $data['name'] : '' }}" required />
        </div>
        <div class="form-group">
            <select name="country_id" class="form-control" required>
                <option value="">Select an option</option>
                @foreach ($countries as $country)
                    <option value="{{ $country['id'] }}"
                        {{ isset($data) && $data['country_id'] == $country['id'] ? 'selected' : '' }}>{{ $country['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" class="form-control"
                value="{{ isset($data) ? $data['email'] : '' }}" required />
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control" required />
        </div>
        <div class="form-group">
            <input type="password" name="password_confirm" placeholder="Password Confirm" class="form-control" required />
        </div>
        <button class="btn btn-primary" type="submit">Register</button>
    </form>
@endsection
