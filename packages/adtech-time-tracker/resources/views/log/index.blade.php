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
        <button href="javascript:void(0)" class="subtle button js-section-action" id="refresh">
            Refresh
        </button>
        <button href="javascript:void(0)" class="subtle button js-section-action" id="set-visibility">
            Hide details
        </button>
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
                        <a href="javascript:void(0)" class="edit" data-id="{{ $log->id }}">
                            <img src={{ asset('images/edit.svg') }} />
                        </a>
                        <a href="javascript:void(0)" class="delete" data-id="{{ $log->id }}">
                            <img src={{ asset('images/trash.svg') }} />
                        </a>
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
    <script src="{{ asset('js/services/common.js') }}"></script>
        {{-- For realtime purpose --}}

    <script>
        var Promise = TrelloPowerUp.Promise;
        var t = TrelloPowerUp.iframe();
        let cardVisible

        let cardId = @json($cardId);


        (async () => {
            cardVisible = await getLogVisibility(t, cardId)
            cardVisible ? $("#set-visibility").text("Hide Details") : $("#set-visibility").text("Show Details")
        })();

        // Enable pusher logging - don't include this in production
        //Realtime
        Pusher.logToConsole = false;

        var pusher = new Pusher(@json(config('broadcasting.connections.pusher.key')), {
            cluster: @json(config('broadcasting.connections.pusher.options.cluster'))
        });

        var channel = pusher.subscribe('test-pusher');
        channel.bind('log-created', function(data) {
            const newestLog = generateItemHtml(data.log)
            $("#result").prepend(newestLog)
        });
        channel.bind('log-updated', async function() {
            const logs = await refreshLogs(cardId)
            $("#result").html(logs)
        });

        //End realtime
        $("#refresh").click(async function() {
            const content = await refreshLogs(cardId)
            $("#result").html(content)
        })

        $("#set-visibility").click(async function() {
            await setLogVisibility(t, cardId, !cardVisible)
            // console.log(await getLogVisibility(t,cardId))
            t.showCard(cardId)
        });

        $(document).on('click', '.delete', async function(e) {
            e.preventDefault()
            const logId = $(this).data('id');
            const wantsDelete = confirm('Are you sure to delete this log')
            if (wantsDelete) {
                try {
                    await destroyLog(logId)
                    t.alert({
                        message: 'Log deleted successfully',
                        duration: 3
                    })
                    const content = await refreshLogs(cardId);
                    $("#result").html(content)
                } catch (e)
                {
                    console.error(e)
                }
            }
        })

        //edit log
        $(document).on('click', '.edit', async function(e) {
            e.preventDefault()
            const logId = $(this).data('id');
            return t.modal({
                url: route('log.edit', logId),
                title: 'Edit Log work',
                fullscreen: false
            })
        })

    </script>
@endpush
