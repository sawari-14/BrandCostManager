<x-app-layout>
    <style>
    .link-item{
      text-decoration:none;
    }
    .link-item:hover{
      background-color:#d3d3d3;
    }
  </style>
    <div class="container mt-2">
        <p class="h6" style="color:#696969;">< 管理者としてログインしています ></p>
    </div>
    <div class="container py-5 mt-5" style="max-width: 600px;">
      <div class="p-3 rounded-3 border center-block" style="background-color: #f5f5f5">
          <div class="container-fluid py-2 text-center">
              <h4 style="color:#696969;">Management</h5>
              <h1 class="display-6"></h1>
              <div class="container d-flex justify-content-evenly mt-3">
                    <a href="/manage_users" class="container text-center rounded border pt-4 mx-3 link-item">
                      <p class="h4 mb-4">users</p>
                    </a>
                    <a href="/manage_items" class="container rounded border pt-4 mx-3 link-item">
                        <p class="h4 mb-4">items</p>
                    </a>
                    <a href="/manage_costs" class="container rounded border pt-4 mx-3 link-item">
                        <p class="h4 mb-4">costs</p>
                    </a>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>