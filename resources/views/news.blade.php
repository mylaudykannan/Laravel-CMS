@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($news as $n)
                <div class="card mb-2">
                    <div class="card-header">{{ $n->title }}</div>

                    <div class="card-body">
                        
                        <a href="{{URL('news/'.$n->slug)}}">View</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
