@extends('adtech-time-tracker::layouts.app')

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
    @include('adtech-time-tracker::log._form')
</div>
<hr/>
@endsection

@push('js')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="{{ asset('vendor/adtech-time-tracker/js/repository.js') }}"></script>
    <script src="{{ asset('vendor/adtech-time-tracker/js/services/user.js') }}"></script>
    <script src="{{ asset('vendor/adtech-time-tracker/js/services/log.js') }}"></script>

    <script>
        var Promise = TrelloPowerUp.Promise;
        var t = TrelloPowerUp.iframe();

        (async () => {
            let user = await getMember(t)

            let cardId = t.arg('cardId');
            let boardId = t.arg('boardId');

            $("#log-date").datepicker({
                uiLibrary: 'bootstrap4',
                format: 'dd-mm-yyyy'
            })
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
                try {
                    await storeLog(data)
                    t.alert({
                        message: 'Log stored successfully',
                        duration: 3
                    })
                    t.closeModal()
                } catch  (e) {
                    console.log(e)
                }
            });
        })()


    </script>

@endpush
