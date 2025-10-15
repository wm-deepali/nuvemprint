@extends('layouts.new-master')

@section('title')
  Nuvem Prints - Contact Us
@endsection

@section('content')
  <!--start page wrapper -->
  <div class="page-wrapper">
    <div class="page-content">
      <!--start breadcrumb-->
      <section class="py-3 border-bottom d-none d-md-flex">
        <div class="container">
          <div class="page-breadcrumb d-flex align-items-center">
            <h3 class="breadcrumb-title pe-3">Contact Us</h3>
            <div class="ms-auto">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i> Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <!--end breadcrumb-->

      @php
        use App\Models\ContactInfo;
        $contactFooter = ContactInfo::first();
        $address = $contactFooter->full_address ?? "Unit 7 Lotherton Way Garforth Leeds LS252JY";
        $mapUrl = "https://maps.google.com/maps?q=" . urlencode($address) . "&t=m&z=16&output=embed&iwloc=near";
      @endphp

      <section class="py-5">
        <div class="container">
          <div class="row">
            <!-- Map -->
            <div class="col-md-6 mb-4">
              <div class="rounded shadow-sm overflow-hidden">
                <iframe src="{{ $mapUrl }}" class="w-100" height="400" style="border:0;" allowfullscreen
                  loading="lazy"></iframe>
              </div>
              <!-- <div class="p-3 bg-light rounded ">-->
              <!--  <h5 class="mb-3">Contact Information</h5>-->
              <!--  <p><strong>Address:</strong><br>{{ $contactFooter->full_address ?? 'Unit 7 Lotherton Way Garforth Leeds LS252JY' }}</p>-->
              <!--  <p><strong>Phone:</strong><br>{{ $contactFooter->contact_number ?? '01132 874724' }}</p>-->
              <!--  <p><strong>Email:</strong><br>{{ $contactFooter->email ?? 'andy@nuvemprint.com' }}</p>-->
              <!--  <p><strong>Working Hours:</strong><br>Mon - Sat / 9:00 AM - 6:00 PM</p>-->
              <!--</div>-->
            </div>

            <!-- Contact Info + Form -->
            <div class="col-md-6 bg-light rounded ">
              <div class="mb-4 ">
                <h4 class="mb-3 text-uppercase">Get in Touch</h4>
                <p>
                  <strong>Address:</strong><br>{{ $contactFooter->full_address ?? 'Unit 7 Lotherton Way Garforth Leeds LS252JY' }}
                </p>
                <p><strong>Phone:</strong><br>{{ $contactFooter->contact_number ?? '01132 874724' }}</p>
                <p><strong>Email:</strong><br>{{ $contactFooter->email ?? 'andy@nuvemprint.com' }}</p>
                <p><strong>Working Hours:</strong><br>Mon - Sat / 9:00 AM - 6:00 PM</p>
              </div>

              <form id="contact-form" method="POST" action="{{ route('contact.submit') }}">
                @csrf
                <div id="form-message"></div>

                <div class="mb-3">
                  <label class="form-label">Your Name</label>
                  <input type="text" name="name" class="form-control" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Your Email</label>
                  <input type="email" name="email" class="form-control" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Subject</label>
                  <input type="text" name="subject" class="form-control" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Message</label>
                  <textarea name="message" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                  <button type="submit" id="submit-btn" class="btn btn-primary">Send Message</button>
                </div>
              </form>

              <script>
                document.getElementById('contact-form').addEventListener('submit', function (e) {
                  e.preventDefault(); // Prevent normal form submission

                  const form = this;
                  const submitBtn = document.getElementById('submit-btn');
                  submitBtn.disabled = true; // disable button immediately
                  submitBtn.innerText = 'Sending...';

                  const formData = new FormData(form);

                  fetch(form.action, {
                    method: 'POST',
                    headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}',
                      'Accept': 'application/json',
                    },
                    body: formData
                  })
                    .then(response => response.json())
                    .then(data => {
                      if (data.success) {
                        document.getElementById('form-message').innerHTML =
                          `<div class="alert alert-success">${data.message}</div>`;
                        form.reset();
                      } else {
                        document.getElementById('form-message').innerHTML =
                          `<div class="alert alert-danger">${data.message || 'Something went wrong'}</div>`;
                      }
                      submitBtn.disabled = false;
                      submitBtn.innerText = 'Send Message';
                    })
                    .catch(error => {
                      console.error(error);
                      document.getElementById('form-message').innerHTML =
                        `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
                      submitBtn.disabled = false;
                      submitBtn.innerText = 'Send Message';
                    });
                });
              </script>



            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!--end page wrapper -->
@endsection