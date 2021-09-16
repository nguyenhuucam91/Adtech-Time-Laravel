@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <style>
        .container{
            max-width: 700px;
        }
    </style>
@endpush


@section('content')
<div class="container">
    <form id="logwork-form">
        <div class="d-flex justify-content-between">
            <div>
                <p class="text-center">Date</p>
                <input type="text" class="form-control" id="log-date" value="{{ date('d-m-Y') }}" tabindex="1"/>
            </div>

            <div>
                <p class="text-center">Time spent (4w 2h 2d)</p>
                <input type="text" class="form-control" id="time-spent" tabindex="2"/>
            </div>

            <div>
                <p >&nbsp;</p>
                <button type="submit" class="btn btn-primary" id="log-work">Log work</button>
            </div>
        </div>
        <div>
            <p>Description</p>
            <textarea class="form-control" id="description" tabindex="3"></textarea>
        </div>
    </form>
</div>
<hr/>
<!-- Result after query -->
        <div id="result" class="list-group">
            @foreach($logs as $log)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <img src="{{ $log->avatar_url }}" />
                        <div class="d-flex flex-column">
                            <p>{{ $log->username }} - {{ $log->time_spent }}</p>
                            <span>{{ $log->logged_at }}</span>
                        </div>
                    </div>
                    <span>{{ $log->description }}</span>
                </div>
            @endforeach
        </div>
@endsection

    @push('js')
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <script src="{{ asset('js/repository.js') }}"></script>
        <script src="{{ asset('js/services/user.js') }}"></script>
        <script src="{{ asset('js/services/log.js') }}"></script>
        <script>
            var date = new Date();
            $('#log-date').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'dd-mm-yyyy',
            });
            </script>
        <script>

            (async () => {
            var Promise = TrelloPowerUp.Promise;
            var t = TrelloPowerUp.iframe();
            let cardId = t.arg('cardId');
            let boardId = t.arg('boardId');

            const user = await getMember(t, @json(config('services.trello.key')));
            // const user = {id: 1, username: 'camnh', avatarUrl: 'a/c'}
            // cardId = 1; boardId = 1;
            //send post request on form submit
            $("#logwork-form").submit(async function(e) {
                //console.log(a)
                e.preventDefault();
                const logDate = $("#log-date").val();
                const timeSpent = $("#time-spent").val();
                const description = $("#description").val();
                const data = {
                    user_id: user.id,
                    username: user.username,
                    avatar_url: user.avatarUrl,
                    card_id: cardId,
                    logged_at: logDate,
                    time_spent: timeSpent,
                    board_id: boardId,
                    description
                };
                await storeLog(data)
                const logHtml = await getLogs(cardId)
                $("#result").html(logHtml.data.map(item =>
                `<div class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <img src="${item.avatar_url}" />
                        <div class="d-flex flex-column">
                            <p>${item.username} - ${item.time_spent}</p>
                            <span>${item.logged_at}</span>
                        </div>
                    </div>
                    <span>${item.description}</span>
                </div>`))
            });
        })()

        </script>
    @endpush
</body>
</html>
