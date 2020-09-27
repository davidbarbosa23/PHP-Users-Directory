@extends('layouts.app')

@section('title', 'Register')
@section('content')

    <section class="container">
        <div class="row py-5">
            <div class="card col-md-8 col-lg-6 mx-auto">
                <div class="card-body">
                    <h1 class="h3 mb-3 font-weight-normal">Register</h1>
                    
                    @includeWhen(isset($errors), 'lib.alerterror', ['errors' => $errors ?? []])
                    @includeWhen(isset($success), 'lib.alertsuccess', ['success' => $success ?? []])

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
                                        {{ isset($data) && $data['country_id'] == $country['id'] ? 'selected' : '' }}>
                                        {{ $country['name'] }}
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
                            <input type="password" name="password_confirm" placeholder="Password Confirm"
                                class="form-control" required />
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
