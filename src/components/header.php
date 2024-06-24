<?php
$page_title = isset($page_title) ? $page_title : 'Default Title';
$page_current = isset($page_current) ? $page_current : 'Default Page';
?>

<!-- Header -->
<div class="d-flex flex-column vw-100 border-bottom shadow py-2"
    style="padding-left: 150px; height:175px; background: white;">
    <div class="d-flex px-0 mx-5">
        <h1 id="titulo" class="text-start h-75"><?php echo $page_title; ?></h1>
    </div>
    <div class="d-flex align-items-end px-0 border-top border-2 mt-5">
        <div class="d-flex align-items-center justify-content-start pt-3 mx-5">
            <a class="link-secondary link-opacity-75 link-offset-2 link-underline link-underline-opacity-10"
                href="./index.php">Inicio</a>
            <div class="mx-2 opacity-75">/</div>
            <a id="pag_actual" class="link-secondary link-offset-2 link-underline link-underline-opacity-10"
                href="<?php echo $page_current; ?>"><?php echo $page_title; ?></a>
        </div>
    </div>
</div>