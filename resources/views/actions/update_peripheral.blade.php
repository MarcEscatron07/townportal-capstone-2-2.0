@section('title','Update Peripheral')

@section('breadcrumb','/ Peripherals / Update Peripheral')

<x-layout>
    <div class="container">
        <div class="row">
            <div class="col">

                @include('partials.panel')

                <div class="container-shadow p-4">
                    <form action="/peripherals/{{ $peripheral->id }}" method="POST">
                        @csrf
                        @method('PATCH')

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="peripheral_computer">
                                            <div>Computer <span class="form-required">*</span></div>
                                            <div>
                                                <sub>(Row, No.)
                                                </sub>
                                            </div>
                                        </label>
                                        <div class="d-flex">								
                                            <select id="peripheral_computer" class="form-control auto-width" name="per_num" required>
                                                <option value="">Select PC No..</option>
                                                @foreach($computers as $computer)
                                                    @if($computer->id == $peripheral->computer_id)
                                                    <option value="{{ $computer->id }}" selected>{{ $computer->location->row.$computer->pc_number }}</option>
                                                    @else
                                                    <option value="{{ $computer->id }}">{{ $computer->location->row.$computer->pc_number }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="peripheral_name">Name <span class="form-required">*</span></label>
                                        <input id="peripheral_name" type="text" class="form-control auto-width" name="per_name" value="{{ $peripheral->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="peripheral_brand">Brand <span class="form-required">*</span></label>
                                        <input id="peripheral_brand" type="text" class="form-control auto-width" name="per_brand" value="{{ $peripheral->brand }}" required>
                                    </div>									
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="peripheral_type">Type <span class="form-required">*</span></label>
                                        <select id="peripheral_type" class="form-control auto-width" name="per_type" required>
                                            <option value="">Select peripheral type..</option>
                                            @foreach($types as $type)
                                                @if($type->id == $peripheral->type_id)
                                                <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                                @else
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endif                                            
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="peripheral_serial">Serial No. <span class="form-required">*</span></label>
                                        <input id="peripheral_serial" type="text" class="form-control auto-width" name="per_serial" value="{{ $peripheral->serial_number }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="peripheral_cost">Cost <span class="form-required">*</span></label>
                                        <input id="peripheral_cost" type="number" min="1" step="1" class="form-control auto-width" name="per_cost" value="{{ $peripheral->cost }}" required>
                                    </div>                                
                                </div>	
                                <div class="col-4">			
                                    <div class="form-group">
                                        <label for="peripheral_pdate">Purchase Date <span class="form-required">*</span></label>
                                        <input id="peripheral_pdate" type="date" class="form-control auto-width" name="per_pdate" value="{{ $peripheral->purchase_date }}" required>
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