
        <!--footer section start-->
        <footer>
           <?php echo $sitename; ?>
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>


<!-- Placed js at the end of the document so the pages load faster -->

<script src="<?php echo getResource('js/jquery-ui-1.9.2.custom.min.js') ?>"></script>
<script src="<?php echo getResource('js/jquery-migrate-1.2.1.min.js') ?>"></script>
<script src="<?php echo getResource('js/bootstrap.min.js') ?>"></script>
<script src="<?php echo getResource('js/bootstrap-formhelpers.js') ?>"></script>
<script src="<?php echo getResource('js/modernizr.min.js') ?>"></script>
<script src="<?php echo getResource('js/jquery.nicescroll.js') ?>"></script>
<script src="<?php echo getResource('js/gallery.js') ?>"></script>

<script src="<?php echo getResource('js/advanced-datatable/js/jquery.dataTables.js') ?>"></script>
<script src="<?php echo getResource('js/data-tables/DT_bootstrap.js') ?>"></script>

<?= $page_level_scripts?>

<script src="<?php echo getResource('js/easypiechart/jquery.easypiechart.js') ?>"></script>
<script src="<?php echo getResource('js/easypiechart/easypiechart-init.js') ?>"></script>
<script src="<?php echo getResource('js/sparkline/jquery.sparkline.js') ?>"></script>
<script src="<?php echo getResource('js/sparkline/sparkline-init.js') ?>"></script>
<script src="<?php echo getResource('js/flot-chart/jquery.flot.js') ?>"></script>
<script src="<?php echo getResource('js/flot-chart/jquery.flot.tooltip.js') ?>"></script>
<script src="<?php echo getResource('js/morris-chart/raphael-min.js') ?>"></script>
<script src="<?php echo getResource('js/calendar/clndr.js') ?>"></script>
<script src="<?php echo getResource('js/calendar/evnt.calendar.init.js') ?>"></script>
<script src="<?php echo getResource('js/dashboard-chart-init.js') ?>"></script>
<script src="<?php echo getResource('js/bootstrap-fileupload.min.js') ?>"></script>
<script src="<?php echo getResource('js/bootstrap-formhelpers.js') ?>"></script>


<script src="<?php echo getResource('js/custom_scripts.js') ?>"></script>



<script src="<?php echo getResource('js/scripts.js') ?>"></script>
            <script>
                $(document).ready(function(){
                    $('[data-toggle="tooltip"]').tooltip();
                });
            </script>
<script type ="text/javascript">
$(function() {
    $("#uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>
            <script>
                $(document).ready(function(){
                    $('[data-toggle="tooltip"]').tooltip();
                });
            </script>
<script type="text/javascript">
    function PrintDiv(){
        var old_data = document.body.innerHTML;
        var print_data = document.getElementById('printArea');

        newWin= window.open("");
        newWin.document.write(print_data.outerHTML);
        newWin.print();
        newWin.close();

    }
</script>



</body>
</html>
