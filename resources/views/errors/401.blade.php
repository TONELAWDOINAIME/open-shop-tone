{{-- @extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized')) --}}

<x-master-layout>

    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-top: 15%;">
                <h1 class="text-center">401</h1>
                <h3 class="text-center">Oups ! Vous essayez d'accéder à une ressource protégée !</h3>
            </div>
        </div>
    </div>

</x-master-layout>