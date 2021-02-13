
<style>
    #vendorBanner {
        position: relative; margin-bottom: 80px; background: lime;
    }
    #vendorBanner h1 {
        position: absolute; z-index: 2; left: 250px; bottom: -120px;
        height: 70px; line-height: 70px; float: left;
    }
    #vendorBanner {
        height: 200px; width: 100%;
    }
    #vendorLogo {
        position: absolute; z-index: 2; left: 50px; bottom: -75px;
        display: block; border: solid #fff 5px; width: 150px; height: 150px;
    }
</style>

<div id="vendorBanner">
    <img src="<?= $frontendData['vendor']['bannerPath']; ?>" alt="<?= $frontendData['vendor']['vendorName"']; ?>" id="vendorBanner">
    <img src="<?= $frontendData['vendor']['logoPath']; ?>" alt="<?= $frontendData['vendor']['vendorName"']; ?>" id="vendorLogo">
    <h1><?= $frontendData['vendor']['vendorName']; ?></h1>
</div>


<?php
    dmp($frontendData['vendor']);
    dmp($this->page);
?>