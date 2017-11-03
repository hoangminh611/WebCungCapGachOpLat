<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}
	//thêm sản phẩm
	public function add($item, $id,$quantity){
		$giohang = ['qty'=>0, 'price' => 0, 'item' => $item];
		if($this->items){
			//kiểm tra cái id co trong $this->item k
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}	
			$giohang['qty']+=$quantity;
			$giohang['price'] = $item->export_price * $giohang['qty'];
			$this->items[$id] = $giohang;
			$this->totalQty+=$quantity;
			$this->totalPrice +=  $item->export_price * $quantity;
	}

	//giảm 1
	public function reduceByOne($id){ 
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']->export_price;;
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']->export_price;;
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
		if($this->totalQty<=0){
			unset($this->totalPrice);
		}
	}
	//tăng 1
	public function riseByOne($id){ 
		$this->items[$id]['qty']++;
		$this->items[$id]['price'] += $this->items[$id]['item']->export_price;
		$this->totalQty++;
		$this->totalPrice += $this->items[$id]['item']->export_price;
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
		if($this->totalQty<=0){
			unset($this->totalPrice);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
