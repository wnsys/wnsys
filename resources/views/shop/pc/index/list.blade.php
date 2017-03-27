@extends('shop')
@section("right")
    <div class="col-md-9">
    @include("index.components.breadcrumb")
    <ul class="list-group">
        @foreach($bloglist as $blog)
            <li class="list-group-item">
                @if($blog->created_at)
                    <span class="badge"> {{$blog->created_at->toDateString()}}</span>
                @endif
                <a href="/shop/show/{{$blog->id}}">{{$blog->title}}</a>
                [{{$blog->cat->name}}]
            </li>
        @endforeach
    </ul>
    {{$bloglist->links()}}
    </div>
@endsection
