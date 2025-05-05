@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Vehicle Categories</h2>

                    @if(session('success'))
                        <div class="alert alert-success w-100 mt-2">{{ session('success') }}</div>
                    @endif

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal" onclick="openCreateModal()">Add Category</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table style-1" id="ListDatatableView">
                            <thead class="table-light">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Category Name</th>
                                    <th width="160">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $index => $category)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning"
                                                onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')">Edit</button>

                                            <form action="{{ route('vehicle-categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                @if($categories->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No categories found.</td>
                                    </tr>
                                @endif
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" name="name" id="categoryName" class="form-control" required>
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
        document.getElementById('categoryForm').action = "{{ route('vehicle-categories.store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('categoryName').value = '';
    }

    function openEditModal(id, name) {
        document.getElementById('categoryModalLabel').innerText = 'Edit Category';
        document.getElementById('categoryForm').action = "/vehicle-categories/" + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('categoryName').value = name;

        new bootstrap.Modal(document.getElementById('categoryModal')).show();
    }
</script>
@endsection
