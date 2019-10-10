@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Success!!</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Your payment was successful. We will send {{ $payment->to_send / 1000 }} {{ strtoupper($payment->crypto) }} to {{ '@' . $payment->send_to }}.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection