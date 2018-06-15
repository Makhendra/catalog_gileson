
<nav class="navbar navbar-expand-lg navbar-light bg-light categories">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @foreach($categories as $category)
                <? $act = empty($active_category->categoryParent->alias)? $active_category->alias : $active_category->categoryParent->alias; ?>
                @if($category->childrens->count() > 0)
                <li class="nav-item dropdown {{empty($active_category) ? '' : ( ($act == $category['alias']) ? 'active' : '') }}">
                    <a class="nav-link dropdown-toggle" href="/{{$category['alias']}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$category['title']}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($category['childrens'] as $category_drop)
                            <a class="dropdown-item" href="/{{$category_drop['alias']}}">{{$category_drop['title']}}</a>
                        @endforeach
                    </div>
                </li>
                @else
                    <li class="nav-item {{empty($active_category) ? '' : ( ($act == $category['alias']) ? 'active' : '') }}">
                        <a class="nav-link" href="{{$category['alias']}}">{{$category['title']}}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>