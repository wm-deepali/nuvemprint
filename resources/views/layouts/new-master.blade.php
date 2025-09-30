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
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    let currentIndex = 0;
    const totalSlides = slides.length / 2; // Original slides count

    function updateSlider() {
      const offset = -currentIndex * 33.33;
      slider.style.transform = `translateX(${offset}%)`;
      // Reset to cloned slides when reaching the end
      if (currentIndex >= totalSlides) {
        setTimeout(() => {
          slider.style.transition = 'none';
          currentIndex = 0;
          slider.style.transform = `translateX(0)`;
          setTimeout(() => {
            slider.style.transition = 'transform 0.5s ease';
          }, 50);
        }, 500);
      }
      // Reset to original slides when going backward from start
      if (currentIndex < 0) {
        setTimeout(() => {
          slider.style.transition = 'none';
          currentIndex = totalSlides - 1;
          slider.style.transform = `translateX(${-(currentIndex * 33.33)}%)`;
          setTimeout(() => {
            slider.style.transition = 'transform 0.5s ease';
          }, 50);
        }, 500);
      }
    }

    nextBtn.addEventListener('click', () => {
      currentIndex++;
      updateSlider();
    });

    prevBtn.addEventListener('click', () => {
      currentIndex--;
      updateSlider();
    });

    // Auto slide every 5 seconds
    let autoSlide = setInterval(() => {
      currentIndex++;
      updateSlider();
    }, 5000);

    // Pause on hover
    sliderContainer.addEventListener('mouseover', () => clearInterval(autoSlide));
    sliderContainer.addEventListener('mouseout', () => {
      autoSlide = setInterval(() => {
        currentIndex++;
        updateSlider();
      }, 5000);
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

</body>

</html>