<?php  require APPROOT .'/views/include/header.php'; ?>
<h1><?php echo $data['title'] ?></h1>
<ul>
    <?php foreach($data['post'] as $post) : ?>
        <li><?php echo $post->title; ?></li>
    <?php endforeach; ?>

</ul>
<?php  require APPROOT .'/views/include/footer.php'; ?>
