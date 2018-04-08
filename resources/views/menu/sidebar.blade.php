<Slideout menu="#menu" panel="#panel" :toggle-Selectors="['.toggle-button']" @on-open="open">
    <nav id="menu">
        <div class="menu-head">
            <i class="fa fa-trophy fa-2x logo"></i>
            <span>OFTM</span>
        </div>
        <div class="menu-main">
            <ul>
                <li>
                    <i class="fa fa-user fa-2x logo"></i>
                    <span>Teilnehmerkartei</span>
                </li>
                <li>
                    <i class="fa fa-user fa-2x logo"></i>
                    <span>Teilnehmerkartei</span>
                </li>
                <li>
                    <i class="fa fa-user fa-2x logo"></i>
                    <span>Teilnehmerkartei</span>
                </li>
                <li>
                    <i class="fa fa-user fa-2x logo"></i>
                    <span>Teilnehmerkartei</span>
                </li>
            </ul>
        </div>
    </nav>
    <main id="panel">
        <header>
            <div>
                <button class="toggle-button">☰</button>
                Panel
            </div>
        </header>
    </main>
</Slideout>