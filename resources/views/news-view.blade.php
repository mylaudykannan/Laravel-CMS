@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($news['sections'] as $ns)
                <?php
                $content = json_decode($ns['content'], true);
                ?>
                @if (isset($content['content']))
                    {!! $content['content'] !!}
                @endif
            @endforeach
        </div>
    </div>
@endsection
