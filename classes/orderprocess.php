<?php
class orderProcess
{
    public static function AddtoCart($productId, $qty)
    {
        $dbo = DBO::getDBO();
        $msg = '';
        $product = Product::getProduct($productId);
        $userId = $_SESSION['user']['id'] ?? 0;
        $sessionId = session_id();
        $sql = "SELECT * FROM `cart` WHERE `product_id`='$productId' AND `session_id`='$sessionId'";
        $result = mysqli_query($dbo, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE `cart` SET `qty`=`qty`+ $qty  WHERE `product_id`='$productId' AND `session_id`='$sessionId'";
            $msg = 'product quantity updated in cart';
        } else {
            $sql = "INSERT INTO `cart` SET `product_id` = '$productId', `session_id` = '$sessionId', `user_id` = '$userId', `price` = '" . $product['price'] . "', `qty` = '$qty', `created_at` = '" . date('Y-m-d H:i') . "'";
            $msg = 'Product added into cart';
        }
        mysqli_query($dbo, $sql);
        return $msg;
    }
    public static function removefromcart($id)
    {
        $dbo = DBO::getDBO();
        $sql = "DELETE FROM `cart` WHERE `id`='$id'";
        mysqli_query($dbo, $sql);
        return true;
    }
    public static function updatecart($id, $qty)
    {
        $dbo = DBO::getDBO();
        $sql = "UPDATE `cart` SET `qty`='$qty' WHERE `id`='$id'";
        mysqli_query($dbo, $sql);
        return true;
    }
    public static function createOrder($addressId)
    {
        $dbo = DBO::getDBO();
        $orderId = 0;
        $sql = "SELECT * FROM `orders` WHERE `id`='" . $_SESSION['user']['id'] . "' AND `order_status`='in progress'";
        
        $result = mysqli_query($dbo, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $orderId = $row['id'];            
        } else {
            $order = new Order;
            $order->userId = $_SESSION['user']['id'];
            $order->amount = 0.00;
            $order->createdAt = date('Y-m-d');
            $order->addressId = $addressId;
            $order->paymentStatus = 'unpaid';
            $order->orderStatus = 'in progress';
            $orderId = $order->create();
        }
        //order present in cart
        $sql="SELECT * FROM `cart` WHERE `user_id`='".$_SESSION['user']['id']."'";
        $result=mysqli_query($dbo,$sql);
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                // if order exists in order detail
                $sql="SELECT * FROM `orders-detail` WHERE `order_id`='$orderId' AND `product_id`='".$row['product_id']."'";
                $result=mysqli_query($dbo,$sql);
                // if exists avoid it and do nothing
                if(mysqli_num_rows($result)>0){
                    // do nothing
                }else{                    
                    //insert into order-detail page 
                    $product=Product::getProduct($row['product_id']);
                    $orderDetail = new OrderDetail;
                    $orderDetail->orderId = $orderId;
                    $orderDetail->productId = $row['product_id'];
                    $orderDetail->title = $product['title'];
                    $orderDetail->price = $row['price'];
                    $orderDetail->qty = $row['qty'];
                    $orderDetail->create();                    
                 }
            }
        }
        return true;
    }
}
