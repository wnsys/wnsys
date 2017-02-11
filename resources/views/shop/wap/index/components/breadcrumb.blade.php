<ol class="breadcrumb">
    @foreach($breadcrumb as $item)
    <li class="{{$item['class']}}">
        @if($item["url"])
        <a  href="{{$item[url]}}">{{$item[name]}}</a>
        @else
        {{$item[name]}}
        @endif

    </li>
    @endforeach
</ol>