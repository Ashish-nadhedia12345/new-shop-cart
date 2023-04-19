<?php
class Order{
    public $dbo;
    public $userId;
    public $addressId;
    public $amount;
    public $paymentStatus;
    public $orderStatus;
    public $createdAt;
    public function __construct()
    {
        $this->dbo=DBO::getDBO();
    }
    public function create(){
        $sql="INSERT INTO `orders` SET `user_id`='$this->userId',`address_id`='$this->addressId',`amount`='$this->amount',`payment_status`='$this->paymentStatus',`order_status`='$this->orderStatus',`created_at`='$this->createdAt'";
        $result=mysqli_query($this->dbo,$sql);
        if(mysqli_affected_rows($this->dbo)>0){
            return mysqli_insert_id($this->dbo);
        }else{
            return false;
        }
    }
    public static function getAllOrder(){
        $order=[];
        $sql="SELECT * FROM `orders`";
        $result=mysqli_query(DBO::getDBO(),$sql);
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $order[]=$row;
            }
        }
            return $order;
    }
    public static function getOrder(int $id): array|bool
    {        
        $sql = "SELECT * FROM `orders` WHERE id = $id";
        $result = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return false;
        }
    }

} 