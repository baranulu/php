<div class="container my-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2 py-0 px-3">Blog Makaleleri</h1>
        <i class="fas fa-blog fa-2x"></i>
    </div>

    <div class="row">
        <?php if ($response->result): ?>
            <?php foreach ($response->value as $post): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://files.idyllic.app/files/static/2384139?width=640&optimizer=image" class="card-img-top" alt="<?= htmlspecialchars($post['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                            <p class="card-text"><?= substr($post['description'], 0, 100) ?>...</p>
                            <a href="/blog/detail/<?= $post['slug'] ?>" class="btn btn-dark btn-sm">Devamını Oku</a>
                        </div>
                        <div class="card-footer text-muted">
                            Yayınlanma Tarihi: <?= date('d M Y', strtotime($post['created_at'])) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="alert alert-warning">Henüz blog makalesi eklenmemiş.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
