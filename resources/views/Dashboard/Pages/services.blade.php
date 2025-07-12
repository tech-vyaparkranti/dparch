@extends('layouts.dashboardLayout')
@section('title', 'Manage Projects')
@section('content')

<x-content-div heading="Manage Projects">
    <x-card-element header="Add / Edit Project">
        <x-form-element method="POST" enctype="multipart/form-data" id="projectForm" action="javascript:">
            <x-input type="hidden" name="id" id="id" value=""></x-input>
            <x-input type="hidden" name="action" id="action" value="insert"></x-input>

            {{-- Main Image --}}
            <x-input-with-label-element 
                id="image" 
                label="Project Main Image" 
                name="image" 
                type="file" 
                accept="image/*" 
                required>
            </x-input-with-label-element>

            {{-- Banner Image --}}
            <x-input-with-label-element 
                id="banner_image" 
                label="Project Banner Image" 
                name="banner_image" 
                type="file" 
                accept="image/*" 
                required>
            </x-input-with-label-element>

            {{-- Project Name --}}
            <x-input-with-label-element 
                id="project_name" 
                label="Project Name" 
                name="project_name" 
                required>
            </x-input-with-label-element>

            {{-- Description --}}
           <x-text-area-with-label 
    id="description"
    label="Description"
    name="description"
    required
    rows="4"
></x-text-area-with-label>

            {{-- Gallery Images --}}
            <div class="mb-3">
                <label for="gallery_images" class="form-label">Gallery Images (Multiple)</label>
                <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" multiple accept="image/*">
            </div>

            {{-- Status --}}
            <x-select-with-label id="status" name="status" label="Status" required="true">
                <option value="live">Live</option>
                <option value="disabled">Disabled</option>
            </x-select-with-label>

            {{-- Sorting --}}
            <x-input-with-label-element 
                id="sorting" 
                label="Sorting" 
                type="numeric"
                name="sorting">
            </x-input-with-label-element>

            <x-form-buttons></x-form-buttons>
        </x-form-element>
    </x-card-element>

    <x-card-element header="Projects Data">
        <x-data-table>
            {{-- DataTable will render here --}}
        </x-data-table>
    </x-card-element>
</x-content-div>
@endsection
<style>
    /* Make summernote fill its container */
    #description, .note-editor, .note-editing-area, .note-editable {
        width: 100% !important;
        min-width: 100% !important;
        box-sizing: border-box;
    }
</style>
@section('script')
<script type="text/javascript">
    let site_url = '{{ url('/') }}';
    let table = "";

    $(function() {
        $('#description').summernote({
    placeholder: 'Description',
    tabsize: 2,
    height: 100
});
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: {
                url: "{{ route('projects.data') }}",
                type: 'POST',
                data: { '_token': '{{ csrf_token() }}' }
            },
            columns: [
                { data: "DT_RowIndex", orderable: false, searchable: false, title: "Sr.No." },
                { data: "id", name: "id", visible: false },
                {
                    data: "image",
                    render: function(data) {
                        return data ? '<img src="' + site_url + data + '" class="img-thumbnail" style="max-width:60px;">' : '';
                    },
                    orderable: false, searchable: false, title: "Main Image"
                },
                {
                    data: "banner_image",
                    render: function(data) {
                        return data ? '<img src="' + site_url + data + '" class="img-thumbnail" style="max-width:60px;">' : '';
                    },
                    orderable: false, searchable: false, title: "Banner"
                },
                { data: "project_name", name: "project_name", title: "Project Name" },
                { data: "description", name: "description", title: "Description" },
                // Optional: Gallery images preview column
                // { data: "gallery_preview", orderable: false, searchable: false, title: "Gallery Images" },
                { data: "status", name: "status", title: "Status" },
                { data: "sorting", name: "sorting", title: "Sorting" },
                { data: "action", name: "action", orderable: false, searchable: false, title: "Action" }
            ],
            order: [[1, "desc"]]
        });
    });

    // Edit button handler (example, adjust to your actual data structure)
    $(document).on("click", ".edit", function() {
        let row = $.parseJSON(atob($(this).data("row")));
        if (row['id']) {
            $("#id").val(row['id']);
            $("#image").attr("required", false);
            $("#banner_image").attr("required", false);
            $("#project_name").val(row['project_name']);
            $("#description").val(row['description']);
            $("#status").val(row['status']);
            $("#sorting").val(row['sorting']);
            $("#action").val("update");
            // Optionally: show image previews for image/banner/gallery
            scrollToDiv();
        } else {
            errorMessage("Something went wrong. Code 101");
        }
    });

    function Disable(id) {
        changeAction(id, "disable", "This item will be disabled!", "Yes, disable it!");
    }
    function Enable(id) {
        changeAction(id, "enable", "This item will be enabled!", "Yes, enable it!");
    }
    function changeAction(id, action, text, confirmButtonText) {
        if (id) {
            Swal.fire({
                title: 'Are you sure?',
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('projects.save') }}',
                        data: {
                            id: id,
                            action: action,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                successMessage(response.message, true);
                                table.ajax.reload();
                            } else {
                                errorMessage(response.message);
                            }
                        },
                        failure: function(response) {
                            errorMessage(response.message);
                        }
                    });
                }
            });
        } else {
            errorMessage("Something went wrong. Code 102");
        }
    }

    $(document).ready(function() {
        $("#projectForm").on("submit", function() {
            var form = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route('projects.save') }}',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        successMessage(response.message, "reload");
                    } else {
                        errorMessage(response.message);
                    }
                },
                failure: function(response) {
                    errorMessage(response.message);
                }
            });
        });
    });
</script>
@include('Dashboard.include.dataTablesScript')
@endsection
