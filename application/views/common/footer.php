</div>
<!-- /.content-wrapper ends -->
<div id="snackbar"></div>
<footer class="page-footer font-small blue">

  	<!-- Copyright -->
  	<div class="footer-copyright text-center py-3">
  		© 2021 Copyright:
  		<a href="javascript:void(0);">HyperText Dev</a>
  	</div>
  	<!-- Copyright -->

</footer>

<script src="<?= base_url('assets/js/generic.js');?>"></script>

<?php 
$arr = isset($jsArr) ? $jsArr : [];
foreach ($arr as $key => $value) { ?>
		<script src="<?= $value ?>"></script>
<?php }?>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="<?= base_url('assets/js/dropdown/hierarchy-select.min.js');?>"></script>
<script src="<?= base_url('assets/js/Chart.min.js');?>"></script>
<script src="<?= base_url('assets/js/sb-admin-2.min.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</body>