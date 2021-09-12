<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="create-log.css"/>
</head>
<body>
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

    @push('js')
        <script src="../../public/js/helper.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <script src="create-log.js"></script>
        <script>
            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap4'
            });
        </script>
    @endpush
</body>
</html>
