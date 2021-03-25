<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Home</title>
        <!--<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">-->
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/vendor/datatables.min.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/css/style.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/vendor/perfect-scrollbar.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/vendor/pickadate/classic.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/vendor/pickadate/classic.date.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/vendor/datatables.min.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/vendor/sweetalert2.min.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/vendor/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/vendor/select2.min.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/vendor/select2-bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/fonts/fontawesome/css/all.min.css">
        <link rel="icon" href="<?= base_url('assets') ?>/images/favicon.png" sizes="32x32" />
        <link rel="icon" href="<?= base_url('assets') ?>/images/favicon.png" sizes="192x192" />
        <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets') ?>/images/favicon.png" />
        <script type="text/javascript" src="<?= base_url('assets') ?>/js/vendor/jquery.min.js"></script>
        <script src="<?= base_url('assets') ?>/js/vendor/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url('assets') ?>/js/vendor/sweetalert2.min.js"></script>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Business Ideas</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">

                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.col-lg-3 -->
        <div class="row">

            <div class="col-lg-1">

            </div>
            <div class="col-lg-10 " style="margin-top:10px ">



                <div class="row" >
                    <?php
                    $sr = $this->paginator->get_start_count();
                    foreach ($products as $key => $value) {
                        ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail" >
                                <img src="<?=base_url('uploads/images/').$value->cover_image ?>" class="img-responsive">
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <h3><a href="<?= base_url('product-detail/').$value->product_id.'/'.$value->product_name?>"><?=$value->product_name?></a></h3>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <h5  class="col-md-6 text-nowrap text-success text-left">Profit: $<?=$value->profit?></h5>
                                        <h5 class="col-md-6 text-nowrap text-right">Price: $<?=$value->price?></h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-10">
                                            <p class="card-text">Date: <?=date('d-M-Y', strtotime($value->date))?></p>
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
                <!-- /.row -->

            </div>
        </div>
        <!-- /.col-lg-9 -->

    </body>
    <script>
        var url = "<?= base_url('assets') ?>/images";
        var base_url = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url('assets') ?>/js/vendor/jquery.mask.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/vendor/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/vendor/datatables.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/vendor/pickadate/picker.js"></script>
    <script src="<?= base_url('assets') ?>/js/vendor/pickadate/picker.date.js"></script>
    <script src="<?= base_url('assets') ?>/js/es5/script.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/vendor/datatables.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/vendor/dropzone.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/vendor/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/vendor/select2.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/scripts.js"></script>
</body>

</html>