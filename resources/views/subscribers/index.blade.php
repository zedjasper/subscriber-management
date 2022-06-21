@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Subscribers</h5>

                <table id="datatable" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>State</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var table = $('#datatable').DataTable({
            pageLength: 50,
            lengthChange: false,
            processing: true,
            serverSide: true,
            ajax: "/subscribers/ajax",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email', },
                { data: 'state' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[1, 'asc']],
            language: {
                paginate: {
                    previous: 'Previous',
                    next: 'Next'
                }
            }
        });
    });
</script>
@endsection