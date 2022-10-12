@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Airtime</span> Pricing</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <!-- <h5 class="card-header">Data</h5> -->
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <div class="row"> 
                          <div class="col-lg-4 col-md-6 col-sm-12">
                          <div class="accordion mt-3" id="accordionExample">
                                <div class="card accordion-item active">
                                <h2 class="accordion-header" id="headingOne">
                                    <button
                                    type="button"
                                    class="accordion-button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#accordionOne"
                                    aria-expanded="true"
                                    aria-controls="accordionOne"
                                    >
                                    Accordion Item 1
                                    </button>
                                </h2>

                                <div
                                    id="accordionOne"
                                    class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample"
                                >
                                    <div class="accordion-body">
                                    Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing
                                    marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping
                                    soufflé. Wafer gummi bears marshmallow pastry pie.
                                    </div>
                                </div>
                                </div>
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