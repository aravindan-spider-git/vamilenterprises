@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                    <h6>Company List</h6>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <!-- Add Button -->
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#companyModal" onclick="openCreateModal()">Add Company</button>
                </div>
                <!-- Company Table -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table style-1" id="ListDatatableView">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Category</th> <!-- Added column for Category -->
                                    <th width="160">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $index => $company)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->category->name ?? '-' }}</td> <!-- Display category name -->
                                        <td>
                                            <button class="btn btn-sm btn-warning" onclick="openEditModal({{ $company->id }}, '{{ $company->name }}', {{ $company->category_id }})">Edit</button>

                                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline-block">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this company?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="companyModal" tabindex="-1" aria-labelledby="companyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="companyForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="companyModalLabel">Add Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category_id" id="companyCategoryId" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Company Name</label>
                        <input type="text" name="name" id="companyName" class="form-control" required>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->

<!-- Modal Handling Script -->
<script>
    function openCreateModal() {
        document.getElementById('companyModalLabel').innerText = 'Add Company';
        document.getElementById('companyForm').action = "{{ route('companies.store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('companyName').value = '';
        document.getElementById('companyCategoryId').value = '';
    }
    function openEditModal(id, name, categoryId) {
        document.getElementById('companyModalLabel').innerText = 'Edit Company';
        document.getElementById('companyForm').action = '/companies/' + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('companyName').value = name;
        document.getElementById('companyCategoryId').value = categoryId;
        new bootstrap.Modal(document.getElementById('companyModal')).show();
    }
</script>

@endsection
