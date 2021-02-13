<?php
/**
 *
 */
//dmp($productCategoriesTree);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm" id="megamenu">
<!--    <a href="#" class="navbar-brand font-weight-bold d-block d-lg-none">MegaMenu</a>-->
    <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbarContent" class="collapse navbar-collapse">
        <ul class="navbar-nav mx-auto">

        <?php
        foreach($productCategoriesTree as $key => $category):
            $megamenuClass = empty($category['subCategories']) ? '' : ' dropdown megamenu';
            $dropDownAttrs = empty($category['subCategories']) ? '' : 'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
            $dropDownToggler = empty($category['subCategories']) ? '' : 'dropdown-toggle';
            $subcats = count($category['subCategories']);
            ?>

            <li class="nav-item <?= $megamenuClass; ?>">
                <a id="megamneu-<?= $category['pageID']; ?>" href="/<?= $category['pageUri']; ?>" <?= $dropDownAttrs; ?> class="nav-link <?= $dropDownToggler; ?> font-weight-bold text-uppercase"><?= $category['pageName']; ?></a>
                <div aria-labelledby="megamneu-<?= $category['pageID']; ?>" class="dropdown-menu border-0 p-0 m-0">
                    <div class="container">
                        <div class="row bg-light rounded-0 py-2 shadow-sm w-100">

                        <?php foreach($category['subCategories'] as $subCategory_1): ?>

                            <div class="col-md-3">
                                <h6 class="font-weight-bold text-uppercase"><?= $subCategory_1['pageName']; ?></h6>
                                <ul class="list-unstyled">

                                    <?php foreach($subCategory_1['subCategories'] as $subCategory_2): ?>

                                    <li class="nav-item"><a href="/<?= $subCategory_2['pageUri']; ?>" class="nav-link text-small pb-0"><?= $subCategory_2['pageName']; ?></a></li>

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


<?php /*
                        <?php
                        foreach($productCategoriesTree as $category):
                        $megamenuClass = empty($category['subCategories']) ? '' : ' megamenu';
                        ?>

                            <div class="col-md-3">
                                <a id="megamneu-<?= $category['pageID']; ?>" href="/<?= $category['pageUri']; ?>" class="nav-link font-weight-bold text-uppercase"><?= $category['pageName']; ?></a>
                                <ul class="list-unstyled">
                                    <?php foreach($category['subCategories'] as $subCategory_1): ?>
                                    <li class="nav-item"><a id="megamneu-<?= $subCategory_1['pageID']; ?>" href="/<?= $subCategory_1['pageUri']; ?>" class="nav-link font-weight-bold text-uppercase"><?= $subCategory_1['pageName']; ?></a></li>
                                    <ul class="list-unstyled pl-2">
                                        <?php foreach($subCategory_1['subCategories'] as $subCategory_2): ?>
                                            <li class="nav-item"><a id="megamneu-<?= $subCategory_2['pageID']; ?>" href="/<?= $subCategory_2['pageUri']; ?>" class="nav-link font-weight-bold"><?= $subCategory_2['pageName']; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        <?php endforeach; ?>
 */

