<?php
class PRODUCT
{
    public $dbo;
    public $title;
    public $description;
    public $image;
    public $catID;
    public $status;
    public $price;
    public function __construct()
    {
        $this->dbo = DBO::getDBO();
    }
    public function create()
    {
        $sql = "INSERT INTO `products` SET `title` = '$this->title', `image` = '$this->image', `description` = '$this->description' , `cat_id` = '$this->catID' ";
        $result=mysqli_query($this->dbo, $sql);
        if (mysqli_affected_rows($this->dbo) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function uploadImage($imageFieldName, $editCase = false): string
    {
        // check if image is uploading
        if (isset($_FILES[$imageFieldName]) && $_FILES[$imageFieldName]['name'] != '') {
            $ext = substr($_FILES[$imageFieldName]['name'], strrpos($_FILES[$imageFieldName]['name'], '.'));
            $newFileName = md5(time()) . uniqid() . $ext;
            //exit($_FILES[$imageFieldName]['tmp_name']);
            if (move_uploaded_file($_FILES[$imageFieldName]['tmp_name'], PRODUCT_IMAGES_FS_PATH . $newFileName)) {
                return $newFileName;
            } else {
                return 'noimg.png';
            }
        } else {
            // image not uploaded
            if ($editCase == true) { // if edit category submitted and image is not uploaded
                $cat = self::getProduct($_GET['id']);
                return $cat['image'];
            } else { // create case
                return 'noimg.png';
            }
        }
    }
    public function updateProduct($id)
    {
        $sql = "UPDATE `products` SET `title`='{$this->title}',`description`='{$this->description}',`image`='$this->image', `price` = '{$this->price}' WHERE `id`='$id'";
        $result = mysqli_query($this->dbo, $sql);
        return true;
    }
    public static function deleteProduct($id)
    {
        $sql = "DELETE FROM `products` WHERE `id`='$id'";
        mysqli_query(DBO::getDBO(), $sql);
        return true;
    }
    public static function getAllProduct($catID=0)
    {
        $product = [];
        $sql = "SELECT * FROM `products`";
        $result = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $product[] = $row;
            }
        }
        return $product;
    }
    public static function getProduct($id)
    {
        $product = [];
        $sql = "SELECT * FROM `products` WHERE `id`='$id'";
        $result = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return false;
        }
    }
}
