@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">Contacts</div>

                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        Add new data
                    </button>
                    @livewire('contact-index')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection