<?php

defined( 'ABSPATH' ) || exit;

$user = wp_get_current_user();
if ( $user ) :
    ?>
    <?php $user_info = get_userdata($user->ID);
    
    if (isset($user_info->display_name)){
        $user_name = $user_info->display_name;
    }else{
        $user_name = 'Anónimo';
    }
?>
				

<?php endif;

?>
<div class="row pb-3">
    <div class="col-md-6 zindex-3">
        <img class="img-fluid px-5" src="<?php echo get_template_directory_uri().'/img/subheader.png' ?>" alt="hola">
    </div>
    <div class="col-md-6 d-flex align-items-start flex-column zindex-3">
        <!-- Search form -->
        <div class="w-100">
            <?php echo get_search_form(); ?>
        </div>
        <div class="mt-auto pb-5">
            <h1>HOLA, <?php if ( isset($user_name) ) {echo $user_name;} ?></h1>
        </div>
    </div>
    <div class="subheader-text bg-gris py-2 zindex-1">
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 d-flex align-items-center">
                <span>Recuerda <strong>"Trabaja con moral y la moral te traerá dignidad"</strong></span>
            </div>
        </div>
    </div>

</div>