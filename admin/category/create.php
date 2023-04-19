<h5>Create Category</h5>
<form action="<?=SITE_WS_PATH.'/admin/category/categories.php?action=createCategory'?>" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr>
            <td><input type="text" name="title" placeholder="title" required class="form-control"></td>
        </tr>
        <tr>
            <td><textarea name="description" id="" cols="30" rows="10" class="form-control" required placeholder="description"></textarea></td>
        </tr>
        <tr>
            <td><input type="file" name="image" placeholder="image" class="form-control"></td>
        </tr>
        <tr>
            <td><button  class="btn btn-primary">save</button></td>
        </tr>
    </table>
</form>