@extends('app.admin.admin_layout')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">QoinCo Pricing/ </span> MANAGE</h4>

    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
          <li class="nav-item">
            <a class="nav-link " href="{{ route('set_pricing_page') }}"><i class="bx bx-user me-1"></i> SET PRICE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> MANAGE PRICE</a>
          </li>
        </ul>
        <div class="card mb-4">
          <h5 class="card-header">Pricing . . .</h5>
          <!-- Account -->
            <div class="card-body">
              <hr class="my-0" />
            <!-- Result  -->


            <table class="table" id="table_id">
              <thead>
                  <tr>
                    <th>#</th>
                    <th>Data Quantity</th>
                    <th>Network</th>
                    <th>Data Price</th>
                    <th>Duraction</th>
                    <th>Interest</th>
                    <th>Payment period</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($PriceInfo as $pric)
                    <?php $i++ ?>
                      <tr>
                        <td>{{ $i }}</td>
                        <td>
                          <i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $pric->data_quant }}</strong>
                        </td>
                        <td>{{ $pric->display_text }}</td>
                        <td> {{ $pric->data_price }}</td>
                        <td><a ><span class="badge bg-primary me-1">{{ $pric->duration }}</span></a></td>
                        <td><span class="badge bg-success"> {{ $pric->interest }} </span></td>
                        <td><span class="badge bg-success"> {{ $pric->payment_period }} {{ $pric->dataID }} </span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              @if($pric->data_quant == 0)
                              <a class="dropdown-item" href="manage_pricing_page/{{ $pric->dataID }}" onclick="return confirm('Are you sure to disable this user?')"
                                ><i class="bx bx-trash me-2"></i> Disable</a
                              >@endif
                              @if($pric->data_quant == 1)
                              <a class="dropdown-item" href="manage_pricing_page/{{ $pric->dataID }}" onclick="return confirm('Are you sure to reactivate this user?')"
                                ><i class="bx bx-user-pin me-2"></i> Activate</a
                              >@endif 
                              <a class="dropdown-item" href="manage_pricing_page/{{ $pric->dataID }}" onclick="return confirm('Are you sure to delete ?')">
                              <i class="bx bx-trash me-2"></i> Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
          <!-- /Account -->
        </div>
        
      </div>
    </div>
  </div>

@endsection