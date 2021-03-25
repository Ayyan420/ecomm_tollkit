<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row" >
            <?php
            $sr = $this->paginator->get_start_count();
            foreach ($products as $key => $value) {
                ?>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail" >
                        <img src="<?= base_url('uploads/images/') . $value->cover_image ?>" class="img-responsive">
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <h3><a href="<?= base_url('public-product-detail/') . $value->product_id . '/' . $value->product_name ?>"><?= $value->product_name ?></a></h3>
                                </div>

                            </div>
                            <div class="row">
                                <h5  class="col-md-6 text-nowrap text-success text-left">Profit: $<?= $value->profit ?></h5>
                                <h5 class="col-md-6 text-nowrap text-right">Price: $<?= $value->price ?></h5>
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <p class="card-text">Date: <?= date('d-M-Y', strtotime($value->date)) ?></p>
                                </div>
                                <div class="col-md-2">
                                    <a class="text-right"><span class="glyphicon glyphicon-star"></span></a> 
                                </div>
                            </div>

                            <p> </p>
                        </div>
                    </div>
                </div>
                <?php
            }
            if (empty($products)) {
                ?>
                <tr>
                    <td colspan="100" class="text-center">No Record Found</td>
                </tr>
            <?php }
            ?>

        </div>
        <?php echo $this->paginator->get_links(); ?>
    </div>
</div>
