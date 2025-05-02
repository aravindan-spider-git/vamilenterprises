@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                    <h2>Company Categories</h2>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal" onclick="openCreateModal()">Add Category</button>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Category Name</th>
                                    <th>Company</th>
                                    <th width="160">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $index => $category)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->company->name ?? '-' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning"
                                                onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', {{ $category->company_id }})">Edit</button>

                                            <form action="{{ route('company-categories.destroy', $category->id) }}" method="POST" style="display:inline-block">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
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
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="categoryForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" name="name" id="categoryName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Company</label>
                        <select name="company_id" id="companyId" class="form-control" required>
                            <option value="">-- Select Company --</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
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

<script>
    function openCreateModal() {
        document.getElementById('categoryModalLabel').innerText = 'Add Category';
        document.getElementById('categoryForm').action = "{{ route('company-categories.store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('categoryName').value = '';
        document.getElementById('companyId').value = '';
    }

    function openEditModal(id, name, companyId) {
        document.getElementById('categoryModalLabel').innerText = 'Edit Category';
        document.getElementById('categoryForm').action = '/company-categories/' + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('categoryName').value = name;
        document.getElementById('companyId').value = companyId;
        new bootstrap.Modal(document.getElementById('categoryModal')).show();
    }
</script>
@endsection
