<?php 
namespace services\frontend;

use lienhoa\models\Danhmuc;
use lienhoa\models\Sanpham;
use lienhoa\models\Gioithieu;
use lienhoa\models\News;
use Contact;
use lienhoa\models\Customer;

use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $sanpham;
	protected $gioithieu;
	protected $news;
	protected $contact;
	protected $danhmuc;
	protected $customer;

	public function __construct(Sanpham $sanpham, Gioithieu $gioithieu, News $news, Contact $contact, Danhmuc $danhmuc, Customer $customer){
		$this->sanpham = $sanpham;
		$this->gioithieu = $gioithieu;
		$this->news = $news;
		$this->contact = $contact;
		$this->danhmuc = $danhmuc;
		$this->customer = $customer;
	}
	// DANH MUC
	public function showdanhmuc(array $with=array()){
		$query = $this->danhmuc->with($with);
		return $query->where('status',1)->get();
	}
	public function sanpham_danhmuc($slug){
		return $this->sanpham->where('danhmuc_name',$slug)->where('status',1)->paginate(12);
	}
	public function name_danhmuc($slug){
		return $this->danhmuc->select('title','slug')->where('slug',$slug)->first();
	}
	public function sanpham_detail($slug_danhmuc,$slug){
		return $this->sanpham->where('slug',$slug)->first();
	}
	public function danhmuc_id($danhmuc_slug){
		return $this->danhmuc->where('slug',$danhmuc_slug)->first()->id;
	}

	// SANPHAM
	public function sp_moinhat(){
		return $this->sanpham->where('status',1)->orderBy('id','DESC')->take(12)->get();
	}
	public function sp_xemnhieu(){
		return $this->sanpham->where('status',1)->orderBy('solanxem','DESC')->take(8)->get();
	}
	public function sp_relate($danhmuc_slug,$sp_slug){
		return $this->sanpham->where('status',1)->where('danhmuc_id',$this->danhmuc_id($danhmuc_slug))->whereNotIn('slug',[$sp_slug])->select('name','slug','image_path','image_name')->take(10)->get();
	}
	// GIOITHIEU
	public function gioithieu(){
		return $this->gioithieu->first();
	}

	// TINTUC
	public function tintuc($pagi){
		return $this->news->where('status',1)->orderBy('order','DESC')->paginate($pagi);
	}
	public function tintuc_detail($slug){
		return $this->news->where('slug',$slug)->first();
	}
	public function tintuc_relate($number,$slug){
		$current = $this->tintuc_detail($slug);
		return $current != null ? $this->news->where('status',1)->take($number)->offset($current->id)->get() : null;
	}
	// LIENHE
	public function contact(){
		return $this->contact->first();
	}
	public function contact_map(){
		return $this->contact->first()->map;
	}
	public function getEmailContact(){
		return $this->contact->select('email')->first();
	}

	// SEARCH
	public function search($key){
		return $this->sanpham->where('status',1)->whereRaw("MATCH(name,mota,style,chatlieu) AGAINST(? IN BOOLEAN MODE)", array($key))->paginate(10);
	}

	//CUSTOMER
	public function pushLienhe($data){
		return $this->customer->create($data);
	}


}