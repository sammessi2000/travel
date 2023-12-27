<?php 
$title = $lang != 'vi' ? 'title_' . $lang : 'title'; 
$description = $lang != 'vi' ? 'description_' . $lang : 'description'; 
$content = $lang != 'vi' ? 'content_' . $lang : 'content'; 
?>

<form action="" method="post" class="form-horizontal form-main">
<div id="main">
<div class="container-fluid">
<?php echo $this->Admin->admin_head('Sửa bài viết'); ?>
<?php echo $this->Admin->admin_breadcrumb('Sửa bài viết'); ?>

<?php echo $this->Session->flash(); ?>

<?php if($multiple_lang == true) : ?>
    <div class="lang">
        <a href="<?php echo $url_here; ?>?lang=vi" <?php if($lang == 'vi') echo 'class="active"'; ?>><i class="icon icon-vi"></i> Tiếng Việt</a>
        <a href="<?php echo $url_here; ?>?lang=en" <?php if($lang == 'en') echo 'class="active"'; ?>><i class="icon icon-en"></i> Tiếng Anh</a>
        <!--<a href="<?php echo $url_here; ?>?lang=jp" <?php if($lang == 'jp') echo 'class="active"'; ?>><i class="icon icon-en"></i> Tiếng Nhật</a>-->
        <!-- <a href="<?php echo $url_here; ?>?lang=cn" <?php if($lang == 'cn') echo 'class="active"'; ?>><i class="icon icon-en"></i> Tiếng Trung</a> -->
        <!--<a href="<?php echo $url_here; ?>?lang=kr" <?php if($lang == 'kr') echo 'class="active"'; ?>><i class="icon icon-en"></i> Tiếng Hàn</a>-->
    </div>
<?php endif; ?>

<div class="box">
<div class="box-content">

            <div class="control-group">
                <label class="control-label">Tiêu đề </label>
                <div class="controls">
                    <?php echo $this->Form->hidden('Node.title'); ?>
                    <?php echo $this->Form->input('Node.' . $title, array('label' => false, 'div' => false, 'placeholder' => 'Tiêu đề bài viết', 'class' => 'span11 node_title', 'id' => 'node_title', 'maxlength' => '70', 'required')); ?>
                    <?php echo $this->Form->hidden('Node.id'); ?>
                    <div class="clearfix"></div>
                    <div class="msg" id="response_msg"></div>
                </div>
            </div>
            
        <div class="control-group">
            <label class="control-label">Slug </label>
            <div class="controls">
                <?php echo $this->Form->input('Node.slug', array('type'=>'text', 'div'=>false, 'label'=>false, 'class'=>'custome_slug span8')); ?>
                <span class="btn btn-warning change_slug">Cập nhật</span>
            </div>
        </div> 

<!--            <div class="control-group">
                <label class="control-label">Link tùy chỉnh</label>
                <div class="controls">
                    <?php echo $this->Form->input('Node.link', array('label' => false, 'div' => false, 'type' => 'text', 'class' => 'span11')); ?>
                </div>
            </div>-->
            
            <div class="control-group">
                <label class="control-label">Mục lục </label>
                <div class="controls">
                    <?php echo $this->Form->input('category_id', array('label' => false, 'div' => false, 'required', 'class' => 'span6', 'options' => $category_tree, 'selected' => $cat_selected, 'empty' => 'Chọn mục lục', 'multiple' => true, 'style'=>'height: 200px;')); ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Trạng thái </label>
                <div class="controls">
                    <?php echo $this->Form->input('Node.status', array('label' => false, 'div' => false, 'type' => 'select', 'class' => 'span3', 'options' => array('1' => 'Xuất bản', '0' => 'Tạm lưu'))); ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Ngày </label>
                <div class="controls">
                    <?php echo $this->Form->input('Node.created', array('label' => false, 'type'=>'text', 'required', 'div' => false, 'class' => 'span3 dated', 'value'=>date('Y-m-d', $this->data['Node']['created']))); ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Thumbnail </label>
                <div class="controls">
                    <div class="thumbnail-preview thumbnail image"></div>
                    <?php echo $this->Form->input('News.image', array('label' => false, 'div' => false, 'class' => 'span6 image_preview', 'id' => 'thumbnail', 'required')); ?>
                    <input type="button" class="btn btn-info" onclick="file_manager('thumbnail');" value="Chọn ảnh">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Tóm tắt </label>
                <div class="controls">
                    <?php
                    echo $this->Form->input('News.'.$description, array('type' => 'textarea', 'div' => false, 'label' => false, 'class' => 'span11 news_description', 'rows' => 3, 'cols' => false, 'required'));
                    ?>
                </div>
            </div> 

            <div class="control-group">
                <label class="control-label">Nội dung </label>
                <div class="span9 news_content_ckeditor">
                    <?php
                    $CKEditor = new CKEditor();
                    $CKEditor->config['width'] = '740';
                    $CKEditor->config['height'] = '180';
                    CKFinder::SetupCKEditor($CKEditor);

                    $initialValue = $this->data['News'][$content];
                    echo $CKEditor->editor("data[News][".$content."]", $initialValue, "extra");
                    ?>
                </div>
            </div> 

             <div class="control-group">
                <label class="control-label">Tags </label>
                <div class="controls">
                    <?php
                    $str_tag = "";
                    if(is_array($data_tags) && count($data_tags) > 0)
                    {
                        foreach($data_tags as $v)
                            $str_tag .= $v['Node']['title'] . ', ';
                    }

                    $str_tag = trim($str_tag, ', ');
                    echo $this->Form->input('News.tags', array('type' => 'textarea', 'div' => false, 'label' => false, 'class' => 'span11', 'rows' => 3, 'cols' => false, 'value'=>$str_tag));
                    ?>
                </div>
            </div>  
            
            <div class="control-group">
                <label class="control-label">SEO Title </label>
                <div class="controls">
                    <?php echo $this->Form->input('News.seo_title', array('type'=>'text', 'div'=>false, 'label'=>false, 'class'=>'span10')); ?>
                </div>
            </div> 

            <div class="control-group">
                <label class="control-label">SEO Keywords</label>
                <div class="controls">
                    <?php echo $this->Form->input('News.seo_keyword', array('type' => 'text', 'maxlength' => 120, 'div' => false, 'label' => false, 'class' => 'span11 news_keyword')); ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">SEO Description</label>
                <div class="controls">
                    <?php echo $this->Form->input('News.seo_description', array('type' => 'textarea', 'maxlength' => 120, 'div' => false, 'label' => false, 'class' => 'span9 news_description', 'rows' => 2)); ?>
                </div>
            </div>

        <!--     <div class="control-group">
                <label class="control-label">Focus Keywords</label>
                <div class="controls">
                    <?php echo $this->Form->input('News.focus_keyword', array('type' => 'text', 'maxlength' => 120, 'div' => false, 'label' => false, 'class' => 'span3 forcus_key')); ?>
                    <span class="SeoStatus">
                        <span>Thông tin chuẩn SEO : </span>
                        <span class="SeoStatusTitle">Tiêu đề</span>,
                        <span class="SeoStatusDescription  text-center">Mô tả</span>,
                        <span class="SeoStatusContent  text-center">Nội dung</span>
                    </span>
                </div>
            </div> -->

            <div class="control-group">
                <label class="control-label">&nbsp;</label>
                <div class="controls">
                    <input type="submit" name="submit" value="Hoàn tất" class="btn btn-primary" />
                    <input type="reset" name="reset" value="Làm lại" class="btn" />
                </div>
            </div>
            
             

    </div>
    </div>
</div>

</div>
</div>
    </form>

<script type="text/javascript">
    $('.change_slug').click(function() {
        var name = $('.node_title').val();
        $.ajax({
            url: "<?php echo DOMAINAD; ?>admin_node/get_slug/?t=" + name,
            type: 'GET',
            dataType: 'html',
            cache: false,
            success: function(data) {
                $('.custome_slug').val(data);
            },
            error: function() {}
        });
    });
    $('.dated').datepicker({format: 'yyyy-mm-dd'});

    // check();
    // $('.forcus_key').keyup(function () {
    //     check();
    // });

    function check()
    {
        // var v = $('.forcus_key').val();
        // var arr = new Array();
        // arr = v.split(' ');
        // if (arr.length < 2)
        //     return false;

        // var title = $('.node_title').val();
        // var des = $('.news_description').val();
        // var content = CKEDITOR.instances["data[News][content]"].getData();

        // if (searchText(v, title) == 1)
        //     $('.SeoStatusTitle').addClass('valid-seo');
        // else
        //     $('.SeoStatusTitle').removeClass('valid-seo');


        // if (searchText(v, des) == 1)
        //     $('.SeoStatusDescription').addClass('valid-seo');
        // else
        //     $('.SeoStatusDescription').removeClass('valid-seo');


        // if (searchText(v, content) == 1)
        //     $('.SeoStatusContent').addClass('valid-seo');
        // else
        //     $('.SeoStatusContent').removeClass('valid-seo');
    }

    function searchText(key, text)
    {
        if (key.length <= 0 || text.length <= 0)
            return 0;

        var regExp = new RegExp(key, 'i');

        if (regExp.test(text))
        {
            return 1;
        }

        return 0;
    }

    //Kiểm tra độ dài text
    $('.node_title').maxlength({
        alwaysShow: true,
        threshold: 10,
        warningClass: "label label-info",
        limitReachedClass: "label label-warning",
        placement: 'top',
        message: 'Đã dùng %charsTyped% / %charsTotal% ký tự.'
    });

    $('.news_keyword').maxlength({
        alwaysShow: true,
        threshold: 10,
        warningClass: "label label-info",
        limitReachedClass: "label label-warning",
        placement: 'top',
        message: 'Đã dùng %charsTyped% / %charsTotal% ký tự.'
    });


    //Kiểm tra trùng lặp tiêu đề
    var is_sendding_request = false;

    setInterval(function() {
        check();
        if (is_sendding_request == false)
        {
            var v = $('.node_title').val();
            var n = v.length;
            var url = "<?php echo DOMAINAD; ?>admin_node/check_exits_news/" + v + "/" + <?php echo $this->data['Node']['id'] ?>;

            if (n >= 4)
            {
//            alert('data');
                is_sendding_request = true;
                $.ajax({
                    url: url,
                    cache: false,
                    dataType: "html",
                    success: function (data) {
                        if (data == "1")
                            $('#response_msg').html("<div style='color: red; font-weight: bold; margin-top: 15px;'>Tiêu đề đã tồn tại !!!</div>");
                        else
                            $('#response_msg').html("");
                        
                        is_sendding_request = false;
                    },
                    error: function () {
                        is_sendding_request = false;
                    }
                });
            }
            
            return false;
        }
    }, 3000);
</script>