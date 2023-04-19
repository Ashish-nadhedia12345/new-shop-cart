<?php
class Address
{
    public $dbo;
    public $addressline1;
    public $addressline2;
    public $city;
    public $state;
    public $country;
    public $status;
    public function __construct()
    {
        $this->dbo = DBO::getDBO();
    }
    public function create()
    {
        $sql = "INSERT INTO  `addresses` 
        SET
        `address_line1`='$this->addressline1',
        `address_line2`='$this->addressline2',
        `city`='$this->city',
        `state`='$this->state',
        `country`='$this->country',
        `user_id`='" . $_SESSION['user']['id'] . "'";
        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_affected_rows($this->dbo) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function getAllAddress($userId)
    {
        $address = [];
        $sql = "SELECT * FROM `addresses` WHERE `user_id`='$userId' AND `status`=1";
        $result = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $address[] = $row;
            }
        }
        return $address;
    }
    public static function deleteAddress(int $id): bool
    {
        $sql = "UPDATE `addresses` SET `status` = 0 WHERE id = $id and `user_id` = '".$_SESSION['user']['id']."'";
        mysqli_query(DBO::getDBO(), $sql);
        return true;
    }
}
