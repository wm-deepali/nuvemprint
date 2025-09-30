<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--favicon-->
  <link rel="icon" href="{{ URL::asset('assets/images/favicon-32x32.png') }}" type="image/png" />

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="description" content="Nuvem Print">
  <meta name="keywords" content="Nuvem Print">
  @stack('before-styles')

  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @stack('after-styles')
</head>

<body>
  @include('layouts.includes.header')


  @yield('content')

  @include('layouts.includes.footer')
  @yield('footer')

  @stack('after-scripts')
  <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const select = document.getElementById("countrySelect");
    const options = select.querySelector(".options");
    const selected = select.querySelector("span");

    select.addEventListener("click", () => {
      options.style.display = options.style.display === "block" ? "none" : "block";
    });

    options.querySelectorAll(".option").forEach(opt => {
      opt.addEventListener("click", () => {
        selected.innerHTML = opt.innerHTML;
        options.style.display = "none";
      });
    });

    document.addEventListener("click", (e) => {
      if (!select.contains(e.target)) {
        options.style.display = "none";
      }
    });
  </script>

  <script>
    const tabButtons = document.querySelectorAll('.tab-button');
    const contents = document.querySelectorAll('.content-wrapper');

    tabButtons.forEach(button => {
      button.addEventListener('click', () => {
        const tabId = button.getAttribute('data-tab');

        // Remove active class from all buttons and contents
        tabButtons.forEach(btn => btn.classList.remove('active'));
        contents.forEach(content => content.classList.remove('active'));

        // Add active class to clicked button and corresponding content
        button.classList.add('active');
        document.getElementById(tabId + '-content').classList.add('active');
      });
    });
  </script>
  <script>
    const navLinks = document.querySelectorAll(".main-nav .nav-link");
    const megaMenu = document.querySelector(".mega-dropdown");
    const leftItems = document.querySelectorAll(".dropdown-left li");
    const rightContents = document.querySelectorAll(".dropdown-right .content");

    let isMenuOpen = false;

    // Top menu click → open mega menu
    navLinks.forEach(link => {
      link.addEventListener("click", e => {
        e.preventDefault();
        let target = link.getAttribute("data-menu");

        // Toggle open/close
        if (isMenuOpen && megaMenu.dataset.active === target) {
          megaMenu.style.display = "none";
          isMenuOpen = false;
          return;
        }

        megaMenu.style.display = "flex";
        megaMenu.dataset.active = target;
        isMenuOpen = true;

        // left side active set (only on click)
        leftItems.forEach(li => li.classList.remove("active"));
        const leftTarget = document.querySelector(`.dropdown-left li[data-target="${target}"]`);
        if (leftTarget) leftTarget.classList.add("active");

        // right content show
        rightContents.forEach(c => c.style.display = "none");
        document.getElementById(target).style.display = "block";
      });
    });

    // Left side click → update right content
    leftItems.forEach(li => {
      li.addEventListener("click", () => {
        leftItems.forEach(x => x.classList.remove("active"));
        li.classList.add("active");

        let target = li.getAttribute("data-target");
        rightContents.forEach(c => c.style.display = "none");
        document.getElementById(target).style.display = "block";
      });
    });

    // Outside click → close mega menu
    document.addEventListener("click", e => {
      if (!e.target.closest(".main-nav") && !e.target.closest(".mega-dropdown")) {
        megaMenu.style.display = "none";
        isMenuOpen = false;
      }
    });
    // Ensure menu is hidden initially
    document.addEventListener("DOMContentLoaded", () => {
      megaMenu.style.display = "none";
      isMenuOpen = false;
    });

  </script>
</body>

</html>