@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <section class="jumbotron text-center">
        <div class="container">
            <h1>Lorem Ipsum</h1>

            <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin feugiat efficitur mi,
                at eleifend elit dictum in. Donec id dignissim enim. Morbi diam turpis, lobortis nec volutpat quis,
                sollicitudin a metus. Morbi fermentum, ligula vitae efficitur placerat, justo lectus porttitor augue, eu
                rhoncus felis neque sit amet mi. Nulla facilisi. Aliquam eu vehicula tortor, et placerat arcu. Pellentesque
                turpis tellus, porta ut ligula in, sagittis tempus est.</p>
            <p>
                <a href="/users" class="btn btn-primary my-2">Users Directory</a>
            </p>
        </div>
    </section>

@endsection
