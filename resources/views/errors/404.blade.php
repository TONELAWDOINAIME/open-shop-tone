{{--@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
--}}

{{-- 20210423 --}}
<x-master-layout>

    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-top: 15%;">
                <h1 class="text-center">404</h1>
                <h3 class="text-center">Oups ! La page que vous recherchez n'existe pas !</h3>
            </div>
        </div>
    </div>

</x-master-layout>