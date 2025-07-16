
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-brand-center"
  data-nav="brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="<?php echo e(url('admin/home')); ?>">
          <span class="brand-logo">
            <?php if(\Auth::user()->logo_img): ?>
        <img src="<?php echo e(asset('images/logo/' . \Auth::user()->logo_img)); ?>" alt="">
      <?php else: ?>
        <img src="<?php echo e(asset('admin_assets')); ?>/images/logo.png" alt="">
      <?php endif; ?>
          </span>
        </a>
      </li>
    </ul>
  </div>
  <div class="navbar-container d-flex content align-items-center">
    <div class="bookmark-wrapper d-flex align-items-center">
      <ul class="nav navbar-nav d-xl-none">
        <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
              data-feather="menu"></i></a></li>
      </ul>
    </div>
    <ul class="nav navbar-nav align-items-center ml-auto">
      <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
            data-feather="search"></i></a>
        <div class="search-input">
          <div class="search-input-icon"><i data-feather="search"></i></div>
          <input class="form-control input" type="text" placeholder="Search..." tabindex="-1" data-search="search">
          <div class="search-input-close"><i data-feather="x"></i></div>
          <ul class="search-list search-list-main"></ul>
        </div>
      </li>



      <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="user-nav d-sm-flex d-none">
            <span class="user-name font-weight-bolder"><?php echo e(\Auth::user()->name); ?></span>
            <span class="user-status"><?php echo e(ucfirst(\Auth::user()->username)); ?></span>
          </div>
          <span class="avatar">
            <?php if(\Auth::user()->profile_img): ?>
        <img class="round" src="<?php echo e(asset('images/profiles/' . \Auth::user()->profile_img)); ?>" alt="Robert Downey"
          height="40" width="40">
      <?php else: ?>
        <img class="round" src="<?php echo e(asset('admin_assets')); ?>/images/admin-profile.png" alt="Robert Downey"
          height="40" width="40">
      <?php endif; ?>
            <span class="avatar-status-online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
          <a class="dropdown-item" href="<?php echo e(route('profile.show')); ?>"><i class="mr-50" data-feather="user"></i>
            Profile</a>
          <a class="dropdown-item" href="<?php echo e(route('profile.setting')); ?>"><i class="mr-50" data-feather="settings"></i>
            Settings</a>
          <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"><i class="mr-50"
              data-feather="power"></i>
            <?php echo e(__('Logout')); ?>

          </a>

          <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="horizontal-menu-wrapper">
  <div
    class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border"
    role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto">
          <a class="navbar-brand" href="index.html">
            <span class="brand-logo">
              <img src="<?php echo e(asset('admin_assets')); ?>/images/logo.png" alt="">
            </span>
          </a>
        </li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
              class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="navbar-container main-menu-content" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item active"><a class="nav-link d-flex align-items-center"
            href="<?php echo e(route('home')); ?>"><span>Dashboard</span></a></li>
        <!--li class="nav-item"><a class="nav-link d-flex align-items-center" href="<?php echo e(route('slider.index')); ?>"><span>Slider</span></a></li-->
        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Products Catalogue</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.manage-categories.index')); ?>"><span>Categories</span></a></li>

            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.manage-subcategories.index')); ?>"><span>Subcategories</span></a></li>

            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.attributes.index')); ?>"><span>Attributes</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.attribute-groups.index')); ?>"><span>Attribute Groups</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.attribute-values.index')); ?>"><span>Attribute Values</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.subcategory-attributes.index')); ?>"><span>Attribute Mapping</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.group-assignments.index')); ?>"><span>Group Assignments</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.attribute-conditions.index')); ?>"><span>Attribute Conditions</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.pricing-rules.index')); ?>"><span>Pricing Rules
                </span></a></li>
          </ul>
        </li>
         <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Customer & Orders</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class=" dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.customers')); ?>"><span> Customers</span></a>
            </li>
              <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.quote.request')); ?>"><span> Quote Request</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.quote.request')); ?>"><span> Orders</span></a>
            </li>
          </ul>
        </li>
         <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Content Management</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class=" dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.content.blogs')); ?>"><span>Manage Blogs</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.content.faq')); ?>"><span>Manage FAQ</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.content.dynamic.pages')); ?>"><span>Dynamic Page Creations</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.content.manage.page.content')); ?>"><span>Manage Page Content</span></a>
            </li>
          </ul>
        </li>

        <!--<li class="dropdown nav-item" data-menu="dropdown">-->
        <!--  <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">-->
        <!--    <span>Book Options</span>-->
        <!--  </a>-->
        <!--  <ul class="dropdown-menu">-->
        <!--    <li><a class=" dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-book-type.index')); ?>"><span>Manage Book Type</span></a></li>-->
        <!--    <li><a class=" dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-print-colour.index')); ?>"><span>Manage Page Printing Colour</span></a>-->
        <!--    </li>-->
        <!--    <li><a class="dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-orientation.index')); ?>"><span>Manage Orientation</span></a></li>-->
        <!--    <li><a class="dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-paper-size.index')); ?>"><span>Manage Paper Size</span></a></li>-->
        <!--    <li><a class="dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-paper-type.index')); ?>"><span>Manage Paper Type</span></a></li>-->
        <!--    <li><a class=" dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-paper-weight.index')); ?>"><span>Manage Paper Weight</span></a></li>-->
        <!--    <li><a class="dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-binding.index')); ?>"><span>Manage Binding</span></a></li>-->
        <!--  </ul>-->
        <!--</li>-->

        <!--<li class="dropdown nav-item" data-menu="dropdown">-->
        <!--  <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">-->
        <!--    <span>Cover Options</span>-->
        <!--  </a>-->
        <!--  <ul class="dropdown-menu">-->
        <!--    <li><a class=" dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-cover-type.index')); ?>"><span>Manage Cover Type</span></a></li>-->
        <!--    <li><a class=" dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-cover-weight.index')); ?>"><span>Manage Cover Weight</span></a></li>-->
        <!--    <li><a class=" dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-cover-print-colour.index')); ?>"><span>Manage Cover Printing-->
        <!--          Colour</span></a></li>-->
        <!--    <li><a class="dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-cover-finish.index')); ?>"><span>Manage Cover Finish</span></a></li>-->
        <!--    <li><a class=" dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-endpaper-colour.index')); ?>"><span>Choose Endpaper Colour</span></a></li>-->
        <!--    <li><a class="dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-cover-foiling.index')); ?>"><span>Manage Cover Foiling</span></a></li>-->
        <!--  </ul>-->
        <!--</li>-->

        <!--<li class="dropdown nav-item" data-menu="dropdown">-->
        <!--  <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">-->
        <!--    <span>Dust Options</span>-->
        <!--  </a>-->
        <!--  <ul class="dropdown-menu">-->
        <!--    <li><a class=" dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-dust-jacket-colour.index')); ?>"><span>Manage Dust Jacket Colour</span></a>-->
        <!--    </li>-->
        <!--    <li><a class="dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-dust-jacket-finish.index')); ?>"><span>Manage Dust Jacket Finish</span></a>-->
        <!--    </li>-->
        <!--  </ul>-->
        <!--</li>-->

        <!--<li class="dropdown nav-item" data-menu="dropdown">-->
        <!--  <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">-->
        <!--    <span>Other Options</span>-->
        <!--  </a>-->
        <!--  <ul class="dropdown-menu">-->
        <!--    <li><a class=" dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-bookmark-ribbon.index')); ?>"><span>Manage BookMark Ribbon</span></a>-->
        <!--    </li>-->
        <!--    <li><a class="dropdown-item d-flex align-items-center"-->
        <!--        href="<?php echo e(route('admin.manage-head-tail-band.index')); ?>"><span>Manage Head and Tail Band</span></a>-->
        <!--    </li>-->
        <!--  </ul>-->
        <!--</li>-->

        <!--<li class="dropdown nav-item" data-menu="dropdown">-->
        <!--  <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">-->
        <!--    <span>Pricing Rules</span>-->
        <!--  </a>-->
        <!--  <ul class="dropdown-menu">-->
        <!--    <li>-->
        <!--      <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.pricing-rules.index')); ?>">-->
        <!--        <span>Pricing Rules</span>-->
        <!--      </a>-->
        <!--    </li>-->
        <!--    <li>-->
        <!--      <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.quotes.index')); ?>">-->
        <!--        <span>View Quote Request</span>-->
        <!--      </a>-->
        <!--    </li>-->

        <!--  </ul>-->

        <!--</li>-->

        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="<?php echo e(route('admin.manage.department')); ?>">
            <span>Manage Departments</span>
          </a>
        </li>

      </ul>
    </div>
  </div>
</div><?php /**PATH /home/tpmhelpinghand/public_html/nuvem.tpmhelpinghand.com/resources/views/partials/header.blade.php ENDPATH**/ ?>