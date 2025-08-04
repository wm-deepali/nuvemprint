<?php

use App\Http\Controllers\Admin\AttributeGroupController;
use App\Http\Controllers\Admin\AttributeGroupSubcategoryAssignmentController;
use App\Http\Controllers\Admin\BindingController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookmarkRibbonController;
use App\Http\Controllers\Admin\CoverFinishController;
use App\Http\Controllers\Admin\CoverFoilingController;
use App\Http\Controllers\Admin\CoverPrintingColourController;
use App\Http\Controllers\Admin\CoverTypeController;
use App\Http\Controllers\Admin\CoverWeightController;
use App\Http\Controllers\Admin\CustomerEstimateController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DustJacketColourController;
use App\Http\Controllers\Admin\DustJacketFinishController;
use App\Http\Controllers\Admin\EndpaperColourController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HeadAndTailBandController;
use App\Http\Controllers\Admin\ManagePaperSizeController;
use App\Http\Controllers\Admin\OrientationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PaperWeightController;
use App\Http\Controllers\Admin\QuotePricingController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\SubcategoryAttributeController;
use App\Http\Controllers\Admin\SubcategoryAttributeValueController;
use App\Http\Controllers\Admin\AttributeConditionController;
use App\Http\Controllers\Admin\PricingRuleController;
use App\Http\Controllers\Admin\QuoteController;

use App\Http\Controllers\Admin\VatController;
use App\Http\Controllers\DeliveryChargeController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\ProofReadingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    HomeController,
    PaperTypeController,
    SoftBackBookController,
    ContactController,
    ArtWorkController,
    BookSizeController,
    PdfInstructionController,
    LayoutController,
    SupplyingController,
    ToolBoxController,
    BookTemplateController,
    IsbnController,
    LibraryRegistrationController,
    PrintDemandController,
    CoverDesignController,
    HardBackBookController,
    HardBackBookPrintedSlipController,
    YearBookController,
    SliderController,
    CategoryController,
    SubCategoryController,
    PrintingColourController
};
use App\Http\Controllers\Admin\BookTypeController;
use App\Http\Controllers\Admin\PageTypeController;
use App\Http\Controllers\Admin\PageRangeController;
use App\Http\Controllers\Admin\QuantityRangeController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/foo', function () {
    $target = '/var/www/vhosts/bookempire.co.uk/httpdocs/storage/app/public';
    $shortcut = '/var/www/vhosts/bookempire.co.uk/httpdocs/public/storage';
    symlink($target, $shortcut);
});
Auth::routes(['register' => false]);


Route::group(['middleware' => 'auth'], function () {




    Route::get('/profile', [HomeController::class, 'profile'])
        ->name('profile.show');

    Route::get('/settings', [HomeController::class, 'profileSettings'])
        ->name('profile.setting');

    Route::post('social-form-submission', [HomeController::class, 'socialFormSubmit'])
        ->name('social-form.submit');

    Route::post('user-info-form-submission', [HomeController::class, 'userInfoSubmit'])
        ->name('user-bio.submit');

    Route::post('user-basic-info-submission', [HomeController::class, 'userBasicInfoSubmit'])
        ->name('user-basicinfo.submit');

    Route::post('change-password', [HomeController::class, 'changePassword'])
        ->name('change-password');

    Route::get('save-basic-settings', [HomeController::class, 'basicSettingSubmit'])
        ->name('basic-setting.save');

    Route::get('get-states', [HomeController::class, 'getStateList'])
        ->name('get-states');

    Route::get('get-cities', [HomeController::class, 'getCityList'])
        ->name('get-cities');

    // Route for About us
    // Route::get('manage-about', [AboutController::class, 'index'])
    //     ->name('about.index');
    // Route::post('manage-about/store', [AboutController::class, 'store'])
    //     ->name('about.store');

    // Route for Contact Enquiries
    // Route::get('manage-enquiries', [EnquiryController::class, 'index'])
    //     ->name('contact-enquiry.index');
    // Route::get('manage-enquiries/{id}/delete', [EnquiryController::class, 'delete'])
    //     ->name('contact-enquiry.delete');

    // Route for Callback Enquiries
    // Route::get('manage-callback-enquiries', [CallbackEnquiryController::class, 'index'])
    //     ->name('callback-enquiry.index');
    // Route::get('manage-callback-enquiries/{id}/delete', [CallbackEnquiryController::class, 'delete'])
    //     ->name('callback-enquiry.delete');

    // Route for Teams
    Route::resource('teams', TeamController::class);

    // Route for Orders
    Route::resource('orders', OrderController::class);

    // Route for Slider
    Route::resource('slider', SliderController::class);

    // Route for Trade Binding Price
    Route::resource('trade-binding-price', TradeBindingPriceController::class)
        ->parameters(['trade-binding-price' => 'tradeBindingPrice']);

    // Route for Spine Calculator
    Route::resource('spine-calculator', SpineCalculatorController::class)
        ->parameters(['spine-calculator' => 'spineCalculator']);

    // Manage-Recent-Book
    Route::resource('manage-recent-books', RecentBookController::class)
        ->parameters(['manage-recent-books' => 'recentBook']);

    // Route for Uploaded Proofs
    Route::resource('uploaded-proofs', UploadedProofController::class)
        ->parameters(['uploaded-proofs' => 'uploadedProof']);
    Route::get('proof/feedbacks/{id}', [UploadedProofController::class, 'manageFeedbacks'])->name('proof.feedbacks');

    // Route for Approval Proofs
    Route::resource('approval-proofs', ApprovedProofController::class)
        ->parameters(['approval-proofs' => 'approvedProof']);

    // Route for ProofApprovalSignOff
    Route::resource('proof-approval-sign-off', ProofApprovalSignOffController::class)
        ->parameters(['proof-approval-sign-off' => 'proofApprovalSignOff']);

    // Route for Free File Assessment
    Route::resource('free-file-assessment', FileAssessmentController::class)
        ->parameters(['free-file-assessment' => 'fileAssessment']);

    // Route for Testimonial
    Route::get('feedback-approved', [TestimonialController::class, 'feebackApproval'])->name('feedback.approved');
    Route::resource('testimonials', TestimonialController::class);

    /* Route for Terms and conditons*/
    Route::get('terms-and-condition', [TermsConditionController::class, 'create'])->name('terms.create');
    Route::post('terms/store', [TermsConditionController::class, 'store'])->name('terms.store');

    /* Route for Manage Paper Types and Extras*/
    Route::get('paper-types-and-extras', [PaperTypeController::class, 'create'])->name('paper-types.create');
    Route::post('paper-types-and-extras/store', [PaperTypeController::class, 'store'])->name('paper-types.store');

    /* Route for File Formats*/
    Route::get('file-formats', [FormatsOfFileController::class, 'create'])->name('file-format.create');
    Route::post('file-formats/store', [FormatsOfFileController::class, 'store'])->name('file-format.store');

    /* Route for Wire Bound*/
    Route::get('wire-bound', [WireBoundController::class, 'create'])->name('wirebound.create');
    Route::post('wire-bound/store', [WireBoundController::class, 'store'])->name('wirebound.store');

    /* Route for Soft Back Book*/
    Route::get('softback', [SoftBackBookController::class, 'create'])->name('softback.create');
    Route::post('softback/store', [SoftBackBookController::class, 'store'])->name('softback.store');

    /* Route for Hard Back Book*/
    Route::get('hardback', [HardBackBookController::class, 'create'])->name('hardback.create');
    Route::post('hardback/store', [HardBackBookController::class, 'store'])->name('hardback.store');

    /* Route for YearBook*/
    Route::get('yearbook', [YearBookController::class, 'create'])->name('yearbook.create');
    Route::post('yearbook/store', [YearBookController::class, 'store'])->name('yearbook.store');

    /* Route for Audio*/
    Route::get('audio', [AudioController::class, 'create'])->name('audio.create');
    Route::post('audio/store', [AudioController::class, 'store'])->name('audio.store');

    /* Route for Spiral*/
    Route::get('spiral', [SpiralController::class, 'create'])->name('spiral.create');
    Route::post('spiral/store', [SpiralController::class, 'store'])->name('spiral.store');

    /* Route for FlipBook*/
    Route::get('flip-book', [FlipBookController::class, 'create'])->name('flip.create');
    Route::post('flip-book/store', [FlipBookController::class, 'store'])->name('flip.store');

    /* Route for EBook*/
    Route::get('ebook', [EBookController::class, 'create'])->name('ebook.create');
    Route::post('ebook/store', [EBookController::class, 'store'])->name('ebook.store');

    /* Route for Booklets*/
    Route::get('booklets', [BookletController::class, 'create'])->name('booklet.create');
    Route::post('booklets/store', [BookletController::class, 'store'])->name('booklet.store');

    /* Route for Payment Details*/
    Route::get('manage-payment-details', [PaymentDetailController::class, 'create'])->name('payment-details.create');
    Route::post('manage-payment-details/store', [PaymentDetailController::class, 'store'])->name('payment-details.store');

    Route::resource('manage-instant-quote', InstantQuoteController::class);

    // Trade Binding Route For Book Types
    Route::resource('trade-binding/page-type', PageTypeController::class);

    // Trade Binding Route For Book Types
    Route::resource('trade-binding/book-type', BookTypeController::class);

    // Manage-HardBackBookPrintedSlip
    Route::resource('manage-printed-slips', HardBackBookPrintedSlipController::class)
        ->parameters(['manage-printed-slips' => 'hardBackBookPrintedSlip']);

    // Trade Binding Page Range Routes
    Route::resource('trade-binding/page-range', PageRangeController::class);

    // Trade Binding Manage Quantity Range Routes
    Route::resource('trade-binding/quantity-range', QuantityRangeController::class);
    Route::post('get/page/ranges', [QuantityRangeController::class, 'getPageRanges']);


    //artwork-category
    Route::resource('manage-artwork-category', ArtWorkController::class);
    Route::get('change-status-art', [ArtWorkController::class, 'changeStatus'])->name('change-status-art');
    Route::get('view-art-edit', [ArtWorkController::class, 'viewArt'])->name('view-art-edit');
    Route::post('artwork-content', [ArtWorkController::class, 'artwokContent'])->name('artwork-content');

    // Route for Site Meta Tags
    Route::get('site/metas', [HomeController::class, 'manageSiteMetas'])->name('admin.manageSiteMetas');
    Route::get('site/meta/edit/{id}', [HomeController::class, 'editMetaContent'])->name('admin.editMetaContent');
    Route::post('update/site/metas', [HomeController::class, 'updateSiteMetas'])->name('admin.updateSiteMetas');
});

//contact
Route::resource('company-contact', ContactController::class);
Route::get('change-status', [ContactController::class, 'changeStatus'])->name('change-status');

//book-size
Route::resource('manage-book-size', BookSizeController::class);
Route::get('change-status-book', [BookSizeController::class, 'changeStatus'])->name('change-status-book');
Route::match(['get', 'post'], 'book/content', [BookSizeController::class, 'storeContent'])->name('book/content');
Route::post('store-block-content', [BookSizeController::class, 'storeBlockContent'])->name('store-block-content');
Route::post('store-main-content', [BookSizeController::class, 'storeMainContent'])->name('store-main-content');

//pdf-instraction
Route::resource('manage-pdf-instruction', PdfInstructionController::class);
Route::get('change-status-pdf', [PdfInstructionController::class, 'changeStatus'])->name('change-status-pdf');
Route::match(['get', 'post'], 'pdf/content', [PdfInstructionController::class, 'storeContent'])->name('pdf/content');
Route::post('store-pdf', [PdfInstructionController::class, 'storePdf'])->name('store-pdf');
Route::post('store-describe-pdf', [PdfInstructionController::class, 'storeDescribePdf'])->name('store-describe-pdf');

//layout
Route::resource('manage-layout', LayoutController::class);
Route::get('change-status-layout', [LayoutController::class, 'changeStatus'])->name('change-status-layout');
Route::match(['get', 'post'], 'layout/content', [LayoutController::class, 'layoutContent'])->name('layout/content');
Route::post('save/block', [LayoutController::class, 'saveBlock'])->name('save/block');

//supplying
Route::resource('manage-supplying', SupplyingController::class);
Route::get('change-status-supplying', [SupplyingController::class, 'changeStatus'])->name('change-status-supplying');
Route::match(['get', 'post'], 'supplying/content', [SupplyingController::class, 'supplyingContent'])->name('supplying/content');
Route::post('save/supplying', [SupplyingController::class, 'saveSupplying'])->name('save/supplying');

//toolbox
Route::resource('manage-toolbox-category', ToolBoxController::class);
Route::get('change-status-toolbox', [ToolBoxController::class, 'changeStatus'])->name('change-status-toolbox');
Route::get('view-toolbox-edit', [ToolBoxController::class, 'viewtoolBox'])->name('view-toolbox-edit');
Route::post('toolbox-content', [ToolBoxController::class, 'toolboxContent'])->name('toolbox-content');

//template
Route::resource('manage-book-template', BookTemplateController::class);
Route::get('change-status-tempalte', [BookTemplateController::class, 'changeStatus'])->name('change-status-tempalte');
;
Route::post('store-tempalte-content', [BookTemplateController::class, 'templateContent'])->name('store-tempalte-content');
Route::post('store-tempalte-block', [BookTemplateController::class, 'templateBlock'])->name('store-tempalte-block');

//isbn
Route::resource('manage-isbn', IsbnController::class);

//manage-library
Route::resource('manage-library', LibraryRegistrationController::class);

//manage-library
Route::resource('manage-print-demand', PrintDemandController::class);



//coverdesing
Route::resource('manage-cover-design', CoverDesignController::class);
Route::get('change-status-cover', [CoverDesignController::class, 'changeStatus'])->name('change-status-cover');
;
Route::post('store-cover-banner', [CoverDesignController::class, 'storeBanner'])->name('store-cover-banner');

// Route::view('/pricing-rules', 'pricing_rules_list')->name('admin.pricing.rules.list');
// Route::view('/pricing-rules/add', 'add_pricing_rule')->name('pricing.rules.add');
// Route::view('/quote-requests', 'quote_requests')->name('quote.requests');



Route::group(['middleware' => 'auth'], function () {
    Route::name('admin.')->group(function () {

        Route::get('/home', [HomeController::class, 'index'])
            ->name('home');

        Route::get('customers', [CustomerEstimateController::class, 'index'])->name('customers');
        Route::get('customers/detail/{id}', [CustomerEstimateController::class, 'detail'])->name('customers.detail');
        Route::delete('customer/{id}', [CustomerEstimateController::class, 'destroy'])->name('customer.destroy');
        Route::get('quote-request', [QuoteController::class, 'index'])->name('quote.request');
        Route::get('order-details/{id}', [QuoteController::class, 'show'])->name('quote.show');
        Route::get('/quotes/{id}/download-pdf', [QuoteController::class, 'downloadPdf'])->name('quotes.download.pdf');
        Route::post('/quotes/update-status', [QuoteController::class, 'updateStatus'])->name('quotes.update.status');
        Route::post('/quotes/update-department', [QuoteController::class, 'processToDepartment'])->name('quote.update-department');
        Route::get('/quote/{quote}/invoice', [QuoteController::class, 'viewInvoice'])->name('quotes.invoice');
        Route::post('/quotes/payment-submit', [QuoteController::class, 'submitPayment'])->name('quotes.payment.submit');
        Route::get('/invoices/download/{quote}', [QuoteController::class, 'downloadInvoice'])->name('invoices.download');
        Route::post('/quotes/update-note', [QuoteController::class, 'updateNote'])->name('quote.update-note');


        // Route::view('quote-request', 'admin.customer_estimates.quote_request')->name('quote.request');
        Route::view('order-details', 'admin.quotes.index')->name('quote.index');
        Route::resource('manage-department', DepartmentController::class);

        Route::view('content/manage-page-content', 'admin.content.manage_page_content')->name('content.manage.page.content');

        Route::get('content/faq', [FaqController::class, 'index'])->name('content.faq');
        Route::post('/faqs/store', [FaqController::class, 'store'])->name('faqs.store');
        Route::post('faqs/update/{id}', [FaqController::class, 'update'])->name('faqs.update');
        Route::delete('faqs/delete/{id}', [FaqController::class, 'destroy'])->name('faqs.delete');
        Route::get('faqs/edit/{id}', [FaqController::class, 'edit'])->name('faqs.edit');


        Route::get('content/blogs', [BlogController::class, 'index'])->name('content.blogs');
        Route::post('/blogs/store', [BlogController::class, 'store'])->name('content.blogs.store');
        Route::get('content/blogs/create', [BlogController::class, 'create'])->name('content.blogs.create');
        Route::get('content/blogs/{id}/edit', [BlogController::class, 'edit'])->name('content.blogs.edit');
        Route::delete('content/blogs/{id}', [BlogController::class, 'destroy'])->name('content.blogs.destroy');
        Route::post('content/blogs/update/{id}', [BlogController::class, 'update'])->name('content.blogs.update');

        Route::get('content/dynamic-pages', [PageController::class, 'index'])->name('content.dynamic.pages');
        Route::prefix('pages')->name('pages.')->group(function () {
            Route::post('/store', [PageController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [PageController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [PageController::class, 'update'])->name('update');
            Route::delete('/{id}', [PageController::class, 'destroy'])->name('destroy');
        });



        // ===== Category MANAGEMENT ROUTES ===== //
        Route::resource('manage-categories', CategoryController::class);
        Route::resource('manage-subcategories', SubCategoryController::class);


        // ===== Dynamic Quote System ===== //
        Route::resource('attributes', AttributeController::class);
        Route::resource('attribute-groups', AttributeGroupController::class);
        Route::resource('attribute-values', AttributeValueController::class);
        Route::resource('group-assignments', AttributeGroupSubcategoryAssignmentController::class);
        Route::resource('subcategory-attributes', SubcategoryAttributeController::class);
        Route::resource('attribute-conditions', AttributeConditionController::class);
        Route::resource('pricing-rules', PricingRuleController::class);
        Route::resource('quotes', QuoteController::class);

        Route::get('attributes/{id}/values', [AttributeValueController::class, 'getValues']);
        Route::get('subcategories/{id}/attributes', [AttributeConditionController::class, 'getSubcategoryAttributes']);

        Route::resource('proof-reading', ProofReadingController::class);
        Route::resource('delivery-charges', DeliveryChargeController::class);
        Route::resource('postal-codes', PostalCodeController::class);
        Route::resource('manage-vat', VatController::class);


        // ===== Quote Pricing ===== //
        Route::resource('quote-pricing', QuotePricingController::class);
        Route::get('quote-pricing/step2/{quote}', [QuotePricingController::class, 'step2'])
            ->name('quote-pricing.step2');
        Route::post('quote-pricing/step2/save/{quote}', [QuotePricingController::class, 'step2Save'])
            ->name('quote-pricing.step2.save');
    });
});
