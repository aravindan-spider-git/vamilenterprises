@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Vehicle List</h2>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vehicleModal" onclick="openCreateVehicleModal()">Add Vehicle</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Registration No.</th>
                  
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicles as $index => $vehicle)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $vehicle->name }}</td>
                                        <td>{{ $vehicle->registration_number }}</td>
                
                                        <td>{{ $vehicle->status }}</td>
                                        <td>
                                            @if($vehicle->image)
                                                <img src="{{ asset('storage/' . $vehicle->image) }}" alt="Image" width="60">
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" onclick="openEditVehicleModal({{ $vehicle }})">Edit</button>

                                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline-block">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this vehicle?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                @if($vehicles->isEmpty())
                                    <tr><td colspan="10" class="text-center">No vehicles found.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Vehicle Modal -->
<div class="modal fade" id="vehicleModal" tabindex="-1" aria-labelledby="vehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="vehicleForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="vehicle_id" id="vehicleId">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vehicleModalLabel">Add Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Vehicle Name</label>
                        <input type="text" class="form-control" name="name" id="vehicleName" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Registration Number</label>
                        <input type="text" class="form-control" name="registration_number" id="vehicleReg" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" id="vehicleStatus">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Purchase Date</label>
                        <input type="date" class="form-control" name="purchase_date" id="vehicleDate">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="vehicleImage">
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openCreateVehicleModal() {
        document.getElementById('vehicleModalLabel').innerText = 'Add Vehicle';
        document.getElementById('vehicleForm').action = "{{ route('vehicles.store') }}";
        document.getElementById('formMethod').value = 'POST';
        // Clear fields
        document.getElementById('vehicleForm').reset();
        document.getElementById('vehicleId').value = '';
    }

    function openEditVehicleModal(vehicle) {
        document.getElementById('vehicleModalLabel').innerText = 'Edit Vehicle';
        document.getElementById('vehicleForm').action = "/vehicles/" + vehicle.id;
        document.getElementById('formMethod').value = 'PUT';

        // Populate fields
        document.getElementById('vehicleId').value = vehicle.id;
        document.getElementById('vehicleName').value = vehicle.name;
        document.getElementById('vehicleReg').value = vehicle.registration_number;
        document.getElementById('vehicleStatus').value = vehicle.status;
        document.getElementById('vehicleDate').value = vehicle.purchase_date ?? '';

        new bootstrap.Modal(document.getElementById('vehicleModal')).show();
    }
</script>
@endsection
