@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="create-log.css"/>
@endpush


  @section('content')
    <div class="container">
    <div class="row d-flex justify-content-between">
      <div>
        <p class="text-center">Date</p>
        <input type="text" class="form-control" id="datepicker"/>
      </div>

      <div>
        <p class="text-center">Hours spent</p>
        <input type="number" class="form-control"/>
      </div>

      <div>
        <p >&nbsp;</p>
        <button class="btn btn-primary" id="log-work">Log work</button>
      </div>
    </div>
    <br/>
    <div class="row">
      <p>Description</p>
      <textarea name="description" class="form-control"></textarea>
    </div>

    <!-- Result after query -->
    <ul id="result" class="list-group"></ul>
  </div>
  @endsection

    @push('js')
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <script>
            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap4'
            });
            </script>
        <script>
            var Promise = TrelloPowerUp.Promise;
            var t = TrelloPowerUp.iframe();
            const cardId = t.arg('cardId')
            console.log(cardId)
        </script>
    @endpush
</body>
</html>
