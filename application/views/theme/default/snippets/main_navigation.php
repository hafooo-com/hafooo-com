<?php
/**
 *
 */
//dmp($productCategoriesTree);
$megaMenu = $menu['mega_menu'];
?>

    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm" id="megamenu">
        <!--    <a href="#" class="navbar-brand font-weight-bold d-block d-lg-none">MegaMenu</a>-->
        <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarContent" class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">

                <?php
                foreach($megaMenu as $key => $category):
                    $megamenuClass = empty($category['subs']) ? '' : ' dropdown megamenu';
                    $dropDownAttrs = empty($category['subs']) ? '' : 'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                    $dropDownToggler = empty($category['subs']) ? '' : 'dropdown-toggle';
                    $subcats = count($category['subs']);
                    ?>

                    <li class="nav-item <?= $megamenuClass; ?>">
                        <a id="megamneu-<?= $category['menuItemID']; ?>" href="/<?= $category['uri']; ?>" <?= $dropDownAttrs; ?> class="nav-link <?= $dropDownToggler; ?> font-weight-bold text-uppercase"><?= $category['title']; ?></a>
                        <div aria-labelledby="megamneu-<?= $category['menuItemID']; ?>" class="dropdown-menu border-0 p-0 m-0">
                            <div class="container">
                                <div class="row bg-light rounded-0 py-2 shadow-sm w-100">

                                    <?php foreach($category['subs'] as $subCategory_1): ?>

                                        <div class="col-md-3">
                                            <h6 class="font-weight-bold text-uppercase"><?= $subCategory_1['title']; ?></h6>
                                            <ul class="list-unstyled">

                                                <?php foreach($subCategory_1['subs'] as $subCategory_2): ?>

                                                    <li class="nav-item"><a href="/<?= $subCategory_2['uri']; ?>" class="nav-link text-small pb-0"><?= $subCategory_2['title']; ?></a></li>

                                                <?php endforeach; ?>

                                            </ul>
                                        </div>

                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </li>

                <?php
                endforeach;
                ?>

            </ul>
        </div>
    </nav>
