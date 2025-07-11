@extends('layouts.dashboardLayout')
@section('title', 'Why Choose Us')
@section('content')

<x-content-div heading="Manage Why Choose Us">
    <x-card-element header="Add / Edit Why Choose Us Feature">
        <x-form-element method="POST" enctype="multipart/form-data" id="whyChooseUsForm" action="javascript:">
            <x-input type="hidden" name="id" id="id" value="" />
            <x-input type="hidden" name="action" id="action" value="insert" />

            {{-- Icon upload --}}
            <div class="mb-3">
                <label for="icon" class="form-label">Upload Icon (PNG, SVG, etc.)</label>
                <input type="file" name="icon" id="icon" class="form-control" accept="image/*">
                <div id="icon-preview" class="mt-2"></div>
            </div>

            {{-- Title --}}
            <x-input-with-label-element 
                id="title" 
                label="Feature Title"
                name="title"
                required
            ></x-input-with-label-element>

            {{-- Status --}}
            <x-select-with-label 
                id="status" 
                name="status" 
                label="Status" 
                required="true"
            >
                <option value="live">Live</option>
                <option value="disabled">Disabled</option>
            </x-select-with-label>
            
            {{-- Sorting --}}
            <x-input-with-label-element 
                id="sorting" 
                label="Sorting" 
                type="numeric"
                name="sorting"
            ></x-input-with-label-element>

            <x-form-buttons></x-form-buttons>
        </x-form-element>
    </x-card-element>

    <x-card-element header="Why Choose Us Features">
        <x-data-table>
            {{-- DataTable will render here --}}
        </x-data-table>
    </x-card-element>
</x-content-div>
@endsection

@section('script')
<script type="text/javascript">
    let table = "";
    $(function() {
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: {
                url: "{{ route('whyChooseUsData') }}",
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: "DT_RowIndex", orderable: false, searchable: false, title: "Sr.No." },
                { data: "id", name: "id", visible: false },
                { 
                    data: "icon",
                    render: function(data) {
                        if (data) {
                            // DATA IS FULL URL! Don't prepend site_url.
                            return '<img src="' + data + '" class="img-thumbnail" style="max-width:48px;">';
                        }
                        return '';
                    },
                    orderable: false, searchable: false, title: "Icon"
                },
                { data: "title", name: "title", title: 'Title' },
                { data: "status", name: "status", title: 'Status' },
                { data: "sorting", name: "sorting", title: 'Sorting' },
                { data: 'action', name: 'action', orderable: false, searchable: false, title: 'Action' },
            ],
            order: [[1, "asc"]]
        });
    });

    // When editing, fill fields and show icon preview
    $(document).on("click", ".edit", function() {
        let row = $.parseJSON(atob($(this).data("row")));
        if (row['id']) {
            $("#id").val(row['id']);
            $("#icon").attr("required", false);
            $("#title").val(row['title']);
            $("#status").val(row['status']);
            $("#sorting").val(row['sorting']);
            $("#action").val("update");
            // Show icon preview (data is full URL)
            if(row['icon']) {
                $("#icon-preview").html('<img src="' + row['icon'] + '" alt="Current Icon" style="max-width: 70px;" class="mb-2">');
            } else {
                $("#icon-preview").html('');
            }
            scrollToDiv();
        } else {
            errorMessage("Something went wrong. Code 201");
        }
    });

    // Enable/Disable feature
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
                        url: '{{ route('whyChooseUsSave') }}',
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
            errorMessage("Something went wrong. Code 202");
        }
    }

    // Handle form submit via AJAX
    $(document).ready(function() {
        $("#whyChooseUsForm").on("submit", function() {
            var form = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route('whyChooseUsSave') }}',
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

        // When icon file is chosen, show preview
        $("#icon").on("change", function() {
            let input = this;
            if(input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#icon-preview').html('<img src="'+e.target.result+'" alt="Icon Preview" style="max-width:70px;">');
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
@include('Dashboard.include.dataTablesScript')
@endsection
