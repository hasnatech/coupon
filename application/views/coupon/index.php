<div class="container">
	<div class="float-end">
		<a id="export" href="<?php echo base_url('coupon/export') ?>" class="btn btn-success">Export</a> &nbsp;
		<a id="import_btn" href="<?php echo base_url('coupon/import') ?>" class="btn btn-secondary">
			Import
			<div id="spinner" class="spinner-border spinner-border-sm hidden" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</a>
		<input type="file" class="hidden" name="import" id="import" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
	</div>
	<h2>Manage Coupon</h2>
	<a href="<?php echo base_url('coupon/add') ?>" class="btn btn-primary">New Coupon</a>
	<br><br>
	<?php if($this->session->flashdata('success')){ ?>
	<div class="alert alert-success">
		<strong><span class="glyphicon glyphicon-ok"></span>
			<?php echo $this->session->flashdata('success'); ?></strong>
	</div>
	<?php } ?>

	<?php if(!empty($coupons)) {?>
	<table id="datatable" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>SL No</th>
				<th>Code</th>
				<th>Price</th>
				<th>Issued</th>
				<th>Issued Date</th>
				<th>Actions</th>
			</tr>
		</thead>
	</table>
	<?php } else {?>
	<div class="alert alert-info" role="alert">
		<strong>No Coupons Found!</strong>
	</div>
	<?php } ?>

	<div id="myModal" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Import Result</h5>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
			</div>
			<div class="modal-body">
				<div class="scrollable">
				<div id="result">
				</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>

	<script>
		$().ready(function (){

	
		var table = $('#datatable').DataTable({
			"language": {                
            	"infoFiltered": ""
        	},
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo base_url('coupon/fetch') ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0,1,2,3,4,5],
				"orderable": false
			}]

		});

		$("#export").click(function(e){
			e.preventDefault();
			var form = $('<form></form>');
			form.attr("method", "post");
			form.attr("action", "<?php echo base_url('coupon/export') ?>");
			var parameters = table.page.info();
			var search = $("#datatable_wrapper input[type='search']").val();
			if(search != ''){
				parameters.search = search;
			}
			$.each(parameters, function(key, value) {
				var field = $('<input></input>');

				field.attr("type", "hidden");
				field.attr("name", key);
				field.attr("value", value);

				form.append(field);
			});
			$(document.body).append(form);
			form.submit();
		});


		$("#import_btn").click(function(e){
			e.preventDefault();
			$("#import").click();
			$('#import').change(function() {
				$("#spinner").removeClass("hidden");
				var data = new FormData();
				data.append('import',  $(this)[0].files[0]);
			
				$("#close").click(function(){
					location.reload();
				})

				$.ajax({
					url: '<?php echo base_url('coupon/import') ?>',
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					method: 'POST',
					success: function(data){
						console.log(data);
						$("#result").text("");
						for (let i = 0; i < data.length; i++) {
							$("#result").append("<p>" + data[i] + "</p>");	
						}
						$("#myModal").show()
						$("#spinner").addClass("hidden");
					},
					uploadProgress: function(event, position, total, percentComplete) {
						var percentVal = percentComplete + '%';
						console.log(percentVal);
						//bar.width(percentVal);
						//percent.html(percentVal);
					}
				});
			});
		});
	});
	</script>
</div>
