<x-app-layout>
  <style>
    .link-item{
      text-decoration:none;
    }
    .link-item:hover{
      background-color:#d3d3d3;
    }
  </style>
  <div class="container py-2" style="max-width: 500px;">
      <div class="p-2 rounded-3 border center-block" style="background-color: #f5f5f5">
          <div class="container-fluid py-2 text-center">
              <h5 style="color:#696969;">your brand</h5>
              <h1 class="display-6">{{ $user['brand_name'] }}</h1>
              <a href="{{ route('edit_brand') }}" class="btn btn-outline-primary">変更</a>
              <div class="container d-flex justify-content-evenly mt-3">
                    <a href="{{ route('item_manage') }}" class="container text-center rounded border pt-4 mx-3 link-item">
                      <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-bag text-primary" viewBox="0 0 16 16" style="display:inline;">
                          <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg>
                      </div>
                      <p class="h4 m-1">items</p>
                    </a>
                    <a href="{{ route('cost_manage') }}" class="container rounded border pt-4 mx-3 link-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-cash-coin text-primary" viewBox="0 0 16 16" style="display:inline;">
                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                        </svg>
                        <p class="h4 m-1">costs</p>
                    </a>
              </div>
          </div>
      </div>
  </div>

  <div class="container border-top">
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center d-flex justify-content-center mt-3">
        <div class="col">
          <div class="card mb-4 rounded-3">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">今年の総経費</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">￥{{ $sum }}</h1>
              <a href="{{ route('cost_detail') }}" class="w-50 btn btn-primary">詳細</a>
            </div>
          </div>
        </div>
      </div>
  </div>
</x-app-layout>



