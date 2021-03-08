$().ready(function () {
	CKEDITOR.replace('content', {
		toolbar: [{
				name: 'document',
				groups: ['mode', 'document', 'doctools'],
				items: ['Source']
			},
			{
				name: 'clipboard',
				groups: ['clipboard', 'undo'],
				items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
			},
			{
				name: 'insert',
				items: ['Image']
			},
			//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
			//{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
			{
				name: 'basicstyles',
				groups: ['basicstyles', 'cleanup'],
				items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
			},
			{
				name: 'paragraph',
				groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
				items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
			},
			{
				name: 'links',
				items: ['Link', 'Unlink', 'Anchor']
			},
			{
				name: 'styles',
				items: ['Styles', 'Format', 'Font', 'FontSize']
			},
			{
				name: 'colors',
				items: ['TextColor', 'BGColor']
			},
			{
				name: 'tools',
				items: ['Maximize', 'ShowBlocks']
			},
			{
				name: 'others',
				items: ['-']
			},
			//{ name: 'about', items: [ 'About' ] }
		]
	});


	for (instance in CKEDITOR.instances) {
		//CKEDITOR.instances[instance].updateElement();
		$("#content").val(CKEDITOR.instances[instance].getData());
	}
});
