@section('title','Update Desktop')

@section('breadcrumb','/ Desktops / Update Desktop')

<x-layout>
    <div class="container">
        <div class="row">
            <div class="col">

                @include('partials.panel')

                <div class="container-shadow p-4">
                    <form action="/desktops/{{ $desktop->id }}" method="POST">
                    @csrf
                    @method('PATCH')

                        <div class="row">
                            <div class="col-5">
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

                                                @if($computer->id == $desktop->computer_id)
                                                <option value="{{ $computer->id }}" selected>{{ $computer->location->row.$computer->pc_number }}</option>
                                                @else
                                                <option value="{{ $computer->id }}">{{ $computer->location->row.$computer->pc_number }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="desktop_name">Name <span class="form-required">*</span></label>
                                    <input id="desktop_name" type="text" class="form-control auto-width" name="dsk_name" value="{{ $desktop->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="desktop_brand">Brand <span class="form-required">*</span></label>
                                    <input id="desktop_brand" type="text" class="form-control auto-width" name="dsk_brand" value="{{ $desktop->brand }}" required>
                                </div>									
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="desktop_serial">Serial No. <span class="form-required">*</span></label>
                                    <input id="desktop_serial" type="text" class="form-control auto-width" name="dsk_serial" value="{{ $desktop->serial_number }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="desktop_cost">Cost <span class="form-required">*</span></label>
                                    <input id="desktop_cost" type="number" min="1" step="1" class="form-control auto-width" name="dsk_cost" value="{{ $desktop->cost }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="desktop_pdate">Purchase Date <span class="form-required">*</span></label>
                                    <input id="desktop_pdate" type="date" class="form-control auto-width" name="dsk_pdate" value="{{ $desktop->purchase_date }}" required>
                                </div>
                                <button type="submit" class="btn btn-warning rounded-0 w-50">Update</button>
                            </div>	
                        </div>					
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>