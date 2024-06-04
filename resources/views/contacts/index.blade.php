
@extends('layouts.main')

@section('title', 'Contact App | All Contacts')

@section('content')
    <!-- content -->
    <main class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                  <div class="card-header card-title">
                    <div class="d-flex align-items-center">
                      <h2 class="mb-0">All Contacts</h2>
                      <div class="ml-auto">
                        <a href='{{route('contacts.create')}}' class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>
                    </div>
                  </div>
                  @include('contacts._filter')
                  {{-- sessionvar her --}}
                  @if ($message = session('message'))
                    <div class='alert alert-success'>{{ $message }}</div>
                  @endif
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Company</th>
                        <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $index => $contact)
                        {{-- show this normally --}}
                        @include('contacts._contact',['contact' => $contact, 'index' => $index])
                    @empty
                        {{-- show this if empty --}}
                        @include('contacts._empty')
                    @endforelse
                    {{-- /inbuilt if then else --}}
                    {{-- @each( 'contacts._contact',$contacts ,'contact', 'contacts._empty' ) --}}
                </tbody>
                </table>
                    {{-- laravel has an inbuilt pagination here using
                          this function will automatically add the button nav
                          customisation is done providers/AppserviceProvider

                          * we can edit this template using the vendors
                            using php artisan vendor: publish
                          * this creates the pagination template here :
                          * resources/views/vendor/pagination
                          * we can then update this layout of the pagination menu
                          * use the Appends/withqueryString modifier to use the url info to filter the data using the data.
                          --}}
                          {{$contacts->withQueryString()->links()}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

@endsection
