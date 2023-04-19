<?php
class Category
{
    public $dbo;
    public $title;
    public $description;
    public $image;
    public $parentID;
    public $status;
    public function __construct()
    {
        $this->dbo = DBO::getDBO();
    }
    public function create()
    {
        $sql = "INSERT INTO `categories` SET `title` = '$this->title', `image` = '$this->image', `description` = '$this->description'";
        $result = mysqli_query($this->dbo, $sql);
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
                $cat = self::getCategory($_GET['id']);
                return $cat['image'];
            } else { // create case
                return 'noimg.png';
            }
        }
    }
    public function updateCategory($id)
    {
        $sql = "UPDATE `categories` SET `title`='$this->title',`description`='$this->description',`image`='$this->image' WHERE `id`='$id'";
        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_affected_rows($this->dbo) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function deleteCategory($id)
    {
        $sql = "DELETE FROM `categories` WHERE `id`='$id'";
        mysqli_query(DBO::getDBO(), $sql);
        return true;
    }
    public static function getAllCategory()
    {
        $category = [];
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $category[] = $row;
            }
        }
        return $category;
    }
    public static function getCategory($id)
    {
        $category = [];
        $sql = "SELECT * FROM `categories` WHERE `id`='$id'";
        $result = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return false;
        }
    }
}
