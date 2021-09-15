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
                <input type="text" class="form-control" id="log-date"/>
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
            <textarea name="description" class="form-control" id="description"></textarea>
        </div>
    </form>
    <!-- Result after query -->
    <ul id="result" class="list-group"></ul>
  </div>
  @endsection

    @push('js')
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <script>
            $('#log-date').datepicker({
                uiLibrary: 'bootstrap4'
            });
            </script>
        <script>
          (async () => {
              var Promise = TrelloPowerUp.Promise;
              var t = TrelloPowerUp.iframe();
              const cardId = t.arg('cardId')
              // const apiKey = getApiKey();
              // const userToken = getUserAccessToken(t);
            const user = await getMember(t);
            //send post request on form submit
            $("#logwork-form").submit(function(e) {
                e.preventDefault();
                const logDate = $("#log-date").val();
                const timeSpent = $("#time-spent").val();
                const description = $("#description").val();
                post(route('createlog.store'), {
                    user_id: user.id,
                    username: user.username,
                    avatar_url: user.avatarUrl,
                    card_id: cardId,
                    logged_at: logDate,
                    timeSpent,
                    description
                });
            });
        })()

        </script>
    @endpush
</body>
</html>
