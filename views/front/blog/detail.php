<div class="container my-4">
<?php 
        if (!$response->result) {
            echo '<div class="alert alert-danger">' . $response->exception . '</div>';
        } else { 
        ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <a href="/blog" class="btn btn-dark btn-sm"> <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
    </a>
       
    <h1 class="h2 py-0 px-3"><?php echo $response->value->title; ?></h1>
        <i class="fas fa-blog fa-2x"></i>
    </div>
    <div class="row justify-content-center">
     
            <div class="col-md-10">
                <img src="https://files.idyllic.app/files/static/2384139?width=640&optimizer=image" class="img-fluid mb-4 mx-auto d-block" alt="<?php echo $response->value->title; ?>">
                <p class="text-muted text-center">Yayınlanma Tarihi: <?php echo date('d M Y', strtotime($response->value->created_at)); ?></p>
                <div class="content bg-light p-4 rounded">
                    <?php echo $response->value->description; ?>
                </div>
            </div>
        <?php 
        }
        ?>
    </div>
</div>
