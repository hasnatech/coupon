		<div class="space-50"></div>
		<div class="container">
			<footer class="main-footer">
				<div class="container1">
					<?php $config = get_config(); ?>
					<div class="d-flex">

						<div class="flex-fill">
							<strong>Copyright &copy; <?php echo date('Y'); ?>.</strong> All rights reserved.
							<!-- <?php echo $config['powered']; ?> -->
						</div>
						<div class="hidden-xs">
							<b>Version</b> <?php echo $config['version']; ?>
						</div>
					</div>
				</div>

			</footer>
			</div>
		</div>
	</div>
</div>
<div id="assetModal" class="modal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Assets Window
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="assetframe" src="<?= base_url('asset') ?>" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
    </div>
<script>
        $().ready(function(){
            $("#asset").click(function(){
                $('#assetModal').modal('show');
            });
        })
    </script>
</body>
</html>
