
@extends('layouts.dashboardLayout')
@section('title', 'Manage Projects')

@section('content')
<x-content-div heading="Manage Projects">
    <x-card-element header="Add / Edit Project">
        <x-form-element method="POST" enctype="multipart/form-data" id="projectForm" action="javascript:">
            <x-input type="hidden" name="id" id="id" value="" />
            <x-input type="hidden" name="action" id="action" value="insert" />

            {{-- ✅ New Main Image --}}
            <x-input-with-label-element 
                id="main_image" 
                label="Main Image" 
                name="main_image" 
                type="file" 
                accept="image/*" 
                required>
            </x-input-with-label-element>

            {{-- ✅ Banner Image --}}
            <x-input-with-label-element 
                id="banner_image" 
                label="Banner Image" 
                name="banner_image" 
                type="file" 
                accept="image/*" 
                required>
            </x-input-with-label-element>

            {{-- ✅ Project Name --}}
            <x-input-with-label-element 
                id="project_name" 
                label="Project Name" 
                name="project_name" 
                required>
            </x-input-with-label-element>

            {{-- ✅ Main Description --}}
            <x-text-area-with-label
                id="description"
                label="Main Description"
                name="description"
                required
            ></x-text-area-with-label>

            {{-- ✅ Dynamic Sections with MULTIPLE image uploads --}}
            <label class="form-label mt-3">Project Content Sections (Multiple Images + Description)</label>
            <div id="project-sections-wrapper">
                <div class="project-section d-flex gap-3 mb-3 align-items-start">
                    <div class="image-upload-wrapper flex-grow-1">
                        <input type="file" name="sections[0][images][]" accept="image/*" class="form-control" multiple>
                        {{-- This div will be used to append existing image previews and hidden inputs --}}
                        <div class="existing-images-preview d-flex flex-wrap mt-2"></div>
                    </div>
                    {{-- Add the class 'section-description-editor' --}}
                    <textarea name="sections[0][description]" class="form-control section-description-editor flex-grow-1" placeholder="Enter description"></textarea>
                    <button type="button" class="btn btn-success add-section">+</button>
                </div>
            </div>

            {{-- ✅ Status --}}
            <x-select-with-label id="status" name="status" label="Status" required="true">
                <option value="live">Live</option>
                <option value="disabled">Disabled</option>
            </x-select-with-label>

            {{-- ✅ Sorting --}}
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
    let sectionIndex = 0; // Start with 0 for the first section, then increment
    let site_url = '{{ url('/') }}';
    let table = "";

    // Function to initialize Summernote on a given textarea element
    function initializeSummernote(element) {
        $(element).summernote({
            placeholder: 'Description',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    }

    // Initialize Summernote on the *first* textarea when the page loads
    $(document).ready(function() {
        initializeSummernote($('#project-sections-wrapper .section-description-editor').eq(0));
    });

    // Add Section Button
    $(document).on('click', '.add-section', function () {
        // Increment sectionIndex BEFORE creating the new element to ensure unique names
        sectionIndex++;
        let html = `
            <div class="project-section d-flex gap-3 mb-3 align-items-start">
                <div class="image-upload-wrapper flex-grow-1">
                    <input type="file" name="sections[${sectionIndex}][images][]" multiple accept="image/*" class="form-control">
                    <div class="existing-images-preview d-flex flex-wrap mt-2"></div>
                </div>
                <textarea name="sections[${sectionIndex}][description]" class="form-control section-description-editor flex-grow-1" placeholder="Enter description"></textarea>
                <button type="button" class="btn btn-danger remove-section">–</button>
            </div>`;
        
        let newSection = $(html); // Create jQuery object from HTML string
        $('#project-sections-wrapper').append(newSection);

        // Initialize Summernote on the new textarea
        initializeSummernote(newSection.find('.section-description-editor'));
    });

    $(document).on('click', '.remove-section', function () {
        // Destroy Summernote instance before removing the element
        $(this).closest('.project-section').find('.section-description-editor').summernote('destroy');
        $(this).closest('.project-section').remove();
    });

    // Summernote for main description (remains the same)
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

    // Edit button click handler
    $(document).on("click", ".edit", function () {
        let row = $.parseJSON(atob($(this).data("row")));
        if (row['id']) {
            $("#id").val(row['id']);
            $("#main_image").attr("required", false);
            $("#banner_image").attr("required", false);
            $("#project_name").val(row['project_name']);
            $("#description").summernote('code', row['description']); // Set content for main description
            $("#status").val(row['status']);
            $("#sorting").val(row['sorting']);
            $("#action").val("update");

            $('#project-sections-wrapper').empty();
            sectionIndex = 0; // Reset sectionIndex for edit mode

            // Ensure sections is an array, parsing if necessary
            if (row.sections && typeof row.sections === 'string') {
                row.sections = JSON.parse(row.sections);
            }

            if (Array.isArray(row.sections)) {
                row.sections.forEach((section, i) => {
                    let imagePreviewHtml = '';
                    let existingImagePaths = []; // To store paths for backend

                    if (Array.isArray(section.images)) {
                        section.images.forEach(img => {
                            // Ensure img path includes /storage/ if it's relative
                            let imageUrl = img.startsWith('/storage/') ? img : '/storage/' + img;

                            imagePreviewHtml += `
                                <div class="position-relative d-inline-block me-2 mb-2">
                                    <img src="${site_url}${imageUrl}" class="img-thumbnail" style="width:50px; height:50px; object-fit: cover;">
                                    <button type="button" class="btn btn-danger btn-sm remove-existing-image" data-path="${imageUrl}" style="position:absolute; top:-5px; right:-5px; border-radius:50%; width:20px; height:20px; font-size:12px; line-height:1; padding:0;">&times;</button>
                                    <input type="hidden" name="sections[${sectionIndex}][existing_images][]" value="${imageUrl}">
                                </div>`;
                            existingImagePaths.push(imageUrl); // Store original path for hidden input
                        });
                    }

                    let btnHtml = i === 0
                        ? `<button type="button" class="btn btn-success add-section">+</button>`
                        : `<button type="button" class="btn btn-danger remove-section">–</button>`;

                    let html = `
                        <div class="project-section d-flex gap-3 mb-3 align-items-start">
                            <div class="image-upload-wrapper flex-grow-1">
                                <input type="file" name="sections[${sectionIndex}][images][]" class="form-control" multiple accept="image/*">
                                <div class="existing-images-preview d-flex flex-wrap mt-2">
                                    ${imagePreviewHtml}
                                </div>
                            </div>
                            <textarea name="sections[${sectionIndex}][description]" class="form-control section-description-editor flex-grow-1" placeholder="Enter description">${section.description}</textarea>
                            ${btnHtml}
                        </div>`;
                    
                    let newSectionElement = $(html);
                    $('#project-sections-wrapper').append(newSectionElement);

                    // Initialize Summernote on the newly appended textarea
                    initializeSummernote(newSectionElement.find('.section-description-editor'));
                    
                    sectionIndex++;
                });
            }

            scrollToDiv();
        } else {
            errorMessage("Something went wrong. Code 101");
        }
    });

    // Handle removing existing images from the preview
    $(document).on('click', '.remove-existing-image', function() {
        $(this).closest('.position-relative').remove(); // Remove the image preview and its hidden input
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
        $("#projectForm").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission

            // Ensure Summernote content is saved to underlying textareas before FormData is created
            $('.section-description-editor').each(function() {
                $(this).val($(this).summernote('code'));
            });

            var form = new FormData(this);
            // Append CSRF token to FormData
            form.append('_token', '{{ csrf_token() }}');

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
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle validation errors or other server errors
                    if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                        errorMessage(jqXHR.responseJSON.message);
                    } else {
                        errorMessage('An unexpected error occurred.');
                    }
                    console.error("AJAX Error:", textStatus, errorThrown, jqXHR.responseText);
                }
            });
        });
    });
</script>
@include('Dashboard.include.dataTablesScript')
@endsection
