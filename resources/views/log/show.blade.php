@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
<link rel="stylesheet" href="{{ asset('css/pages/log/show.css') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
@endpush

@section('content')
    <div id="result">
        @foreach ($logs as $log)
        <div class="result-item">
            <div class="work-log-creator">
                <img src="{{ $log->avatar_url.'/30.png' }}" class="member-avatar">
            </div>
            <div class="work-log-title">
                <div class="tracked-time-wrapper">
                    <span class="work-log-username">{{ $log->username }} logged {{ $log->time_spent }}</span>
                    <span>
                        <a href="">Edit</a>
                        <a href="javascript:void(0)" class="delete" data-id="{{ $log->id }}">Delete</a>
                    </span>
                </div>
                <div><span class="work-log-description">{{ $log->description }}</span></div>
                <div class="logged-time">
                    {{ $log->updated_at }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/repository.js') }}"></script>
    <script src="{{ asset('js/services/log.js') }}"></script>
    <script>
        (async() => {
            $(".delete").click(async function(e) {
                e.preventDefault()
                const logId = $(this).data('id');
                await destroyLog(logId)
            })
        }) ()
    </script>
@endpush
