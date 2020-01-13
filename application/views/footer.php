<?php
/**
 * Created by PhpStorm.
 * User: Rebecca
 * Date: 7/17/2019
 * Time: 10:44 PM
 */
?>
<!-- ================== Start Footer ============================ -->
<footer class="main-footer">
    <strong>AgroFarm Management System &copy; 2019</strong> All rights reserved.
</footer>
<!-- ================== End Footer ============================ -->

</div>
<!-- End Site Wrapper -->

<!-- Sweet Alert 3 -->
<script src="<?php echo base_url()?>assets/js/sweet_alert"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>assets/bower_components/chart.js/Chart.js"></script>
<!--Jquery Validator-->
<script src="<?php echo base_url()?>assets/js/jquery-validator.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- Base URL -->
<script>var base_url = '<?php echo site_url() ?>';</script>
<!-- Bootstrap Notify -->
<script src="<?php echo base_url()?>assets/js/bootstrap-notify.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Clock  -->
<script src="<?php echo base_url()?>assets/js/clock.js" type="text/javascript"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Full Calendar -->
<script src="<?php echo base_url()?>assets/bower_components/moment/moment.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/fullcalendar/dist/gcal.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/dist/js/demo.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree();
    })

    $(function () {
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            changeMonth: true,
            changeYear: true,
            todayHighlight: true,
            orientation: 'bottom left',
        })
    });
</script>
<script>
    $(function () {
        $('.data_tables').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "pageLength"  : 10,
        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
			editable: false,
			header: {
				left: 'prev,today,next',
				center: 'title',
				right: 'month,agendaWeek,agendaDay',
			},
			events: "<?php echo base_url(); ?>delivery/calendar/load_events",
			selecttable: false,
		})
    });
</script>
<script>
    // jquery validate plugin
    $.validate();

    $(function () {
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
</script>
</body>
</html>

