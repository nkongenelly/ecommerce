<h3>Categories</h3>

<ul class="list-group">
    @foreach($archives as $archive)
    <li class="list-group-item">
        <a href="/productsbuyer?category_name={{ $archive['id'] }}">
                    {{ $archive['category_name'] }}
                    ({{ $archive->products->count() }})
            </a>
    </li>
    @endforeach
</ul>