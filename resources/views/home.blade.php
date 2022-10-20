<x-layout>
    <div class="container">
        <div class="row">
            <div class="col">
                @include('partials.panel')
            </div>
        </div>
        <div class="row mt-4 justify-content-center">
    
           <div class="dashboard-panel col-3 d-flex flex-column justify-content-center align-items-center bg-light" style="height:200px;">
                <h1 class="dashboard-title text-primary">Computers</h1>
                <h2 class="mt-2">{{ $computerCount }}</h2>
            </div>    
            <div class="dashboard-panel col-3 mx-5 d-flex flex-column justify-content-center align-items-center bg-light" style="height:200px;">
                <h1 class="dashboard-title text-danger">Desktops</h1>
                <h2 class="mt-2">{{ $desktopCount }}</h2>
            </div>
            <div class="dashboard-panel col-3 d-flex flex-column justify-content-center align-items-center bg-light" style="height:200px;">
                <h1 class="dashboard-title text-success">Peripherals</h1>
                <h2 class="mt-2">{{ $peripheralCount }}</h2>
            </div>
        </div>
    </div>
</x-layout>