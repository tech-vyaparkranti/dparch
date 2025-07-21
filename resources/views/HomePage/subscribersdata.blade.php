@extends('layouts.dashboardLayout')
@section('title', 'Newsletter Subscribers')

@section('content')
<x-content-div heading="Newsletter Subscriptions">
    <x-card-element header="Subscribers List">
        <x-data-table></x-data-table>
    </x-card-element>
</x-content-div>
@endsection

@section('script')
<script type="text/javascript">
    let table = "";
    $(function () {
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: {
                url: "{{ route('admin.subscribers.data') }}",
                type: "POST",
                data: {
                    '_token': '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', title: "Sr.No." },
                { data: 'email', name: 'email', title: 'Email' },
                { data: 'created_at', name: 'created_at', title: 'Subscribed At' },
            ],
            order: [[2, "desc"]]
        });
    });
</script>
@include('Dashboard.include.dataTablesScript')
@endsection
