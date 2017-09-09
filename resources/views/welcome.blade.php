@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="content">
            @include('partials.nav')
            <div class="title">Laravel 5</div>
            <?php $var = '<p>some p</p>'; ?>
            @for($i = 0; $i < 10; $i++ )
                {!! $var !!}<!-- output html or js from variable -->
            @endfor

        </div>
    </div>

@endsection

