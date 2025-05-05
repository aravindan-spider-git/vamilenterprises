@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Document List</h2>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Add Button -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#documentModal" onclick="openCreateModal()">Add Document</button>
                </div>

                <!-- Document Table -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table style-1" id="ListDatatableView">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>File</th>
                                    <th width="160">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $index => $doc)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $doc->title }}</td>
                                        <td>{{ $doc->description }}</td>
                                        <td>{{ $doc->category->name ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                                $extension = Str::lower(pathinfo($doc->file_path, PATHINFO_EXTENSION));
                                            @endphp
                                            @if ($extension === 'xlsx' || $extension === 'docx')
                                                <a href="{{ asset('storage/' . $doc->file_path) }}" download>Download</a>
                                            @else
                                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank">View</a>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning"
                                                onclick="openEditModal({{ $doc->id }}, '{{ $doc->title }}', '{{ $doc->description }}', '{{ $doc->file_path }}', '{{ $doc->category_id }}')">Edit</button>
                                            <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" style="display:inline-block;">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this document?')">Delete</button>
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
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <form id="documentForm" method="POST" enctype="multipart/form-data" class="w-100">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <div class="modal-content w-100">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentModalLabel">Add Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Title</label>
                            <input type="text" name="title" id="docTitle" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select name="category_id" id="docCategory" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" id="docDescription" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Upload File</label>
                        <input type="file" name="file" class="form-control" id="docFile">
                        <small class="text-muted">Only select a file when uploading new or replacing</small>
                    </div>

                    <div class="mb-3" id="filePreviewWrapper" style="display: none;">
                        <label>File Preview</label>
                        <div id="filePreview"></div>
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
        document.getElementById('documentModalLabel').innerText = 'Add Document';
        document.getElementById('documentForm').action = "{{ route('documents.store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('docTitle').value = '';
        document.getElementById('docDescription').value = '';
        document.getElementById('docCategory').value = '';
        document.getElementById('docFile').required = true;

        document.getElementById('filePreviewWrapper').style.display = 'none';
        document.getElementById('filePreview').innerHTML = '';
    }

    function openEditModal(id, title, description, filepath, categoryId) {
        document.getElementById('documentModalLabel').innerText = 'Edit Document';
        document.getElementById('documentForm').action = '/documents/' + id;
        document.getElementById('formMethod').value = 'POST';

        let existingMethodField = document.querySelector('input[name="_method"]');
        if (existingMethodField) {
            existingMethodField.remove();
        }

        let methodField = document.createElement("input");
        methodField.setAttribute("type", "hidden");
        methodField.setAttribute("name", "_method");
        methodField.setAttribute("value", "PUT");
        document.getElementById('documentForm').appendChild(methodField);

        document.getElementById('docTitle').value = title;
        document.getElementById('docDescription').value = description;
        document.getElementById('docCategory').value = categoryId;
        document.getElementById('docFile').required = false;

        const filePreviewWrapper = document.getElementById('filePreviewWrapper');
        const filePreview = document.getElementById('filePreview');
        const ext = filepath.split('.').pop().toLowerCase();
        const previewUrl = `/storage/${filepath}`;

        filePreviewWrapper.style.display = 'none';
        filePreview.innerHTML = '';

        if (['jpg', 'jpeg', 'png'].includes(ext)) {
            filePreview.innerHTML = `<img src="${previewUrl}" class="img-fluid rounded" alt="Preview" style="max-height: 300px;">`;
            filePreviewWrapper.style.display = 'block';
        } else if (ext === 'pdf') {
            filePreview.innerHTML = `<iframe src="${previewUrl}" width="100%" height="400px" style="border: none;"></iframe>`;
            filePreviewWrapper.style.display = 'block';
        } else if (ext === 'xlsx' || ext === 'docx' ) {
            filePreview.innerHTML = `<a href="${previewUrl}" download>Download Excel File</a>`;
            filePreviewWrapper.style.display = 'block';
        }
        new bootstrap.Modal(document.getElementById('documentModal')).show();
    }
</script>
@endsection
