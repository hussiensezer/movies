<?php
ob_start();
$pageTitle = 'Episodes View ';
include 'init.php';
checkGuest();

// FETCH THE ROLE WHO WE ARE SELECT BY THE GET FOR ID TO EDIT OF HIS DATA
$prod = fetchForEdit('products',$_GET['id']);



// EPISODE_PRODUCT;
$sqlEpisode =  "SELECT * FROM episode_product WHERE product_id = {$_GET['id']} ORDER BY id  DESC";
$episodes = select_rows($sqlEpisode);

?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width ">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <a href='episode_create.php?on=<?php echo str_replace(' ', '-',$prod['name'] ) . "&id=" . $prod['id']?>' class='btn btn-success btn-sm mb-2'> <i class="fas fa-plus mr-1"></i>New Episode</a>
                <h1 class='text-center mb-5'><?php echo $prod['name'] ?></h1>
                <?php
                    view_alerts();
                ?>
                <!-- START TABLE -->
                <div class='table-responsive'>
                    <table class='table table-hover table-dark  table-striped text-center'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Active</th>
                                <th>Created_At</th>
                                <th>Updated_At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($episodes as $index => $epis):?>
                                <tr>
                                <td><?php echo $index + 1 ;?></td>
                                <td><a class='text-light' href="links_view.php?id=<?php echo $epis['id'] . '&epi=' . str_replace(' ', '-', $epis['name'] )  . '&prod=' . str_replace(' ', '-',$prod['name']) . '&idprod=' . $_GET['id'] ?>"> <?php echo $epis['name'] ;?> </a></td>
                                <td>
                                    <a href='process\episodes_process.php\active\<?php echo $epis['id']?>'>
                                        <span class='fa fa-check-circle <?php echo $epis['active'] == 1 ? 'text-success' :'text-muted' ;?>'>
                                        </span>
                                    </a>
                                </td>
                                <td><?php echo $epis['created_at'] ;?></td> 
                                <td><?php echo $epis['updated_at'] ;?></td>
                                <td>
                                    <a href='episode_edit.php?id=<?php echo $epis['id'] . '&name=' . str_replace(' ', '-', $prod['name'])?>' class='far fa-edit text-primary mr-2'></a>
                                    <a href='process\episodes_process.php\delete\<?php echo $epis['id']?>' class='fa fa-times-circle text-danger confirmed'></a>
                                </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- END TABLE -->
            </div>
        </div>
    </div>
</div>

<!-- END RIGHT SIDE -->





<!-- THE FOOTER -->
<?php 

include $tpl . 'footer.php';
ob_end_flush();

?>