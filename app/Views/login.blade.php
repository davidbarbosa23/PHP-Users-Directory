@extends('layouts.app')

@section('title', 'Login')
@section('content')

    <section class="container">
        <div class="row py-5">
            <div class="card col-md-8 col-lg-6 mx-auto">
                <div class="card-body">
                    <h1 class="h3 mb-3 font-weight-normal">Login</h1>

                    @includeWhen(isset($errors), 'lib.alerterror', ['errors' => $errors ?? []])
                    @includeWhen(isset($success), 'lib.alertsuccess', ['success' => $success ?? []])
                    
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
                </div>
            </div>
        </div>
    </section>

@endsection
