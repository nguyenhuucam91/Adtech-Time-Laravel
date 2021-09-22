@extends('layouts.app')

@section('content')
    <h1 style="text-align:center">You're set!</h1>
    <p style="text-align:center">This window should close automatically. If it doesn't, go ahead and close it.</p>
@endsection

@push('js')
    <script>
      var token = window.location.hash.substring(7);
      if (window.opener) {
        window.opener.authorize(token);
      } else {
        localStorage.setItem('token', token);
      }

      setTimeout(() => {
        window.close();
      }, 1000);

    </script>
@endpush
