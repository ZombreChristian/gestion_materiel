@extends('admin.admin_dashboard')
@section('admin')

{{-- start CSS --}}


{{-- --- end CSS --}}
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">


                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>

                <p>Role : <b>
                    @foreach(auth()->user()->roles as $role)
                        {{ $role->name }}
                    @endforeach
                </b> </p>

            </div>
        </main>
    </div>

    <div class="row"></div>




    @if (Auth::user()->can('menu.personnel'))

        @include('personnel.contenu')

    @endif

    @if (Auth::user()->can('menu.permanence'))

        @include('permanencier.contenu')

    @endif









    @if (Auth::user()->can('menu.AMO'))

    @include('gestionnaire.contenu')

    @endif





</div>



@endsection
