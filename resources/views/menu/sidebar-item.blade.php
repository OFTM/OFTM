@foreach($items as $item)
    <li>
        <a @lm-attrs($item) href="{!! $item->url() !!}" @lm-endattrs>
            <section>
                @if($item->icon)
                    <i class="fa fa-{!! $item->icon !!} fa-2x logo"></i>
                @else
                    <i class="fa logo"></i>
                @endif
                <span>@isset($children)- @endisset{!! $item->title !!}</span>
            </section>
        </a>
        @if($item->hasChildren())
            <ul>
                @include('menu.sidebar-item', ['items' => $item->children(), 'children' => true])
            </ul>
        @endif
    </li>
@endforeach