 <nav class="navbar navbar-expand navbar-light navbar-top" aria-label="navbar-top">
     <div class="container-fluid">
         <a href="#" class="burger-btn d-block">
             <i class="bi bi-justify fs-3"></i>
         </a>

         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
             aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav ms-auto mb-lg-0">

             </ul>
             <div class="dropdown">
                 <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                     <div class="user-menu d-flex">
                         <div class="user-name text-end me-3">
                             <h6 class="mb-0 text-gray-600">{{ auth()->user()->email }}</h6>
                             <p class="mb-0 text-sm text-gray-600 text-capitalize">{{ auth()->user()->role }}</p>
                         </div>
                         <div class="user-img d-flex align-items-center">
                             <div class="avatar avatar-md">
                                 <img src="/assets/compiled/jpg/1.jpg" />
                             </div>
                         </div>
                     </div>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                     style="min-width: 11rem">
                     <li>
                         <h6 class="dropdown-header">Hello, John!</h6>
                     </li>
                     <li>
                         <button class="dropdown-item" type="button" id="btnChangePassword">
                             <i class="icon-mid bi bi-gear me-2"></i>
                             Ubah Password
                         </button>
                     </li>
                     <li>
                         <hr class="dropdown-divider" />
                     </li>
                     <li>
                         <a class="dropdown-item" href="{{ route('logout.index') }}"><i
                                 class="icon-mid bi bi-box-arrow-left me-2"></i>
                             Logout</a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </nav>
 @include('users.settings.change-password.modal')
