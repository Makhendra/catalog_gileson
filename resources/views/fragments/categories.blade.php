<nav class="navbar navbar-expand-lg navbar-light bg-light categories">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @foreach($categories as $category)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$category['title']}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(isset($categories['childrens']))
                            @foreach($categories['childrens'] as $category_drop)
                                <a class="dropdown-item" href="#">{{$category_drop['title']}}</a>
                            @endforeach
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</nav>