@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Document Categories</h2>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Add Button -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#documentModal" onclick="openCreateModal()">Add Category</button>
                </div>

                <!-- Category Table -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table style-1" id="ListDatatableView">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
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
                                            <form action="{{ route('document-categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
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
<div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="documentForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="name" id="docTitle" class="form-control" required>
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

<!-- Modal JS -->
<script>
    function openCreateModal() {
        document.getElementById('documentModalLabel').innerText = 'Add Category';
        document.getElementById('documentForm').action = "{{ route('document-categories.store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('docTitle').value = '';
    }

    function openEditModal(id, title) {
        document.getElementById('documentModalLabel').innerText = 'Edit Category';
        document.getElementById('documentForm').action = '/document-categories/' + id;
        document.getElementById('formMethod').value = 'POST';

        let existingMethodField = document.querySelector('input[name="_method"]');
        if (existingMethodField) existingMethodField.remove();

        let methodField = document.createElement("input");
        methodField.setAttribute("type", "hidden");
        methodField.setAttribute("name", "_method");
        methodField.setAttribute("value", "PUT");
        document.getElementById('documentForm').appendChild(methodField);

        document.getElementById('docTitle').value = title;

        new bootstrap.Modal(document.getElementById('documentModal')).show();
    }
</script>
@endsection
