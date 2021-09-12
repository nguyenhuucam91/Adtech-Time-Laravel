@extends('layouts.app')

@push('js')
    @routes
    <script src="{{ asset('js/client.js') }}"></script>
@endpush
