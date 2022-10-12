@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Frequently Asked </span> Questions</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <!-- <h5 class="card-header">Data</h5> -->
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <div class="row"> 
                        
                        @foreach ($FaqInfo as $item)
                          <div class="col-lg-4 col-md-3 col-sm-12">

                            {{-- Faq Coloumn Ends here --}}
                            <div class="accordion mt-3" id="accordionExample">
                              <div class="card accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                  <button
                                  type="button"
                                  class="accordion-button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionOne{{ $item->id }}"
                                  aria-expanded="true"
                                  aria-controls="accordionOne"
                                  >
                                  {{ $item->question }}
                                  </button>
                              </h2>

                              <div
                                  id="accordionOne{{ $item->id }}"
                                  class="accordion-collapse collapse"
                                  data-bs-parent="#accordionExample"
                              >
                                  <div class="accordion-body">
                                    {{ $item->answer }}
                                  </div>
                              </div>
                              </div>
                            </div>
                         
                          {{-- Faq Coloumn Ends here --}}
                        </div>
                            @endforeach
                          
                      </div>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
              </div>
            </div>
@endsection