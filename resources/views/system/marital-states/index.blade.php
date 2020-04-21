@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Marital Status') }}</div>
                    <div class="card-body">
                        <marital-states-table></marital-states-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
