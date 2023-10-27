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
        <x-footer />
    </div>
</div>
@include('layouts.script')
