<?php include_once "pages/ortam.php";?>
<div id="ajaxout"></div>
    <div class="clearfix"></div>
     <footer class="site-footer" style="display: none;">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Yönetim Paneli
                    </div>
                    <div class="col-sm-6 text-right">
                       Tüm Hakları Saklıdır
                    </div>
                </div>
            </div>
    </footer>
</div>
    <?php include_once "assets/icons.php";?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="https://kit.fontawesome.com/d3897fd5a7.js" crossorigin="anonymous"></script>
    <script src="<?php echo $ayar->panel;?>assets/js/picker/color-picker.min.js"></script>
    <script src="<?php echo $ayar->panel;?>assets/js/main.js?version=1"></script>
    <script src="<?php echo $ayar->panel;?>assets/sistem.js?version=1"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
<script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
<script>
    if ($('#editor').attr('id')) {
        
 CKEDITOR.replace('editor');
    }
</script>
</body>
</html>