
    </div><!-- #content .container-->
</div><!-- #content-->


<footer id="footer">
    <div class="container">
        <div class="row">


            <div class="col-3">
                <ul>
                    <li>homepage</li>
                    <li>cart</li>
                    <li>checkout</li>
                    <li>search result</li>
                    <li>vendor/home</li>
                    <li>vendor/index</li>
                    <li>vendor/details</li>
                    <li>vendor/registration</li>
                    <li>vendor/products(CRUD)</li>
                    <li>vendor/orders(CRUD)</li>
                </ul>
            </div>

            <div class="col-3">
                <ul>
                    <li>user/index</li>
                    <li>user/orders</li>
                    <li>user/details</li>
                    <li>admin/index</li>
                    <li>admion/products</li>
                    <li>admin/users</li>
                </ul>
            </div>

            <div class="col-6">
                <form id="dict-form">

                    <div class="form-group row">
                        <div class="col">
                            <label for="phraseKey">KEY</label>
                            <input id="phraseKey" name="phraseKey" type="text" class="form-control" required="required">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="appView">App view</label>
                            <input id="appView" name="appView" type="text" class="form-control" required="required">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="en">EN</label>
                            <input id="en" name="en" type="text" class="form-control" required="required">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="sk">SK</label>
                            <input id="sk" name="sk" type="text" class="form-control" required="required">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="cs">CS</label>
                            <input id="cs" name="cs" type="text" class="form-control" required="required">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <div id="btn-dict" class="btn btn-primary"> * * * GO * * * </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <?php
//    dmp(get_defined_vars());
//dmp($productCategoriesTree);
?>
</footer>

<div id="bottom-bar">
    <div class="container">
        <p>POWERED BY SYSTEM 1006</p>
    </div>
</div>

<?php
//$frontendData
//dmp($this->page);
?>
<script src="/theme/default/js/jquery-3.5.1.min.js"></script>
<script src="/theme/default/js/popper.min.js"></script>
<script src="/theme/default/assets/bootstrap/js/bootstrap.js"></script>
<script src="/theme/default/js/common.min.js<?= kc(); ?>"></script>

<?php
if(isset($frontendData['js'])):
foreach($frontendData['js'] as $jsFile):
    if(is_file(FCPATH . trim($jsFile, '/'))):
    ?>
<script src="<?= $jsFile; ?><?= kc(); ?>"></script>
    <?php
    endif;
endforeach;
endif;
?>
<?php if(is_file(FCPATH . 'theme/default/js/' . strtolower($viewFile) . '.min.js')): ?><script src="/theme/default/js/<?= strtolower($viewFile); ?>.min.js<?= kc(); ?>"></script><?php endif; ?>

</body>
</html>