   <body data-layout="horizontal" data-topbar="dark">

     <!-- Begin page -->
     <div id="wrapper">

       <!-- Navigation Bar-->
       <header id="topnav">

         <!-- Topbar Start -->
         <div class="navbar-custom">
           <div class="container-fluid">
             <ul class="list-unstyled topnav-menu float-right mb-0">

               <li class="dropdown notification-list">
                 <!-- Mobile menu toggle-->
                 <a class="navbar-toggle nav-link">
                   <div class="lines">
                     <span></span>
                     <span></span>
                     <span></span>
                   </div>
                 </a>
                 <!-- End mobile menu toggle-->
               </li>
               <li class="dropdown notification-list">
                 <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown"
                 href="#" role="button" aria-haspopup="false" aria-expanded="false">
                 <img src="<?= base_url() ?>assets\images\users\profile2.png" alt="user-image"
                 class="rounded-circle">
                 <span class="pro-user-name ml-1">
                   <?= $admin->fullname; ?> <i class="mdi mdi-chevron-down"></i>
                 </span>
               </a>
               <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                 <!-- item-->
                 <div class="dropdown-header noti-title">
                   <h6 class="text-overflow m-0">Welcome !</h6>
                 </div>



                 <div class="dropdown-divider"></div>

                 <!-- item-->
                 <a href="logout" class="dropdown-item notify-item">
                   <i class="fe-log-out"></i>
                   <span>Logout</span>
                 </a>

               </div>
             </li>

             <li class="dropdown notification-list">
               <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">
                 <i class="fe-settings noti-icon"></i>
               </a>
             </li>

           </ul>

           <!-- LOGO -->
           <div class="logo-box">
             <a href="/" class="logo logo-light">
               <span class="logo-lg">
                 <img src="<?= base_url() ?>assets\images\shopee-logo.png" alt="shopee-logo" height="50">
               </span>
               <span class="logo-sm">
                 <img src="<?= base_url() ?>assets\images\shopee-logo.png" alt="shopee-logo" height="50">
               </span>
             </a>

           </div>

           <div class="clearfix"></div>
         </div> <!-- end container-fluid-->
       </div>


     </header>