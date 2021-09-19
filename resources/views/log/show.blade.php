@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
<link rel="stylesheet" href="{{ asset('css/pages/log/show.css') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://p.trellocdn.com/power-up.min.css"/>
@endpush

@section('content')
    <div class="operations">
        <button href="javascript:void(0)" class="subtle button js-section-action" id="refresh">Refresh</button>
        <button id="hide-details" href="javascript:void(0)" class="subtle button js-section-action">Hide Details</button>
    </div>
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
        {{-- For realtime purpose --}}
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        var Promise = TrelloPowerUp.Promise;
        var t = TrelloPowerUp.iframe();
        let cardId = @json($cardId);

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher(@json(config('broadcasting.connections.pusher.key')), {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('test-pusher');
        channel.bind('message', function(data) {
            const newestLog = generateItemHtml(data.log)
            $("#result").prepend(newestLog)
        });

        function generateItemHtml(item)
        {
            return `<div class="result-item">
                        <div class="work-log-creator">
                            <img src=${item.avatar_url + "/30.png"} class="member-avatar">
                        </div>
                        <div class="work-log-title">
                            <div class="tracked-time-wrapper">
                                <span class="work-log-username">${item.username} logged ${item.time_spent}</span>
                                <span>
                                    <a href="">Edit</a>
                                    <a href="javascript:void(0)" class="delete" data-id="${item.id}">Delete</a>
                                </span>
                            </div>
                            <div><span class="work-log-description">${item.description}</span></div>
                            <div class="logged-time">
                                ${item.updated_at}
                            </div>
                        </div>
                    </div>
                    `
        }

        $("#refresh").click(async function() {
            const logs = await getLogs(cardId)
            const content = logs.data.map((item) => generateItemHtml(item))
            $("#result").html(content)
        })

        $(document).on('click', '.delete', async function(e) {
            e.preventDefault()
            const logId = $(this).data('id');
            const wantsDelete = confirm('Are you sure to delete this log')
            if (wantsDelete) {
                await destroyLog(logId)
                const logs = await getLogs(cardId)
                const content = logs.data.map((item) => generateItemHtml(item))
                $("#result").html(content)
            }
        })

    </script>
@endpush
