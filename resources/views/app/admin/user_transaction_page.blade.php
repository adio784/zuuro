@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaction / </span> </h4>

        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
            <!-- <h5 class="card-header">Data</h5> -->
            <!-- Data -->
            
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row"> 
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive text-wrap">
                            <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Transaction ID</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Number</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($UserInfo as $user)
                      <?php $i++ ?>
                      <tr>
                        <td>{{ $i }}</td>
                        <td>
                          <i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $user->name }}</strong>
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->TransferRef }}</td>
                        <td>
                          <a href="tel:{{ $user->TransactionType }}" class="nav_link"> {{ $user->TransactionType }}</a>
                        </td>
                        <td><a href="mailto:{{ $user->Price }}"><span class="badge bg-label-primary me-1">{{ $user->Price }}</span></a></td>
                        <td> Successful </td>
                        <td> {{ $user->AccountNumber }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /Account -->
            </div>
            
          </div>
        </div>
</div>
@endsection