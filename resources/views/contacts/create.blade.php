@extends('layouts.main')

@section('title', 'Contact App | Add Contact')

@section('content')

    <!-- content -->
    <main class="py-5">
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-title">
                  <strong>Add New Contact</strong>
                </div>
                <div class="card-body">
                    <form action={{route('contacts.store')}} method="POST">
                        {{-- Post requests are blocked by defaut to stop Cross site forgery attacks,
                            we meed to set hidden input var to allow --}}
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @include('contacts._form')

                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
@endsection
