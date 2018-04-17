<Slideout menu="#menu" panel="#panel" :toggle-Selectors="['.toggle-button']" @on-open="open" @on-close="close"
          padding="180px">
    <nav id="menu">
        <div class="menu-head">
            <i class="fa fa-trophy fa-2x logo"></i>
            <span>OFTM</span>
        </div>
        <div class="menu-main">
            <ul>
                @foreach($Sidebar->roots() as $item)
                    <li>
                        <a @lm-attrs($item) href="{!! $item->url() !!}" @lm-endattrs>
                            <section>
                                @if($item->icon)
                                    <i class="fa fa-{!! $item->icon !!} fa-2x logo"></i>
                                @else
                                    <i class="fa logo"></i>
                                @endif
                                <span>{!! $item->title !!}</span>
                            </section>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
    <main id="panel">
        <header>
            <div>
                <button class="btn btn-outline-dark toggle-button"><i id="slideout-button"
                                                                      class="fa fa-angle-right"></i></button>
            </div>
        </header>
    </main>
</Slideout>