@section('title','New Desktop')

@section('breadcrumb','/ Desktops / New Desktop')

<x-layout>
    <div class="container">
        <div class="row">
            <div class="col">

                @include('partials.panel')

                <div class="mb-2 pt-3">	
                    <a href="/computers/create" class="btn btn-success rounded-0">Add Computer</a>
                </div>
                <div class="container-shadow p-4">
                    <form action="/desktops" method="POST">
                    @csrf

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="desktop_computer">
                                        <div>Computer <span class="form-required">*</span></div>
                                        <div>
                                            <sub>(Row, No.)
                                            </sub>
                                        </div>
                                    </label>
                                    <div class="d-flex">								
                                        <select id="desktop_computer" class="form-control auto-width" name="dsk_num" required>
                                            <option value="">Select PC No..</option>
                                            @foreach($computers as $computer)
                                                <option value="{{ $computer->id }}">{{ $computer->location->row.$computer->pc_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="desktop_name">Name <span class="form-required">*</span></label>
                                    <input id="desktop_name" type="text" class="form-control auto-width" name="dsk_name" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="desktop_brand">Brand <span class="form-required">*</span></label>
                                    <input id="desktop_brand" type="text" class="form-control auto-width" name="dsk_brand" required>
                                </div>									
                                <div class="form-group">
                                    <label for="desktop_serial">Serial No. <span class="form-required">*</span></label>
                                    <input id="desktop_serial" type="text" class="form-control auto-width" name="dsk_serial" required>
                                </div>
                                <div class="form-group">
                                    <label for="desktop_cost">Cost <span class="form-required">*</span></label>
                                    <input id="desktop_cost" type="number" min="1" step="1" class="form-control auto-width" name="dsk_cost" required>
                                </div>
                            </div>	
                            <div class="col-4">							
                                <div class="form-group">
                                    <label for="desktop_pdate">Purchase Date <span class="form-required">*</span></label>
                                    <input id="desktop_pdate" type="date" class="form-control auto-width" name="dsk_pdate" required>
                                </div>
                                <button type="submit" class="btn btn-success rounded-0 w-50">Add</button>
                            </div>		
                        </div>					
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>