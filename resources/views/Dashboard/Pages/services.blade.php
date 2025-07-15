@extends('layouts.dashboardLayout')
@section('title', 'Manage Projects')

@section('content')
<x-content-div heading="Manage Projects">
    <x-card-element header="Add / Edit Project">
        <x-form-element method="POST" enctype="multipart/form-data" id="projectForm" action="javascript:">
            <x-input type="hidden" name="id" id="id" value="" />
            <x-input type="hidden" name="action" id="action" value="insert" />

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

            {{-- Main Description --}}
            <x-text-area-with-label
                id="description"
                label="Main Description"
                name="description"
                required
            ></x-text-area-with-label>

            {{-- Dynamic Sections --}}
            <label class="form-label mt-3">Project Content Sections (Image + Description)</label>
            <div id="project-sections-wrapper">
                <div class="project-section d-flex gap-3 mb-3">
                    <input type="file" name="sections[0][image]" accept="image/*" class="form-control" required>
                    <textarea name="sections[0][description]" class="form-control" rows="1" placeholder="Enter description" required></textarea>
                    <button type="button" class="btn btn-success add-section">+</button>
                </div>
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
                type="number"
                name="sorting">
            </x-input-with-label-element>

            <x-form-buttons></x-form-buttons>
        </x-form-element>
    </x-card-element>

    <x-card-element header="Projects Data">
        <x-data-table></x-data-table>
    </x-card-element>
</x-content-div>
@endsection

@section('script')
<script type="text/javascript">
    let sectionIndex = 1;
    let site_url = '{{ url('/') }}';
    let table = "";

    $(document).on('click', '.add-section', function () {
        let html = `
            <div class="project-section d-flex gap-3 mb-3">
                <input type="file" name="sections[${sectionIndex}][image]" accept="image/*" class="form-control">
                <textarea name="sections[${sectionIndex}][description]" class="form-control" rows="1" placeholder="Enter description" required></textarea>
                <button type="button" class="btn btn-danger remove-section">–</button>
            </div>`;
        $('#project-sections-wrapper').append(html);
        sectionIndex++;
    });

    $(document).on('click', '.remove-section', function () {
        $(this).closest('.project-section').remove();
    });

    $('#description').summernote({
        placeholder: 'Description',
        tabsize: 2,
        height: 100
    });

    $(function() {
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
                    data: "banner_image",
                    render: function(data) {
                        return data ? '<img src="' + site_url + data + '" class="img-thumbnail" style="max-width:60px;">' : '';
                    },
                    orderable: false, searchable: false, title: "Banner"
                },
                { data: "project_name", name: "project_name", title: "Project Name" },
                { data: "status", name: "status", title: "Status" },
                { data: "sorting", name: "sorting", title: "Sorting" },
                { data: "action", name: "action", orderable: false, searchable: false, title: "Action" }
            ],
            order: [[1, "desc"]]
        });
    });

    $(document).on("click", ".edit", function () {
        let row = $.parseJSON(atob($(this).data("row")));
        if (row['id']) {
            $("#id").val(row['id']);
            $("#banner_image").attr("required", false);
            $("#project_name").val(row['project_name']);
            $("#description").summernote('code', row['description']);
            $("#status").val(row['status']);
            $("#sorting").val(row['sorting']);
            $("#action").val("update");

            $('#project-sections-wrapper').empty();
            sectionIndex = 0;
            if (row.sections && typeof row.sections === 'string') {
                row.sections = JSON.parse(row.sections);
            }
            if (Array.isArray(row.sections)) {
                row.sections.forEach((section, i) => {
                    let btnHtml = i === 0 
                        ? `<button type="button" class="btn btn-success add-section">+</button>` 
                        : `<button type="button" class="btn btn-danger remove-section">–</button>`;

                    let html = `
                    <div class="project-section d-flex gap-3 mb-3">
                        <div>
                            <input type="file" name="sections[${sectionIndex}][image]" class="form-control" accept="image/*">
                            ${section.image ? `<img src="${site_url}${section.image}" alt="Preview" style="width:60px; margin-top:5px;">` : ''}
                            <input type="hidden" name="sections[${sectionIndex}][existing_image]" value="${section.image}">
                        </div>
                        <textarea name="sections[${sectionIndex}][description]" class="form-control" rows="1" required>${section.description}</textarea>
                        ${btnHtml}
                    </div>`;
                    $('#project-sections-wrapper').append(html);
                    sectionIndex++;
                });
            }
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
                        }
                    });
                }
            });
        }
    }

    $(document).ready(function () {
        $("#projectForm").on("submit", function () {
            var form = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route('projects.save') }}',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status) {
                        successMessage(response.message, "reload");
                    } else {
                        errorMessage(response.message);
                    }
                }
            });
        });
    });
</script>
@include('Dashboard.include.dataTablesScript')
@endsection