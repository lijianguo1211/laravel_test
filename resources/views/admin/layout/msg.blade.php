@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="am-alert am-alert-success">
        <div class="am-container">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="am-alert am-alert-danger">
        <div class="am-container">
            {{ session('error') }}
        </div>
    </div>
@endif