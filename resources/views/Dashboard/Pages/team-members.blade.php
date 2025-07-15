@extends('layouts.dashboardLayout')
@section('title', 'Team Members')
@section('content')

<x-content-div heading="Manage Team Members">
    <x-card-element header="Add / Edit Team Member">
        <x-form-element method="POST" enctype="multipart/form-data" id="teamMemberForm" action="javascript:">
            <x-input type="hidden" name="id" id="id" value="" />
            <x-input type="hidden" name="action" id="action" value="insert" />

            {{-- Image upload --}}
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image (PNG, JPG, etc.)</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                <div id="image-preview" class="mt-2"></div>
            </div>

            {{-- Name --}}
            <x-input-with-label-element 
                id="name" 
                label="Name"
                name="name"
                required
            ></x-input-with-label-element>

            {{-- Designation --}}
            <x-input-with-label-element 
                id="designation" 
                label="Designation"
                name="designation"
                required
            ></x-input-with-label-element>

            {{-- Short Description --}}
            <x-input-with-label-element 
                id="short_description" 
                label="Short Description" 
                name="short_description" 
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

    <x-card-element header="Team Members List">
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
                url: "{{ route('teamMemberData') }}",
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: "DT_RowIndex", orderable: false, searchable: false, title: "Sr.No." },
                { data: "id", name: "id", visible: false },
                { 
                    data: "image",
                    render: function(data) {
                        return data ? '<img src="' + data + '" class="img-thumbnail" style="max-width:48px;">' : '';
                    },
                    orderable: false, searchable: false, title: "Image"
                },
                { data: "name", name: "name", title: 'Name' },
                { data: "designation", name: "designation", title: 'Designation' },
                { data: "short_description", name: "short_description", title: 'Short Description' },
                { data: "status", name: "status", title: 'Status' },
                { data: "sorting", name: "sorting", title: 'Sorting' },
                { data: 'action', name: 'action', orderable: false, searchable: false, title: 'Action' },
            ],
            order: [[1, "asc"]]
        });
    });

    // When editing, fill fields and show image preview
    $(document).on("click", ".edit", function() {
        let row = $.parseJSON(atob($(this).data("row")));
        if (row['id']) {
            $("#id").val(row['id']);
            $("#image").attr("required", false);
            $("#name").val(row['name']);
            $("#designation").val(row['designation']);
            $("#short_description").val(row['short_description']);
            $("#status").val(row['status']);
            $("#sorting").val(row['sorting']);
            $("#action").val("update");

            if (row['image']) {
                $("#image-preview").html('<img src="' + row['image'] + '" alt="Current Image" style="max-width: 70px;" class="mb-2">');
            } else {
                $("#image-preview").html('');
            }
            scrollToDiv();
        } else {
            errorMessage("Something went wrong. Code 201");
        }
    });

    function Disable(id) {
        changeAction(id, "disable", "This member will be disabled!", "Yes, disable it!");
    }

    function Enable(id) {
        changeAction(id, "enable", "This member will be enabled!", "Yes, enable it!");
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
                        url: '{{ route('teamMemberSave') }}',
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

    // Form submit with image
    $(document).ready(function() {
        $("#teamMemberForm").on("submit", function() {
            var form = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route('teamMemberSave') }}',
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

        // Image preview
        $("#image").on("change", function() {
            let input = this;
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').html('<img src="'+e.target.result+'" alt="Image Preview" style="max-width:70px;">');
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
@include('Dashboard.include.dataTablesScript')
@endsection
