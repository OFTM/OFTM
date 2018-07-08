<Slideout menu="#menu" panel="#panel" :toggle-Selectors="['.toggle-button']" @on-open="open" @on-close="close"
          padding="180px">
    <nav id="menu">
        <div class="menu-head">
            <i class="fa fa-trophy fa-2x logo"></i>
            <span>OFTM</span>
        </div>
        <div class="menu-main">
            <ul>
                @include('menu.sidebar-item', ['items' => $Sidebar->roots()])
            </ul>
        </div>
    </nav>
    <main id="panel">
        <header>
            <div>
                <button class="btn btn-outline-dark toggle-button"><i id="slideout-button"
                                                                      class="fa fa-angle-right"></i></button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </header>
        @yield('content')
    </main>
</Slideout>