<div class="hero inner-page" style="background-image: url('{{ asset('assets/main/images/hero_1_a.jpg') }}');">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-5">
                <div class="intro">
                    <h1><strong>@yield('pageTitle')</strong></h1>
                    <div class="custom-breadcrumbs"><a href="{{ route('home') }}">Home</a> <span class="mx-2">/</span> <strong>@yield('pageTitle')</strong></div>
                </div>
            </div>
        </div>
    </div>
</div>

  