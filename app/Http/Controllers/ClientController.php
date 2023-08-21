<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\CateItems;
use App\Models\Products;
use App\Models\ProMemory;
use App\Models\ProColors;
use App\Models\ProDetails;
use App\Models\Comments;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Delivery;
use App\Models\Slider;
use App\Models\Wishlist;
use App\Models\Orders;
use App\Models\OrderDetails;
use App\Models\Discounts_code;
use Carbon\Carbon;
use Session;
use DB;
use App\Models\Contacts;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    public function __construct()
    {
        $allCate=Categories::all();
        view()->share('allCate', $allCate);
        //slider
        $allslide = Slider::where('slide_status','=',1)->orderBy('id','DESC')->get();
        view()->share('allslide', $allslide);
        $slider = Slider::orderBy('id','DESC')->where('slide_status',1)->take(3)->get();
        view()->share('slider', $slider);
    }
    public function index()
    {
        $homeTopPr = Products::where('hot','=','1')->limit(4)->get();
        $homeNewPr = Products::orderBy('id','desc')->limit(5)->get();
        $homeSalePr = Products::orderBy('discount','desc')->limit(6)->get();
        return view('client.pages.index',['homeTopPr'=>$homeTopPr,'homeNewPr'=>$homeNewPr,'homeSalePr'=>$homeSalePr]);
    }
    public function contact()
    {
        if(isset(Auth::user()->id)){
            $dataUser = Auth::user();
            $viewContacts = Contacts::where('id_user','=', $dataUser->id)->get();
            return view('client.pages.contact')->with(compact('dataUser', 'viewContacts'));
        }else{
            $dataUser = Auth::user();
            return view('client.pages.contact')->with(compact('dataUser'));
        }
    }

    public function addcontact(Request $request)
    {
        $contacts = new Contacts();
        if(isset(Auth::user()->id)){
            $contacts->id_user = Auth::user()->id;
            $contacts->user_name = Auth::user()->name;
            $contacts->user_email = Auth::user()->email;
            $contacts->message = $request->message;
        }else{
            $contacts->id_user = 0;
            $contacts->user_name = $request->name;
            $contacts->user_email = $request->email;
            $contacts->message = $request->message;
        }
        $contacts->save();
        $dataUser = Auth::user();
        toastr()->success('Thành công', 'Bạn đã gửi thành công');
        return back();
    }

    public function showContact($id){
        $contacts = Contacts::find($id);
        $dataUser = Auth::user();
        return view('client.pages.edit_contact')->with(compact('contacts', 'dataUser'));
    }


    public function editContact(Request $request)
    {
        $contacts = Contacts::find($request->id);
        if(isset(Auth::user()->id)){
            $contacts->id_user = $request->id_user;
            $contacts->user_name = $request->user_name;
            $contacts->user_email = $request->user_email;
            $contacts->message = $request->message;
        }else{
            $contacts->id_user = $request->id_user;
            $contacts->user_name = $request->name;
            $contacts->user_email = $request->email;
            $contacts->message = $request->message;
        }
        $contacts->save();
        $dataUser = Auth::user();
        toastr()->success('Thành công', 'Bạn đã cập nhật thành công');
        return redirect()->action([ClientController::class,'contact']);
    }

    public function deletecontact($id)
    {
        
        $contacts = Contacts::find($id);
        $contacts -> delete();
        toastr()->success('Thành công', 'Đã xóa tin nhắn liên hệ');
        return back();
    }
    public function getProByCate($id)
    {
        $listPro=Categories::find($id)->Products;
        $cti_bar=Categories::find($id)->Cate_items;
        return view('client.pages.category',['listPro'=>$listPro,'cti_bar'=>$cti_bar]);
    }
    public function getProByCateItem($id)
    {
        $listPro=CateItems::find($id)->Products;
        $cti_bar=CateItems::where('cate_id','=',$id)->get();
        return view('client.pages.category',['listPro'=>$listPro,'cti_bar'=>$cti_bar]);
    }
    public function getProById($id)
    {
        $pro=Products::find($id);
        $pro->view=$pro->view+1;
        $pro->save();
        $images=Products::find($id)->Images;
        $pro_details=Products::find($id)->ProDetails;
        $pro_colors=Products::find($id)->ProColors;
        $pro_memory=Products::find($id)->ProMemory;
        
        $coutall = DB::table('comments')->where('pro_id','=',$pro->id)->count();
        $cout5 = DB::table('comments')->where('pro_id','=',$pro->id)->where('status', '=', 5)->count();
        $cout4 = DB::table('comments')->where('pro_id','=',$pro->id)->where('status', '=', 4)->count();
        $cout3 = DB::table('comments')->where('pro_id','=',$pro->id)->where('status', '=', 3)->count();
        $cout2 = DB::table('comments')->where('pro_id','=',$pro->id)->where('status', '=', 2)->count();
        $cout1 = DB::table('comments')->where('pro_id','=',$pro->id)->where('status', '=', 1)->count();
        
        if($coutall>0){
            $tong = ($cout5*5+$cout4*4+$cout3*3+$cout2*2+$cout1*1)/$coutall;
            $Round =  round($tong, 1);
            $comm = DB::table('comments')->join('users' , 'users.id', '=', 'comments.user_id')->select('comments.*', 'users.name')->where('pro_id','=',$pro->id)->get();
            return view('client.pages.product',['pro'=>$pro,'pro_details'=>$pro_details,'pro_colors'=>$pro_colors,'pro_memory'=>$pro_memory,'images'=>$images, 'comm'=>$comm, 'coutall'=> $coutall,'cout5'=> $cout5,'cout4'=> $cout4,'cout3'=> $cout3,'cout2'=> $cout2,'cout1'=> $cout1, 'Round'=>$Round]);
        }
        else{
            $comm = DB::table('comments')->join('users' , 'users.id', '=', 'comments.user_id')->select('comments.*', 'users.name')->where('pro_id','=',$pro->id)->get();
            return view('client.pages.product',['pro'=>$pro,'pro_details'=>$pro_details,'pro_colors'=>$pro_colors,'pro_memory'=>$pro_memory,'images'=>$images, 'comm'=>$comm, 'coutall'=> $coutall,'cout5'=> $cout5,'cout4'=> $cout4,'cout3'=> $cout3,'cout2'=> $cout2,'cout1'=> $cout1]);
        }
    }

    public function getCateItemByCate(Request $r)
    {
        $cateItems=CateItems::where('cate_id','=',$r->id_cate)->get();
        return response()->json($cateItems);
    }
    public function signup()
    {
        return view('client.pages.register');
    }
    public function forgotpassword()
    {
        return view('client.pages.forgot_password');
    }
    public function manager()
    {
        return view('client.pages.manager');
    }
    public function useraddress()
    {
        Auth::user()->id;
        $listAdr = UserAddress::where('user_id','=',Auth::user()->id)->get();
        return view('client.pages.useraddress')->with(compact('listAdr'));
    }
    public function addAddress(Request $r)
    {
        $adr = new UserAddress();
        $adr->user_id = $r->user_id;
        $adr->name = $r->name;
        $adr->phone = $r->phone;
        $adr->address = $r->address;
        $adr->role = $r->role;
        DB::update('update user_address set role = ?',[0]);

        $adr -> save();
        
        toastr()->success('Thành công', 'Thêm địa chỉ thành công');
        return redirect(route('useraddress'));
    }
    public function geteditAddress($id)
    {
        $adr=UserAddress::find($id);

        return view('client.pages.editaddress',['adr'=>$adr]);
    }
    public function editAddress(Request $r)
    {
        $adr=UserAddress::find($r->id);
        $adr->user_id = $r->user_id;
        $adr->name = $r->name;
        $adr->phone = $r->phone;
        $adr->address = $r->address;

        $adr->role = $r->role;
        DB::update('update user_address set role = ?',[0]);

        $adr -> save();
        
        toastr()->success('Thành công', 'Chỉnh sửa địa chỉ thành công');
        return redirect(route('useraddress'));
    }
    public function deleteAddress($id){
        $adr = UserAddress::find($id);
        $id =$adr->id;
        $adr->delete();
        toastr()->success('Thành công', 'Xoá địa chỉ thành công');
        return redirect('useraddress');
    }
    public function edit_profile()
    {
        return view('client.pages.edit_profile');
    }
    // Tìm kiếm
    public function search(){
        $listPro=CateItems::all();
        $cti_bar=Categories::all();
        $keywords = $_GET['keywords'];
        $listPro=Products::where('name','LIKE', '%'.$keywords.'%')
        ->orWhere('detail','LIKE', '%'.$keywords.'%')->get();
        if(count($listPro)==0){
            $listPro = Products::all();
            $MesSearch = 'Không tìm thấy kết quả của từ khóa: '.$keywords.'. Hiển thị danh sách sản phẩm:';
            return view('client.pages.category')->with(compact('listPro','cti_bar','keywords','listPro', 'MesSearch'));
        }else{
            $MesSearch = 'Kết quả của từ khóa: '.$keywords.'.';
            return view('client.pages.category')->with(compact('listPro','cti_bar','keywords','listPro', 'MesSearch'));
        }
    }

    //comment
    public function store($id, Request $request)
    {
        $pro_id = $id;
        $comment = new Comments();
        $product = Products::find($id);
        $comment->pro_id = $pro_id;
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->content;
        if($request->rating_status > 0){
            $comment->status = $request->rating_status;
        }
        else{
            $comment->status = 5;
        }
        $comment->save();

        return redirect()->back();
    }
    public function store1($id, Request $request)
    {
        $allusern = User::where('id', '=', )->get;
        return redirect()->back();
    }
    // /// Cart and pay
    public function addCart(Request $request)
    {
        $pro_id=$request->pro_id;
        $name=$request->name;
        $image=$request->image;
        $price=$request->price;
        $qty=$request->qty;

        $cart = session()->get('cart', []);
        if(isset($cart[$name])  ){
            $cart[$name]=[
                'id'=>$pro_id,
                'name'=>$name,
                'image'=>$image,
                'price'=>$price,
                'qty'=>$cart[$name]['qty']+=$qty,
                'total'=>$cart[$name]['qty']*$cart[$name]['price']
            ];
        }   
        else{
            $cart[$name]=[
                'id'=>$pro_id,
                'name'=>$name,
                'image'=>$image,
                'price'=>$price,
                'qty'=>$qty,
                'total'=>$price*$qty
            ];

        }
        session()->put('cart', $cart); 
        $cart=session()->get('cart', []);
        return redirect()->back()->with('success','Đã thêm sản phẩm vào giỏ hàng');
    }
    public function updatCart(Request $r)
    {
        dd($r);
        // $qty=$r->qty;
        // $name =$r->proName;
        // dd($name);
        // $cart = session()->get('cart', []);
        // if(isset($cart[$name])  ){
        //     $cart[$name]['qty']=$qty;
        //     dd( $cart[$name]['qty']);
        // }
        // else{
        //     return redirect()->back()->with('error', 'Không tìm thấy sản phẩm');
        // }
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
    public function viewCart()
    {
        if (Auth::check()){
            $userAddress=UserAddress::where('user_id','=', Auth::user()->id)->get();
            view()->share('userAddress', $userAddress);
        }
        $allProCart=session()->get('cart');
        $delivery=Delivery::all();
        return view('client.pages.cart')->with(compact('allProCart','delivery'));
    }

    public function getAddressById(Request $r)
    {
        $address=UserAddress::find($r->id);
        return response()->json($address);
    }

    public function deleteItemCart($name)
    {
       $cart = session()->get('cart', []);
       if(isset($cart[$name])  ){
        unset($cart[$name]);
        session()->put('cart', $cart);
       }
       $allProCart=session()->get('cart');
       toastr()->success('Thành công', 'Đã xóa sản phẩm khỏi giỏ hàng');
       return redirect()->back();
    }
    // Danh sách yêu thích
    public function wishlist()
    {
        $wishlist = Wishlist::where('user_id','=', Auth::user()->id)->get();
        return view('client.pages.wishlist', compact('wishlist'));
    }
    public function add($pro_id) 
    {
        $pro_wish=Wishlist::where('pro_id','=',$pro_id,)->where('user_id', '=', Auth::id())->first();
        if($pro_wish){
            toastr()->success('Thành công', 'Thêm vào yêu thích thành công');
            return redirect(route('listWish')); 
        }else{
            Wishlist::insert([
                'user_id' => Auth::id(),
                'pro_id' => $pro_id
            ]);
        }
        toastr()->success('Thành công', 'Thêm vào yêu thích thành công');
        return redirect(route('listWish'));
    }
    public function delete($id)
    {
        
        $wishlist = Wishlist::find($id);
        $wishlist -> delete();
        toastr()->success('Thành công', 'Đã xóa sản phẩm khỏi yêu thích');
        return redirect(route('listWish'));
    }
    public function showcount($id)
    {
        $wishlistcount = Wishlist::count($id);
        return view('client.pages',compact('wishlistcount'));
    }

    public function insertOrder(Request $r)
    {
        // INSERT ORDER
        $order = new Orders();
        $order->user_id=$r->user_id;
        $order->user_address=$r->user_address;
        $order->deli_id=$r->deli_id;
        $order->discount=$r->discount;
        $order->total=$r->total;
        $order->status=0;
        $order->note=$r->note;
        $order ->save();

        $order_id= $order->id;
        // INSERT ORDER_DETAIL
        $allProCart=session()->get('cart');
        foreach($allProCart as $pro){
            $order_detail = new OrderDetails();
            $order_detail->order_id=$order_id;
            $order_detail->product_id=$pro['id'];
            $order_detail->product_name=$pro['name'];
            $order_detail->number=$pro['qty'];
            $order_detail->price=$pro['price'];
            $order_detail->save();
        }
        session()->forget(['cart','coupon']);
        return redirect()->back()->with('success', 'Tạo đơn hàng thành công');

    }

    public function orders()
    {
        $orders=Orders::where('user_id','=',Auth::id() )->orderBy('id','desc')->get();
        return view('client.pages.orders',compact('orders'));
    }
    public function orderdetails($id)
    {
        $order=Orders::find($id);
        $details=OrderDetails::where('order_id','=', $id)->get();
        return view('client.pages.orderdetails', compact('order','details'));
    }
    public function cancelOrders($id)
    {
        $order=Orders::find($id);
        $order->status=4;
        $order->save();
        return redirect()->back()->with('success', 'Hủy đơn hàng thành công');
    }
    
    public function loginClient(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
           return redirect()->back()->with('success', 'Đăng nhập thành công');
        } else {
            return redirect()->back()->with('error', 'Đăng nhập thất bại!');
        }
    }
    public function discountCode(Request $request)
    {
        $today = Carbon::today();
        $data = $request->discountCode;
        // dd($data);
        $coupon = Discounts_code::where('code','=',$data)->where('quantity','>',0)->whereDate('start_time','<',$today)->whereDate('end_time','>',$today)->first();
        
        if($coupon){
            $coupon_session = Session::get('coupon');
                $cou[] = array(
                    'code' => $coupon->code,
                    'quantity' => $coupon->quantity,
                    'discount' => $coupon->dicount,
                ); 
            Session::put('coupon',$cou);
            Session::save();
            $coupon->quantity=$coupon->quantity-1;
            $coupon->save();
            return redirect()->back()->with('success','Áp dụng mã giảm giá thành công');
        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng hoặc hết hạn');
        }
        
        }
}
