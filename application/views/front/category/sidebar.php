<h3 class="my-5">
    <span class="my-3"><span class="text-danger"><i class="fa fa-fire"></i></span></span> <b>Trending Topics</b>
</h3>
<?php foreach ($post_popular as $post_popular) : ?>
    <a href="<?php echo base_url('post/detail/' . $post_popular->post_slug); ?>" class="card mb-3 bg-dark text-white shadow-sm border-0 bg-overlay ">
        <div class="home3-img-frame">
            <img class="card-img" src="<?php echo base_url('assets/img/post/thumbs/' . $post_popular->post_image); ?>" alt="Card image">
        </div>
        <div class="card-img-overlay d-flex flex-column align-items-start" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,0.8))">
            <h3 class="card-title mt-auto text-white"><?php echo substr($post_popular->post_title, 0, 35); ?>..</h3>
            <p class="card-text"><i class="bi-clock"></i> <?php echo date_time_ago($post_popular->created_at); ?></p>
            <span class="badge bg-light-success text-success mr-2"><?php echo $post_popular->category_name; ?></span>
        </div>
    </a>
<?php endforeach; ?>

<h3 class="my-5"> <span class="my-3"><i class="fa fa-tags"></i></span> <b>Category</b></h3>
<ul class="list-group list-group-flush">
    <?php foreach ($category as $category) : ?>
        <ul>
            <li><a class="text-decoration-none text-muted fs-4" href="<?php echo base_url('category/item/' . $category->category_slug); ?>"> <?php echo $category->category_name; ?></a></li>
        </ul>
    <?php endforeach; ?>
</ul>