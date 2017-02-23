<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-header">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
        </div>
        <div class="collapse navbar-collapse " id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="/" class="dropdown-toggle" data-toggle="dropdown">
                        博客
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($blog_category as $item)
                            <li><a href="/blog/cat/{{$item[id]}}">{{$item[name]}}</a></li>
                        @endforeach

                    </ul>
                </li>
                <li class="">
                    <a href="/shop" >
                        商城
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>