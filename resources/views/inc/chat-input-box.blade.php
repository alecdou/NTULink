<style>
    #bottom-nav {
        width: 100%;
        background-color: lightblue !important;
        z-index: 5 !important;
    }


</style>

<link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sticky-footer-navbar/">

<nav id="bottom-nav" class="navbar navbar-expand fixed-bottom navbar-light bg-light">

    <div class="navbar container-fluid py-0 px-3 m-0">
        <form method="POST" action="/search" class="input-group">
            @csrf
            <input id="search-input" name="keywords" class="form-control rounded-left" type="text" placeholder="Search for ...">
            <div class="input-group-append">
                <button id="search-btn" class="btn btn-primary" type="submit" style="background-color: lightblue; border-color: lightblue"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
</nav>

<script>


</script>
