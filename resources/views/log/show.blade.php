@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="create-log.css"/>
@endpush


@section('content')
    <form id="logwork-form">
        <div class="container">
            <div class="row d-flex justify-content-between">
            <div>
                <p class="text-center">Date</p>
                <input type="text" class="form-control" id="log-date" value="{{ date('d-m-Y') }}"/>
            </div>

            <div>
                <p class="text-center">Time spent (4w 2h 2d)</p>
                <input type="text" class="form-control" id="time-spent"/>
            </div>

            <div>
                <p >&nbsp;</p>
                <button type="submit" class="btn btn-primary" id="log-work">Log work</button>
            </div>
            </div>
            <br/>
            <div class="row">
            <p>Description</p>
            <textarea class="form-control" id="description"></textarea>
        </div>
    </form>
    <!-- Result after query -->
    <div class="row">
        <div id="result" class="list-group">
            @foreach($logs as $log)
            <div class="list-group-item d-flex justify-content-between">
                <img src="{{ $log->avatar_url }}" alt={{ $log->username }} />
                <p>{{ $log->time_spent }}</p>
                <p>{{ $log->description }}</p>
            </div>
            @endforeach
        </div>
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
            const cardId = t.arg('cardId')
              // const apiKey = getApiKey();
              // const userToken = getUserAccessToken(t);
            const user = await getMember(t, @json(config('services.trello.key')));
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
                    description
                };
                const response = await storeLog(data)
                await getLogs()
            });
        })()

        </script>
    @endpush
</body>
</html>
