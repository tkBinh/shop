<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart) {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add($item, $id) {
        //giỏ hàng là 1 mảng
        //khởi tạo giỏ hàng rỗng
        $cart = ['qty' => 0, 'price' => $item->unit_price, 'item' => $item];
        //thêm 1 sản phẩm vào giỏ hàng
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
               $cart = $this->items[$id];
            }
        }
        //thêm 1 vào số lượng
        $cart['qty']++;
        //tính tiền sản phẩm vừa thêm theo số lượng
        $cart['price'] = $item->unit_price * $cart['qty'];
        $this->items[$id] = $cart;
        //thêm 1 vào biến tổng sản phẩm
        $this->totalQty++;
        //thêm tiền sản phẩm vào tổng tiền giỏ hàng
        $this->totalPrice += $item->unit_price;
    }
    //Xóa 1 sản phẩm trong giỏ
    public function reduceOne($id) {
        //Giảm 1 trong số lượng sản phẩm
        $this->items[$id]['qty']--;
        // ?
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }
    //gỡ nhiều sản phẩm khỏi giỏ
    public function removeItem($id) {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }




}
