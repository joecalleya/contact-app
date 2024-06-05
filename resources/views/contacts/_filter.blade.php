<div class="card-body">
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6">
        <form>
            <div class="row">
                <div class="col">
                  @include('contacts._select')
                </div>
                <div class="col">
                  <div class="input-group mb-3">
                    {{-- this will add search to url --}}
                    <input type="text" class="form-control" value="{{request()->query('search')}}" id='search-input' name='search' placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
                    <div class="input-group-append">
                      @if(request()->filled('search') || request()->filled('company_id'))
                        <button class="btn btn-outline-secondary" type="button"
                        onclick="document.getElementById('search-input').value = '',
                                 document.getElementById('search-select').selectedIndex = 0,
                                 this.form.submit() ">
                            <i class="fa fa-refresh"></i>
                          </button>
                      @endif
                      <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
        </form>
      </div>
    </div>
