@extends('Layouts.LandingLayout')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Generation Data</h3>
    </div>
    <div class="card-body">
        <span>
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            @if ($errors->any())
        </span>
        <small>
            <div class="text-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </small>
        <ul class="nav nav-pills" id="myTab3" role="tablist">
            <li class="nav-item mr-2">
                <a class="nav-link active show" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                    aria-controls="home" aria-selected="true">Table</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                    aria-controls="profile" aria-selected="false">Input</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent2">
            <div class="tab-pane fade active show" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                <div class="card-body">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="tabel-generation" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Generation</th>
                                        <th>Years</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Generation</th>
                                        <th>Years</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                <div class="card">
                    <div class="card-header">
                        <h4>Input New Data</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('generation.store')}}" class="wizard-content mt-2">
                            @csrf
                            <div class="wizard-pane">
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left">Generation</label>
                                    <div class="col-lg-4 col-md-6">
                                        <input type="text" name="generation" class="form-control" required
                                            placeholder="Insert Text Here!">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left">Years</label>
                                    <div class="col-lg-4 col-md-6">
                                        <input type="text" name="years" class="form-control" required
                                            placeholder="Insert Text Here!">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4"></div>
                                    <div class="col-lg-4 col-md-6 text-left">
                                        <button id="save-data" class="btn btn-icon icon-right btn-primary">Save <i
                                                class="fas fa-save"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel-generation').DataTable( {
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{route('generation.ajax')}}",
        columns: [
            
            {data:'generation', name:'generation'},
            {data:'years', name:'years'},
            {data:'created_at', name:'created_at'},
            {data:'updated_at', name:'updated_at'},
            {data: 'action', name: 'action'},
            ],
        order:[[0,'asc']]
        });

        $('#save-data').click(function()
        {
            Swal.fire({
            icon: 'success',
            title: 'Yeay',
            text: 'Send data success!'
            }) 
        });
    });
</script>
@endsection