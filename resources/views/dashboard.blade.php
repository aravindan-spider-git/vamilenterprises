@extends('layouts.app')


@section('content')
<div class="container-fluid">

        <div class="form-head d-flex flex-wrap align-items-center">
            <h2 class="font-w600 title mb-2 mr-auto ">Dashboard</h2>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-6 m-t35">
                <a href="{{ route('companies.index') }}">
                <div class="card card-coin">
                    <div class="card-body text-center">
                    <img class="mb-2" src="{{ asset('images/avatar/office-building.png') }}" alt="" height="70px">
                        <h2 class="text-black mb-2 font-w600">{{ $totalCompanies }}</h2>
                        <p class="mb-0 fs-14">
                            Total Companies
                        </p>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xl-4 col-sm-6 m-t35">
                <a href="{{ route('vehicles.index') }}">
                <div class="card card-coin">
                    <div class="card-body text-center">
                    <img class="mb-2" src="{{ asset('images/avatar/transportation.png') }}" alt="" height="70px">
                        <h2 class="text-black mb-2 font-w600">{{ $totalVechile }}</h2>
                        <p class="mb-0 fs-14">
                            Total Vechiles
                        </p>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xl-4 col-sm-6 m-t35">
                <a href="{{ route('documents.index') }}">
                <div class="card card-coin">
                    <div class="card-body text-center">
                    <img class="mb-2" src="{{ asset('images/avatar/documentation.png') }}" alt="" height="70px">
                        <h2 class="text-black mb-2 font-w600">{{ $totalDocument }}</h2>
                        <p class="mb-0 fs-14">
                            Total Documents
                        </p>
                    </div>
                </div>
                </a>
            </div>




        </div>
</div>
@endsection



