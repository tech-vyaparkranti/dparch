<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\HomeProductsController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\WebSiteElementsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WhyChooseUsController;
use App\Http\Controllers\ServiceProjectController;


Route::get("login",[AdminController::class,"Login"])->name("login");
Route::get("logout",[AdminCOntroller::class,"logout"])->name("logout");
Route::post("AdminUserLogin",[AdminController::class,"AdminLoginUser"])->name("AdminLogin");
Route::get("getmenu-items",[HomePageController::class,"getMenu"]);
//pages

Route::middleware(['auth'])->group(function () {

    Route::get("/new-dashboard",[AdminController::class,"dashboard"])->name("new-dashboard");

    // Route::get("site-navigation",[AdminController::class,"siteNav"])->name("siteNav");
    // Route::post("addEditNavigation",[AdminController::class,"addEditNavigation"])->name("addNaviagtion");
    // Route::post("deleteNavigation",[AdminController::class,"deleteNavigation"])->name("deleteNavigation");
    // Route::post("navDataTable",[AdminController::class,"navDataTable"])->name("navDataTable");

    Route::get("manage-gallery",[AdminController::class,"manageGallery"])->name("manageGallery");
    Route::post("addGalleryItems",[AdminController::class,"addGalleryItems"])->name("addGalleryItems");
    Route::post("addGalleryDataTable",[AdminController::class,"addGalleryDataTable"])->name("addGalleryDataTable");
 
    Route::get("add-web-site-elements", [WebSiteElementsController::class, "addWebSiteElements"])->name("webSiteElements");
    Route::post("save-web-site-element", [WebSiteElementsController::class, "saveWebSiteElement"])->name("saveWebSiteElement");
    Route::post("web-site-elements-data", [WebSiteElementsController::class, "getWebElementsData"])->name("webSiteElementsData");
    
    Route::get("slider-admin", [SliderController::class, "slider"])->name("Slider");
    Route::post("save-Slide", [SliderController::class, "saveSlide"])->name("saveSlide");
    Route::post("slider-data", [SliderController::class, "sliderData"])->name("sliderData");

      
    Route::get("products-admin", [ServicesController::class, "servicesSlider"])->name("servicesSlider");
    Route::post("products", [ServicesController::class, "save"])->name("projects.save");
    Route::post("products-data", [ServicesController::class, "data"])->name("projects.data");

        
    Route::get("home-products-admin", [HomeProductsController::class, "homeDestinationsSlider"])->name("homeDestinationsSlider");
    Route::post("home-products-services", [HomeProductsController::class, "homeDestinationsSaveSlide"])->name("homeDestinationsSaveSlide");
    Route::post("home-products-data", [HomeProductsController::class, "homeDestinationsData"])->name("homeDestinationsData");

    Route::post("manage-contact-data", [ServicesController::class, "managecontactdata"])->name("managecontactdata");

// Why Choose Us admin routes (without prefix)
Route::get("why-choose-us", [WhyChooseUsController::class, "index"])->name("why-choose-us.index");
Route::post("why-choose-us/data", [WhyChooseUsController::class, 'data'])->name('whyChooseUsData')->middleware('auth');
Route::post("why-choose-us/save", [WhyChooseUsController::class, 'save'])->name('whyChooseUsSave')->middleware('auth');

Route::get("team-member", [TeamMemberController::class, "index"])->name("teamMember.index");
Route::post("team-member/data", [TeamMemberController::class, 'data'])->name('teamMemberData')->middleware('auth');
Route::post("team-member/save", [TeamMemberController::class, 'save'])->name('teamMemberSave')->middleware('auth');


Route::get("blog-admin", [BlogController::class, "manageBlog"])->name("manageBlog");
Route::post("save-blog", [BlogController::class, "saveBlog"])->name("saveBlog");
Route::post("blog-data", [BlogController::class, "blogData"])->name("blogData");


Route::get("contact-us-data", function () {
    return view("HomePage.ContactUsdata");
})->name("ContactUsData");

});

Route::get("our-services-master", [ServiceProjectController::class, "index"])->name("viewOurServicesMaster");
Route::post("save-our-services", [ServiceProjectController::class, "saveOurServicesMaster"])->name("saveOurServicesMaster");
Route::post("our-services-data", [ServiceProjectController::class, "ourServicesData"])->name("ourServicesData");
    
