@if($actionFlag == 1)
	@section('title','New Computer')
	@section('breadcrumb','/ Computer / New Computer')
@else
	@section('title','Update Computer')
	@section('breadcrumb','/ Computer / Update Computer')
@endif

<x-layout>
    <div class="container">
        <div class="row">
            <div class="col">

                @include('partials.panel')

                <div class="container-shadow p-4">
                    @if($actionFlag == 1)
                    <form action="/computers" method="POST">
                        @csrf				
                    @else
                    <form action="/computers/{{ $computer->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                    @endif

                        <div class="form-group">
                            <label for="computer_row">Row</label>
                            <select id="computer_row" class="form-control" name="cmp_row" required>
                                <option value="">Select a row..</option>
                                @if($actionFlag == 1)
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->row }}</option>
                                    @endforeach
                                @else
                                    @foreach($locations as $location)
                                        @if($location->id === $computer->location_id)
                                            <option value="{{ $location->id }}" selected>{{ $location->row }}</option>
                                        @else
                                            <option value="{{ $location->id }}">{{ $location->row }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="computer_num">PC Number</label>
                            @if($actionFlag == 1)
                                <input id="computer_num" type="number" class="form-control" min="1" max="15" step="1" name="cmp_num" required>
                            @else
                                <input id="computer_num" type="number" class="form-control" min="1" max="15" step="1" name="cmp_num" value="{{ intval($computer->pc_number) }}" required>
                            @endif
                        </div>
                        @if($actionFlag == 1)
                        <button type="submit" class="btn btn-success rounded-0">Add</button>
                        @else
                        <button type="submit" class="btn btn-warning rounded-0">Update</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>