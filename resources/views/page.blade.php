@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($page['sections'] as $ps)
                <?php
                $content = json_decode($ps['content'], true);
                ?>
                @if (isset($content['content']))
                    {!! $content['content'] !!}
                @endif
            @endforeach
        </div>
    </div>
@endsection
