<?php
class OrderDetail{
    public $dbo;
    public $orderId;
    public $productId;
    public $title;
    public $price;
    public $qty;
    public function __construct()
    {
        $this->dbo=DBO::getDBO();
    }
    public function create(){
        $sql="INSERT INTO `orders-detail` SET `order_id`='$this->orderId',`product_id`='$this->productId',`title`='$this->title',`price`='$this->price',`qty`='$this->qty'";
        $result=mysqli_query($this->dbo,$sql);
        if(mysqli_affected_rows($this->dbo)>0){
            return true;
        }else{
            return false;
        }
    }
    public static function getOrderDetail($orderId){
        $orderdetail=[];
        $sql="SELECT * FROM `orders-detail`";
        $result=mysqli_query(DBO::getDBO(),$sql);
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $orderdetail[]=$row;
            }
        }
            return $orderdetail;
    }
    

} 