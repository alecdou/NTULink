<!-- Search Bar -->

<form method="POST" action="/search" class="input-group">
    @csrf
    <input name="keywords" class="form-control border rounded-left border-warning" type="text" placeholder="Search for ...">
    <div class="input-group-append">
        <button class="btn btn-outline-warning" type="submit">Search</button>
    </div>

</form>

