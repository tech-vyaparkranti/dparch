@extends('layouts.dashboardLayout')
@section('title', 'Manage Gallery')
@section('content')
    <x-dashboard-container container_header="Manage Gallery">
        <x-card>
            <x-card-header>Add Gallery Items</x-card-header>
            <x-card-body>
                <x-form id="submit_form"> {{-- Added id to the form --}}
                    <x-input type="hidden" name="id" id="id" value=""></x-input>
                    <x-input type="hidden" name="action" id="action" value="insert"></x-input>

                    {{-- Section to display current image on edit --}}
                    <div id="current_media_display" style="margin-bottom: 20px;">
                        {{-- This area will be populated by JavaScript when editing --}}
                    </div>

                    <x-input-with-label-element name="local_image[]" id="local_image" type="file"
                        label="Upload Images (Optional)" placeholder="Images" accept="image/*"
                        multiple></x-input-with-label-element>

                    <x-input-with-label-element name="alternate_text" id="alternate_text"
                        placeholder="Alternate Text For Image" label="Alternate Text"></x-input-with-label-element>

                    <x-input-with-label-element type="text" id="title" name="title"
                        placeholder="Gallery Item Title" label="Title"></x-input-with-label-element>

                    <x-text-area-with-label id="description" name="description" placeholder="Gallery Item Description"
                        label="Description"></x-text-area-with-label>

                    <x-input-with-label-element type="number" id="position" name="position" placeholder="Position"
                        label="Position"></x-input-with-label-element>

                    <x-select-label-group required name="view_status" id="view_status" label_text="View Status">
                        <option value="visible">Visible</option>
                        <option value="hidden">Hidden</option>
                    </x-select-label-group>
                    <x-select-label-group required name="filter_category" id="filter_category_id" label_text="Filter Category">
                        <option value="Residential">Residential</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Master Planning">Master Planning</option>
                    </x-select-label-group>
                    <x-form-buttons></x-form-buttons>
                </x-form>
            </x-card-body>
        </x-card>
        <x-card>
            <x-card-header>Gallery Data</x-card-header>
            <x-card-body>
                <x-data-table></x-data-table>
            </x-card-body>
        </x-card>
    </x-dashboard-container>
@endsection

@section('script')
    <script type="text/javascript">
        let site_url = '{{ url('/') }}';
        var table = "";
        $(function() {
            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('addGalleryDataTable') }}",
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                "scrollX": true,
                "order": [
                    [1, 'desc']
                ],
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        title: "Action"
                    },
                    {
                        data: '{{ \App\Models\GalleryItem::ID }}',
                        name: '{{ \App\Models\GalleryItem::ID }}',
                        title: "Id"
                    },
                    {
                        data: '{{ \App\Models\GalleryItem::TITLE }}',
                        name: '{{ \App\Models\GalleryItem::TITLE }}',
                        title: "Title"
                    },
                    {
                        data: '{{ \App\Models\GalleryItem::DESCRIPTION }}',
                        name: '{{ \App\Models\GalleryItem::DESCRIPTION }}',
                        title: "Description"
                    },
                    {
                        data: '{{ \App\Models\GalleryItem::ALTERNATE_TEXT }}',
                        name: '{{ \App\Models\GalleryItem::ALTERNATE_TEXT }}',
                        title: "Alternate Text"
                    },
                    {
                        data: '{{ \App\Models\GalleryItem::FILTER_CATEGORY }}',
                        name: '{{ \App\Models\GalleryItem::FILTER_CATEGORY }}',
                        title: "Filter Category"
                    },
                    {
                        data: '{{ \App\Models\GalleryItem::LOCAL_IMAGE }}',
                        render: function(data, type) {
                            let image = '';
                            if (data) {
                                image += '<img alt="Stored Image" src="' + site_url + data +
                                    '" class="img-thumbnail" style="max-width:100px;">';
                            }
                            return image;
                        },
                        orderable: false,
                        searchable: false,
                        title: "Image Local"
                    },
                    {
                        data: '{{ \App\Models\GalleryItem::POSITION }}',
                        name: '{{ \App\Models\GalleryItem::POSITION }}',
                        title: "Position"
                    },
                    {
                        data: '{{ \App\Models\GalleryItem::VIEW_STATUS }}',
                        name: '{{ \App\Models\GalleryItem::VIEW_STATUS }}',
                        title: "View Status"
                    },
                ]
            });
        });

        // Function to scroll to the form when editing
        function scrollToDiv() {
            $('html, body').animate({
                scrollTop: $("#submit_form").offset().top
            }, 500);
        }

        $(document).on("click", ".edit", function() {
            let row = $.parseJSON(atob($(this).data("row")));
            if (row['id']) {
                $("#id").val(row['id']);
                $("#alternate_text").val(row['alternate_text']);
                $("#title").val(row['title']);
                $("#description").val(row['description']);
                $("#position").val(row['position']);
                $("#view_status").val(row['view_status']);
                $("#filter_category_id").val(row['filter_category']);
                $("#action").val("update"); // Set action to update

                // Display current local image only
                let currentMediaHtml = '';
                if (row['local_image']) {
                    currentMediaHtml += '<p><strong>Current Local Image:</strong></p>';
                    currentMediaHtml += '<img src="' + site_url + row['local_image'] + '" alt="Current Local Image" class="img-thumbnail" style="max-width:150px; margin-right: 10px;">';
                    currentMediaHtml += '<br>File: ' + row['local_image'].split('/').pop() + '<br>';
                }

                $('#current_media_display').html(currentMediaHtml);

                scrollToDiv();
            }
        });

        $(document).ready(function() {
            $("#submit_form").on("submit", function(e) {
                e.preventDefault(); // Prevent default form submission
                var form = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('addGalleryItems') }}', // This route should handle both add and update
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            successMessage(response.message, true);
                            table.ajax.reload();
                            $("#submit_form")[0].reset(); // Reset the form after success
                            $("#id").val(''); // Clear ID
                            $("#action").val("insert"); // Reset action to insert
                            $('#current_media_display').html(''); // Clear current media display
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

        function deleteGallery(id) {
            if (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This item will be removed!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('addGalleryItems') }}', // Same route to handle delete
                            data: {
                                id: id,
                                action: "delete",
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status) {
                                    successMessage(response.message);
                                    table.ajax.reload()
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
    </script>
    @include('Dashboard.include.dataTablesScript')
@endsection
