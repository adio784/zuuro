                    {{-- Modal IMPORT --}}
                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Input PIN</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                 <form id="formAccountSettings" method="POST" action="/importExcel" enctype="multipart/form-data">
                                    @csrf
                                      <!-- Result  -->
                                      <div id="error_result">
                                        @if(Session::get('csv_success'))
                                            <div class="alert alert-success alert-dismissible fade show text-dark" role="alert">
                                                <strong>Success!</strong> {{ Session::get('success') }}
                                            </div>
                                        @endif
                                        @if(Session::get('csv_fail'))
                                        <div class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                                            <strong>Oh Oops!</strong> {{ Session::get('fail') }}
                                        </div>
                                        @endif
                                    </div>
                                      <div class="row ">
                                        <div class="mb-3 col-md-12">
                                          <label class="form-label" for="ads_file">Upload</label>
                                          <small>Upload csv file of your custom price here ...</small>
                                          <div class="input-group input-group-merge">
                                          <span id="ads_file" class="input-group-text"><i class="bx bx-file"></i></span>
                                          <input type="file" id="ads_file" class="form-control phone-mask" 
                                                aria-describedby="basic-icon-default-phone2"
                                                name="pricing_file">
                                          </div>
                                          @error('pricing_file') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                                      </div>
                                      
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary m-2" >
                                            Proceed
                                        </button>
                                    </div>

                                  </form>
                              </div>
                            </div>
                        </div>
                    </div>
                 