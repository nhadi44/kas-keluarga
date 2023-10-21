@include('layouts.head')

<script src="/assets/static/js/initTheme.js"></script>
<div id="app">
    <div id="sidebar">
        <x-sidebar />
    </div>
    <div id="main" class="layout-navbar navbar-fixed">
        <header>
            <x-header />
        </header>
        <div id="main-content">
            <div class="page-heading">
                <div class="page-title mb-4">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>@yield('subtitle')</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <x-breadcrumb :data="$breadcrumbs" />
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        @yield('content')
                    </div>
                </section>
            </div>
        </div>
        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2023 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>
                        Crafted with
                        <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                        by <a href="https://saugi.me">Saugi</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>
</div>
@include('layouts.script')
