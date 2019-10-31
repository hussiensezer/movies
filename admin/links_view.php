<?php
ob_start();
$pageTitle = 'Links View ';
include 'init.php';
checkGuest();




// EPISODE_PRODUCT;
$sqlUrl =  "SELECT * FROM url_product WHERE episode_id = {$_GET['id']} ORDER BY id  DESC";
$urls = select_rows($sqlUrl);

?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width ">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <a href='link_create.php?on=<?php echo str_replace(' ', '-',$_GET['prod'] ) . "&id=" . $_GET['id'] . '&epi=' . str_replace('-', ' ',$_GET['epi']) . '&idprod=' . $_GET['idprod'] ?>' class='btn btn-success btn-sm mb-2'> <i class="fas fa-plus mr-1"></i>New Link</a>
                <h1 class='text-center mb-1'><?php echo str_replace('-', ' ',$_GET['prod'] )  ?></h1>
                <h3 class='text-center mb-5'><?php echo str_replace('-', ' ',$_GET['epi'] )  ?></h3>
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
                            foreach($urls as $index => $url):?>
                                <tr>
                                <td><?php echo $index + 1 ;?></td>
                                <td><a class='text-light' href='<?php echo $url['link']?>'> <?php echo $url['link'] ;?> </a></td>
                                <td>
                                    <a href='process\links_process.php\active\<?php echo $url['id']?>'>
                                        <span class='fa fa-check-circle <?php echo $url['active'] == 1 ? 'text-success' :'text-muted' ;?>'>
                                        </span>
                                    </a>
                                </td>
                                <td><?php echo $url['created_at'] ;?></td> 
                                <td><?php echo $url['updated_at'] ;?></td>
                                <td>
                                    <a href='link_edit.php?id=<?php echo $url['id'] . '&on=' .  str_replace(' ', '-',$_GET['prod']) . '&epi=' . str_replace(' ', '-',$_GET['epi']) . '&idprod=' . $_GET['idprod'] ?>' class='far fa-edit text-primary mr-2'></a>
                                    <a href='process\links_process.php\delete\<?php echo $url['id']?>' class='fa fa-times-circle text-danger confirmed'></a>
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