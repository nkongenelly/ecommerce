<h3>Categories</h3>

<ul class="list-group">
    @foreach($products as $archive)
    <li class="list-group-item">
        <a href="/productsbuyer?category_name={{ $archive['category_name'] }}">
                    {{$archive->category->category_name}}
                    ({{$archive->category->count}})
            </a>
    </li>
    @endforeach
</ul>