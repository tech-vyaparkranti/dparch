<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\NavMenu;
use App\Models\GalleryItem;
use App\Models\SliderModel;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Models\ProductsModel;
use App\Models\ServicesModel;
use App\Models\WebSiteElements;
use App\Traits\CommonFunctions;
use App\Models\HomeProductsModel;
use App\Models\WhyChooseUs;
use App\Models\Blog;
use App\Models\Service;


use Mews\Captcha\Facades\Captcha;

class HomePageController extends Controller
{
    use CommonFunctions;

    public function homePage(){
        try{
            $sliders=SliderModel::where([[SliderModel::SLIDE_STATUS,SliderModel::SLIDE_STATUS_LIVE],
            [SliderModel::SLIDE_STATUS,1]])->orderBy(SliderModel::SLIDE_SORTING,"asc")->get();
            $home_products=HomeProductsModel::where('slide_status','live')->get();
            $why_choose_us = WhyChooseUs::where('status', 'live')
            ->orderBy('sorting', 'asc')
            ->get();
           $galleryImages = GalleryItem::where('status', 1)
    ->where('view_status', 'visible')
    ->whereBetween('position', [1, 5])
    ->orderBy('position', 'asc') // optional, for ordered display
    ->get();
            $data = $this->getElement();
            $services = Service::where("status","live")->get();
            $blog = Blog::latest()->take(3)->get(); // limit to 6 or adjust as needed

            return view("HomePage.dynamicHomePage",compact('sliders','home_products','why_choose_us','galleryImages','services','blog'),$data);
        }catch(Exception $exception){
            echo $exception->getMessage();
            return false;
        }

    }
    public function aboutUs(){
        $data = $this->getElement();
        $teamMembers = TeamMember::where('status', 'live')->orderBy('sorting', 'asc')->get();
        $services = Service::where("status","live")->get();

        return view("HomePage.aboutUs",compact('teamMembers','services'),$data);
    }
    public function termsConditions(){
        $data = $this->getElement();
        return view("HomePage.termsConditions",$data);
    }
    public function shippingDeliverypolicy(){
        $data = $this->getElement();
    return view("HomePage.shippingDeliverypolicy",$data);
    }
    public function CancellationRefundPolicy(){
        $data = $this->getElement();
    return view("HomePage.CancellationRefundPolicy",$data);
    }
    public function privacyPolicy(){
        $data = $this->getElement();
        return view("HomePage.privacyPolicy",$data);
    }
    public function destinations(){
        $data = $this->getElement();
        return view("HomePage.destinations",$data);
    }
    public function productPage(){
       $services = ServicesModel::where('status', 'live')
                             ->orderBy('sorting', 'asc') // Replace 'column_name' with the actual column you want to sort by
                             ->get();
        $data = $this->getElement();
        return view("HomePage.productPage",compact('services'),$data);  
    }
    public function productDetails($slug)
    {
        $projectDetails=ServicesModel::where(['status'=>'live','slug'=>$slug])->first();
        $data = $this->getElement();
        return view("HomePage.productDetails",compact('projectDetails'),$data);

    }
    public function reportPage(){
        $data = $this->getElement();
         return view("HomePage.reportPage",$data);
    }
    
    public function galleryPages(){
        $data = $this->getElement();
    $galleryImages = GalleryItem::where('view_status', 'visible')
        ->where('status', 1)
        ->get();
    return view('HomePage.galleryPages', compact('galleryImages'),$data);
}
    public function contactUs(){
        
        $data = $this->getElement();
        return view("HomePage.contactUs",$data);
    }
    public function ComingSoon(){

        return view("HomePage.ComingSoon");
    }

    public function getMenu(){

        $menuItems = NavMenu::where([
            [NavMenu::STATUS,1],
            [NavMenu::VIEW_IN_LIST,NavMenu::VIEW_IN_LIST_YES]])
        ->select(NavMenu::TITLE,NavMenu::URL,NavMenu::URL_TARGET,NavMenu::PARENT_ID,
        NavMenu::NAV_TYPE,NavMenu::POSITION,NavMenu::ID)
        ->orderBy(NavMenu::PARENT_ID,"asc")
        ->orderBy(NavMenu::POSITION,"asc")->get();
        $returnData = [];
        if(count($menuItems)){
            // Nav Menu By Type
            $menuItemTypes = collect($menuItems)->groupBy(NavMenu::NAV_TYPE)->toArray();

            foreach($menuItemTypes as $navType=>$val){
                //for each type item
                foreach($val as $item){
                    if(!filter_var($item[NavMenu::URL], FILTER_VALIDATE_URL)){
                        $item[NavMenu::URL] = url("")."/".$item[NavMenu::URL];
                        //dd(url("items"));
                    }
                    //parent id is null
                    if($item[NavMenu::PARENT_ID]==null && !isset($returnData[$navType][$item[NavMenu::ID]])){
                        $returnData[$navType][$item[NavMenu::ID]] = $item;
                    }
                    //if parent id is set i.e child node
                    if($item[NavMenu::PARENT_ID]){
                        $this->setChildren($returnData,$item);
                    }
                }
            }
            if(count($returnData)){
                $return = ["status"=>true,"message"=>"menu items found.","data"=>$returnData,
                "menu_html"=>$this->getHtml($returnData)];
            }else{
                $return = ["status"=>false,"message"=>"menu items not found.","data"=>null];
            }
        }else{
            $return = ["status"=>false,"message"=>"menu items not set","data"=>null];
        }
        return response()->json($return);
    }

    public function setChildren(&$returnData,$item){

        foreach($returnData as $navType=>$navItem){
            //parent id matches
            if($navType==$item[NavMenu::NAV_TYPE] && !empty($navItem[$item[NavMenu::PARENT_ID]])){
                $returnData[$item[NavMenu::NAV_TYPE]][$item[NavMenu::PARENT_ID]]["child_node"][] = $item;
                return true;
            }
            if(!empty($returnData[$item[NavMenu::NAV_TYPE]])){

                $this->findSetChild($returnData[$item[NavMenu::NAV_TYPE]],$item);
            }

        }


    }

    /**
     * findSetChild
     *
     * @param  mixed $item
     * @param  mixed $itemSet
     * @return void
     */
    public function findSetChild(&$item,$itemSet){
        try{
            foreach($item as $navId=>$navItem){
                if($navItem[NavMenu::ID]==$itemSet[NavMenu::PARENT_ID]){
                    $item[$navId]["child_node"][] = $itemSet;
                    return true;
                }
                if(!empty($item[$navId]["child_node"])){
                    return $this->findSetChild($item[$navId]["child_node"],$itemSet);
                }
            }
        }catch(Exception $exception){
            return false;
        }
    }

    /**
     * getHtml
     *
     * @param  mixed $returnData
     * @return void
     */
    public function getHtml($returnData){
        $html = [];
        foreach($returnData as $key=>$value){
            if(!isset($html[$key])){
                $html[$key] = '';
            }
            foreach($value as $keyVal){
                $html[$key] .= $this->getItemHTML($key,$html,$keyVal);
            }
            //$html[$key] = $this->getItemHTML($key,$html,$value);
        }
        return $html;
    }

    /**
     * getItemHTML
     *
     * @param  mixed $key
     * @param  mixed $html
     * @param  mixed $item
     * @return void
     */
    public function getItemHTML($key,$html,$item){

        $link_html = "";
        if($key=="top"){
            if(!empty($item["child_node"])){

                $subMenu = $this->getItemChildHTML($item,'<div class="dropdown-menu">');
                $link_html .= '<li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                        '.$item[NavMenu::TITLE].'
                                    </a>'.$subMenu.'</div>
                                    </li>';
            }else{
                $link_html .= '<li class="nav-item">
                                    <a target="'.$item[NavMenu::URL_TARGET].'" class="nav-link js-scroll-trigger" href="'.
                                    $item[NavMenu::URL].'">'.$item[NavMenu::TITLE].'</a>
                               </li>';
            }
        }

        return $link_html;
    }

    /**
     * getItemChildHTML
     *
     * @param  mixed $item
     * @param  mixed $html
     * @return void
     */
    public function getItemChildHTML($item,$html){
        if(!empty($item["child_node"])){
            $html .='<a target="'.$item[NavMenu::URL_TARGET].'" class="dropdown-item" href="'.$item[NavMenu::URL].'">'.$item[NavMenu::TITLE].'</a>';
            foreach($item["child_node"] as $item_new){
                return $this->getItemChildHTML($item_new,$html);
            }
        }else{
            return $html .='<a target="'.$item[NavMenu::URL_TARGET].'" class="dropdown-item" href="'.$item[NavMenu::URL].'">'.$item[NavMenu::TITLE].'</a>';
        }
    }

    public function galleryPage(){
        $obj = new GalleryItem();
        $getAllGalleryImages = $obj->getAllGalleryImages();
        $getAllVideos = $obj->getAllGalleryVideos();
        return view("HomePage.galleryPage",compact("getAllGalleryImages","getAllVideos"));
    }

    public function refreshCapthca(){
        try{
            $return = ["status"=>true,"message"=>"Success","data"=>Captcha::src()];

        }catch(Exception $exception){
            $return = ["status"=>false,"message"=>$exception->getMessage(),"data"=>$exception->getTraceAsString()];
        }
        return response()->json($return);
    }

    public function getElement(){
        $elements = $this->getWebSiteElements();
        $data = [];
        if(!empty($elements)){
            foreach($elements as $item){
                $data[$item->{WebSiteElements::ELEMENT}] = $item->{WebSiteElements::ELEMENT_DETAILS};
            }
        } 
        return $data;
    }

    public function blogPage(){
        $blog= Blog::where('blog_status','live')->get();
        $data = $this->getElement();
        return view("HomePage.blogPage",compact('blog'),$data);  
    }
   public function blogDetails($slug)
{
    // CORRECTED LINE:
    // Ensure all conditions in the array are key-value pairs
    $blogDetails = Blog::where([
        'blog_status' => 'live', // This was missing the key
        'slug' => $slug
    ])->first();

    // The rest of your code remains the same
    $data = $this->getElement();
    $recentBlog = Blog::where('status', 1)
        ->where('id', '!=', optional($blogDetails)->id)
        ->latest()
        ->take(5)
        ->get();

    return view("HomePage.blogDetails", compact('blogDetails' ,'recentBlog'), $data);
}
}
