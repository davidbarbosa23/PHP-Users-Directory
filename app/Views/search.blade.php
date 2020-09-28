@extends('layouts.app')

@section('title', 'Directory')

@section('content')

    <section class="container">
        <div class="row py-5">
            <h1 class="h3 mb-3 mr-sm-3 font-weight-normal">Search</h1>

            <form class="form-inline mb-3" method="GET">
                <input name="q" class="form-control mr-sm-2" id="searchInput" type="search" value="{{ $query ?? '' }}"
                    placeholder="Search name or email" aria-label="Search">
                <button class="btn btn-primary my-2 my-sm-0" id="searchButton" type="submit">Search</button>
                <div class="btn-group ml-sm-2" role="group">
                    <button type="button" class="btn btn-outline-secondary buttonData" onclick="updateData(1)">
                        <span>Get Data (EN)</span>
                        <div class="spinner-border spinner-border-sm text-secondary d-none spinerData spiner-1" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                    <button type="button" class="btn btn-outline-secondary buttonData" onclick="updateData(2)">
                        <span>Get Data (ES)</span>
                        <div class="spinner-border spinner-border-sm text-secondary d-none spinerData spiner-2" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                </div>
            </form>

            @if (isset($customers))
                <div class="ml-auto">
                    <span class="badge badge-success">{{ $customers_count }} Found</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Email</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Country</th>
                                <th scope="col">State</th>
                                <th scope="col">City</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Lang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <th scope="row">{{ $customer->id }}</th>
                                    <td>{{ $customer->job_title }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->first_name }}</td>
                                    <td>{{ $customer->document }}</td>
                                    <td>{{ $customer->phone_number }}</td>
                                    <td>{{ $customer->country }}</td>
                                    <td>{{ $customer->state }}</td>
                                    <td>{{ $customer->city }}</td>
                                    <td>{{ $customer->birthday }}</td>
                                    <td>{{ $customer->lang }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>

@endsection

@section('customscripts')

    <script>
        function updateData(id = 1) {
            const $items = $('.buttonData, #searchButton, #searchInput');
            $items.attr('disabled', true);
            $items.find(`.spinerData.spiner-${id}`).removeClass('d-none');

            const options = {
                1: 'en',
                2: 'es'
            };
            fetch(`/search/update?lang=${options[id]}`)
                .then(response => {
                    $items.attr('disabled', false);
                    $items.find(`.spinerData.spiner-${id}`).addClass('d-none');
                    console.log(response);
                })
        }

    </script>

@endsection
