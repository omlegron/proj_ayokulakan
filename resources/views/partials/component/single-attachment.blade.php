<div class="panel-group">
	<div class="panel panel-default">
		<div class="panel-heading">
			<label class="unicase-checkout-title"><b><small>{!! isset($fileTitle) ? $fileTitle : '*Unggah Foto Copy Dokumen' !!}</b></small></label>
		</div>
		<div class="form-group">
			<input type="file" name="{{ isset($attName) ? $attName : '' }}" class="dropify" data-max-file-size="{{ isset($fileSize) ? $fileSize : '' }}" data-show-remove="false" data-allowed-file-extensions="{{ isset($fileType) ? $fileType : '' }}" {{ isset($disable) ? 'id="input-file-now-disabled-2" disabled="disabled"' : '' }} data-default-file="{{ isset($fileUrl) ? imgExist($fileUrl) : '' }}" />
		</div>
	</div>
</div>