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
    @include('log._form')
</div>
<hr/>
@endsection

@push('js')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/repository.js') }}"></script>
    <script src="{{ asset('js/services/user.js') }}"></script>
    <script src="{{ asset('js/services/log.js') }}"></script>

    <script>
        var Promise = TrelloPowerUp.Promise;
        var t = TrelloPowerUp.iframe();

        (async () => {
            let user = await getMember(t)

            const logId = @json($id)

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
                    logged_at: logDate,
                    time_spent: timeSpent,
                    description
                };
                try {
                    await updateLog(logId, data)
                    t.alert({
                        message: 'Log updated successfully',
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
