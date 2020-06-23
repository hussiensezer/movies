<?php
ob_start();
$back = '';
$noNavbar = '';
$noHeader = '';
include '../init.php';

checkGuest();

if(isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 'show'):
// FETCH ALL THE DATA SEND TO Cateogries
$sql = "SELECT categories.*, users.name AS created_by FROM categories INNER JOIN users ON categories.user_id = users.id";
$cateogries = select_rows($sql);

foreach($cateogries as $index => $cat) {?>
    <tr>
    <td><?php echo $index + 1 ;?></td>
    <td><?php echo $cat['name'] ;?></td>
    <td>
        <a href='process\categories_active.php' class='active_cate' data-id="<?php echo $cat['id']?>">
            <span class='fa fa-check-circle <?php echo $cat['active'] == 1 ? 'text-success' :'text-muted' ;?>'>
            </span>
        </a>
    </td>
    <td><?php echo ucfirst($cat['created_by']) ;?></td>
    <td><?php echo $cat['created_at'] ;?></td>
    <td><?php echo $cat['updated_at'] ;?></td>
    <td>
        <a href='category_edit.php?id=<?php echo $cat['id']?>' class='far fa-edit text-primary mr-2'></a>
        <a href='process\categories_delete.php' class='fa fa-times-circle text-danger confirmed delete-cate' data-id="<?php echo $cat['id']?>"></a>
    </td>
    </tr>
<?php
   }

else:

echo "<div class='alert alert-danger'> Sorry Something Is Wrong </div>";
endif;
