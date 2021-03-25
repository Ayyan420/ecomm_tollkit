<link rel="stylesheet" href="<?= base_url('assets') ?>/trumbowyg/dist/ui/trumbowyg.min.css">
<script src="<?= base_url('assets') ?>/trumbowyg/dist/trumbowyg.min.js"></script>
<script src="<?= base_url('assets') ?>/js/vendor/dropzone.min.js"></script>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <form action="<?= base_url('edit-product/') . $product->product_id ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label>Name</label><span class="text-danger">*</span>
                    <input type="text" required=""  placeholder="Name"  class="form-control" name="product_name" value="<?= $product->product_name ?>">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label>Competitor Store URL</label><span class="text-danger">*</span>
                    <input type="text" required=""  placeholder="Competitor Store URL"  class="form-control" name="competitor_store_url" value="<?= $product->competitor_store_url ?>">
                </div>
            </div>
            <div class="col-md-12 form-group mb-3">
                <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <label>Cover Image</label> <span class="text-danger">*</span>
                        <input type="file" onchange="readURL(this);" class="form-control" name="cover_image" value="<?= $product->cover_image ?>">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <image heigh=100 width="100"  id="blah" alt="Image" src="<?= base_url('uploads/images/') . $product->cover_image ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group mb-3">
                    <label>COGs</label><span class="text-danger">*</span>
                    <input type="text" required="" placeholder="COGs" class="form-control" name="cogs" value="<?= $product->cogs ?>">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label>Profit</label><span class="text-danger">*</span>
                    <input type="text" required="" placeholder="Profit" class="form-control" name="profit" value="<?= $product->profit ?>">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label>Price</label><span class="text-danger">*</span>
                    <input type="text" required="" placeholder="Price"  class="form-control" name="price" value="<?= $product->price ?>">
                </div>
            </div>
            <div class="col-md-12 form-group mb-3">
                <label>Description</label><span class="text-danger">*</span>
                <textarea id="trumbowyg" name="description" class="form-control"><?= $product->description ?></textarea>
            </div>
            <hr>
            <h3>Ad creative</h3>
            <div class="row">
                <div class="col-md-4 form-group mb-3">
                    <label>Video ad #1</label><span class="text-danger"></span>
                    <input type="text" placeholder="URL" class="form-control" name="video_ad_1" value="<?= $product->video_ad_1 ?>">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label>Video ad #2</label><span class="text-danger"></span>
                    <input type="text" placeholder="URL" class="form-control" name="video_ad_2" value="<?= $product->video_ad_2 ?>">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label>Thumbnail</label><span class="text-danger"></span>
                    <input type="text" placeholder="URL" class="form-control" name="thumbnail" value="<?= $product->thumbnail ?>">
                </div>
            </div>
            <hr>
            <h3>Facebook Targeting</h3>
            <div class="col-md-12 form-group mb-3">
                <label>Facebook targeting</label><span class="text-danger"></span>
                <input type="text" placeholder="Comma Seprated" class="form-control" name="facebook_targeting" value="<?= $product->facebook_targeting ?>">
            </div>
            <hr>
            <h3>Competitor Video</h3>
            <div class="row">
                <div class="col-md-3 form-group mb-3">
                    <label>Likes</label><span class="text-danger"></span>
                    <input type="number" min="0" placeholder="0" class="form-control" name="likes" value="<?= $product->likes ?>">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label>Comments</label><span class="text-danger"></span>
                    <input type="number" min="0" placeholder="0" class="form-control" name="comments" value="<?= $product->comments ?>">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label>Shares</label><span class="text-danger"></span>
                    <input type="number" min="0" placeholder="0" class="form-control" name="shares" value="<?= $product->shares ?>">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label>Competitor ad</label><span class="text-danger"></span>
                    <input type="text" placeholder="URL" class="form-control" name="competitor_ad" value="<?= $product->competitor_ad ?>">
                </div>

            </div>
            <hr>
            <h3>Ali Express</h3>
            <div class="row">
                <div class="col-md-3 form-group mb-3">
                    <label>Supplier 1</label><span class="text-danger"></span>
                    <input type="text"  placeholder="URL" class="form-control" name="supplier_1" value="<?= $product->supplier_1 ?>">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label>Supplier 1 Order</label><span class="text-danger"></span>
                    <input type="number" min="0"  placeholder="0" class="form-control" name="supplier_1_order" value="<?= $product->supplier_1_order ?>">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label>Supplier 2</label><span class="text-danger"></span>
                    <input type="text" placeholder="URL" class="form-control" name="supplier_2" value="<?= $product->supplier_2 ?>">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label>Supplier 2 Order</label><span class="text-danger"></span>
                    <input type="number" min="0" placeholder="0" class="form-control" name="supplier_2_order" value="<?= $product->supplier_2_order ?>">
                </div>

            </div>
            <hr>
            <h3>Amazon</h3>
            <div class="row">
                <div class="col-md-4 form-group mb-3">
                    <label>Product 1</label><span class="text-danger"></span>
                    <input type="text"  placeholder="URL" class="form-control" name="product_1" value="<?= $product->product_1 ?>">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label>Product 1 reviews</label><span class="text-danger"></span>
                    <input type="number" min="0"  placeholder="0" class="form-control" name="product_1_reviews" value="<?= $product->product_1_reviews ?>">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label>Product 1 ratings</label><span class="text-danger"></span>
                    <input type="number" min="0" max="5"  placeholder="rating count out of 5" class="form-control" name="product_1_ratings" value="<?= $product->product_1_ratings ?>">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label>Product 2</label><span class="text-danger">*</span>
                    <input type="text"  placeholder="URL" class="form-control" name="product_2" value="<?= $product->product_2 ?>">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label>Product 2 reviews</label><span class="text-danger"></span>
                    <input type="number" min="0"  placeholder="0" class="form-control" name="product_2_reviews" value="<?= $product->product_2_reviews ?>">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label>Product 2 ratings</label><span class="text-danger"></span>
                    <input type="number" min="0" max="5"  placeholder="rating count out of 5" class="form-control" name="product_2_ratings" value="<?= $product->product_2_ratings ?>">
                </div>
                <div class="col-md-12 form-group mb-3">
                    <label>Date</label></span>
                    <input type="date" class="form-control picker2" name="date" value="<?= date('Y-m-d',strtotime($product->date)) ?>">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label class="switch switch-primary mr-3">
                        <span>Status</span>
                        <input type="checkbox" name="active" <?= ($product->active) ? 'checked' : '' ?> value="1">
                        <span class="slider"></span>
                    </label>
                </div>

            </div>
            <div class="col-md-12 form-group mb-3">
                <input class="btn btn-block btn-success" type="submit" value="Update Product">
            </div>
        </form>
    </div>
</div>

<script>

    $('#trumbowyg').trumbowyg({
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


//     Dropzone.options.mydropzone = {
//    //url does not has to be written 
//    //if we have wrote action in the form 
//    //tag but i have mentioned here just for convenience sake 
//        url: 'upload.php', 
//        addRemoveLinks: true,
//        autoProcessQueue: false, // this is important as you dont want form to be submitted unless you have clicked the submit button
//        autoDiscover: false,
//        paramName: 'pic', // this is optional Like this one will get accessed in php by writing $_FILE['pic'] // if you dont specify it then bydefault it taked 'file' as paramName eg: $_FILE['file'] 
//        previewsContainer: '#dropzonePreview', // we specify on which div id we must show the files
//        clickable: false, // this tells that the dropzone will not be clickable . we have to do it because v dont want the whole form to be clickable 
//        accept: function(file, done) {
//            console.log("uploaded");
//            done();
//        },
//        error: function(file, msg){
//            alert(msg);
//        },
//        init: function() {
//            var myDropzone = this;
//            //now we will submit the form when the button is clicked
//            $("#sbmtbtn").on('click',function(e) {
//               e.preventDefault();
//               myDropzone.processQueue(); // this will submit your form to the specified action path
//              // after this, your whole form will get submitted with all the inputs + your files and the php code will remain as usual 
//        //REMEMBER you DON'T have to call ajax or anything by yourself, dropzone will take care of that
//            });      
//        } // init end
//    };
////    $("fileUpload").dropzone({url: "/file/post"});
//    Dropzone.options.fileUpload2 = {
//    url: 'blackHole.php',
//    maxFiles: 5,
//    autoProcessQueue: false,
//    uploadMultiple: true,
//    addRemoveLinks:true,
//    accept: function(file) {
//        let fileReader = new FileReader();
//
//        fileReader.readAsDataURL(file);
//        fileReader.onloadend = function() {
//
//            let content = fileReader.result;
//            $('#file').val(content);
//        }
//    }
//}

</script>
