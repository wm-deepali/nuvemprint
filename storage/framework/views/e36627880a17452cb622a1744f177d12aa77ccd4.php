
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


<?php $__env->startSection('title'); ?>
    Nuvem Prints
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .page-wrapper {
            height: auto;
        }

        /* Tab Styling */
        .custom-tabs {
            display: flex;
            gap: 10px;
            /*margin-bottom: 20px;*/
        }

        /*.custom-tab {*/
        /*    padding: 10px 20px;*/
        /*    cursor: pointer;*/
        /*    background-color: #f0f0f0;*/
        /*    border-radius: 5px;*/
        /*    transition: background-color 0.3s;*/
        /*    border-bottom:none !important;*/
        /*}*/

        .custom-tab.active {
            background-color: #00aaa5;
            color: #fff;
        }

        .custom-tab-number {
            margin-right: 5px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }
        .text-areafield{
            border:2px solid #6bd3cc !important;
        col
        or:black !important;
            border-radius: .375rem !important;
        }
        textarea.text-areafield.form-control {
  color: black !important;
}


.upload-card {
  border: 2px dashed #d4d4d4;
  border-radius: 12px;
  padding: 30px 20px;
  text-align: center;
  width: 240px;
  background-color: #fff;
  cursor: pointer;
  transition: border-color 0.3s ease;
}

.upload-card:hover {
  border-color: #5a9ef8;
}

.upload-card i {
  font-size: 30px;
  color: #5a9ef8;
  margin-bottom: 10px;
}

.upload-card .title {
  font-weight: 500;
  color: #333;
  margin-bottom: 5px;
}

.upload-card .or {
  margin: 5px 0;
  font-size: 14px;
  color: #999;
}

.upload-card .browse-btn {
  background-color: #3d82f7;
  border: none;
  color: white;
  padding: 6px 16px;
  font-size: 14px;
  border-radius: 6px;
  cursor: pointer;
  margin-bottom: 10px;
}

.upload-card .file-info {
  font-size: 12px;
  color: #999;
}

.upload-box-card{
    width:100%;
    margin-top:20px;
    display:grid;
   grid-template-columns:1fr 1fr 1fr 1fr;
    gap:20px

    
}
.art-top-left-top{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    
}
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">
            <div class="page-content">
                <div class="container py-5">
                    <div class="art-top-card">
                        
                        <div class="art-top-right">

                            <section class="slider-section"
                                style="background-color: #ff4f42; padding: 30px;height: 450px;">
                                <div class="first-slider">
                                    <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="0"
                                                class="active"></li>
                                            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
                                            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="row d-flex align-items-center">
                                                    <div class="col d-none d-lg-flex justify-content-center">
                                                        <div class="">
                                                            <!-- <h3 class="h3 fw-light" style="color: #fff;">Upload, Pay & Confirm</h3> -->
                                                            <h1 class="h1" style="color: #fff;">Upload, Pay & Confirmg
                                                            </h1>
                                                            <p class="pb-3" style="color: #fff;">If you need to
                                                                rearrange or insert blank pages, do it only after all
                                                                files are uploaded.
                                                            </p>
                                                            <!-- <div class=""> <a class="btn btn-light btn-ecomm" href="javascript:;">Shop Now
												<i class='bx bx-chevron-right'></i></a>
										</div> -->
                                                        </div>
                                                    </div>
                                                    <div class="col" style="height: 400px;padding-top: 60px;">
                                                        <!-- <img src="assets/images/slider/04.png" class="img-fluid" alt="..."> -->
                                                        <!-- Image with Play Button Overlay -->
                                                        <div class="banner-slider-with position-relative text-center">
                                                            <img src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/carousel/carousel-rename.png"
                                                                class="img-fluid">

                                                            <!-- Play Button -->
                                                            <button type="button"
                                                                class="btn btn-light position-absolute top-50 start-50 translate-middle"
                                                                data-bs-toggle="modal" data-bs-target="#videoModal"
                                                                style="border-radius: 50%; width: 60px; height: 60px;">
                                                                ▶
                                                            </button>
                                                        </div>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="videoModal" tabindex="-1"
                                                            aria-labelledby="videoModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content bg-dark">
                                                                    <div class="modal-header border-0">
                                                                        <button type="button"
                                                                            class="btn-close btn-close-white"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body p-0">
                                                                        <div class="ratio ratio-16x9">
                                                                            <iframe id="videoFrame" src="" title="Video"
                                                                                allow="autoplay; encrypted-media"
                                                                                allowfullscreen></iframe>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleDark" role="button"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleDark" role="button"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                </div>

                            </section>
                        </div>
                        <div class="art-top-left" style="border:1px solid #80808069;">
                            <div class="art-top-left-top">
                                <h5>Order Quote <strong>#1234566</strong></h5>
                                <p>Dated: <strong>28th July 2025</strong></p>

                            </div>
                            <div class="art-top-left-details" >
                                <div class="d-flex justify-content-between">
                                    <h6 style="font-size:14px; font-weight:400;">Sub Total</h6>
                                    <h6 style="font-size:14px; font-weight:400;">£56</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 style="font-size:14px; font-weight:400;">Delivery Cost</h6>
                                    <h6 style="font-size:14px; font-weight:400;">£6</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 style="font-size:14px; font-weight:400;">VAT</h6>
                                    <h6 style="font-size:14px; font-weight:400;">£14</h6>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <h6>Total Payable</h6>
                                    <h6>£76</h6>
                                </div>
                             

                            </div>


                        </div>

                    </div>

                    <div class="custom-tab-container">
                        <!-- Tab Headers -->
                        <div class="custom-tabs" id="customTabs">
                            <div class="custom-tab active" data-tab="artwork">
                                <span class="custom-tab-number">1</span>
                                Artwork
                            </div>
                            <div class="custom-tab" data-tab="details">
                                <span class="custom-tab-number">2</span>
                                Details
                            </div>
                            <div class="custom-tab" data-tab="payment">
                                <span class="custom-tab-number">3</span>
                                Payment
                            </div>
                            <!-- <div class="custom-tab" data-tab="printlink">
                                <span class="custom-tab-number">4</span>
                                PrintLink
                            </div> -->
                            
                        </div>

                        <!-- Tab Contents -->
                        <div class="custom-tab-content">
                            <div class="tab-pane active" id="artwork">
                                <div class="tabone-section">
                                    <div>
                                        <div class="custom-art-tab-section-left">
                                            <div class="custom-art-tab-cont">
                                                <h6>Art Prints</h6>
                                                <button class="custom-art-edit-btn">✎ Edit</button>
                                            </div>

                                            <div class="custom-art-card">
                                                <div class="custom-art-item-label">Item 1</div>

                                                <div class="custom-art-field">
                                                    <label>Copies</label>
                                                    <input type="number" value="500" class="custom-art-input-box">
                                                </div>

                                                <div class="custom-art-field">
                                                    <label>Size</label>
                                                    <input type="text" value="A5 (148 mm x 210 mm)"
                                                        class="custom-art-input-box" readonly>
                                                </div>

                                                <div class="custom-art-field custom-art-gsm-options">
                                                    <label>130 <span class="custom-art-subtext">gsm paper -
                                                            Silk</span></label>
                                                    <div class="custom-art-side-options">
                                                        <button class="custom-art-side active">Front</button>
                                                        <button class="custom-art-side">Back</button>
                                                    </div>
                                                </div>

                                                <button class="custom-art-change-options">🔧 Change Options</button>

                                                <div class="custom-art-vat-row">
                                                    <input type="checkbox" checked>
                                                    <label>Add VAT (if applicable)</label>
                                                    <button class="custom-art-info-btn">Info</button>
                                                </div>

                                                <a href="#" class="custom-art-view-quote">📄 View this quote</a>

                                            </div>
                                        </div>
                                        <!--<p style="margin-top: 25px; font-size: 12px;">Drag your file(s) here or click on-->
                                        <!--    the button below to browse your device.-->
                                        <!--</p>-->
                                        <!-- <div class="custom-art-upload-buttons">
                                            <button class="custom-art-btn btn-blue" type="file">Upload File(s)</button>
                                            <button class="custom-art-btn btn-dropbox">Choose from Dropbox</button>
                                            <button class="custom-art-btn btn-link">Paste Link to Print File</button>
                                           

                                            <div class="custom-art-files-box">
                                                📁 Files
                                            </div>

                                            <div class="custom-art-filetypes-box">
                                                <h6>File Types</h6>
                                                <div class="file-tags">
                                                    <span class="tag recommended">Recommended .pdf</span>
                                                    <span class="tag">Images</span>
                                                    <span class="tag">PostScript</span>
                                                    <span class="tag">MS Office</span>
                                                    <span class="tag">OpenOffice</span>
                                                </div>
                                            </div>

                                            <div class="custom-art-instructions">
                                                <p>
                                                    If you need to upload several files, please include a number in your
                                                    file name. <br>
                                                    For example: <strong>file1.pdf, file2.pdf, file3.pdf</strong> or
                                                    <strong>page1.pdf, page2.pdf, page3.pdf</strong><br>
                                                    Those numbers will determine the order. The words ‘front’, ‘back’,
                                                    ‘last’, ‘inner’ are also accepted.
                                                </p>
                                            </div>
                                        </div> -->

                                    </div>
                                    <div class="tab-section-right">
                                        <div class="custom-art-upload-buttons">
                                            <div class="d-flex justify-content-between">

                                          <input type="file" id="real-file-input" multiple>

<!-- Custom button -->
<button class="custom-art-btn btn-blue" type="button" onclick="document.getElementById('real-file-input').click()">
  <i class="fa-solid fa-cloud-arrow-up"></i> Upload File(s)
</button>
                                            <button class="custom-art-btn btn-dropbox"><i class="fa-brands fa-dropbox"></i> Choose from Dropbox</button>
                                            <button class="custom-art-btn btn-link">Paste Link to Print File</button>
                                            <!-- <button class="custom-art-btn btn-design">Design Online</button> -->

                                            <div class="custom-art-btn custom-art-files-box">
                                                📁 Files
                                            </div>
                                            </div>

                                            <div class="custom-art-filetypes-box">
                                                <h6>File Types</h6>
                                                <div class="file-tags">
                                                    <span class="tag recommended">Recommended .pdf</span>
                                                    <span class="tag">Images</span>
                                                    <span class="tag">PostScript</span>
                                                    <span class="tag">MS Office</span>
                                                    <span class="tag">OpenOffice</span>
                                                </div>
                                            </div>

                                            <div class="custom-art-instructions mb-3">
                                                <p>
                                                    If you need to upload several files, please include a number in your
                                                    file name. <br>
                                                    For example: <strong>file1.pdf, file2.pdf, file3.pdf</strong> or
                                                    <strong>page1.pdf, page2.pdf, page3.pdf</strong><br>
                                                    Those numbers will determine the order. The words ‘front’, ‘back’,
                                                    ‘last’, ‘inner’ are also accepted.
                                                </p>
                                            </div>
                                        </div>
                                        <textarea class="form-control text-areafield" id="exampleFormControlTextarea1" rows="5" placeholder="Details..."></textarea>
                                        <!--<img-->
                                        <!--    src="https://www.shutterstock.com/image-photo/real-macro-photo-film-frame-600nw-2472739719.jpg">-->
                                        <!--<p style="font-size: 12px;">You have filled: 1 out of 1 positions</p>-->
                                        <!--<div class="custom-art-vat-row">-->
                                        <!--    <input type="checkbox" checked>-->
                                        <!--    <label>Show guidelines and legend</label>-->

                                        <!--</div>-->

                                       
<!--                                       <div class="upload-card" onclick="document.getElementById('fileInput').click();">-->
<!--  <i class="fa-solid fa-arrow-up-from-bracket"></i>-->
<!--  <p class="title">Drag and Drop files to upload</p>-->
<!--  <p class="or">or</p>-->
<!--  <button class="browse-btn">Browse</button>-->
<!--  <p class="file-info">Supported files: AI, PSD, PDF</p>-->
<!--</div>-->

<!--<input type="file" id="fileInput" style="display: none;" accept=".ai,.psd,.pdf" onchange="handleImageUpload(event)">-->


                                    </div>

                                </div>
                                <div class="upload-box-card">
                                    <div >
                                        <div class="upload-card" onclick="document.getElementById('fileInput').click();">
  <i class="fa-solid fa-arrow-up-from-bracket"></i>
  <p class="title">Drag and Drop files to upload</p>
  <p class="or">or</p>
  <button class="browse-btn">Browse</button>
  <p class="file-info">Supported files: AI, PSD, PDF</p>
</div>

<input type="file" id="fileInput" style="display: none;" accept=".ai,.psd,.pdf" onchange="handleImageUpload(event)">

                                    </div>
                                    <div >
                                        <div class="upload-card" onclick="document.getElementById('fileInput').click();">
  <i class="fa-solid fa-arrow-up-from-bracket"></i>
  <p class="title">Drag and Drop files to upload</p>
  <p class="or">or</p>
  <button class="browse-btn">Browse</button>
  <p class="file-info">Supported files: AI, PSD, PDF</p>
</div>

<input type="file" id="fileInput" style="display: none;" accept=".ai,.psd,.pdf" onchange="handleImageUpload(event)">

                                    </div>
                                    <div >
                                        <div class="upload-card" onclick="document.getElementById('fileInput').click();">
  <i class="fa-solid fa-arrow-up-from-bracket"></i>
  <p class="title">Drag and Drop files to upload</p>
  <p class="or">or</p>
  <button class="browse-btn">Browse</button>
  <p class="file-info">Supported files: AI, PSD, PDF</p>
</div>

<input type="file" id="fileInput" style="display: none;" accept=".ai,.psd,.pdf" onchange="handleImageUpload(event)">

                                    </div><div >
                                        <div class="upload-card" onclick="document.getElementById('fileInput').click();">
  <i class="fa-solid fa-arrow-up-from-bracket"></i>
  <p class="title">Drag and Drop files to upload</p>
  <p class="or">or</p>
  <button class="browse-btn">Browse</button>
  <p class="file-info">Supported files: AI, PSD, PDF</p>
</div>

<input type="file" id="fileInput" style="display: none;" accept=".ai,.psd,.pdf" onchange="handleImageUpload(event)">

                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="details">
                               <div class="tabone-section">
                                    <div>
                                        <div class="custom-art-tab-section-left">
                                            <div class="custom-art-tab-cont">
                                                <h6>Art Prints</h6>
                                                <button class="custom-art-edit-btn">✎ Edit</button>
                                            </div>

                                            <div class="custom-art-card">
                                                <div class="custom-art-item-label">Item 1</div>

                                                <div class="custom-art-field">
                                                    <label>Copies</label>
                                                    <input type="number" value="500" class="custom-art-input-box">
                                                </div>

                                                <div class="custom-art-field">
                                                    <label>Size</label>
                                                    <input type="text" value="A5 (148 mm x 210 mm)"
                                                        class="custom-art-input-box" readonly>
                                                </div>

                                                <div class="custom-art-field custom-art-gsm-options">
                                                    <label>130 <span class="custom-art-subtext">gsm paper -
                                                            Silk</span></label>
                                                    <div class="custom-art-side-options">
                                                        <button class="custom-art-side active">Front</button>
                                                        <button class="custom-art-side">Back</button>
                                                    </div>
                                                </div>

                                                <button class="custom-art-change-options">🔧 Change Options</button>

                                                <div class="custom-art-vat-row">
                                                    <input type="checkbox" checked>
                                                    <label>Add VAT (if applicable)</label>
                                                    <button class="custom-art-info-btn">Info</button>
                                                </div>

                                                <a href="#" class="custom-art-view-quote">📄 View this quote</a>
                                                

                                            </div>
                                             <div class="custom-art-filetypes-box mt-3">
                                                <h6>Address</h6>
                                                
                                            </div>
                                        </div>
                                       

                                    </div>
                                    <div class="tab-section-right">
                                       <div class="custom-address-container">
        <div class="custom-address-title">Billing Address</div>
        <div class="custom-address-field">
            <label>Email *</label>
            <input type="text" placeholder="Email">
        </div>
        <div class="custom-address-field">
            <label>Name *</label>
            <div class="d-flex justify-content-between">
            <input type="text" placeholder="Firstname" style="width: 48%; display: inline-block; margin-right: 4%;">
            <input type="text" placeholder="Surname" style="width: 48%; display: inline-block;">
            </div>
        </div>
        <div class="custom-address-field">
            <label>Phone *</label>
            <input type="text" placeholder="Phone">
        </div>
        <div class="custom-address-field">
            <label>Country</label>
            <select>
                <option value="uk">United Kingdom</option>
                <option value="us">United States</option>
                <option value="ca">Canada</option>
            </select>
        </div>
        <div class="custom-address-field">
            <label>Address</label>
            <input type="text" placeholder="Start typing address">
        </div>
        <div class="custom-address-title">Delivery Address</div>
        <div class="custom-address-field">
            <label>Delivery Instructions</label>
            <input type="text" placeholder="Enter instructions">
        </div>
        <div class="custom-address-field custom-checkbox d-flex">
            <input type="checkbox" id="plainPackaging" style="width: 18px;">
            <label for="plainPackaging " style="margin-top: 6px;">Use plain packaging</label>
        </div>
        <div class="custom-address-field custom-checkbox d-flex">
            <input type="checkbox" id="sameBilling" style="width: 18px;">
            <label for="sameBilling" style="margin-top: 6px;">Same as billing address</label>
        </div>
        <div class="custom-address-field">
            <label>Name *</label>
          <div class="d-flex justify-content-between">
            <input type="text" placeholder="Firstname" style="width: 48%; display: inline-block; margin-right: 4%;">
            <input type="text" placeholder="Surname" style="width: 48%; display: inline-block;">
            </div>
        </div>
        <div class="custom-address-field">
            <label>Phone *</label>
            <input type="text" placeholder="Phone">
        </div>
        <div class="custom-address-field">
            <label>Country</label>
            <select>
                <option value="uk">United Kingdom</option>
                <option value="us">United States</option>
                <option value="ca">Canada</option>
            </select>
        </div>
        <div class="custom-address-field">
            <label>Address</label>
            <input type="text" placeholder="Start typing address">
        </div>
    </div>                         

                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="payment">
                                <h4>Payment Section</h4>
                                <div style="height: 150px; background: #f8d0d0;">[Dummy payment content]</div>
                            </div>
                            <div class="tab-pane" id="printlink">
                                <h4>PrintLink Section</h4>
                                <div style="height: 150px; background: #d9d6fc;">[Dummy printlink content]</div>
                            </div>
                            <div class="tab-pane" id="messages">
                                <h4>Messages Section</h4>
                                <div style="height: 150px; background: #d6fcd9;">[Dummy messages content]</div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>

        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        // Tab Switching
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.custom-tab');
            const panes = document.querySelectorAll('.tab-pane');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const target = tab.getAttribute('data-tab');

                    // Remove active from all tabs and panes
                    tabs.forEach(t => t.classList.remove('active'));
                    panes.forEach(p => p.classList.remove('active'));

                    // Add active to selected tab and pane
                    tab.classList.add('active');
                    const targetPane = document.getElementById(target);
                    if (targetPane) {
                        targetPane.classList.add('active');
                    } else {
                        console.error(`Pane with ID "${target}" not found.`);
                    }
                });
            });
        });

        // Video Modal
        const videoModal = document.getElementById('videoModal');
        const videoFrame = document.getElementById('videoFrame');

        videoModal.addEventListener('show.bs.modal', function () {
            videoFrame.src = "https://www.youtube.com/embed/CpTT4tK8zzM?autoplay=1";
        });

        videoModal.addEventListener('hidden.bs.modal', function () {
            videoFrame.src = "";
        });

        // Address Field Focus/Blur
        document.querySelectorAll('.custom-address-field input, .custom-address-field select').forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.style.backgroundColor = '#f0f0f0';
            });
            input.addEventListener('blur', function () {
                this.parentElement.style.backgroundColor = '';
            });
        });
    </script>
    <script>
  function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
      console.log("Image selected:", file.name);
      // You can preview it or upload via AJAX here
    }
  }
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/artwork.blade.php ENDPATH**/ ?>