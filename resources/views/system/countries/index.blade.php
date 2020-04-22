@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Countries') }}</div>

                    <div class="card-body">
                        <countries-table></countries-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
